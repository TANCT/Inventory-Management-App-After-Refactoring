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




///////////////////////////////////////////////////////////////////////////////////////////

// Route::get('/products', [ProductController::class, 'index']);

// Route::get('/staffs', [ProductController::class, 'index']);



 // Route::post('/products/create', [ProductController::class, 'storeProduct'])->name('products.storeProduct');
    // Route::put('/products/{product}/update', [ProductController::class, 'update'])->name('products.update');
    // Route::put('/merchandisers/{merchandiser}/update', [MerchandiserController::class, 'merchandiser'])->name('merchandisers.update');
    // Route::put('/staffs/{staff}/update', [StaffController::class, 'staff'])->name('staffs.update');
    // Route::put('/orders/{order}/update', [OrderController::class, 'order'])->name('orders.update');
    // Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    // Route::post('/merchandisers', [MerchandiserController::class, 'store'])->name('merchandisers.store');
    // Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    // Route::post('/staffs', [StaffController::class, 'store'])->name('staffs.store');
    // Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    // Route::delete('/merchandisers/{merchandiser}', [MerchandiserController::class, 'destroy'])->name('merchandisers.destroy');
    // Route::delete('/staffs/{staff}', [StaffController::class, 'destroy'])->name('staffs.destroy');
    // Route::delete('/orders/{orders}', [OrderController::class, 'destroy'])->name('orders.destroy');



