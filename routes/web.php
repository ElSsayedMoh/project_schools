<?php

// use App\Http\Controllers\GradeController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\HomeController;
// use App\Http\Controllers\Teachers\TeachersController;
use Illuminate\Support\Facades\View;
// use App\Http\Controllers\ClassRooms\ClassRoomController;

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

Auth::routes();

Route::group(['middleware' => ['guest']], function(){   // guest =>  login الاشخاص الى مش عاملين  
    Route::get('/', function(){
        return view('auth.login');
    });
});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ],
        function(){ 
            //==============================dashboard============================//
            Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

                            ///////////////// Grade /////////////
            Route::group(['namespace' => 'Grades'], function(){
                Route::resource('Grade', GradeController::class);
            });

                            //////////// Classes Rooms ///////////
            Route::group(['namespace' => 'ClassRooms'], function(){
                Route::resource('ClassRooms', ClassRoomController::class);
                Route::post('delete_all', [ App\Http\Controllers\ClassRooms\ClassRoomController::class , 'delete_all'])->name('delete_all');
                Route::post('search_grade', [ App\Http\Controllers\ClassRooms\ClassRoomController::class , 'search_grade'])->name('search_grade');
            });

            ///////////////// Sections /////////////
            Route::group(['namespace' => 'Sections'], function(){
                Route::resource('Sections', SectionsController::class);
                Route::get('/classes/{id}', [App\Http\Controllers\Sections\SectionsController::class, 'getClasses'])->name('/classes/{id}');
            });

            //////////////////// Parents //////////////////////
            Route::view('Parents', 'livewire.show_form');


            ///////////////////// Teachers //////////////////////
            Route::group(['namespace' => 'Teachers'], function(){
                Route::resource('Teachers' , TeachersController::class);
            });

            ///////////////////// Students //////////////////////
            Route::view('Students', 'Pages.Students.list_students');
            Route::group(['namespace' => 'Students'], function(){
                Route::resource('StudentsPromotion' , StudentsPromotionController::class);
                Route::get('getClassroom' , [App\Http\Controllers\Students\StudentsPromotionController::class , 'getClassroom'])->name('getClassroom');
                Route::get('getSection' , [App\Http\Controllers\Students\StudentsPromotionController::class , 'getSection'])->name('getSection');
                Route::resource('StudentsGraduate', StudentsGraduateController::class);
                

            });
});





