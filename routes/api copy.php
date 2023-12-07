<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get('/unit','App\Http\Controllers\Api\UnitController@index');
Route::post('/unit/delete','App\Http\Controllers\Api\UnitController@delete');

// Domain 
Route::get('/domain','App\Http\Controllers\Api\DomainController@index');
Route::post('/domain/delete','App\Http\Controllers\Api\DomainController@delete');
Route::post('/domain/update','App\Http\Controllers\Api\DomainController@update');
// Audit QA
Route::get('/audit/qa','App\Http\Controllers\Api\AuditQAController@index');
Route::post('/audit/qa/delete','App\Http\Controllers\Api\AuditQAController@delete');
Route::post('/audit/qa/update','App\Http\Controllers\Api\AuditQAController@update');
Route::post('/audit/qa/store','App\Http\Controllers\Api\AuditQAController@store');

//Delegation
Route::get('/delegation','App\Http\Controllers\Api\DelegationController@index');
Route::post('/delegation/delete','App\Http\Controllers\Api\delegationController@delete');
Route::post('/delegation/update','App\Http\Controllers\Api\delegationController@update');
Route::post('/delegation/store','App\Http\Controllers\Api\delegationController@store');
//Delegation Role
Route::get('/delegation/role','App\Http\Controllers\Api\DelegationRoleController@index');
Route::post('/delegation/role/delete','App\Http\Controllers\Api\DelegationRoleController@delete');
Route::post('/delegation/role/update','App\Http\Controllers\Api\DelegationRoleController@update');
Route::post('/delegation/role/store','App\Http\Controllers\Api\DelegationRoleController@store');
//Entity
Route::get('/entity','App\Http\Controllers\Api\EntityController@index');
Route::post('/entity/delete','App\Http\Controllers\Api\EntityController@delete');
Route::post('/entity/update','App\Http\Controllers\Api\EntityController@update');
Route::post('/entity/store','App\Http\Controllers\Api\EntityController@store');
// Audit
Route::get('/audit/plan','App\Http\Controllers\Api\AuditController@index1');
Route::get('/audit/plan/edit','App\Http\Controllers\Api\AuditController@edit');

Route::get('/audit','App\Http\Controllers\Api\AuditController@index');
Route::post('/audit/delete','App\Http\Controllers\Api\AuditController@delete');
Route::post('/audit/update','App\Http\Controllers\Api\AuditController@update');
Route::post('/audit/store','App\Http\Controllers\Api\AuditController@store');

        
         //student
         Route::get('/student','App\Http\Controllers\Api\StudentController@index');
         Route::get('/student/edit','App\Http\Controllers\Api\StudentController@edit');
         Route::post('/student/update','App\Http\Controllers\Api\StudentController@update');
         Route::post('/student/store','App\Http\Controllers\Api\StudentController@store');
         Route::post('/student/delete','App\Http\Controllers\Api\StudentController@delete');
        

Route::get('/logout','App\Http\Controllers\Api\AuthController@logout');



Route::group(['namespace' => 'App\Http\Controllers\Api\\'], function(){
    Route::post('/login', 'AuthController@login');
    Route::post('/check/otp', 'AuthController@checkOTP');

    Route::middleware(['auth:api'])->group(function () {

        Route::get('/test', function(){
            return 'heeee';
        });

        Route::get('/logout','AuthController@logout');

        //permission
        Route::get('/permission','PermissionController@index');
        Route::post('/permission/update','PermissionController@update');
        Route::post('/permission/store','PermissionController@store');
        Route::post('/permission/delete','PermissionController@delete');

        //permission feature
        Route::get('/permission/feature','PermissionFeatureController@index');
        Route::post('/permission/feature/update','PermissionFeatureController@update');
        Route::post('/permission/feature/store','PermissionFeatureController@store');
        Route::post('/permission/feature/delete','PermissionFeatureController@delete');

        //role
        Route::get('/role','RoleController@index')->middleware('permission:role,view');
        Route::post('/role/update','RoleController@update')->middleware('permission:role,edit');
        Route::post('/role/store','RoleController@store')->middleware('permission:role,create');
        Route::post('/role/delete','RoleController@delete')->middleware('permission:role,delete');

        //role permission
        Route::get('/role/permission','RolePermissionController@index');
        Route::post('/role/permission/update', 'RolePermissionController@action');

        //user
        Route::get('/user','UserController@index')->middleware('permission:user,view');
        Route::post('/user/update','UserController@update')->middleware('permission:user,edit');
        Route::post('/user/store','UserController@store')->middleware('permission:user,create');
        Route::post('/user/delete','UserController@delete')->middleware('permission:user,delete');


        //api key
        Route::get('/api-key','ApiKeyController@index');
        Route::post('/api-key/update','ApiKeyController@update');
        Route::post('/api-key/store','ApiKeyController@store');
        Route::post('/api-key/delete','ApiKeyController@delete');



        //staff
        Route::get('/staff','StaffController@index')->middleware('permission:staff,view');
        Route::post('/staff/update','StaffController@update')->middleware('permission:staff,edit');
        Route::post('/staff/store','StaffController@store')->middleware('permission:staff,create');
        Route::post('/staff/delete','StaffController@delete')->middleware('permission:staff,delete');
        Route::post('/staff/archive','StaffController@archive')->middleware('permission:staff,archive');
        Route::post('/staff/archive/back','StaffController@archiveBack')->middleware('permission:staff,archive');
        Route::post('/staff/bookmark','StaffController@bookmark')->middleware('permission:staff,bookmark');


    });
});