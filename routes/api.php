<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\ChapterApiController;
use App\Http\Controllers\ChoiceApiController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryApiController;
Route::prefix('v1')->group(function () {
    Route::get('/stories', [StoryApiController::class, 'getstories']);
    Route::get('stories/{id}', [
        StoryApiController::class,
        'getStory',
    ]);
    Route::get('stories/{id}/chapters', [
        StoryApiController::class,
        'getStoryChapters',
    ]);
    Route::get('chapters', [ChapterApiController::class, 'getChapters']);
    Route::get('chapters/{id}', [
        ChapterApiController::class,
        'getChapter',
    ]);
    Route::get('chapters/{id}/choices', [
        ChapterApiController::class,
        'getChapterChoices',
    ]);
    Route::get('choices', [ChoiceApiController::class, 'getChoices']);
    Route::get('choices/{id}', [
        ChoiceApiController::class,
        'getChoice',
    ]);
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('stories', [
            StoryApiController::class,
            'createStory',
        ]);
        Route::put('stories/{id}', [
            StoryApiController::class,
            'updateStory',
        ]);
        Route::delete('stories/{id}', [
            StoryApiController::class,
            'deleteStory',
        ]);
        Route::post('chapters', [
            ChapterApiController::class,
            'createChapter',
        ]);
        Route::put('chapters/{id}', [
            ChapterApiController::class,
            'updateChapter',
        ]);
        Route::delete('chapters/{id}', [
            ChapterApiController::class,
            'deleteChapter',
        ]);
        Route::post('choices', [
            ChoiceApiController::class,
            'createChoice',
        ]);
        Route::put('choices/{id}', [
            ChoiceApiController::class,
            'updateChoice',
        ]);
        Route::delete('choices/{id}', [
            ChoiceApiController::class,
            'deleteChoice',
        ]);
    });
});