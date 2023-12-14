<?php

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
// Auth::routes();
Route::post('/dologin', [App\Http\Controllers\UserController::class, 'dologin'])->name('dologin');
Route::get('/login', [App\Http\Controllers\UserController::class, 'login'])->name('login');
Route::get('/user/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('user.logout');
Route::get('/swtich-lang/{lang}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('language.change');
Route::get('/greeting/create-en', [App\Http\Controllers\LanguageController::class, 'createGreeting'])->name('language.greeting_create_en');
Route::post('/greeting/save/en', [App\Http\Controllers\LanguageController::class, 'greetingEn'])->name('language.greeting_en');
Route::get('/greeting/kh', [App\Http\Controllers\LanguageController::class, 'greetingKh'])->name('language.greeting_kh');
Route::post('/greeting/kh/save', [App\Http\Controllers\LanguageController::class, 'greetingkhSave'])->name('language.greeting_kh_save');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => ['auth', 'useraction']], function(){
    // Route::get('/', function () {
    //     return view('welcome');
    // });

    // dashbaord 
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('get-chart-data', [App\Http\Controllers\HomeController::class, 'getChartData'])->name('home.get_cart_data');


    // employee 
    Route::get('employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
    Route::get('employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
    Route::post('employee/save', [App\Http\Controllers\EmployeeController::class, 'save'])->name('employee.save');
    Route::get('employee/edit/{id}', [App\Http\Controllers\EmployeeController::class, 'edit'])->name('employee.edit');
    Route::post('employee/update', [App\Http\Controllers\EmployeeController::class, 'update'])->name('employee.update');

    // employee work experience
    Route::get('employee/experience', [App\Http\Controllers\EmployeeController::class, 'workExperience'])->name('employee.work_experience');
    // employee family info
    Route::get('employee/family-info', [App\Http\Controllers\EmployeeController::class, 'familyInfo'])->name('employee.family_info');

    
    // users

    Route::get('/user/list', [App\Http\Controllers\UserController::class, 'index'])->name('user.list');
    Route::post('/user/save', [App\Http\Controllers\UserController::class, 'save'])->name('user.save');
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');
    
    Route::get('/village/list', [App\Http\Controllers\VillageController::class, 'index'])->name('village.index');
    Route::post('/village/save', [App\Http\Controllers\VillageController::class, 'save'])->name('village.save');
    Route::get('/village/edit/{id}', [App\Http\Controllers\VillageController::class, 'edit'])->name('village.edit');
    Route::post('/village/update', [App\Http\Controllers\VillageController::class, 'update'])->name('village.update');
    Route::get('/village/delete/{id}', [App\Http\Controllers\VillageController::class, 'delete'])->name('village.delete');
   
    // commune 
    Route::get('/commune/list', [App\Http\Controllers\CommuneController::class, 'index'])->name('commune.index');
    Route::get('/commune/edit/{id}', [App\Http\Controllers\CommuneController::class, 'edit'])->name('commune.edit');

    // district
    Route::get('/district/list', [App\Http\Controllers\DistrictController::class, 'index'])->name('district.index');
    Route::get('/district/edit/{id}', [App\Http\Controllers\DistrictController::class, 'edit'])->name('district.edit');

    // province
    Route::get('/province/list', [App\Http\Controllers\ProvinceController::class, 'index'])->name('province.index');
    
    //Role
    Route::get('/role/list', [App\Http\Controllers\RoleController::class, 'index'])->name('role.index');
    // permission 
    Route::get('/permission/list', [App\Http\Controllers\PermissionController::class, 'index'])->name('permission.index');
    // permission feature
    Route::get('/permission-feature/list/{id}', [App\Http\Controllers\PermissionFeatureController::class, 'index'])->name('permission_feature.index');
    // role permision
    Route::get('/role-permission/list/{roel_id}', [App\Http\Controllers\RolePermissionController::class, 'index'])->name('role_permission.index');
    Route::get('/role-permission/regenerate', [App\Http\Controllers\RolePermissionController::class, 'reGenerateRole'])->name('role_permission.regenerate');
    // save role permission 
    Route::post('/role-psermission/save', [App\Http\Controllers\RolePermissionController::class, 'savePermission'])->name('role_permission.save');


    Route::get('/district-by-id', [App\Http\Controllers\DistrictController::class, 'getDistrictById'])->name('district.get_by_province_id');
    Route::get('/commune-by-id', [App\Http\Controllers\CommuneController::class, 'getCommuneById'])->name('commune.get_by_district_id');
    Route::get('/village-by-id', [App\Http\Controllers\VillageController::class, 'getVillageById'])->name('village.get_by_commune_id');


    // base actoins 
    Route::post('/base-action/save', [App\Http\Controllers\BaseController::class, 'save'])->name('base_action.save');
    Route::get('/base-action/edit', [App\Http\Controllers\BaseController::class, 'edit'])->name('base_action.edit');
    Route::post('/base-action/update', [App\Http\Controllers\BaseController::class, 'update'])->name('base_action.update');
    Route::get('/base-action/delete', [App\Http\Controllers\BaseController::class, 'delete'])->name('base_action.delete');

    Route::group(['prefix'=>'report','as'=>'report.'], function(){
        Route::get('/list-employee', [App\Http\Controllers\ReportController::class, 'listEmployee'])->name('list_employee');
    });

     // Route Database Auditeam
     Route::get('/delegation/list', [App\Http\Controllers\DelegationController::class, 'index'])->name('delegation.index');
     Route::post('/delegation/save', [App\Http\Controllers\DelegationController::class, 'save'])->name('delegation.save');
     Route::get('/delegation/role/list', [App\Http\Controllers\DelegationRoleController::class, 'index'])->name('delegation.role.index');
     Route::get('/audit_category/list', [App\Http\Controllers\AuditCategoryControlle::class, 'index'])->name('audit_category.index');
     Route::get('/audit_type/list', [App\Http\Controllers\AuditTypeControlle::class, 'index'])->name('audit_type.index');
     Route::get('/audit_status/list', [App\Http\Controllers\AuditStatusControlle::class, 'index'])->name('audit_status.index');
     Route::get('/audit_stds/list', [App\Http\Controllers\AuditStdControlle::class, 'index'])->name('audit_stds.index');
     Route::get('/audit_time/list', [App\Http\Controllers\AuditTimeController::class, 'index'])->name('audit_time.index');
     Route::get('/audit_process_status/list', [App\Http\Controllers\AuditProcessStatusController::class, 'index'])->name('audit_process_status.index');
     Route::get('/audit_step/list', [App\Http\Controllers\AuditStepController::class, 'index'])->name('audit_step.index');
     Route::get('/audit_qc/list', [App\Http\Controllers\AuditQCController::class, 'index'])->name('audit_qc.index');
     Route::get('/audit_qa/list', [App\Http\Controllers\AuditQAController::class, 'index'])->name('audit_qa.index');
     Route::get('/domain/list', [App\Http\Controllers\DomainController::class, 'index'])->name('domain.index');
     Route::get('/Audit_report_PFM/list', [App\Http\Controllers\AuditReportPfmController::class, 'index'])->name('audit.report.pfm.index');
     Route::get('/auditee/type/list', [App\Http\Controllers\AuditeeTypeController::class, 'index'])->name('auditee.type.index');
     Route::get('/auditee/person/list', [App\Http\Controllers\AuditeePersonController::class, 'index'])->name('auditee.person.index');
     Route::get('/auditee/contact/type/list', [App\Http\Controllers\AuditeeContactTypeController::class, 'index'])->name('auditee.contact.type.index');
     Route::get('/auditee/person/type/list', [App\Http\Controllers\AuditeePersonTypeController::class, 'index'])->name('auditee.person.type.index');
     Route::get('/client/type/list', [App\Http\Controllers\ClientTypeController::class, 'index'])->name('client.type.index');
     Route::get('/client/person/type/list', [App\Http\Controllers\ClientPersonTypeController::class, 'index'])->name('client.person.type.index');
     Route::get('/client/contact/type/list', [App\Http\Controllers\ClientContactTypeController::class, 'index'])->name('client.contact.type.index');
     Route::get('/client/person/list', [App\Http\Controllers\ClientPersonController::class, 'index'])->name('client.person.index');
     Route::get('/client/list', [App\Http\Controllers\ClientController::class, 'index'])->name('client.index');
     Route::get('/client/auditee/list', [App\Http\Controllers\ClientAuditeeController::class, 'index'])->name('client.auditee.index');
     Route::get('/auditee/list', [App\Http\Controllers\AuditeeController::class, 'index'])->name('auditee.index');
     Route::get('/client/person/contact/list', [App\Http\Controllers\ClientPersonContactController::class, 'index'])->name('client.person.contact.index');
     Route::get('/client/organization/contact/list', [App\Http\Controllers\ClientOrganizationContactController::class, 'index'])->name('client.organization.contact.index');
     Route::get('/auditee/person/contact/list', [App\Http\Controllers\AuditeePersonContactController::class, 'index'])->name('auditee.person.contact.index');
     Route::get('/auditee/organization/contact/list', [App\Http\Controllers\AuditeeOrganizationContactController::class, 'index'])->name('auditee.organization.contact.index');
     Route::get('/audit/pfm/list', [App\Http\Controllers\AuditPFMController::class, 'index'])->name('audit.pfm.index');
     Route::get('/audit/domain/list', [App\Http\Controllers\AuditDomainController::class, 'index'])->name('audit.domain.index');
     Route::get('/audit/tracking/list', [App\Http\Controllers\AuditTrackingController::class, 'index'])->name('audit.tracking.index');
     Route::get('/audit/qa/review/list', [App\Http\Controllers\AuditQAReviewController::class, 'index'])->name('audit.qa.review.index');
     Route::get('/audit/qc/review/list', [App\Http\Controllers\AuditQCReviewController::class, 'index'])->name('audit.qc.review.index');
     Route::get('/unit/list', [App\Http\Controllers\UnitController::class, 'index'])->name('unit.index');
     Route::get('/delegation/team/list', [App\Http\Controllers\DelegationTeamController::class, 'index'])->name('delegation.team.index');
     Route::get('/audit/list', [App\Http\Controllers\AuditController::class, 'index'])->name('audit.index');
     Route::post('/audit/save', [App\Http\Controllers\AuditController::class, 'save'])->name('audit.save');
     
     Route::get('/table/auditee', [App\Http\Controllers\AuditeeTableController::class, 'index'])->name('auditee.table');
    
    Route::get('/Chenge/Layout', [App\Http\Controllers\ChengeLayoutController::class, 'index'])->name('ChengeLayout');
    Route::post('/audit/table/save', [App\Http\Controllers\ChengeLayoutController::class, 'save'])->name('audit.table.save');
    Route::get('/audit/edit/{id}', [App\Http\Controllers\HomeController::class, 'edit'])->name('audit.edit');
    Route::post('/audit/delegation/save', [App\Http\Controllers\HomeController::class, 'delegation_save'])->name('audit.delegation.save');
    Route::post('/audit/delegation/Team/save', [App\Http\Controllers\HomeController::class, 'delegation_team_save'])->name('audit.delegation.team.save');


    
    
    Route::get('/audit/delegation', [App\Http\Controllers\HomeController::class, 'audit_delegation_team'])->name('audit.delegation');
});
Route::get('/Chenge/Layout', [App\Http\Controllers\ChengeLayoutController::class, 'index'])->name('ChengeLayout');
Route::fallback([App\Http\Controllers\PageNotFoundController::class, 'index']);
Route::get('/no-permission', function(){
    echo "You don't have permissoin!";
})->name('no-permission');