<?php

use App\Http\Controllers\Parents\Dashboard\ChildrenController;
use App\Http\Controllers\Students\Dashboard\ExamsController;
use App\Http\Controllers\Students\Dashboard\profileController;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| parent Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parent/dashboard', function () {
        $sons = Students::where('parent_id' , auth()->user()->id)->get();
        return view('pages.parents.dashboard' , compact('sons'));
    });

    Route::resource('student_exams' , ExamsController::class);
    Route::resource('student_profile' , profileController::class);

    Route::get('children' , [ChildrenController::class , 'index'])->name('chlidren.index');
    Route::get('child/{id}' , [ChildrenController::class , 'results'])->name('child.results');
    route::get('attendances' , [ChildrenController::class , 'attendances'])->name('children.attendances');
    route::post('attendances' , [ChildrenController::class , 'attendanceSearch'])->name('children.attendances.search');
    route::get('fees' , [ChildrenController::class , 'fees'])->name('children.fees');
    route::get('receipt/{id}' , [ChildrenController::class , 'receipt'])->name('fees.receipt');
    Route::get('profile_parent' , [ChildrenController::class, 'profile_parent'])->name('profile_parent.show');
    Route::post('profile_parent/{id}' , [ChildrenController::class, 'update_parent_profile'])->name('profile_parent.update');



});