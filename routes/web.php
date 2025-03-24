<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Middleware\CheckUser;
use Illuminate\Support\Facades\Route;

//  Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'handelLogin'])->name('handelLogin');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes (Requires Authentication)
Route::middleware(['CheckUser'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // // Category Routes (Fixed Naming Conflict)
    Route::prefix('category')->group(function () {
        Route::get('/index', [CategoryController::class, 'index'])->name('category');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('category.update');
        Route::delete('/delete/{category}', [CategoryController::class, 'destroy'])->name('category.delete');
    });



    Route::get('/subcategory', [SubCategoryController::class, 'index'])->name('subcategory');
    Route::get('/subcategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
    Route::post('/subcategory/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
    Route::get('/subcategory/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
    Route::put('/subcategory/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.updates');
    Route::delete('/subcategory/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.delete');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
});
