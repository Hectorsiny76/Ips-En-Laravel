<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('test');
});

// When a user goes to /dashboard, run the 'index' method in DashboardController
Route::get('/dashboard', [DashboardController::class, 'index']);
