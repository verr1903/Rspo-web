<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Route::get('/', function () {
    return view('login');
});

Route::get('index', function () {
    return view('admin.index');
});

Route::get('rekapKebun', function () {
    return view('admin.rekapKebun');
});

Route::get('rekapPks', function () {
    return view('admin.rekapPks');
});

Route::get('dataList', function () {
    return view('admin.dataList');
});



