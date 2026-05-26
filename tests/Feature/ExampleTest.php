<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_admin_dashboard_route_is_registered(): void
    {
        $this->assertSame(url('/admin'), route('admin.dashboard'));
    }

    public function test_the_admin_header_renders_static_notifications_ui(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $content = $response->getContent();

        $response
            ->assertOk()
            ->assertSee('adminNotificationsModal')
            ->assertSee('adminNotificationsMobileModal')
            ->assertSee(__('components/notifications-ui.actions.view_all'))
            ->assertSee(__('components/notifications-ui.examples.order.title'))
            ->assertSee(__('components/notifications-ui.modal.description'));

        $this->assertSame(1, substr_count($content, 'id="adminNotificationsModal"'));
        $this->assertSame(1, substr_count($content, 'id="adminNotificationsMobileModal"'));
    }
}
