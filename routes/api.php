<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Category
 */
Route::prefix('/categories')->group(
    function () {
        Route::get('/get', [CategoryController::class, 'getCategoriesAction']);
    }
);

Route::prefix('category')->group(
    function () {
        Route::post('/create', [CategoryController::class, 'createAction']);
        Route::put('/update/{id}', [CategoryController::class, 'updateAction']);
        Route::delete('/delete/{id}', [CategoryController::class, 'deleteAction']);
    }
);

/**
 * Product
 */
Route::prefix('/products')->group(
    function () {
        Route::get('/get', [ProductController::class, 'getProductsAction']);
    }
);

Route::prefix('product')->group(
    function () {
        Route::post('/create', [ProductController::class, 'createAction']);
        Route::put('/update/{id}', [ProductController::class, 'updateAction']);
        Route::delete('/delete/{id}', [ProductController::class, 'deleteAction']);
    }
);

Route::any(
    '{error}',
    function ($page) {
        return response('404 Error');
    }
)->where('error', '(.*)');
