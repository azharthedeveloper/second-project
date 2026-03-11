<?php

use App\Http\Controllers\CacheDemoController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SessionDemoController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\TeacherController;
use App\Http\Middleware\IsactiveMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Route::prefix('/posts')->controller(PostController::class)->middleware(IsactiveMiddleware::class)->group(function () {
    Route::prefix('/posts')->controller(PostController::class)->middleware('isActive')->group(function () {
    // Route::get('/', 'getData');
    // Route::get('/add-data', 'addData');
    // Route::get('/update-data', 'updateData');
    // Route::get('/delete-data', 'deleteData');
    // Route::get('/first-method', 'firstMethod');
    // Route::get('/second-method', 'secondMethod');

    // Route::get('/', 'index')->name('posts-index')->middleware('auth');
    Route::get('/', 'index')->name('posts-index')->middleware('auth');
    Route::get('/create', 'create')->name('posts-create');
    Route::post('/store', 'store')->name('posts-store');
    Route::get('/edit/{id}', 'edit')->name('posts-edit');
    Route::put('/update/{id}', 'update')->name('posts-update');
    Route::delete('/delete/{id}', 'destroy')->name('posts-delete');
});

Route::get('student', [StudentController::class, 'index']);
Route::get('student-profile', [StudentProfileController::class, 'index']);
Route::get('teacher', [TeacherController::class, 'index']);
Route::get('classes', [ClassesController::class, 'index']);

Route::get('/session', [SessionDemoController::class, 'index'])->name('session.demo');
Route::get('/cache', [CacheDemoController::class, 'index'])->name('cache.demo');
