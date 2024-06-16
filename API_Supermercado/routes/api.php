<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ProdutosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TesteController;

//Route::get('/user', function (Request $request) {
//    return $request->user();
//})->middleware('auth:sanctum');

Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);  //Cadastrar User
Route::post('/login', [AuthController::class, 'login']);  //Login User


Route::middleware('auth:sanctum')->group(function(){
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);

    Route::get('/produtos', [ProdutosController::class, 'index']);
    Route::get('/produtos/{produto}', [ProdutosController::class, 'show']);
    Route::post('/produtos', [ProdutosController::class, 'store']);
    Route::put('/produtos/{produto}', [ProdutosController::class, 'update']);
    Route::delete('/produtos/{produto}', [ProdutosController::class, 'destroy']);

    Route::post('/logout', [AuthController::class, 'logout']);
});