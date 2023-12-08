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
// Route::get('/audit/plan/2','App\Http\Controllers\Api\AuditController@index2');
Route::get('/audit/plan','App\Http\Controllers\Api\AuditController@index1');
Route::get('/audit/plan/edit','App\Http\Controllers\Api\AuditController@edit');

Route::get('/audit','App\Http\Controllers\Api\AuditController@index');
Route::post('/audit/delete','App\Http\Controllers\Api\AuditController@delete');
Route::post('/audit/update','App\Http\Controllers\Api\AuditController@update');
Route::post('/audit/store','App\Http\Controllers\Api\AuditController@store');

Route::get('/dashboard','App\Http\Controllers\Api\DashboardController@index');
Route::get('/dashboard/edit','App\Http\Controllers\Api\DashboardController@edit');

Route::get('/dashboard/delegation_team','App\Http\Controllers\Api\DashboardController@delegation_team');


        
         //student
         Route::get('/student','App\Http\Controllers\Api\StudentController@index');
         Route::get('/student/edit','App\Http\Controllers\Api\StudentController@edit');
         Route::post('/student/update','App\Http\Controllers\Api\StudentController@update');
         Route::post('/student/store','App\Http\Controllers\Api\StudentController@store');
         Route::post('/student/delete','App\Http\Controllers\Api\StudentController@delete');
        

Route::get('/logout','App\Http\Controllers\Api\AuthController@logout');


Route::group(['namespace' => 'App\Http\Controllers\Api\\'], function(){
    Route::post('/login', 'AuthController@login');
   

    Route::middleware(['auth:api'])->group(function () {

        Route::get('/test', function(){
            return 'heeee';
        });

        Route::get('/logout','AuthController@logout');

     

      
        //role
        Route::get('/role','RoleController@index');
        Route::post('/role/update','RoleController@update');
        Route::post('/role/store','RoleController@store');
        Route::post('/role/delete','RoleController@delete');

    
        //user
        Route::get('/user','UserController@index');
        Route::post('/user/update','UserController@update');
        Route::post('/user/store','UserController@store');
        Route::post('/user/delete','UserController@delete');


        //api key
        Route::get('/api-key','ApiKeyController@index');
        Route::post('/api-key/update','ApiKeyController@update');
        Route::post('/api-key/store','ApiKeyController@store');
        Route::post('/api-key/delete','ApiKeyController@delete');
    });
});