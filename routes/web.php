<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/layout', function () {
    return view('layout');
});

// Route::get('/home', function () {
//     return view('home');
// });


// Route::get('/about', function () {
//     return view('about', [
//         'name' => 'Darwin Nunez',
//         'email' => 'elmarmutdeuruguay@gmail.com'
//     ]);
// });





Route::get('/home2', function () {
    return view('home2');
});

Route::get('/about2', function () {
    return view('about2');
});

Route::get('/contact', function () {
    return view('contact');
});


Route::get('/posts', [PostController::class, 'index']);



Route::get('/home', [HomeController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);



