<?php

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

Route::get('/','pagesView@index')->middleware(checkposition::class);
Route::get('admin','pagesView@admin')->middleware(checkadmin::class);
Route::get('teacher','pagesView@teacher')->middleware(checkteacher::class);
Route::get('attendance','pagesView@attendance')->middleware(checkteacher::class);
Route::get('busAdd','pagesView@bus_add')->middleware(checkadmin::class);
Route::get('busUpdate','pagesView@bus_update')->middleware(checkadmin::class);
Route::get('busDelete','pagesView@bus_delete')->middleware(checkadmin::class);
Route::get('studentbus','pagesView@assignbus')->middleware(checkadmin::class);
Route::get('employee','pagesView@employee')->middleware(checkadmin::class);
Route::get('grades','pagesView@grades')->middleware(checkteacher::class);
Route::get('parent','pagesView@parent')->middleware(checkadmin::class);
Route::get('profile','pagesView@profile')->middleware(checklogged::class);
Route::get('student','pagesView@student')->middleware(checkadmin::class);
Route::get('studentAccess','pagesView@studentAccess')->middleware(checklogged::class);
Route::get('busAccess','pagesView@busAccess')->middleware(checklogged::class);
Route::get('classAccess','pagesView@classAccess')->middleware(checklogged::class);
Route::get('sheet','pagesView@sheets')->middleware(checkadmin::class);
Route::get('timetable','pagesView@timetable')->middleware(checkadmin::class);
Route::get('notification','pagesView@notification')->middleware(checkadmin::class);
Route::get('bustracking','pagesView@bustracking')->middleware(checkadmin::class);
Route::get('homepage','pagesView@homepage');
Route::get('slider','pagesView@slider')->middleware(checkadmin::class);
Route::get('subject','pagesView@subject')->middleware(checkadmin::class);
Route::get('line','pagesView@line')->middleware(checkadmin::class);
Route::get('news','pagesView@news')->middleware(checkadmin::class);
Route::get('class','pagesView@class')->middleware(checkadmin::class);
Route::get('teachersubjectclass','pagesView@teachersubjectclass')->middleware(checkadmin::class);
Route::get('assignsubjects','pagesView@assignsubjects')->middleware(checkadmin::class);
Route::get('api/buses', 'pagesView@buses_coords')->middleware(checkadmin::class);
Route::get('api/bus', 'pagesView@bus_coords');

Route::get('studentProfile/{id}', 'pagesView@studentProfile');
Route::get('askyourteacher','pagesView@askyourteacher');
Route::get('subjectstudent','pagesView@subjectstudent');
Route::get('studentInterface','pagesView@studentInterface');
Route::get('library','pagesView@library');
Route::get('answerQuestions','pagesView@answerQuestions');
Route::get('updateStudentPassword','pagesView@updateStudentPassword');

Route::get('libraryAdmin','pagesView@libraryAdmin');

Route::get('parentPanel','pagesView@parentPanel');
Route::get('bustrackingparent','pagesView@bustrackingParent');

Route::get('forgetPassword','pagesView@forgetPassword');
Route::get('mailContent','pagesView@mailContent');

//position employee or parent
Route::get('resetPassword/{position}/{id}', 'pagesView@recoveryPassword');

Route::get('confirmPassword/{user}/{pass}', 'formsCont@confirmPassword');

Route::get('logout',function(){
	session()->flush();
	return redirect('/');
});

/*Route::get('addfinger',function(){
	$command = escapeshellcmd('C:\Users\hesha\Desktop\Desktop\pyfingerprint\src\files\enroll_function.py'.' '.INPUT::get('studentId'));
	$output = shell_exec($command);
	echo "done";
});
*/
Route::post('insertEmployee','formsCont@insertEmployee');
Route::post('insertStudent','formsCont@insertStudent');
Route::post('insertParent','formsCont@insertParent');

Route::post('insertBus','formsCont@insertBus');
Route::post('busUpdate1','formsCont@busUpdate1');
Route::post('updateBus','formsCont@updateBus');
Route::post('busDelete1','formsCont@busDelete1');
Route::post('busDelete2','formsCont@busDelete2');

Route::post('uploadSheet','formsCont@uploadSheet');
Route::post('uploadTimetable','formsCont@uploadTimetable');

Route::post('returnStudent','formsCont@returnStudent');
Route::post('insertAttend','formsCont@insertAttend');

Route::post('login','formsCont@login');
Route::post('loginStudent','formsCont@loginStudent');
Route::post('loginEmployee','formsCont@loginEmployee');
Route::post('loginParent','formsCont@loginParent');
Route::post('accessStudent','formsCont@accessStudent');

Route::post('accessBus','formsCont@accessBus');
Route::post('accessClass','formsCont@accessClass');

Route::post('returnGrades','formsCont@returnGrades');
Route::post('insertGrades','formsCont@insertGrades');

Route::post('NotificationSingleDevice','formsCont@NotificationSingleDevice');
Route::post('NotificationMultiDevice','formsCont@NotificationMultiDevice');
Route::post('NotificationSingleTopic','formsCont@NotificationSingleTopic');
Route::post('NotificationMultiTopic','formsCont@NotificationMultiTopic');

Route::post('employeeUpdate','formsCont@employeeUpdate');
Route::post('employeeUpdate1','formsCont@employeeUpdate1');
Route::post('employeeCUpdate1','formsCont@employeeCUpdate1');

Route::post('employeeDelete','formsCont@employeeDelete');
Route::post('employeeDelete1','formsCont@employeeDelete1');
Route::post('employeeCDelete1','formsCont@employeeCDelete1');

Route::post('parentUpdate','formsCont@parentUpdate');
Route::post('parentUpdate1','formsCont@parentUpdate1');
Route::post('parentCUpdate1','formsCont@parentCUpdate1');

Route::post('parentDelete','formsCont@parentDelete');
Route::post('parentDelete1','formsCont@parentDelete1');
Route::post('parentCDelete1','formsCont@parentCDelete1');

Route::post('studentUpdate','formsCont@studentUpdate');
Route::post('studentUpdate1','formsCont@studentUpdate1');
Route::post('studentCUpdate1','formsCont@studentCUpdate1');

Route::post('studentDelete','formsCont@studentDelete');
Route::post('studentDelete1','formsCont@studentDelete1');
Route::post('studentCDelete1','formsCont@studentCDelete1');

Route::post('studentBuss1','formsCont@student_Bus1');
Route::post('studentBuss','formsCont@student_Bus');


Route::post('forgetPass','formsCont@forgetPass');

Route::post('recoveryPassword', 'formsCont@recoveryPassword');


Route::post('addSubjectStudent', 'formsCont@addSubjectStudent');
Route::post('addpost', 'formsCont@addpost');
Route::post('deletePost', 'formsCont@deletePost');
Route::post('addcomment', 'formsCont@addcomment');

Route::post('addcommentTeacher', 'formsCont@addcommentTeacher');
Route::post('loadSheets', 'formsCont@loadSheets');
Route::post('loadSheetsAdmin', 'formsCont@loadSheetsAdmin');

Route::post('addClass','formsCont@addClass');
Route::post('classDelete','formsCont@classDelete');
Route::post('sheetDelete','formsCont@sheetDelete');

Route::post('addSubject','formsCont@addSubject');
Route::post('subjectDelete','formsCont@subjectDelete');

Route::post('addLine','formsCont@addLine');
Route::post('lineDelete','formsCont@lineDelete');

Route::post('assignClassesToTeacher','formsCont@assignClassesToTeacher');
Route::post('assignSubjectsToClass','formsCont@assignSubjectsToClass');
Route::post('updateStudentPass','formsCont@updateStudentPass');

Route::post('addNews','formsCont@addNews');
Route::post('deleteNews','formsCont@deleteNews');

Route::post('enrollFingerPrint','formsCont@enrollFingerPrint');
