<?php

namespace Tests\Feature\Visits;

use App\Visits\Contracts\CanBeVisited;
use App\Visits\Models\Visit;
use App\Visits\Traits\HasVisits;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class VisitsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Schema::create('visit_test_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();

        parent::tearDown();
    }

    public function test_visits_are_unique_per_visitor_and_interval(): void
    {
        Carbon::setTestNow('2026-05-25 10:00:00');

        $post = VisitTestPost::create(['title' => 'First post']);

        $visit = $post
            ->visit()
            ->withIp('127.0.0.1')
            ->withData(['source' => 'homepage'])
            ->dailyInterval();

        $sameVisit = $post
            ->visit()
            ->withIp('127.0.0.1')
            ->withData(['source' => 'other'])
            ->dailyInterval();

        $this->assertSame($visit->id, $sameVisit->id);
        $this->assertSame(1, Visit::count());
        $this->assertSame(['source' => 'homepage'], $visit->fresh()->data);
        $this->assertNotSame('127.0.0.1', $visit->visitor_hash);
        $this->assertSame(64, strlen($visit->visitor_hash));
    }

    public function test_popularity_scopes_order_models_by_visit_count(): void
    {
        Carbon::setTestNow('2026-05-25 10:00:00');

        $popular = VisitTestPost::create(['title' => 'Popular']);
        $quiet = VisitTestPost::create(['title' => 'Quiet']);

        $popular->visit()->withIp('127.0.0.1')->dailyInterval();
        $popular->visit()->withIp('127.0.0.2')->dailyInterval();
        $quiet->visit()->withIp('127.0.0.3')->dailyInterval();

        $result = VisitTestPost::query()->popularToday()->first();

        $this->assertTrue($popular->is($result));
        $this->assertSame(2, $result->visit_count_total);
    }

    public function test_previous_period_popularity_scopes_are_available(): void
    {
        $lastWeek = VisitTestPost::create(['title' => 'Last week']);
        $lastMonth = VisitTestPost::create(['title' => 'Last month']);
        $lastYear = VisitTestPost::create(['title' => 'Last year']);
        $current = VisitTestPost::create(['title' => 'Current']);

        Carbon::setTestNow('2026-05-20 10:00:00');
        $lastWeek->visit()->withIp('127.0.0.1')->dailyInterval();

        Carbon::setTestNow('2026-04-10 10:00:00');
        $lastMonth->visit()->withIp('127.0.0.2')->dailyInterval();

        Carbon::setTestNow('2025-10-10 10:00:00');
        $lastYear->visit()->withIp('127.0.0.3')->dailyInterval();

        Carbon::setTestNow('2026-05-25 10:00:00');
        $current->visit()->withIp('127.0.0.4')->dailyInterval();

        $this->assertTrue($lastWeek->is(VisitTestPost::query()->popularLastWeek()->first()));
        $this->assertTrue($lastMonth->is(VisitTestPost::query()->popularLastMonth()->first()));
        $this->assertTrue($lastYear->is(VisitTestPost::query()->popularLastYear()->first()));
    }
}

class VisitTestPost extends Model implements CanBeVisited
{
    use HasVisits;

    public $timestamps = false;

    protected $table = 'visit_test_posts';

    protected $guarded = [];
}
