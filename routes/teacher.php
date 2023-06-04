<?php

use App\Http\Controllers\Quizzes\QuizzesController;
use App\Http\Controllers\Teachers\OnlineClassesTeacher;
use App\Http\Controllers\Teachers\ProfileController;
use App\Http\Controllers\Teachers\QuestionController;
use App\Http\Controllers\Teachers\QuizzesOfTeacherController;
use App\Http\Controllers\Teachers\StudentsOfTeacherController;
use App\Models\Students;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| student Routes
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {

        $ids = Teachers::findOrFail(auth()->user()->id)->Sections()->pluck('section_id');
        $count_sections = $ids->count();
        $count_students = Students::whereIn('section_id', $ids)->count();
        return view('pages.Teachers.dashboard' , compact('count_sections' , 'count_students'));
    });

    Route::get('students_of_teacher' , [StudentsOfTeacherController::class , 'index'])->name('students_of_teacher');
    Route::get('sections_of_teacher' , [StudentsOfTeacherController::class , 'section'])->name('sections_of_teacher');
    Route::post('attendance_store' , [StudentsOfTeacherController::class , 'attendance_store'])->name('attendance_store');
    Route::get('report_attendance' , [StudentsOfTeacherController::class , 'report_attendance'])->name('report_attendance');
    Route::post('attendance_search' , [StudentsOfTeacherController::class , 'attendance_search'])->name('attendance_search');



    ///////////////////// Quizze //////////////////////
    Route::resource('quizzes' ,QuizzesOfTeacherController::class );
    Route::get('getClassroomTeacher' , [QuizzesOfTeacherController::class , 'getClassroomTeacher'])->name('getClassroomTeacher');
    Route::get('getSectionTeacher' , [QuizzesOfTeacherController::class , 'getSectionTeacher'])->name('getSectionTeacher');

    ///////////////// Question //////////////////////
    Route::resource('Question', QuestionController::class);

    ////////////////// Online Classes //////////////////////
    Route::resource('online_classes_teacher' , OnlineClassesTeacher::class);
    Route::get('/offline_teacher', [OnlineClassesTeacher::class , 'offLineCreate'])->name('offline_teacher.create');
    Route::post('/offline_teacher', [OnlineClassesTeacher::class , 'offLineStore'])->name('offline_teacher.store');

    //////////// Profile //////////////////////
    Route::get('profile_teacher' , [ProfileController::class, 'index'])->name('profile_teacher.show');
    Route::post('profile_teacher/{id}' , [ProfileController::class, 'update'])->name('profile_teacher.update');
});