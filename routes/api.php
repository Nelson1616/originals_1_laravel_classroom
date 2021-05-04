<?php

use App\Http\Controllers\Api\ClassroomController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ModulesController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix('classrooms')->name('classrooms.')->group(function(){
    Route::get('/', [ClassroomController::class, 'index'])->name('index');
    Route::post('/', [ClassroomController::class, 'store'])->name('store');
    Route::put('/{id}', [ClassroomController::class, 'update'])->name('update');
    Route::delete('/{id}', [ClassroomController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [ClassroomController::class, 'show'])->name('show');

    Route::post('/enter', [ClassroomController::class, 'enter'])->name('enter');
    Route::post('/exit', [ClassroomController::class, 'exit'])->name('exit');
});

Route::prefix('users')->name('users.')->group(function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::put('/{id}', [UserController::class, 'update'])->name('update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [UserController::class, 'show'])->name('show');
});

Route::prefix('modules')->name('modules.')->group(function(){
    Route::get('/', [ModulesController::class, 'index'])->name('index');
    Route::post('/', [ModulesController::class, 'store'])->name('store');
    Route::put('/{id}', [ModulesController::class, 'update'])->name('update');
    Route::delete('/{id}', [ModulesController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [ModulesController::class, 'show'])->name('show');
});

Route::prefix('lessons')->name('modules.')->group(function(){
    Route::get('/', [LessonController::class, 'index'])->name('index');
    Route::post('/', [LessonController::class, 'store'])->name('store');
    Route::put('/{id}', [LessonController::class, 'update'])->name('update');
    Route::delete('/{id}', [LessonController::class, 'destroy'])->name('destroy');
    Route::get('/{id}', [LessonController::class, 'show'])->name('show');
});



