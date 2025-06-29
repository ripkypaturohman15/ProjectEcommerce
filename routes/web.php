<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController as UserLoginController;
use App\Http\Controllers\Auth\RegisterController as UserRegisterController;
use App\Http\Controllers\Auth\AuthenticatedSessionController as UserAuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController as UserOrderController;

use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController as AdminAuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

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

// --- Routes untuk Umum / User ---

// Halaman utama dan detail produk (bisa diakses siapa saja)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products/{product:slug}', [HomeController::class, 'show'])->name('products.show');

// Autentikasi User (hanya bisa diakses jika belum login)
Route::middleware('guest:web')->group(function () {
    Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserLoginController::class, 'login']);
    Route::get('/register', [UserRegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [UserRegisterController::class, 'register']);
});

// Logout User (membutuhkan login)
Route::post('/logout', [UserAuthenticatedSessionController::class, 'destroy'])->name('logout')
    ->middleware('auth:web');


// Keranjang Belanja (bisa diakses siapa saja, data keranjang di session)
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add/{product}', [CartController::class, 'addToCart'])->name('add');
    Route::post('/update/{product}', [CartController::class, 'updateCart'])->name('update');
    Route::delete('/remove/{product}', [CartController::class, 'removeFromCart'])->name('remove');
});

// Checkout & Pesanan (Membutuhkan autentikasi User)
Route::middleware(['auth:web'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
    Route::get('/orders', [UserOrderController::class, 'history'])->name('orders.history');
    Route::get('/orders/{order}', [UserOrderController::class, 'show'])->name('orders.show');
});


// --- Routes untuk Admin ---
Route::prefix('admin')->name('admin.')->group(function () {
    // Autentikasi Admin (hanya bisa diakses jika belum login admin)
    Route::middleware('guest:admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [AdminLoginController::class, 'login']);
    });

    // Logout Admin (membutuhkan login admin)
    Route::post('/logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('logout')
        ->middleware('auth:admin');

    // Dashboard dan Manajemen Admin (Membutuhkan autentikasi Admin)
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Manajemen Kategori (CRUD)
        Route::resource('categories', AdminCategoryController::class);

        // Manajemen Produk (CRUD)
        Route::resource('products', AdminProductController::class);

        // Manajemen Pesanan
        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');
    });
});