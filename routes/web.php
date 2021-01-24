<?php

use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\MassScheduleAllController;
use App\Http\Controllers\MassScheduleController;
use App\Http\Controllers\RoleController;
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

// Auth::routes(['register' => false]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cool', function () {
    return view('admin.cool');
});

Route::middleware('auth')->group(function () {
    Route::get('/mass_schedules', [MassScheduleController::class, 'index'])->name('mass_schedules.index');
    // Route::get('/mass_schedules/{massSchedule}/edit', [MassScheduleController::class, 'edit'])->name('mass_schedules.edit');
    Route::get('/mass_schedules/{massSchedule}/edit-reading', [MassScheduleController::class, 'editReading'])->name('mass_schedules.edit_reading');
    Route::get('/mass_schedules/{massSchedule}/edit-song', [MassScheduleController::class, 'editSong'])->name('mass_schedules.edit_song');
    Route::patch('/mass_schedules/{massSchedule}', [MassScheduleController::class, 'update'])->name('mass_schedules.update');
    Route::patch('/mass_schedules/{massSchedule}/song', [MassScheduleController::class, 'updateSong'])->name('mass_schedules.update_song');

    Route::get('/mass_schedules/day/{dayNum}', [MassScheduleController::class, 'getByDayNum'])->name('mass_schedules.day');
    Route::get('/mass_schedules/isidata/', [MassScheduleController::class, 'isiData'])->name('mass_schedules.isidata');

    Route::get('/sunday_masses', [MassScheduleController::class, 'sundayMassesIndex'])->name('mass_schedules.sunday_masses');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::put('/roles/{role}/attach', [RoleController::class, 'attachUser'])->name('roles.user.attach');
    Route::put('/roles/{role}/detach', [RoleController::class, 'detachUser'])->name('roles.user.detach');

    Route::get('/mass_schedules_all/{massSchedule}/edit', [MassScheduleAllController::class, 'edit'])->name('mass_schedules_all.edit'); //supaya route edit mengandung data
    Route::patch('/mass_schedules_all/{massSchedule}', [MassScheduleAllController::class, 'update'])->name('mass_schedules_all.update');
    Route::delete('/mass_schedules_all/{massSchedule}', [MassScheduleAllController::class, 'destroy'])->name('mass_schedules_all.destroy');
    Route::resource('mass_schedules_all', MassScheduleAllController::class);
});
