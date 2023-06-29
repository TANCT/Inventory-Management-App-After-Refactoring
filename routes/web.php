<?php
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MerchandiserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\DisposedController;
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
});

Route::resource('products', ProductController::class);
Route::resource('merchandisers', MerchandiserController::class);
Route::resource('orders', OrderController::class);
Route::resource('staffs', StaffController::class);
Route::resource('disposedproducts',DisposedController::class);
Route::group(['middleware' => ['web']], function () {
    Route::put('/products/{product}/dispose', [ProductController::class, 'dispose'])->name('products.dispose');
    
});


