<?php

use App\Http\Controllers\ExtraPointsController;
use App\Http\Controllers\PointRegister;
use App\Http\Controllers\PointTableController;
use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/createNewTablePoint', [PointTableController::class, 'create'])->name('profile.tablePointSend');
    Route::get('/tablePointCreator', [PointTableController::class, 'show'])->name('profile.tablePointC');
    Route::post('/editpoints', [ProfileController::class, 'editPoints'])->name('profile.editP');
    Route::get('/dashboard', [ProfileController::class, 'show'])->name('dashboard');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/create-register/{id}', [PointRegister::class, 'createRegister'])->name('register.create');
    Route::get('/create-extra-point', [ExtraPointsController::class, 'show'])->name('extraP');
    Route::post('/sendExtraPoint', [ExtraPointsController::class, 'store'])->name('extraPCreate');
    Route::post('/delete-extra-point/{id}', [ExtraPointsController::class, 'delete'])->name('deleteExtraPoint');
    Route::get('/edit-table/{id}', [PointTableController::class, 'table'])->name('Sedittable');
    Route::post('/edit-table', [PointTableController::class, 'edit'])->name('EditTable');
    Route::post('/delete-table', [PointTableController::class, 'delete'])->name('deleteTable');

});

require __DIR__.'/auth.php';
