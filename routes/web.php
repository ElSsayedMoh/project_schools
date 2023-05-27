<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Quizzes\QuizzesController;
use App\Http\Controllers\Subjects\SubjectsController;
use Illuminate\Support\Facades\View;

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
            Route::group(['namespace' => 'App\Http\Controllers\Grades'], function(){
                Route::resource('Grade', GradeController::class);
            });

                            //////////// Classes Rooms ///////////
            Route::group(['namespace' => 'App\Http\Controllers\ClassRooms'], function(){
                Route::resource('ClassRooms', ClassRoomController::class);
                Route::post('delete_all', [ App\Http\Controllers\ClassRooms\ClassRoomController::class , 'delete_all'])->name('delete_all');
                Route::post('search_grade', [ App\Http\Controllers\ClassRooms\ClassRoomController::class , 'search_grade'])->name('search_grade');
            });

            ///////////////// Sections /////////////
            Route::group(['namespace' => 'App\Http\Controllers\Sections'], function(){
                Route::resource('Sections', SectionsController::class);
                Route::get('/classes/{id}', [App\Http\Controllers\Sections\SectionsController::class, 'getClasses'])->name('/classes/{id}');
            });

            //////////////////// Parents //////////////////////
            Route::view('Parents', 'livewire.show_form');


            ///////////////////// Teachers //////////////////////
            Route::group(['namespace' => 'App\Http\Controllers\Teachers'], function(){
                Route::resource('Teachers' , TeachersController::class);
            });

            ///////////////////// Students //////////////////////
            Route::view('Students', 'Pages.Students.list_students');
            Route::group(['namespace' => 'App\Http\Controllers\Students'], function(){
                Route::resource('StudentsPromotion' , StudentsPromotionController::class);
                Route::get('getClassroom' , [App\Http\Controllers\Students\StudentsPromotionController::class , 'getClassroom'])->name('getClassroom');
                Route::get('getSection' , [App\Http\Controllers\Students\StudentsPromotionController::class , 'getSection'])->name('getSection');
                Route::resource('StudentsGraduate', StudentsGraduateController::class);
                Route::resource('Fees_Invoices' , FeesInvoicesController::class);
                Route::resource('receipt_students' , ReceiptStudentsController::class);
                Route::resource('Payment_student' , PaymentStudentController::class);
                Route::resource('Attendance' , AttendanceController::class);

                //// online classes
                Route::resource('online_classes' , OnlineClasseController::class);
                Route::get('/offline', [App\Http\Controllers\Students\OnlineClasseController::class , 'offLineCreate'])->name('offline.create');
                Route::post('/offline', [App\Http\Controllers\Students\OnlineClasseController::class , 'offLineStore'])->name('offline.store');

                /// Library
                Route::resource('Library' , LibraryController::class);
                Route::get('downloadAttachment/{file_name}' , [App\Http\Controllers\Students\LibraryController::class , 'downloadAttachment'])->name('downloadAttachment');
            });


            ///////////////////// Fees //////////////////////
            Route::group(['namespace' => 'App\Http\Controllers\Fees'], function(){
                Route::resource('Fees' , FeesController::class);
                Route::resource('fee_processing' , FeeProcessingController::class);

            });

            ///////////////////// Subjects //////////////////////
            Route::resource('Subjects' ,SubjectsController::class );

            ///////////////////// Quizze //////////////////////
            Route::resource('Quizze' ,QuizzesController::class );
});




