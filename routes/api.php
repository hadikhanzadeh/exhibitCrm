<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:sanctum'])->post('/tourRequest', [\App\Http\Controllers\TourRequestController::class, 'store']);
Route::middleware(['auth:sanctum'])->post('/boothBuilding', [\App\Http\Controllers\BoothBuildingController::class, 'store']);

