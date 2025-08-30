<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('login');
});

Route::get('index', function () {
    return view('admin.index', ['title' => 'Dashboard']);
});

Route::get('rekapKebun', function () {
    return view('admin.rekapKebun', ['title' => 'Rekap Kebun']);
});

Route::get('rekapPks', function () {
    return view('admin.rekapPks', ['title' => 'Rekap PKS']);
});

Route::get('dataList', function () {
    return view('admin.dataList', ['title' => 'Data List']);
});



