<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider
{
    public function register()
    {
        $helpers = config('helpers.global', []);

        foreach ($helpers as $helper) {
            if (class_exists($helper)) {
                class_alias($helper, class_basename($helper));
            }
        }
    }
}
