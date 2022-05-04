<?php

use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DeliveriesController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\ServiceProvidersController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ZoneController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth:admin'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['prefix' => 'admin/', 'middleware' => 'auth:admin'], function () {

    /**
    * Categories
    */
    Route::group(['prefix'=>'categories'], function() {
        Route::get('/', [CategoriesController::class, 'index'])->name('categories.index');
        Route::get('/create', [CategoriesController::class, 'create'])->name('categories.create');
        Route::get('/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
        Route::get('/trashed', [CategoriesController::class, 'trashed'])->name('categories.trashed');
        Route::get('/{id}', [CategoriesController::class, 'show'])->name('categories.show');
        Route::post('/', [CategoriesController::class, 'store'])->name('categories.store');
        Route::put('/{id}', [CategoriesController::class, 'update'])->name('categories.update');
        Route::delete('/{id}', [CategoriesController::class, 'destroy'])->name('categories.destroy');
        Route::put('/restore/{id}', [CategoriesController::class, 'restore'])->name('categories.restore');
        Route::put('/needDelivery/{id}', [CategoriesController::class, 'needDelivery'])->name('categories.needDelivery');
        Route::put('/changeStatues/{id}', [CategoriesController::class, 'changeStatues'])->name('categories.changeStatues');
    });

    /**
     * Delivery
     */
    Route::group(['prefix'=>'deliveries'], function() {
        Route::get('/', [DeliveriesController::class, 'index'])->name('deliveries.index');
        Route::get('/create', [DeliveriesController::class, 'create'])->name('deliveries.create');
        Route::get('/edit/{id}', [DeliveriesController::class, 'edit'])->name('deliveries.edit');
        Route::get('/trashed', [DeliveriesController::class, 'trashed'])->name('deliveries.trashed');
        Route::get('/{id}', [DeliveriesController::class, 'show'])->name('deliveries.show');
        Route::post('/', [DeliveriesController::class, 'store'])->name('deliveries.store');
        Route::put('/{id}', [DeliveriesController::class, 'update'])->name('deliveries.update');
        Route::delete('/{id}', [DeliveriesController::class, 'destroy'])->name('deliveries.destroy');
        Route::put('/restore/{id}', [DeliveriesController::class, 'restore'])->name('deliveries.restore');
        Route::put('/changeStatues/{id}', [DeliveriesController::class, 'changeStatues'])->name('deliveries.changeStatues');
    });

    /**
     * Zones
     */
    Route::group(['prefix'=>'zones'], function() {
        Route::get('/', [ZoneController::class, 'index'])->name('zones.index');
        Route::get('/create', [ZoneController::class, 'create'])->name('zones.create');
        Route::get('/edit', [ZoneController::class, 'edit'])->name('zones.edit');
        Route::get('/trashed', [ZoneController::class, 'trashed'])->name('zones.trashed');
        Route::get('/{id}', [ZoneController::class, 'show'])->name('zones.show');
        Route::post('/', [ZoneController::class, 'store'])->name('zones.store');
        Route::put('/{id}', [ZoneController::class, 'update'])->name('zones.update');
        Route::delete('/{id}', [ZoneController::class, 'destroy'])->name('zones.destroy');
        Route::put('/restore/{id}', [ZoneController::class, 'restore'])->name('zones.restore');
        Route::put('/changeStatues/{id}', [ZoneController::class, 'changeStatues'])->name('zones.changeStatues');
    });

    /**
     * Reservations
     */
    Route::group(['prefix'=>'reservations'], function() {
        Route::get('/', [ReservationController::class, 'index'])->name('reservations.index');
        Route::put('/changeStatues/{id}', [ReservationController::class, 'changeStatues'])->name('reservations.changeStatues');
    });

    /**
    * Services
    */
    Route::group(['prefix'=>'services'], function() {
        Route::get('/', [ServicesController::class, 'index'])->name('services.index');
        Route::get('/create', [ServicesController::class, 'create'])->name('services.create');
        Route::get('/edit/{id}', [ServicesController::class, 'edit'])->name('services.edit');
        Route::get('/trashed', [ServicesController::class, 'trashed'])->name('services.trashed');
        Route::get('/{id}', [ServicesController::class, 'show'])->name('services.show');
        Route::post('/', [ServicesController::class, 'store'])->name('services.store');
        Route::put('/{id}', [ServicesController::class, 'update'])->name('services.update');
        Route::delete('/{id}', [ServicesController::class, 'destroy'])->name('services.destroy');
        Route::put('/restore/{id}', [ServicesController::class, 'restore'])->name('services.restore');
        Route::put('/changeStatues/{id}', [ServicesController::class, 'changeStatues'])->name('services.changeStatues');
    });//

    /**
    * ServiceProviders
    */
    Route::group(['prefix'=>'serviceProviders'], function() {
        Route::get('/', [ServiceProvidersController::class, 'index'])->name('serviceProviders.index');
        Route::get('/create', [ServiceProvidersController::class, 'create'])->name('serviceProviders.create');
        Route::get('/edit/{id}', [ServiceProvidersController::class, 'edit'])->name('serviceProviders.edit');
        Route::get('/trashed', [ServiceProvidersController::class, 'trashed'])->name('serviceProviders.trashed');
        Route::get('/{id}', [ServiceProvidersController::class, 'show'])->name('serviceProviders.show');
        Route::post('/', [ServiceProvidersController::class, 'store'])->name('serviceProviders.store');
        Route::put('/{id}', [ServiceProvidersController::class, 'update'])->name('serviceProviders.update');
        Route::delete('/{id}', [ServiceProvidersController::class, 'destroy'])->name('serviceProviders.destroy');
        Route::put('/restore/{id}', [ServiceProvidersController::class, 'restore'])->name('serviceProviders.restore');
        Route::put('/changeStatues/{id}', [ServiceProvidersController::class, 'changeStatues'])->name('serviceProviders.changeStatues');
    });

    /**
     * Users
     */
    Route::group(['prefix'=>'users'], function() {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::put('/changeStatues/{id}', [UserController::class, 'changeStatues'])->name('users.changeStatues');
    });


});

