<?php

use App\Http\Controllers\RobotController;
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

Route::get('/', [RobotController::class, 'index']);
Route::post('/create', [RobotController::class, 'create'])->name('create');
Route::get('/read', [RobotController::class, 'read'])->name('read');
Route::post('/update', [RobotController::class, 'update'])->name('update');
Route::delete('/delete', [RobotController::class, 'delete'])->name('delete');
Route::get('/edit', [RobotController::class, 'edit'])->name('edit');