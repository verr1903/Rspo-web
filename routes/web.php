<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\KebunController;

Route::get('/', function () {
    return view('login');
});

Route::get('index', function () {
    return view('admin.index', ['title' => 'Dashboard']);
});

Route::get('rekapKebun', [KebunController::class, 'index'])->name('kebun');
Route::put('/rekapKebun/{id}', [KebunController::class, 'update'])->name('kebun.update');
Route::delete('/rekapKebun/{id}', [KebunController::class, 'destroy'])->name('kebun.destroy');


Route::get('rekapPks', function () {
    return view('admin.rekapPks', ['title' => 'Rekap PKS']);
});

Route::get('dataList', function () {
    return view('admin.dataList', ['title' => 'Data List']);
});
