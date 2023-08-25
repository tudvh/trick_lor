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


Route::get('/test-editor', [Site\HomeController::class, 'testEditor']);
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [Admin\HomeController::class, 'dashboard'])->name('admin.dashboard');

    Route::group(['prefix' => 'posts'], function () {
        Route::get('/', [Admin\PostsController::class, 'index'])->name('admin.posts.index');
        Route::get('/search', [Admin\PostsController::class, 'search'])->name('admin.posts.search');
        Route::get('/create', [Admin\PostsController::class, 'create'])->name('admin.posts.create');
        Route::get('/{post}/setStatus/', [Admin\PostsController::class, 'setStatus'])->name('admin.posts.setStatus');
    });
});


Route::get('/', [Site\HomeController::class, 'home'])->name('site.home');
Route::get('/post/{postSlug}', [Site\HomeController::class, 'post'])->name('site.post');
Route::get('/{language}', [Site\HomeController::class, 'language'])->name('site.language');
