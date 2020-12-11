<?php

use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\MassScheduleController;
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

// Route::get('/', function () {
//     return view('front_page');
// });
Route::get('/', [FrontPageController::class, 'index'])->name('front_page.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cool', function () {
    return view('admin.cool');
});


Route::get('/mass_schedules', [MassScheduleController::class, 'index'])->name('mass_schedules.index');
Route::get('/mass_schedules/{massSchedule}/edit', [MassScheduleController::class, 'edit'])->name('mass_schedules.edit');
Route::patch('/mass_schedules/{massSchedule}', [MassScheduleController::class, 'update'])->name('mass_schedules.update');

Route::get('/mass_schedules/day/{dayNum}', [MassScheduleController::class, 'getByDayNum'])->name('mass_schedules.day');
Route::get('/mass_schedules/isidata/', [MassScheduleController::class, 'isiData'])->name('mass_schedules.isidata');
