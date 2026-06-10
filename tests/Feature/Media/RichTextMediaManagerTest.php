<?php

namespace Tests\Feature\Media;

use App\Services\Media\RichTextMediaManager;
use Carbon\Carbon;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RichTextMediaManagerTest extends TestCase
{
    use RefreshDatabase;

    private string $diskRoot;

    protected function setUp(): void
    {
        parent::setUp();

        $this->diskRoot = sys_get_temp_dir().DIRECTORY_SEPARATOR.'simple-dashboard-rich-text-test';

        $filesystem = new Filesystem();
        $filesystem->deleteDirectory($this->diskRoot);
        $filesystem->makeDirectory($this->diskRoot, 0755, true);

        config()->set('filesystems.disks.rich-text-test', [
            'driver' => 'local',
            'root' => $this->diskRoot,
            'url' => '/storage/rich-text-test',
        ]);

        Storage::forgetDisk('rich-text-test');
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow();
        Storage::forgetDisk('rich-text-test');

        if (isset($this->diskRoot)) {
            (new Filesystem())->deleteDirectory($this->diskRoot);
        }

        parent::tearDown();
    }

    public function test_upload_endpoint_returns_generic_editor_response(): void
    {
        Carbon::setTestNow('2026-06-09 12:00:00');

        $this->postJson(route('admin.rich-text-media.uploads.store'), [
            'file' => UploadedFile::fake()->image('Inline Image.jpg', 20, 20),
            'disk' => 'rich-text-test',
            'mode' => 'temporary',
            'temporary_key' => 'draft-123',
        ])
            ->assertOk()
            ->assertJsonPath('path', 'temp/draft-123/inline-image-20260609120000.jpg')
            ->assertJsonStructure(['url', 'location', 'path']);

        Storage::disk('rich-text-test')
            ->assertExists('temp/draft-123/inline-image-20260609120000.jpg');
    }

    public function test_manager_commits_temporary_images_and_syncs_owner_folder(): void
    {
        Carbon::setTestNow('2026-06-09 12:00:00');

        $manager = app(RichTextMediaManager::class);
        $uploaded = $manager->uploadTemporaryImage(
            UploadedFile::fake()->image('Inline Image.jpg', 20, 20),
            'rich-text-test',
            'draft-123'
        );

        $html = '<p><img src="'.$uploaded['url'].'" alt=""></p>';
        $committedHtml = $manager->commitTemporaryImages('rich-text-test', 'draft-123', 15, $html);

        Storage::disk('rich-text-test')
            ->assertMissing('temp/draft-123/inline-image-20260609120000.jpg');

        Storage::disk('rich-text-test')
            ->assertExists('15/inline-image-20260609120000.jpg');

        $this->assertStringContainsString('15/inline-image-20260609120000.jpg', $committedHtml);
    }

    public function test_manager_removes_owner_images_not_referenced_in_html(): void
    {
        Storage::disk('rich-text-test')->put('15/keep.jpg', 'keep');
        Storage::disk('rich-text-test')->put('15/remove.jpg', 'remove');

        $html = '<p><img src="/storage/rich-text-test/15/keep.jpg" alt=""></p>';

        app(RichTextMediaManager::class)->syncOwnerImages('rich-text-test', 15, $html);

        Storage::disk('rich-text-test')->assertExists('15/keep.jpg');
        Storage::disk('rich-text-test')->assertMissing('15/remove.jpg');
    }
}
