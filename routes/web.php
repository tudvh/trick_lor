<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site;
use App\Http\Controllers\Admin;
use Livewire\Livewire;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Admin
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [Admin\HomeController::class, 'dashboard'])->name('admin.dashboard');

    // Personal
    Route::group(['prefix' => 'personal'], function () {
        Route::get('/', [Admin\AuthController::class, 'personal'])->name('admin.personal');
        Route::put('/update', [Admin\AuthController::class, 'updatePersonal'])->name('admin.personal.update');
    });

    // Auth
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/login', [Admin\AuthController::class, 'login'])->name('admin.auth.login');
        Route::post('/login', [Admin\AuthController::class, 'handleLogin'])->name('admin.auth.login');
        Route::get('/logout', [Admin\AuthController::class, 'logout'])->name('admin.auth.logout');
        Route::post('/change-password', [Admin\AuthController::class, 'changePassword'])->name('admin.auth.change-password');
    });

    // Post
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [Admin\PostController::class, 'index'])->name('admin.posts.index');
        Route::get('/create', [Admin\PostController::class, 'create'])->name('admin.posts.create');
        Route::post('/', [Admin\PostController::class, 'store'])->name('admin.posts.store');
        Route::get('/filter', [Admin\PostController::class, 'filter'])->name('admin.posts.filter');
        Route::post('/preview', [Admin\PostController::class, 'preview'])->name('admin.posts.preview');
        Route::get('/{post}', [Admin\PostController::class, 'show'])->name('admin.posts.show');
        Route::get('/{post}/edit', [Admin\PostController::class, 'edit'])->name('admin.posts.edit');
        Route::put('/{post}', [Admin\PostController::class, 'update'])->name('admin.posts.update');
        Route::delete('/{post}', [Admin\PostController::class, 'destroy'])->name('admin.posts.destroy');
        Route::get('/{post}/toggle-status', [Admin\PostController::class, 'toggleStatus'])->name('admin.posts.toggle-status');
    });

    // Category
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [Admin\CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [Admin\CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [Admin\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{category}/edit', [Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{category}', [Admin\CategoryController::class, 'update'])->name('admin.categories.update');
    });
});

// Site
Route::group(['prefix' => ''], function () {
    Route::get('/', [Site\HomeController::class, 'home'])->name('site.home');
    Route::get('/search', [Site\HomeController::class, 'search'])->name('site.search');
    Route::get('/trending', [Site\HomeController::class, 'trending'])->name('site.trending');
    Route::get('/post/{post}', [Site\HomeController::class, 'post'])->name('site.post');
    Route::get('/category/{category}', [Site\HomeController::class, 'category'])->name('site.category');

    // Activity
    Route::group(['prefix' => 'activities'], function () {
        Route::get('/view', [Site\ActivityController::class, 'view'])->name('site.activities.view');
        Route::get('/save', [Site\ActivityController::class, 'save'])->name('site.activities.save');
        Route::get('/comment', [Site\ActivityController::class, 'comment'])->name('site.activities.comment');
    });

    // Personal
    Route::group(['prefix' => 'personal'], function () {
        Route::get('/', [Site\UserController::class, 'personal'])->name('site.personal');
        Route::put('/update', [Site\UserController::class, 'updatePersonal'])->name('site.personal.update');
    });

    // Auth
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/login', [Site\AuthController::class, 'handleLogin']);
        Route::post('/register', [Site\AuthController::class, 'handleRegister']);
        Route::get('/logout', [Site\AuthController::class, 'logout'])->name('site.auth.logout');
        Route::post('/change-password', [Site\AuthController::class, 'changePassword'])->name('site.auth.change-password');
        Route::post('/forgot', [Site\AuthController::class, 'forgot'])->name('site.auth.forgot');
        Route::get('/reset-password', [Site\AuthController::class, 'resetPassword'])->name('site.auth.reset-password');
        Route::post('/reset-password', [Site\AuthController::class, 'handleResetPassword'])->name('site.auth.reset-password');

        // Google
        Route::get('/google', [Site\GoogleController::class, 'redirectToGoogle']);
        Route::get('/google/callback', [Site\GoogleController::class, 'handleGoogleCallback']);
    });
});

// Livewire
Livewire::setScriptRoute(function ($handle) {
    return Route::get(env('APP_URL') . '/vendor/livewire/livewire/dist/livewire.js', $handle);
});

Livewire::setUpdateRoute(function ($handle) {
    return Route::post(env('APP_URL') . '/livewire/update', $handle);
});
