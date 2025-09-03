<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KebunController;
use App\Http\Controllers\PksController;
use App\Exports\RekapKebunExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\DataListController;
use App\Http\Controllers\ListPksController;
use App\Http\Controllers\ListKebunController;
use App\Http\Controllers\ListAfdelingController;


Route::get('/', function () {
    return view('login');
});

Route::get('index', function () {
    return view('admin.index', ['title' => 'Dashboard']);
});

// rekap kebun
Route::get('rekapKebun', [KebunController::class, 'index'])->name('kebun');
Route::put('/rekapKebun/{id}', [KebunController::class, 'update'])->name('kebun.update');
Route::delete('/rekapKebun/{id}', [KebunController::class, 'destroy'])->name('kebun.destroy');
Route::get('/export-rekap-kebun', [KebunController::class, 'exportExcel'])->name('exportExcel.rekapKebun');
Route::get('/rekapKebun/pdf/{id}', [KebunController::class, 'exportPDFPerKebun'])->name('rekapKebun.pdf.row');

// rekap pks
Route::get('rekapPks', [PksController::class, 'index'])->name('pks');
Route::put('/rekapPks/{id}', [PksController::class, 'update'])->name('pks.update');
Route::delete('/rekapPks/{id}', [PksController::class, 'destroy'])->name('pks.destroy');
Route::get('/export-rekap-pks', [PksController::class, 'exportExcel'])->name('exportExcel.rekapPks');
Route::get('/rekapPks/pdf/{id}', [PksController::class, 'exportPDFPerPks'])->name('rekapPks.pdf.row');

// data list
Route::get('/dataList', [DataListController::class, 'index'])->name('dataList');
Route::resource('list-pks', ListPksController::class)->only(['store', 'update', 'destroy']);
Route::resource('list-kebun', ListKebunController::class)->only(['store', 'update', 'destroy']);
Route::resource('list-afdeling', ListAfdelingController::class)->only(['store', 'update', 'destroy']);


