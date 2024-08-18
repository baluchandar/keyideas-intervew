<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [App\Http\Controllers\ProductController::class, 'index'])->name('catalog');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/import-csv', [App\Http\Controllers\Admin\AdminController::class, 'import_csv']);
});
Route::get('/get-products', [App\Http\Controllers\ProductController::class, 'get_products']);

require __DIR__.'/auth.php';
