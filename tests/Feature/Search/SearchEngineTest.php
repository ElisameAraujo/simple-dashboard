<?php

namespace Tests\Feature\Search;

use App\Livewire\Admin\Search\SearchSpotlight;
use App\Models\User;
use App\Search\Exceptions\InvalidSearchConfigurationException;
use App\Search\SearchEngine;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Tests\TestCase;

class SearchEngineTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::get('/search-test/settings', fn () => 'Settings')
            ->name('search.test.settings');

        Route::get('/search-test/users/{user}', fn (User $user) => $user->name)
            ->name('search.test.users.show');

        Route::get('/search-test/users/{user}/edit', fn (User $user) => $user->name)
            ->name('search.test.users.edit');

        Route::getRoutes()->refreshNameLookups();
    }

    public function test_empty_admin_scope_returns_empty_collection(): void
    {
        $results = app(SearchEngine::class)->scope('admin')->preview();

        $this->assertCount(0, $results);
    }

    public function test_static_and_model_sources_can_be_searched_from_config(): void
    {
        $this->configureAdminSearch();

        $user = User::factory()->create([
            'name' => 'Maria Spotlight',
            'email' => 'maria@example.com',
        ]);

        User::factory()->create([
            'name' => 'Quiet Account',
            'email' => 'quiet@example.com',
        ]);

        $results = app(SearchEngine::class)
            ->scope('admin')
            ->search('spotlight');

        $this->assertTrue($results->contains(fn ($result): bool => $result->title === 'Maria Spotlight'));
        $this->assertTrue($results->contains(fn ($result): bool => $result->title === 'Search Settings'));

        $userResult = $results->first(fn ($result): bool => $result->title === 'Maria Spotlight');

        $this->assertSame(route('search.test.users.edit', ['user' => $user->id]), $userResult->url);
        $this->assertSame('edit', $userResult->clickAction);
        $this->assertSame('Visit', $userResult->actions[0]['label']);
    }

    public function test_invalid_configuration_stops_execution(): void
    {
        $this->configureAdminSearch([
            'models.users.fields_weight.unknown' => 100,
        ]);

        $this->expectException(InvalidSearchConfigurationException::class);
        $this->expectExceptionMessage('admin.models.users');

        app(SearchEngine::class)->scope('admin')->search('maria');
    }

    public function test_livewire_table_search_applies_configured_fields_to_builder(): void
    {
        config()->set('search.livewire_tables.users', [
            'model' => User::class,
            'searchable_fields' => ['name', 'email'],
            'fields_weight' => [
                'name' => 100,
                'email' => 40,
            ],
            'term_mode' => 'all',
            'match_mode' => 'partial',
        ]);

        $match = User::factory()->create([
            'name' => 'Joao Searchable',
            'email' => 'joao@example.com',
        ]);

        User::factory()->create([
            'name' => 'Hidden Account',
            'email' => 'hidden@example.com',
        ]);

        $results = app(SearchEngine::class)
            ->livewireTable('users')
            ->apply(User::query(), 'Searchable')
            ->get();

        $this->assertCount(1, $results);
        $this->assertTrue($match->is($results->first()));
    }

    public function test_spotlight_component_uses_custom_search_engine(): void
    {
        $this->configureAdminSearch();

        User::factory()->create([
            'name' => 'Panel Search',
            'email' => 'panel@example.com',
        ]);

        Livewire::test(SearchSpotlight::class)
            ->call('open')
            ->set('term', 'panel')
            ->assertSet('isOpen', true)
            ->assertSee('Panel Search')
            ->call('close')
            ->assertSet('isOpen', false)
            ->assertSet('term', '');
    }

    private function configureAdminSearch(array $overrides = []): void
    {
        $config = [
            'min_chars' => 2,
            'limit' => 10,
            'groups' => [
                'settings' => [
                    'label' => 'Settings',
                    'icon' => 'fa-solid fa-gear',
                    'order' => 10,
                ],
                'users' => [
                    'label' => 'Users',
                    'icon' => 'fa-solid fa-user',
                    'order' => 20,
                ],
            ],
            'statics' => [
                'search_settings' => [
                    'title' => 'Search Settings',
                    'summary' => 'Configure the admin spotlight.',
                    'group' => 'settings',
                    'route' => 'search.test.settings',
                    'keywords' => ['spotlight', 'settings'],
                ],
            ],
            'models' => [
                'users' => [
                    'model' => User::class,
                    'group' => 'users',
                    'title_field' => 'name',
                    'summary_field' => 'email',
                    'select_fields' => ['id', 'name', 'email', 'email_verified_at'],
                    'searchable_fields' => ['name', 'email'],
                    'fields_weight' => [
                        'name' => 100,
                        'email' => 40,
                    ],
                    'route' => 'search.test.users.show',
                    'route_fields' => [
                        'user' => 'id',
                    ],
                    'suggestions' => true,
                ],
            ],
            'actions' => [
                'users' => [
                    'show' => true,
                    'click' => 'edit',
                    'items' => [
                        'edit' => [
                            'label' => 'Edit',
                            'icon' => 'fa-solid fa-pen',
                            'route' => [
                                'name' => 'search.test.users.edit',
                                'parameters' => [
                                    'user' => 'id',
                                ],
                            ],
                        ],
                        'visit' => [
                            'label' => 'Visit',
                            'icon' => 'fa-solid fa-arrow-up-right-from-square',
                            'route' => [
                                'name' => 'search.test.users.show',
                                'parameters' => [
                                    'user' => 'id',
                                ],
                            ],
                            'visible_when' => [
                                [
                                    'field' => 'email_verified_at',
                                    'operator' => 'not_null',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($overrides as $key => $value) {
            data_set($config, $key, $value);
        }

        config()->set('search.scopes.admin', $config);
    }
}
