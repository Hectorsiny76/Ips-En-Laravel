<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('test');
});

Route::get('/dashboard', function () {
    return view('layout.dashboard', );
});
