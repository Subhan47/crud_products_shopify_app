<?php
use App\Http\Controllers\ProductController;
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

Route::middleware(['verify.shopify'])->group(function () {
    // Home Route, calls the index method of ProductController
    Route::get('/',[ProductController::class, 'index'])->name('home');

    // Store Product Route, calls the store method of ProductController to store a new Product
    Route::post('/store-product',[ProductController::class, 'store'])->name('store-product');

    // Show Product Route, calls the show method of ProductController to show the specific product
    Route::get('/show-product/{id}',[ProductController::class, 'show'])->name('show-product');

    // Edit Product Route, calls the edit method of ProductController to show the specific product to be Edited
    Route::get('/edit-product/{id}',[ProductController::class, 'edit'])->name('edit-product');

    // Update Product Route, calls the update method of ProductController to update the specific product
    Route::post('/update-product',[ProductController::class, 'update'])->name('update-product');

    // Delete Product Route, calls the delete method of ProductController to Delete the specific product
    Route::post('/delete-product/{id}',[ProductController::class, 'destroy'])->name('delete-product');

    Route::get('/count-products',[ProductController::class, 'productsCount'])->name('count-products');






});
