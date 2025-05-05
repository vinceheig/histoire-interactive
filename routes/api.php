<?php

use App\Http\Controllers\ChapterApiController;
use App\Http\Controllers\ChoiceApiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoryApiController;

Route::get('stories', [StoryApiController::class, 'getstories']);
Route::get('stories/{id}', [
	StoryApiController::class,
	'getStory',
]);
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

Route::get('chapters', [ChapterApiController::class, 'getChapters']);
Route::get('chapters/{id}', [
	ChapterApiController::class,
	'getChapter',
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

Route::get('choices', [ChoiceApiController::class, 'getChoices']);
Route::get('choices/{id}', [
	ChoiceApiController::class,
	'getChoice',
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