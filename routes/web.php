<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Customer\TRCustomerController;
use App\Http\Controllers\Admin\Customer\OtherCostumerController;
use App\Http\Controllers\Admin\CategoryController;

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

Auth::routes();

Route::middleware('auth')->as('admin.')->prefix('panel')->group(function (){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');

    Route::as('tr_customer.')->prefix('yurtici-musteriler')->group(function (){
       Route::get('/',[TRCustomerController::class, 'index'])->name('index');
       Route::get('/ekle/{personal_type}',[TRCustomerController::class, 'create'])->name('create');
       Route::post('/ekle/',[TRCustomerController::class, 'store'])->name('store');
        Route::get('/düzenle/{customer}/{personal_type}',[TRCustomerController::class, 'edit'])->name('edit');
        Route::post('/düzenle/{customer}/',[TRCustomerController::class, 'update'])->name('update');
        Route::post('/sil/{customer}/',[TRCustomerController::class, 'destroy'])->name('destroy');
    });

    Route::as('other_customer.')->prefix('yurtdisi-musteriler')->group(function (){
       Route::get('/',[OtherCostumerController::class, 'index'])->name('index');
       Route::get('/ekle/{personal_type}',[OtherCostumerController::class, 'create'])->name('create');
       Route::post('/ekle/',[OtherCostumerController::class, 'store'])->name('store');
        Route::get('/düzenle/{customer}/{personal_type}',[OtherCostumerController::class, 'edit'])->name('edit');
        Route::post('/düzenle/{customer}/',[OtherCostumerController::class, 'update'])->name('update');
        Route::post('/sil/{customer}/{personal_type}',[OtherCostumerController::class, 'destroy'])->name('destroy');
    });
    Route::as('category.')->prefix('kategoriler')->group(function (){
       Route::get('/', [CategoryController::class, 'index'])->name('index');
       Route::get('/ekle', [CategoryController::class, 'create'])->name('create');
       Route::post('/ekle', [CategoryController::class, 'store'])->name('store');
       Route::get('/altkategoriler', [CategoryController::class, 'getCategory'])->name('getCategory');
    });
});
