<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TaskController;

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

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/weather', [WeatherController::class, 'fetchWeather']);
    Route::post('/weather/save', [WeatherController::class, 'saveWeatherAsTask']);
    Route::get('/task/view/{id}', [TaskController::class, 'show']);
    Route::get('/task/edit/{id}', [TaskController::class, 'edit']);
    Route::post('/task/update/{id}', [TaskController::class, 'update']);
    Route::get('/task/delete/{id}', [TaskController::class, 'destroy']);
});

require __DIR__ . '/auth.php';
