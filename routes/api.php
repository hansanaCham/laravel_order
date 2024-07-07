<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\AuthController; 
use App\Http\Controllers\OrderController;


//public routes
Route::post('/sing_up', [AuthController::class,'register']);
Route::post('/sing_in', [AuthController::class,'signIn']);

// protected routs
Route::post('/sing_out', [AuthController::class,'signOut'])->middleware('auth:sanctum');
Route::get('/user', function (Request $request) {
    return response()->json([$request->user()]);
})->middleware('auth:sanctum');

Route::get('/users', function (Request $request) {
    return response()->json(User::all());
});
Route::resource('order', OrderController::class)->middleware('auth:sanctum');


