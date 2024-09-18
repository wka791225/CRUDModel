<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\ModelTestController;

Route::get('/', function () {
    return Inertia::render('Frontend/Index', [
        'response' => rtFormat([100, 200, 300]),
    ]);
});
Route::get('/test-model', [ModelTestController::class, 'index'])->name('data.allModelsList');
Route::post('/create-controller',[ModelTestController::class, 'doController'])->name('data.createController');