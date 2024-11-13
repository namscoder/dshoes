<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::prefix('admin')->middleware('checkrole')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin');
    //user
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::match(['GET', 'POST'], '/add/user', [UserController::class, 'store'])->name('add_user');
    Route::match(['GET', 'POST'], '/edit/user/{id}', [UserController::class, 'update'])->name('edit_user');
    Route::get('/delete/user/{id}', [UserController::class, 'destroy'])->name('delete_user');
//category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
    Route::match(['GET', 'POST'], '/add/category', [CategoryController::class, 'store'])->name('add_category');
    Route::match(['GET', 'POST'], '/edit/category/{id}', [CategoryController::class, 'update'])->name('edit_category');
    Route::get('/delete/category/{id}', [CategoryController::class, 'destroy'])->name('delete_category');
//product
    Route::get('/products', [ProductController::class, 'index'])->name('products');
    Route::match(['GET', 'POST'], '/add/book', [ProductController::class, 'store'])->name('add_product');
    Route::match(['GET', 'POST'], '/edit/book/{id}', [ProductController::class, 'update'])->name('edit_product');
    Route::get('/delete/image/{id}', [ProductController::class, 'delete_image'])->name('delete_image');
    Route::get('/delete/product/{id}', [ProductController::class, 'destroy'])->name('delete_product');
});
// Đăng ký đăng nhập
Route::match(['GET', 'POST'], '/register', [AuthController::class, 'register'])->name('register');
Route::match(['GET', 'POST'], '/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('auth');
Route::match(['GET', 'POST'], '/update_avatar', [AuthController::class, 'update_Avatar'])->name('update_avatar')->middleware('auth');
Route::match(['GET', 'POST'], '/doimk', [AuthController::class, 'update_Password'])->name('doimk')->middleware('auth');
Route::match(['GET', 'POST'], '/update_profile', [AuthController::class, 'update_Profile'])->name('update_profile')->middleware('auth');
