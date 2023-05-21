<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});


// Employee
Route::get('/employee', [UserController::class, 'index']);
Route::get('/employee-add', [UserController::class, 'create']);
Route::post('/employee', [UserController::class, 'store']);
Route::get('/employee-edit/{id}', [UserController::class, 'edit']);
Route::post('/employee/{id}', [UserController::class, 'update']);
Route::get('/employee-delete/{id}', [UserController::class, 'delete']);
Route::delete('/employee-destroy/{id}', [UserController::class, 'destroy']);


// Menu
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/menu-add', [MenuController::class, 'create']);
Route::post('/menu', [MenuController::class, 'store']);



// Member
Route::get('/member', [MemberController::class, 'index']);
Route::get('/read-member', [MemberController::class, 'read']);
Route::get('/create-member', [MemberController::class, 'create']);
Route::get('/store-member', [MemberController::class, 'store']);
