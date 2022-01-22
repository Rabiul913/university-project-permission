<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Secure;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\VachicleController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\StopController;
use App\Http\Controllers\RouteDetailController;
use App\Http\Controllers\HomeController;

use App\http\Controllers\Auth\ForgotPasswordController;
use App\http\Controllers\Auth\ResetPasswordController;


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
    return view('welcome');
});



Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth'],'prefix'=>'student'], function() {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('class', ClasseController::class);
    Route::resource('sections', SectionController::class);
    Route::resource('students', StudentController::class);
    Route::resource('vachicles', VachicleController::class);
    Route::resource('routes', RouteController::class);
    Route::resource('routedetails',RouteDetailController::class);
    Route::resource('stops', StopController::class);
    Route::resource('schedules', RouteDetailController::class);

});

// Route::resource('roles', RoleController::class);
// Route::resource('permissions', PermissionController::class);

Route::get('getsections',[StudentController::class, 'getSections']);
Route::get('routesearch',[RouteController::class, 'search']);
Route::get('getroutes/{id}',[RouteController::class, 'getRoutes']);
Route::get('getroutedetails',[RouteDetailController::class, 'getRouteDetails']);

// Route::get('exportStudent',[StudentController::class, 'exportStudent']);
  
// Route::get('importExportView', [StudentController::class, 'importExportView']);
// Route::get('export', [StudentController::class, 'export'])->name('export');
// Route::post('import', [StudentController::class, 'import'])->name('import');
Route::post('/import',[StudentController::class, 'importData']);
Route::get('/export',[StudentController::class, 'exportData']);


