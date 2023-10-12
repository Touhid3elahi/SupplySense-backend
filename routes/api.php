<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\RateController;
use App\Http\Controllers\API\MaterialController;
use App\Http\Controllers\API\SupplierController;
use App\Http\Controllers\API\ComparativeStatementController;

// Authentication Routes
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('logout', [AuthController::class, 'logout']);

// Routes with 'auth:sanctum' middleware
Route::middleware(['auth:sanctum'])->group(function () {
    // Get the authenticated user
    Route::get('user', function (Request $request) {
        return $request->user();
    });

    Route::resource('rates', RateController::class);

    // Supplier Routes
    Route::resource('suppliers', SupplierController::class);

    // Material Routes
    Route::resource('materials', MaterialController::class);

    // Comparative Statement Routes
    Route::get('comparative-statements', [ComparativeStatementController::class, 'index']);
    Route::post('comparative-statements', [ComparativeStatementController::class, 'store']);

    Route::post('compare', [ComparativeStatementController::class, 'compare']);

});




