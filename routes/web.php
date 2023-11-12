<?php

use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\CategoryTagController;
use App\Http\Controllers\Admin\Customer\OtherCostumerController;
use App\Http\Controllers\Admin\Customer\TRCustomerController;
use App\Http\Controllers\Admin\Product\ProductTagController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Currency\CurrencyController;
use App\Http\Controllers\Admin\Delivery\DeliveryController;
use App\Http\Controllers\Admin\TermOfOffer\TermOfOfferController;
use App\Http\Controllers\Admin\OfferController;
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
       Route::get('/düzenle/{category}', [CategoryController::class, 'edit'])->name('edit');
       Route::post('/düzenle/{category}', [CategoryController::class, 'update'])->name('update');
       Route::post('/sil/{category}', [CategoryController::class, 'destroy'])->name('destroy');

       Route::get('/altkategoriler', [CategoryController::class, 'getCategory'])->name('getCategory');

        Route::get('/search-categories', [CategoryController::class, 'searchCategories'])->name('searchCategories');
        Route::get('/search-categories-id', [CategoryController::class, 'getCategoryId'])->name('getCategoryId');
    });

    Route::as('category.tag.')->prefix('kategoriler-etiketleri')->group(function (){
       Route::get('/', [CategoryTagController::class, 'index'])->name('index');
       Route::get('/ekle', [CategoryTagController::class, 'create'])->name('create');
       Route::post('/ekle', [CategoryTagController::class, 'store'])->name('store');
       Route::get('/düzenle/{categoryTag}', [CategoryTagController::class, 'edit'])->name('edit');
       Route::post('/düzenle/{categoryTag}', [CategoryTagController::class, 'update'])->name('update');
       Route::post('/sil/{categoryTag}', [CategoryController::class, 'destroy'])->name('destroy');
    });

    Route::resource('urun-etiketleri', ProductTagController::class)
        ->except(['show'])
        ->names('product.tag')
        ->parameters(['urun-etiketleri' => 'productTag']);

    Route::post('delete-single-image', [ProductController::class, 'deleteSingleImage'])->name('product.deleteImage');
    Route::resource('urunler', ProductController::class)
        ->except(['show'])
        ->names('product')
        ->parameters(['urunler' => 'product']);

    Route::resource('teklifler', OfferController::class)
        ->names('offer')
        ->parameters(['teklifler' => 'offer']);

    Route::resource('sistem-ayarlari/para-birimi', CurrencyController::class)
        ->except(['show'])
        ->names('currency')
        ->parameters(['para-birimi' => 'currency']);

    Route::resource('sistem-ayarlari/teslimat', DeliveryController::class)
        ->except(['show'])
        ->names('delivery')
        ->parameters(['teslimat' => 'delivery']);

    Route::resource('sistem-ayarlari/teklif-sartlari', TermOfOfferController::class)
        ->except(['show'])
        ->names('term_of_offer')
        ->parameters(['teklif-sartlari' => 'term_of_offer']);

    Route::post('upload', [\App\Http\Controllers\HomeController::class, 'upload'])->name('upload');
});
