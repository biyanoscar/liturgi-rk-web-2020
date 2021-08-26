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
use App\Http\Controllers\OrganistController;
use App\Http\Controllers\SettingController;

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
Route::get('/teks-misa', [FrontPageController::class, 'showMassText'])->name('front_page.show_mass_text');

// Auth::routes(['register' => false]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/cool', function () {
    return view('admin.cool');
});

Route::middleware('auth')->group(function () {
    Route::prefix('mass_schedules')->name('mass_schedules.')->group(function () {
        Route::get('/', [MassScheduleController::class, 'index'])->name('index');
        Route::get('/{massSchedule}/edit-reading', [MassScheduleController::class, 'editReading'])->name('edit_reading');
        Route::get('/{massSchedule}/edit-song', [MassScheduleController::class, 'editSong'])->name('edit_song');
        Route::patch('/{massSchedule}', [MassScheduleController::class, 'update'])->name('update');
        Route::patch('/{massSchedule}/song', [MassScheduleController::class, 'updateSong'])->name('update_song');

        Route::get('/day/{dayNum}', [MassScheduleController::class, 'getByDayNum'])->name('day');
    });

    Route::get('/sunday_masses', [MassScheduleController::class, 'sundayMassesIndex'])->name('mass_schedules.sunday_masses');

    Route::resource('choirs', ChoirController::class);

    Route::resource('choir_members', ChoirMemberController::class);
    Route::get('/choir_members/{choir}/create-by-parent', [ChoirMemberController::class, 'createByParent'])->name('choir_members.create_by_parent');

    Route::resource('ministry_schedules', MinistryScheduleController::class);

    Route::group(['prefix' => 'ministry_schedules', 'as' => 'ministry_schedules.'], function () {
        Route::get('/{schedule}/create-by-mass-schedule', [MinistryScheduleController::class, 'createByMassSchedule'])->name('create_by_mass_schedule');
        Route::get('/{schedule}/fill-by-mass-schedule', [MinistryScheduleController::class, 'fillByMassSchedule'])->name('fill_by_mass_schedule');

        //route tambahkan petugas ke jadwal misa
        Route::put('/{ministrySchedule}/attach', [MinistryScheduleController::class, 'attachChoirMember'])->name('choirMember.attach');
        Route::put('/{ministrySchedule}/detach', [MinistryScheduleController::class, 'detachChoirMember'])->name('choirMember.detach');

        Route::patch('/{ministrySchedule}/updated-by-choir', [MinistryScheduleController::class, 'updatedByChoir'])->name('updated_by_choir');
    });
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('roles', RoleController::class);
    Route::put('/roles/{role}/attach', [RoleController::class, 'attachUser'])->name('roles.user.attach');
    Route::put('/roles/{role}/detach', [RoleController::class, 'detachUser'])->name('roles.user.detach');

    Route::resource('users', UserController::class);
});

Route::middleware(['auth', 'role:liturgi'])->group(function () {
    Route::prefix('mass_schedules_all')->name('mass_schedules_all.')->group(function () {
        Route::get('/create_by_date_range', [MassScheduleAllController::class, 'createByDateRange'])->name('create_by_date_range');
        Route::post('/store_by_date_range', [MassScheduleAllController::class, 'storeByDateRange'])->name('store_by_date_range');

        Route::get('/{massSchedule}/edit', [MassScheduleAllController::class, 'edit'])->name('edit'); //supaya route edit mengandung data
        Route::patch('/{massSchedule}', [MassScheduleAllController::class, 'update'])->name('update');
        Route::delete('/{massSchedule}', [MassScheduleAllController::class, 'destroy'])->name('destroy');
    });
    Route::resource('mass_schedules_all', MassScheduleAllController::class);
    
    Route::resource('settings', SettingController::class);

    Route::resource('organists', OrganistController::class);
});
