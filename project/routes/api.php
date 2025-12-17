<?php

use App\Http\Controllers\NginxController;
use App\Http\Controllers\VhostController;
use Illuminate\Support\Facades\Route;

Route::prefix('nginx')->group(function () {
    Route::post('start', [NginxController::class, 'start']);
    Route::post('stop', [NginxController::class, 'stop']);
    Route::post('restart', [NginxController::class, 'restart']);
    Route::post('reload', [NginxController::class, 'reload']);
});

Route::prefix('vhosts')->group(function () {
    Route::post('/', [VhostController::class, 'store']);
    Route::delete('/{domain}', [VhostController::class, 'destroy']);
});
