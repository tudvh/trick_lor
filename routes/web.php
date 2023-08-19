<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site;

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

Route::get('/', [Site\HomeController::class, 'home'])->name('site.home');
Route::get('/post/{postSlug}', [Site\HomeController::class, 'post'])->name('site.post');

Route::get('/test-editor', [Site\HomeController::class, 'testEditor']);
