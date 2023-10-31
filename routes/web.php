<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Customer\TRCustomerController;

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
    });
});
