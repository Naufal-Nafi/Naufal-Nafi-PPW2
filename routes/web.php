<?php

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

Route::get('/home', function () {
    return view('home');
});


Route::get('/about', function () {
    return view('about', [
        'name' => 'Darwin Nunez',
        'email' => 'elmarmutdeuruguay@gmail.com'
    ]);
});





Route::get('/home2', function () {
    return view('home2');
});

Route::get('/about2', function () {
    return view('about2');
});

Route::get('/contact', function () {
    return view('contact');
});