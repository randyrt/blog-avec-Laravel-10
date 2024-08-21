<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


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


/**
 * All_Routes of login and singin
 */
Route::get('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'register']);
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');



/** 
 * All_Routes of Post
 */
$slug = '[a-z\-]+';
Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/categories/{category}', [PostController::class, 'postByCategory'])->name('post.byCategory')->where(['slug' => $slug]);
Route::get('/tags/{tag}', [PostController::class, 'postByTag'])->name('post.byTag')->where(['slug' => $slug]);
Route::get('/{post}', [PostController::class, 'show'])->name('posts.show')->where(['slug' => $slug]);


