<?php

use App\Http\Controllers\Admin\Configs\MaintenanceController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin/configs/maintenance')->group(function () {
    Route::get('', [MaintenanceController::class, 'index'])
        ->name('admin.configs.maintenance');
});
