<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\MainController;
use App\Http\Controllers\auth\coustamAuthController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\colleges\Collegename;
use App\Http\Controllers\Admin\colleges\Collegecourse;
use App\Http\Controllers\Admin\colleges\CollegeDept;
use App\Http\Controllers\Admin\colleges\CollegePosition;
use App\Http\Middleware\Adminaccess;
use App\Http\Controllers\Public\StudentProfile;
use App\Http\Controllers\Public\Profile;


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
// Admin Routes
Route::get('/admindash/dashboard',[DashboardController::class, 'index'])->middleware(Adminaccess::class);
Route::get('/admindash/dashboard/userrequests',[DashboardController::class, 'userrequests'])->middleware(Adminaccess::class);

// College
Route::get('admindash/Colleges', function () {
    return view('Admin.Colleges.index');
})->middleware(Adminaccess::class);
// College Name Route
Route::get('admindash/Colleges/name',[Collegename::class, 'index'])->middleware(Adminaccess::class);
Route::POST('admindash/Colleges/addcolleges',[Collegename::class, 'Addcolleges'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/delete',[Collegename::class,'Deletecolleges'])->middleware(Adminaccess::class);

//courses
Route::get('admindash/Colleges/Courses',[Collegecourse::class,'index'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/Addcourses',[Collegecourse::class,'Addcourses'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/deletecourse',[Collegecourse::class,'deletecourses'])->middleware(Adminaccess::class);

// Dept
Route::get('admindash/Colleges/Dept',[CollegeDept::class,'index'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/Adddept',[CollegeDept::class,'Adddept'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/deletedept',[CollegeDept::class,'deletedept'])->middleware(Adminaccess::class);

//Position 
Route::get('admindash/Colleges/Position',[CollegePosition::class,'index'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/Addposition',[CollegePosition::class,'Addposition'])->middleware(Adminaccess::class);
Route::post('admindash/Colleges/deleteposition',[CollegePosition::class,'deleteposition'])->middleware(Adminaccess::class);


Route::get('/',[MainController::class, 'index']);

Route::get('/register', [MainController::class, 'register']);
Route::get('/saveregister', [coustamAuthController::class, 'register']);

Route::get('/login', [MainController::class, 'login']);
Route::get('/userlogin',[coustamAuthController::class, 'login']);

Route::get('/logout', [coustamAuthController::class, 'logout']);

//Student Profile 
Route::get('/profile',[Profile::class, 'index']);
Route::get('/studentprofile',[StudentProfile::class, 'index']);
Route::get('/trycode',[StudentProfile::class, 'trycode']);