<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginRegisterController;
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
})->name('welcome');

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


Route::get('/posts', [PostController::class, 'index'])->name('posts');



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index']);
Route::get('/contact', [ContactController::class, 'index']);


// Autentikasi
Route::controller(LoginRegisterController::class)->group(function () {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::middleware('admin')->group(function () { // Gunakan middleware admin
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        // mulai buku
        Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::delete('/buku/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::put('/buku/{id}', [BukuController::class, 'update'])->name('buku.update');

        Route::resource('gallery', GalleryController::class);
    });
    Route::post('/logout', 'logout')->name('logout');
});

Route::get('restricted', function () {
    return redirect()->route('login')
        ->with('success', 'Anda berusia lebih dari 18 tahun!');
})->middleware('checkage');

