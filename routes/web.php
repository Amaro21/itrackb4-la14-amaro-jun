<?php
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', [HomeController::class, 'index'])
->name('home');

Route::get('/teachers/featured', [TeacherController::class, 'featured'])
->name('teachers.featured');

Route::get('/register',  [RegisterController::class, 'create'])
->name('register');

Route::post('/register',  [RegisterController::class, 'store'])
->name('register.store');

Route::get('/login',   [LoginController::class, 'create'])
->name('signin');

Route::post('/login',  [LoginController::class, 'store'])
->name('login.store');

Route::post('/logout', [LoginController::class, 'destroy'])
->name('logout');

Route::resource('movies', MovieController::class)

->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'auth');

Route::resource('teachers', TeacherController::class)
->only(['index', 'show']);



