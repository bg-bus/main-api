<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/bus', [BusController::class, 'index']);
Route::post('/bus/create', [BusController::class, 'create']);
Route::put('/bus/update/{id}', [BusController::class, 'update']);
Route::delete('/bus/delete/{id}', [BusController::class, 'delete']);
