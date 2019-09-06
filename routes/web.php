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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

// users routes
Route::get('/users','UserController@manage')->middleware('auth','permission:Screen_69,[],screen_level');
Route::post('/users','UserController@save')->middleware('auth',"permission:Screen_69,Add,operation_level");
Route::post('/users/update','UserController@update')->middleware('auth',"permission:Screen_69,Edit,operation_level");
Route::get('/users/{id}/delete','UserController@delete')->middleware('auth',"permission:Screen_69,Delete,operation_level");
Route::get('/users/{id}/edit','UserController@edit')->middleware('auth',"permission:Screen_69,Edit,operation_level");


//branches routes
Route::get('/users/branches','UserController@manageBranches')->middleware('auth');
Route::post('/users/branches/add','UserController@saveBranches')->middleware('auth');
Route::get('/users/branch/{id}/{cascade}/delete','UserController@deleteBranch')->middleware('auth');
Route::post('/users/branches/update','UserController@updateBranch')->middleware('auth');
Route::get('/users/branch/{id}/edit','UserController@editBranch')->middleware('auth');
Route::get('/users/{id}/branches','UserController@user_branches')->middleware('auth');
Route::post('/users/{id}/branches/update','UserController@updateUserBranch')->middleware('auth');




//centers routes
Route::get('/center','CenterController@manage')->middleware('auth');
Route::post('/center/add','CenterController@save')->middleware('auth');
Route::post('/center/update','CenterController@update')->middleware('auth');
Route::get('/center/{key}/{source}/{last_id}/search','CenterController@search')->middleware('auth');
Route::get('/center/{id}/edit','CenterController@edit')->middleware('auth');
Route::get('/center/opening','CenterController@open_center')->middleware('auth');
Route::post('/center/opening/update','CenterController@open_center_update')->middleware('auth');

//permissions routes
Route::get('/permissions','PermissionController@index')->middleware('auth');
Route::post('/permissions/add','PermissionController@save')->middleware('auth');
Route::post('/permissions/{id}/update','PermissionController@update')->middleware('auth');
Route::get('/permissions/{id}/edit','PermissionController@edit')->middleware('auth');
Route::get('/permissions/users','PermissionController@users_list')->middleware('auth');
Route::get('/permissions/{id}/tree','PermissionController@manage_tree')->middleware('auth');
Route::post('/permissions/users/{id}/edit','PermissionController@update_user_permissions')->middleware('auth');

//students route
Route::get('/students','StudentController@index')->middleware('auth');
Route::get('/students/manage','StudentController@manage')->middleware('auth');
Route::post('/students/add','StudentController@save')->middleware('auth');
Route::post('/students/{id}/renew','StudentController@renew_registration')->middleware('auth');
Route::post('/students/{id}/update','StudentController@update')->middleware('auth');
Route::get('/students/{id}/recycle','StudentController@recycle_bin')->middleware('auth');
Route::get('/students/{id}/undo_recycle','StudentController@undo_recycle_bin')->middleware('auth');
Route::get('/students/recycle','StudentController@recycle')->middleware('auth');
Route::get('/students/{student_name}/search/basic','StudentController@basic_search')->middleware('auth');


//teachers route
Route::get('/teachers','TeacherController@index')->middleware('auth');
Route::get('/teachers/manage','TeacherController@manage')->middleware('auth');
Route::post('/teachers/add','TeacherController@save')->middleware('auth');
Route::post('/teachers/{id}/update','TeacherController@update')->middleware('auth');


//groups route
Route::get('/groups','GroupController@index')->middleware('auth');
Route::get('/groups/manage','GroupController@manage')->middleware('auth');
Route::get('/groups/{id}/schedules','GroupController@teacher_schedule')->middleware('auth');
Route::get('/groups/{id}/update','GroupController@update_group')->middleware('auth');
Route::get('/groups/{id}/students','GroupController@groups_students')->middleware('auth');
Route::post('/groups/add','GroupController@save')->middleware('auth');
Route::post('/groups/{id}/edit','GroupController@edit')->middleware('auth');
Route::post('/groups/payment/update','GroupController@update_payment')->middleware('auth');
Route::get('/groups/student/{student_id}/{group_id}/delete','GroupController@remove_student_group')->middleware('auth');
Route::get('/groups/{group_id}/delete','GroupController@delete_group')->middleware('auth');
Route::get('/groups/students/{id}/add','GroupController@add_group_students')->middleware('auth');
Route::post('/groups/students/add','GroupController@add_students_group')->middleware('auth');

//financial route
Route::get('/salary','FinancialController@index')->middleware('auth');
Route::get('/salary/{id}/statement','FinancialController@salary_statement')->middleware('auth');












