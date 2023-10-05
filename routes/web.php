<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site;
use App\Http\Controllers\Admin;


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
    Route::get('/login', [Admin\AuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [Admin\AuthController::class, 'handleLogin'])->name('admin.login');
    Route::get('/logout', [Admin\AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/', [Admin\HomeController::class, 'dashboard'])->name('admin.dashboard');

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
    Route::get('/language/{language}', [Site\HomeController::class, 'language'])->name('site.language');
});
