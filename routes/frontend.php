<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ModelTestController;

Route::get('/', [ModelTestController::class, 'index'])->name('data.allModelsList');
// Route::get('/test-model', [ModelTestController::class, 'index'])->name('data.allModelsList');
Route::post('/create-controller',[ModelTestController::class, 'doController'])->name('data.createController');
Route::get('/controller',[ModelTestController::class, 'doController'])->name('data.testController');