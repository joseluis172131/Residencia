<?php

use App\Http\Controllers\Almacen_AdminController;
use App\Http\Controllers\Ingenieria_AdminController;
use App\Http\Controllers\Oficina_AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudPaileriaController;
use App\Http\Controllers\Auth\LoginController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });
    // Otras rutas protegidas
});


Route::get('/', [CrudPaileriaController::class,'index'])->name('datos');
Route::get('/Ingenieria', [Ingenieria_AdminController::class,'index'])->name('Ingenieria');
Route::get('/oficina', [Oficina_AdminController::class,'index'])->name('oficina');
Route::get('/almacen', [Almacen_AdminController::class, 'index'])->name('almacen');

Route::put('crud.update {id}', [CrudPaileriaController::class,'update'])->name('crud.update');
Route::delete('crud.destroy {id}', [CrudPaileriaController::class,'destroy'])->name('crud.destroy');
Route::post('crudpaileria.create', [CrudPaileriaController::class,'create'])->name('crudpaileria.create');

Route::put('Ingenieria.update {id}', [Ingenieria_AdminController::class,'update'])->name('Ingenieria.update');
Route::delete('Ingenieria.destroy {id}', [Ingenieria_AdminController::class,'destroy'])->name('Ingenieria.destroy');
Route::post('Ingenieria.create', [Ingenieria_AdminController::class,'create'])->name('Ingenieria.create');

Route::put('oficina.update {id}', [Oficina_AdminController::class,'update'])->name('oficina.update');
Route::delete('Oficina.destroy {id}', [Oficina_AdminController::class,'destroy'])->name('Oficina.destroy');
Route::post('Oficina.create', [Oficina_AdminController::class,'create'])->name('Oficina.create');

Route::put('almacen.update {id}', [Almacen_AdminController::class,'update'])->name('almacen.update');
Route::delete('almacen.destroy {id}', [Almacen_AdminController::class,'destroy'])->name('almacen.destroy');
Route::post('almacen.create', [Almacen_AdminController::class,'create'])->name('almacen.create');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

/* Route::post('logout', [LoginController::class, 'logout'])->name('logout');
 */