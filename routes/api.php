<?php

use App\Http\Controllers\BusRouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckUserPermission;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    $user = $request->user()->load('type');

    return response()->json([
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'role' => $user->type->type ?? 'user',
        'type_id' => $user->type_id,
        'created_at' => $user->created_at,
        'updated_at' => $user->updated_at,
    ]);
});

Route::middleware(['auth:sanctum', CheckUserPermission::class])->group(function () {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/routes', [BusRouteController::class, 'index']);
    Route::get('/routes/{id}', [BusRouteController::class, 'show']);
    Route::post('/routes/generate', [BusRouteController::class, 'generate']);
    Route::post('/routes/store', [BusRouteController::class, 'store']);
    Route::delete('/routes/{id}', [BusRouteController::class, 'destroy']);
        
    Route::apiResource('bus-stops', App\Http\Controllers\BusStopController::class);
});