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
    Route::get('/', [Admin\HomeController::class, 'dashboard'])->name('admin.dashboard');

    // Auth
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/login', [Admin\AuthController::class, 'login'])->name('admin.auth.login');
        Route::post('/login', [Admin\AuthController::class, 'handleLogin'])->name('admin.auth.handle-login');
        Route::get('/logout', [Admin\AuthController::class, 'logout'])->name('admin.auth.logout');
    });

    // Category
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [Admin\CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('/create', [Admin\CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/', [Admin\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/{category}/edit', [Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/{category}', [Admin\CategoryController::class, 'update'])->name('admin.categories.update');
    });

    // Post
    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [Admin\PostController::class, 'index'])->name('admin.posts.index');
    });

    // User
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [Admin\UserController::class, 'index'])->name('admin.users.index');
    });

    // Comment
    Route::group(['prefix' => 'comments'], function () {
        Route::get('/', [Admin\CommentController::class, 'index'])->name('admin.comments.index');
    });
});

// Site
Route::group(['prefix' => ''], function () {
    Route::get('/', [Site\HomeController::class, 'home'])->name('site.home');
    Route::get('/search', [Site\HomeController::class, 'search'])->name('site.search');
    Route::get('/trending', [Site\HomeController::class, 'trending'])->name('site.trending');
    Route::get('/post/{post}', [Site\HomeController::class, 'post'])->name('site.post');
    Route::get('/category/{category}', [Site\HomeController::class, 'category'])->name('site.category');
    Route::get('/@{username}', [Site\HomeController::class, 'profile'])->name('site.profile');

    // Activity
    Route::group(['prefix' => 'activities'], function () {
        Route::get('/view', [Site\ActivityController::class, 'view'])->name('site.activities.view');
        Route::get('/save', [Site\ActivityController::class, 'save'])->name('site.activities.save');
    });

    // Auth
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/verify-email', [Site\AuthController::class, 'verifyEmail'])->name('site.auth.verify-email');
        Route::get('/personal', [Site\AuthController::class, 'personal'])->name('site.auth.personal');
        Route::get('/logout', [Site\AuthController::class, 'logout'])->name('site.auth.logout');
        Route::post('/change-password', [Site\AuthController::class, 'changePassword'])->name('site.auth.change-password');
        Route::get('/reset-password', [Site\AuthController::class, 'resetPassword'])->name('site.auth.reset-password');
        Route::post('/reset-password', [Site\AuthController::class, 'handleResetPassword'])->name('site.auth.handle-reset-password');

        // Google
        Route::get('/google', [Site\GoogleController::class, 'redirectToGoogle']);
        Route::get('/google/callback', [Site\GoogleController::class, 'handleGoogleCallback']);
    });

    // Post
    Route::group(['prefix' => 'my-posts'], function () {
        Route::get('/', [Site\PostController::class, 'index'])->name('site.my-posts.index');
        Route::get('/new', [Site\PostController::class, 'create'])->name('site.my-posts.create');
        Route::get('/{post}/edit', [Site\PostController::class, 'edit'])->name('site.my-posts.edit');
    });
});
