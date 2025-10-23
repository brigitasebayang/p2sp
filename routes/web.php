<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/homebefore', function () {
    return view('homebefore');
});

Route::get('/homeLayanan', function () {
    return view('homeLayanan');
});


Route::get('/', function () {
    return view('homebefore');
});
