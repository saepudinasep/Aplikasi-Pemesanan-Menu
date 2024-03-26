<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChefController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TableController;
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
    return view('index');
})->middleware('guest');

Route::get('/home', function () {
    return view('home');
})->middleware('auth');


Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticating'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('/change-password', [AuthController::class, 'edit']);
Route::post('/change-password', [AuthController::class, 'update']);
Route::get('/profile', [AuthController::class, 'show']);


// Employee
Route::get('/employee', [UserController::class, 'index'])->middleware('auth', 'MustAdmin');
Route::get('/employee-add', [UserController::class, 'create'])->middleware('auth', 'MustAdmin');
Route::post('/employee', [UserController::class, 'store'])->middleware('auth', 'MustAdmin');
Route::get('/employee-edit/{id}', [UserController::class, 'edit'])->middleware('auth', 'MustAdmin');
Route::post('/employee/{id}', [UserController::class, 'update'])->middleware('auth', 'MustAdmin');
Route::delete('/employee/{id}', [UserController::class, 'destroy'])->middleware('auth', 'MustAdmin');


// Menu
Route::get('/menu', [MenuController::class, 'index'])->middleware('auth', 'MustAdmin');
Route::get('/menu-add', [MenuController::class, 'create'])->middleware('auth', 'MustAdmin');
Route::post('/menu', [MenuController::class, 'store'])->middleware('auth', 'MustAdmin');
Route::get('/menu-edit/{id}', [MenuController::class, 'edit'])->middleware('auth', 'MustAdmin');
Route::post('/menu/{id}', [MenuController::class, 'update'])->middleware('auth', 'MustAdmin');
Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->middleware('auth', 'MustAdmin');



// Member
Route::get('/member', [MemberController::class, 'index'])->middleware('auth', 'MustAdmin');
Route::get('/member-add', [MemberController::class, 'create'])->middleware('auth', 'MustAdmin');
Route::post('/member', [MemberController::class, 'store'])->middleware('auth', 'MustAdmin');
Route::get('/member-edit/{id}', [MemberController::class, 'edit'])->middleware('auth', 'MustAdmin');
Route::post('/member/{id}', [MemberController::class, 'update'])->middleware('auth', 'MustAdmin');
Route::delete('/member/{id}', [MemberController::class, 'destro'])->middleware('auth', 'MustAdmin');


// Menu Waiter
Route::get('/table', [TableController::class, 'index']);
Route::get('/order/{id}', [TableController::class, 'order']);
Route::get('/show/{id}', [TableController::class, 'show']);

// Order Menu
Route::post('/pesan', [OrderController::class, 'pesan']);
Route::get('/read', [OrderController::class, 'read']);

// Menu Cashier
Route::get('/payment', [PaymentController::class, 'index']);
Route::post('/payment', [PaymentController::class, 'store'])->name('payment');
Route::get('/show-payment/{id}', [PaymentController::class, 'show']);
Route::post('/store', [PaymentController::class, 'store']);

// Menu Chef
Route::get('/view-order', [ChefController::class, 'index']);
Route::post('/updateOrder', [ChefController::class, 'update'])->name('updateOrder');


// Report
Route::get('/report', [ReportController::class, 'index']);
Route::post('/generate-report', [ReportController::class, 'store']);
