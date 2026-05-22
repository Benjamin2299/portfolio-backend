<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SkillController;
use App\Http\Controllers\Api\ExperienceController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CertificationController;

Route::prefix('v1')->group(function () {

    // Public routes
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{slug}', [ProjectController::class, 'show']);

    Route::get('/skills', [SkillController::class, 'index']);

    Route::get('/experiences', [ExperienceController::class, 'index']);

    Route::get('/posts', [PostController::class, 'index']);
    Route::get('/posts/{slug}', [PostController::class, 'show']);

    Route::get('/testimonials', [TestimonialController::class, 'index']);

    Route::get('/services', [ServiceController::class, 'index']);

    Route::get('/settings', [SettingController::class, 'index']);

    Route::get('/categories', [CategoryController::class, 'index']);

    Route::get('/certifications', [CertificationController::class, 'index']);

    Route::post('/messages', [MessageController::class, 'store']);

});