<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\MainController;
use App\Http\Controllers\auth\coustamAuthController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
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

// Route::get('/admin', function () {
//     return view('Admin.index');
// });
Route::get('/admindash',[DashboardController::class, 'index']);
Route::get('/',[MainController::class, 'index']);

Route::get('/register', [MainController::class, 'register']);
Route::get('/saveregister', [coustamAuthController::class, 'register']);

Route::get('/login', [MainController::class, 'login']);
Route::get('/userlogin',[coustamAuthController::class, 'login']);
