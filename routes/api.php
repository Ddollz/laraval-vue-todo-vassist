<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

//To do apis
Route::get('/todo/{id}', [TodoController::class, 'getList']);
Route::post('/todo/{id}', [TodoController::class, 'addTodo']);
Route::put('/todoUpdate/{id}', [TodoController::class, 'updateTodo']);
Route::delete('/todoDelete/{id}', [TodoController::class, 'deleteTodo']);

//User apis
Route::get('/userall', [UserController::class, 'getList']);
Route::put('/userUpdate/{id}', [UserController::class, 'updateUser']);
Route::delete('/userDelete/{id}', [UserController::class, 'deleteUser']);

