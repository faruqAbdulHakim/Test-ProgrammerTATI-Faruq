<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EmployeeLogController;
use App\Http\Controllers\ProvinceController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::middleware(Authenticate::class)->group(function() {
  Route::get('/', [Controller::class, 'index'])->name('index');

  Route::get('/test-1', [EmployeeLogController::class, 'index'])->name('test.1');
  Route::delete('/test-1/{id}', [EmployeeLogController::class, 'delete'])->name('test.1.delete');
  Route::get('/test-1/create', [EmployeeLogController::class, 'create'])->name('test.1.create');
  Route::post('/test-1/create', [EmployeeLogController::class, 'create'])->name('test.1.create');
  Route::put('/test-1/{id}/edit', [EmployeeLogController::class, 'update'])->name('test.1.edit');
  
  Route::get('/test-2', [Controller::class, 'test_2'])->name('test.2');
  Route::delete('/test-2/{id}', [ProvinceController::class, 'delete'])->name('test.2.delete');
  Route::get('/test-2/create', [ProvinceController::class, 'create'])->name('test.2.create');
  Route::post('/test-2/create', [ProvinceController::class, 'create'])->name('test.2.create');
  Route::get('/test-2/{id}/edit', [ProvinceController::class, 'edit'])->name('test.2.edit');
  Route::put('/test-2/{id}/edit', [ProvinceController::class, 'edit'])->name('test.2.edit');
  
  Route::get('/test-3', [Controller::class, 'test_3'])->name('test.3');
  Route::post('/test-3', [Controller::class, 'test_3'])->name('test.3');
  
  Route::get('/test-4', [Controller::class, 'test_4'])->name('test.4');
  Route::post('/test-4', [Controller::class, 'test_4'])->name('test.4');
});
