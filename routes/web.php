<?php

use Illuminate\Support\Facades\Route;

Route::get('/owner', function () {
    return view('dashboardOwner');
});

Route::get('/', function () {
    return view('homebefore');
});

Route::get('/login', function () {
    return view('login');
});


Route::get('/homeLayanan', function () {
    return view('homeLayanan');
});

Route::get('/homeProduk', function () {
    return view('homeProduk');
});

Route::get('/dashboardCS', function () {
    return view('dashboardCS');
});

Route::get('/homeHewan', function () {
    return view('homeHewan');
});

Route::get('/homeCustomer', function () {
    return view('homeCustomer');
});

Route::get('/homePegawai', function () {
    return view('homePegawai');
});