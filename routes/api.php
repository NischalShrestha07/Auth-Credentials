<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::get('/category',[CategoryController::class,'index'])->name('');
Route::post('/', [AuthController::class, 'login']);
Route::middleware(['CheckUserToken'])->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/{id}', [CategoryController::class, 'getCategory'])->name('category.get');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    // Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    // Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
});
