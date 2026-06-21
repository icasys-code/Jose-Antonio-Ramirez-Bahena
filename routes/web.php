<?php

use App\Http\Controllers\PracticasController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AttributeValueController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarModelController;
use App\Http\Controllers\CarVariantController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\ComponentPartController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\PartVariantController;
use App\Http\Controllers\PriceHistoryController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WarehouseController;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $featuredVehicles = Vehicle::with(['variant.model.brand', 'images'])
        ->take(3)
        ->get();

    return view('welcome', compact('featuredVehicles'));
})->name('home');

Route::get('/vehiculos', [VehicleController::class, 'catalog'])->name('vehiculos');
Route::get('/piezas', [PartController::class, 'catalog'])->name('piezas');
Route::view('/nosotros', 'cliente.nosotros')->name('nosotros');
Route::view('/contacto', 'cliente.contacto')->name('contacto');
Route::view('/publicar', 'cliente.publicar')->name('publicar');
Route::view('/registro', 'cliente.registro')->name('registro');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('administrador.dashboard');
    })->name('dashboard');
    Route::resource('attributes', AttributeController::class);
    Route::resource('attributevalues', AttributeValueController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('carmodels', CarModelController::class);
    Route::resource('carvariants', CarVariantController::class);
    Route::resource('categories', CategorieController::class);
    Route::resource('components', ComponentController::class);
    Route::resource('componentparts', ComponentPartController::class);
    Route::resource('images', ImageController::class);
    Route::resource('manufacturers', ManufacturerController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('orderitems', OrderItemController::class);
    Route::resource('parts', PartController::class);
    Route::resource('partvariants', PartVariantController::class);
    Route::resource('pricehistorys', PriceHistoryController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('users', UserController::class);
    Route::resource('vehicles', VehicleController::class);
    Route::resource('vendors', VendorController::class);
    Route::resource('warehouses', WarehouseController::class);
});

Route::get('/prueba', function () {
    return view('administrador.prueba');
});

Route::get('/pruebac', function () {
    return view('cliente.prueba');
});

Route::get('/practicas', [PracticasController::Class,]);