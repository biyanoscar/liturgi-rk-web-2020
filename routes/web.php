<?php

use App\Http\Controllers\ChoirController;
use App\Http\Controllers\ChoirMemberController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\MassScheduleAllController;
use App\Http\Controllers\MassScheduleController;
use App\Http\Controllers\MinistryScheduleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
Route::get('/jadwal', [FrontPageController::class, 'schedule'])->name('front_page.schedule');

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
    // Route::get('/mass_schedules/isidata/', [MassScheduleController::class, 'isiData'])->name('mass_schedules.isidata');

    Route::get('/sunday_masses', [MassScheduleController::class, 'sundayMassesIndex'])->name('mass_schedules.sunday_masses');

    Route::resource('choirs', ChoirController::class);

    Route::resource('choir_members', ChoirMemberController::class);
    Route::get('/choir_members/{choir}/create-by-parent', [ChoirMemberController::class, 'createByParent'])->name('choir_members.create_by_parent');

    Route::resource('ministry_schedules', MinistryScheduleController::class);
    Route::get('/ministry_schedules/{schedule}/create-by-mass-schedule', [MinistryScheduleController::class, 'createByMassSchedule'])->name('ministry_schedules.create_by_mass_schedule');
    Route::get('/ministry_schedules/{schedule}/fill-by-mass-schedule', [MinistryScheduleController::class, 'fillByMassSchedule'])->name('ministry_schedules.fill_by_mass_schedule');

    //route tambahkan petugas ke jadwal misa
    Route::put('/ministry_schedules/{ministrySchedule}/attach', [MinistryScheduleController::class, 'attachChoirMember'])->name('ministrySchedules.choirMember.attach');
    Route::put('/ministry_schedules/{ministrySchedule}/detach', [MinistryScheduleController::class, 'detachChoirMember'])->name('ministrySchedules.choirMember.detach');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::put('/roles/{role}/attach', [RoleController::class, 'attachUser'])->name('roles.user.attach');
    Route::put('/roles/{role}/detach', [RoleController::class, 'detachUser'])->name('roles.user.detach');

    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'role:liturgi'])->group(function () {
    Route::get('/mass_schedules_all/create_by_date_range', [MassScheduleAllController::class, 'createByDateRange'])->name('mass_schedules_all.create_by_date_range');
    Route::post('/mass_schedules_all/store_by_date_range', [MassScheduleAllController::class, 'storeByDateRange'])->name('mass_schedules_all.store_by_date_range');


    Route::get('/mass_schedules_all/{massSchedule}/edit', [MassScheduleAllController::class, 'edit'])->name('mass_schedules_all.edit'); //supaya route edit mengandung data
    Route::patch('/mass_schedules_all/{massSchedule}', [MassScheduleAllController::class, 'update'])->name('mass_schedules_all.update');
    Route::delete('/mass_schedules_all/{massSchedule}', [MassScheduleAllController::class, 'destroy'])->name('mass_schedules_all.destroy');
    Route::resource('mass_schedules_all', MassScheduleAllController::class);
});
