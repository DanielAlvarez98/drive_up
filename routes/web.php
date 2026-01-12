<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\home\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaintenanceController;
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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {


    Route::get('home', action: [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('car-show/{car}', [HomeController::class, 'show'])->name('car.show');
    Route::get('recordatorios', [HomeController::class, 'recorda'])->name('recorda.show');
    Route::get('perfil', [HomeController::class, 'perfil'])->name('perfil.show');
    Route::post('/perfil/editar', [HomeController::class, 'editPerfil'])->name('perfil.edit');


    Route::get('car', [CarController::class, 'index'])->name('car.index');
    Route::post('cart-create', [CarController::class, 'store'])->name('car.store');
    Route::get('car/{car}/editarAjax', [CarController::class, 'edit'])->name('car.ajax');
    Route::patch('car/{car}/editar', [CarController::class, 'update'])->name('car.update');
    Route::delete('car_delete/{car}', [CarController::class, 'destroy'])->name('car.destroy');

    Route::get('documents', [DocumentController::class, 'index'])->name('document.index');
    Route::post('documents-create', [DocumentController::class, 'store'])->name('doc.store');
    Route::get('document/{document}/editarAjax', [DocumentController::class, 'edit'])->name('doc.ajax');
    Route::patch('documents/{document}/editar', [DocumentController::class, 'update'])->name('doc.update');
    Route::delete('documents/{document}', [DocumentController::class, 'destroy'])->name('doc.destroy');

    Route::get('mantenimientos', [MaintenanceController::class, 'index'])->name('mant.index');
    Route::post('mantenimientos-create', [MaintenanceController::class, 'store'])->name('mant.store');
    Route::get('mantenimientos/{maintenance}/editarAjax', [MaintenanceController::class, 'edit'])->name('mant.ajax');
    Route::patch('mantenimientos/{maintenance}/editar', [MaintenanceController::class, 'update'])->name('mant.update');
    Route::delete('mantenimientos/{maintenance}', [MaintenanceController::class, 'destroy'])->name('mant.destroy');
});
