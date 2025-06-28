<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Response;
use Mews\Captcha\Facades\Captcha;
use App\Http\Controllers\UserBookController;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest routes
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('welcome');
});

// Authentication routes - Satu halaman login untuk semua
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register hanya untuk user
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Protected routes
Route::middleware(['auth'])->group(function () {
    // Dashboard/Home
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // User only: Peminjaman
    Route::middleware('role:user')->group(function () {
        Route::resource('peminjaman', PeminjamanController::class)->except(['edit', 'update']);
        Route::get('/user/books', [UserBookController::class, 'index'])->name('user.books.index');
    });
});

// Admin routes - Tanpa route login terpisah
Route::prefix('admin')->group(function () {
    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/dashboard', function() {
            return view('admin.dashboard');
        })->name('admin.dashboard');
        Route::resource('books', BookController::class);
    });
});

// Route untuk refresh captcha
Route::get('/captcha/refresh', function () {
    return response()->json(['captcha'=> captcha_src('flat')]);
});

// Route untuk reload captcha
Route::get('/reload-captcha', function () {
    return response()->json(['captcha'=> captcha_img('flat')]);
});
