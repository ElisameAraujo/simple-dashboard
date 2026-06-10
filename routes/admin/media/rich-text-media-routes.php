<?php

use App\Http\Controllers\Admin\Media\RichTextMediaUploadController;
use Illuminate\Support\Facades\Route;

Route::prefix('/admin/media/rich-text')->group(function () {
    Route::post('/uploads', [RichTextMediaUploadController::class, 'store'])
        ->name('admin.rich-text-media.uploads.store');
});
