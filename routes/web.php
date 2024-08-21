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
 * All_Routes of login and register
 */
Route::prefix('/')->controller(\App\Http\Controllers\Auth\RegisterController::class)->group(function () {
  Route::get('register', 'showRegistrationForm')->name('register');
  Route::post('register', 'register');
});


/**
 * All_Route of authentification
 */
Route::prefix('/')->controller(\App\Http\Controllers\HomeController::class)->group(function () {
  Route::get('home', 'index')->name('home');
  Route::patch('home', 'updatePassword');
});

Route::prefix('/')->controller(\App\Http\Controllers\Auth\LoginController::class)->group(function () {
  Route::get('/login', 'showLoginForm')->name('login');
  Route::post('/login', 'login');
  Route::post('/logout', 'logout')->name('logout');
});



/** 
 * All_Routes of Post
 */
$slug = '[a-z\-]+';
Route::get('/', [PostController::class, 'index'])->name('index');
Route::get('/categories/{category}', [PostController::class, 'postByCategory'])->name('post.byCategory')->where(['slug' => $slug]);
Route::get('/tags/{tag}', [PostController::class, 'postByTag'])->name('post.byTag')->where(['slug' => $slug]);
Route::get('/{post}', [PostController::class, 'show'])->name('posts.show')->where(['slug' => $slug]);
Route::post('/{post}/comment', [PostController::class, 'comment'])->name('posts.comment')->where(['slug' => $slug]);


/**
 * Route_resource for admnistration
 */
Route::resource('/admin/posts', \App\Http\Controllers\AdminController::class)->except('show')->names('admin.posts');


