<?php

use App\Http\Controllers\Almacen_AdminController;
use App\Http\Controllers\Ingenieria_AdminController;
use App\Http\Controllers\Oficina_AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VistasPersonalController;
use App\Http\Controllers\CrudPaileriaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistroController;
use Illuminate\Support\Facades\Route;

// Rutas para registro e inicio de sesión
Route::get('registroVer', [RegistroController::class, 'showRegistrationForm'])->name('registroVer');
Route::post('registro', [RegistroController::class, 'register'])->name('registo.create');

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas para Administradores (Protegidas por el middleware de rol)
Route::middleware(['auth', 'role:Administrador'])->group(function () {
    Route::get('/', [CrudPaileriaController::class, 'index'])->name('datos'); // Dashboard del Administrador
    Route::get('/Ingenieria', [Ingenieria_AdminController::class, 'index'])->name('Ingenieria');
    Route::get('/oficina', [Oficina_AdminController::class, 'index'])->name('oficina');
    Route::get('/almacen', [Almacen_AdminController::class, 'index'])->name('almacen');

    Route::get('pdf-report', [ReportController::class,'generatePDF'])->name('infopaile');
    Route::get('pdf-reporte', [ReportController::class,'generarPDF'])->name('infoAdministrativa');
    Route::get('pdf-informe', [ReportController::class,'InfomePDF'])->name('infoIngenieria');
    Route::get('pdf-info', [ReportController::class,'infoPDF'])->name('infoAlmacen');

    Route::put('crud.update {id}', [CrudPaileriaController::class, 'update'])->name('crud.update');
    Route::delete('crud.destroy {id}', [CrudPaileriaController::class, 'destroy'])->name('crud.destroy');
    Route::post('crudpaileria.create', [CrudPaileriaController::class, 'create'])->name('crudpaileria.create');

    Route::put('Ingenieria.update {id}', [Ingenieria_AdminController::class, 'update'])->name('Ingenieria.update');
    Route::delete('Ingenieria.destroy {id}', [Ingenieria_AdminController::class, 'destroy'])->name('Ingenieria.destroy');
    Route::post('Ingenieria.create', [Ingenieria_AdminController::class, 'create'])->name('Ingenieria.create');

    Route::put('oficina.update {id}', [Oficina_AdminController::class, 'update'])->name('oficina.update');
    Route::delete('Oficina.destroy {id}', [Oficina_AdminController::class, 'destroy'])->name('Oficina.destroy');
    Route::post('Oficina.create', [Oficina_AdminController::class, 'create'])->name('Oficina.create');

    Route::put('almacen.update {id}', [Almacen_AdminController::class, 'update'])->name('almacen.update');
    Route::delete('almacen.destroy {id}', [Almacen_AdminController::class, 'destroy'])->name('almacen.destroy');
    Route::post('almacen.create', [Almacen_AdminController::class, 'create'])->name('almacen.create');
});

// Rutas para Personal de Trabajo (Protegidas por el middleware de rol)
Route::middleware(['auth', 'role:Personal de Trabajo'])->group(function () {
    Route::get('oficinaPersonal', [VistasPersonalController::class, 'verOficina'])->name('oficinaPersonal');
    Route::get('paileriaPersonal', [VistasPersonalController::class, 'verPaileria'])->name('paileriaPersonal');
    Route::get('ingenieriaPersonal', [VistasPersonalController::class, 'verIngenieria'])->name('ingenieriaPersonal');
    Route::get('almacenPersonal', [VistasPersonalController::class, 'verAlmacen'])->name('almacenPersonal');
});
