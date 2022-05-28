<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstoqueController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::apiResources([
    'estoque' => EstoqueController::class
]);

Route::get('getAllProducts', [\App\Http\Controllers\EstoqueController::class, 'getAllProducts'])->name('getAllProducts');
Route::post('saveProduct', [\App\Http\Controllers\EstoqueController::class, 'saveProduct'])->name('saveProduct');
Route::post('updateProduct', [\App\Http\Controllers\EstoqueController::class, 'updateProduct'])->name('updateProduct');