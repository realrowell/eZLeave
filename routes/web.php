<?php

use App\Http\Controllers\admin\AccountManagementController;
use App\Http\Controllers\admin\AdminDashboard;
use App\Http\Controllers\admin\AdminLeaveMaintenanceController;
use App\Http\Controllers\admin\AdminLeaveManagementController;
use App\Http\Controllers\admin\AdminLeavePageController;
use App\Http\Controllers\admin\AdminPageController;
use App\Http\Controllers\admin\AreaOfAssignmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Page_Controller;
use App\Http\Controllers\indexPageController;
use App\Http\Controllers\User_Profile_Controller;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\admin\DepartmentController;
use App\Http\Controllers\admin\PositionController;
use App\Http\Controllers\admin\SubDepartmentController;
use App\Http\Controllers\admin\SystemSettingsController;
use App\Http\Controllers\HRStaffController;
use App\Http\Controllers\hr_staff\LeaveCreditController;
use App\Http\Controllers\hr_staff\LeaveTypesController;
use App\Http\Controllers\hr_staff\LeaveApplicationController;
use App\Http\Controllers\employee\EmployeeDashboard;
use App\Http\Controllers\employee\EmployeeLeaveApplicationController;
use App\Http\Controllers\employee\EmployeePageController;
use App\Http\Controllers\employee\EmployeeProfileController;
use App\Http\Controllers\employee\NotificationController;
use App\Http\Controllers\hr_staff\HrStaffLeavePageController;
use App\Http\Controllers\hr_staff\HrStaffPageController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/', [indexPageController::class, 'index'])->name('index');

Route::get('/profile/user_profile', [User_Profile_Controller::class, 'profile_user_profile'])->name('employee_user_profile');
Route::get('/profile/user_profile/edit', [User_Profile_Controller::class, 'profile_user_profile_edit']);


/*
|
|--------------------------------------------------------------------------
| Employee Profile Routes
|--------------------------------------------------------------------------
|
|
*/
Route::get('/dashboard', [EmployeeDashboard::class, 'employee_dashboard'])->name('employee_dashboard');
Route::get('/profile', [EmployeeProfileController::class, 'employee_profile'])->name('employee_profile');
Route::get('/profile/update/view', [EmployeeProfileController::class, 'employee_profile_update_view'])->name('employee_profile_update_view');
Route::get('/notifications', [EmployeePageController::class, 'user_notifications_page'])->name('user.notification.page');
Route::get('/notifications/mark_read/{id}', [NotificationController::class, 'notification_mark_read'])->name('user.notification.mark_read');
Route::get('/notifications/mark_unread/{id}', [NotificationController::class, 'notification_mark_unread'])->name('user.notification.mark_unread');
Route::patch('/profile/update', [EmployeeProfileController::class, 'employee_update_profile'])->name('employee_update_profile');
Route::get('/leave_management/menu', [EmployeePageController::class, 'profile_leave_management_menu'])->name('profile_leave_management_menu');
Route::get('/leave_management/for_approval/grid_view', [EmployeePageController::class, 'profile_leave_management_for_approval_grid'])->name('profile_leave_management_for_approval_grid');
Route::get('/leave_management/for_approval/list_view', [EmployeePageController::class, 'profile_leave_management_for_approval_list'])->name('profile_leave_management_for_approval_list');
Route::get('/leave_management/approval_history/list_view', [EmployeePageController::class, 'profile_leave_management_approval_history_list'])->name('profile.leave_management.approval_history.list');
Route::get('/leave_management/leave_details/{leave_application_rn}', [EmployeePageController::class, 'leaveDetailsPage'])->name('leave_details_page');
Route::get('/leave_management/leave_details-search_leave/', [EmployeePageController::class, 'leaveDetailsSearchPage'])->name('leave_details.search');
Route::get('/leave_management/pending_approval/grid_view', [EmployeePageController::class, 'profile_leave_management_pending_approval_grid'])->name('profile_leave_management_pending_approval_grid');
Route::get('/leave_management/pending_approval/list_view', [EmployeePageController::class, 'profile_leave_management_pending_approval_list'])->name('profile_leave_management_pending_approval_list');
Route::get('/leave_management/cancelled/grid_view', [EmployeePageController::class, 'profile_leave_management_cancelled_grid'])->name('profile_leave_management_cancelled_grid');
Route::get('/leave_management/cancelled/list_view', [EmployeePageController::class, 'profile_leave_management_cancelled_list'])->name('profile_leave_management_cancelled_list');
Route::get('/leave_management/pending_availment/grid_view', [EmployeePageController::class, 'profile_leave_management_pending_availment_grid'])->name('profile_leave_management_pending_availment_grid');
Route::get('/leave_management/pending_availment/list_view', [EmployeePageController::class, 'profile_leave_management_pending_availment_list'])->name('profile_leave_management_pending_availment_list');
Route::get('/leave_management/history/grid_view', [EmployeePageController::class, 'profile_leave_management_history_grid'])->name('profile_leave_management_history_grid');
Route::get('/leave_management/history/list_view', [EmployeePageController::class, 'profile_leave_management_history_list'])->name('profile_leave_management_history_list');
Route::post('/employee/create_leaveapplication', [EmployeeLeaveApplicationController::class, 'create_employee_leaveapplication'])->name('create_employee_leaveapplication');
Route::post('/employee/update_leaveapplication/{leave_application_rn}', [EmployeeLeaveApplicationController::class, 'update_employee_leaveapplication'])->name('update_employee_leaveapplication');
Route::post('/employee/create_note_leaveapplication/{leave_application_rn}', [EmployeeLeaveApplicationController::class, 'create_note_employee_leaveapplication'])->name('create_note_employee_leaveapplication');
Route::post('/employee/approve_leaveapplication/{leave_application_rn}', [EmployeeLeaveApplicationController::class, 'employee_leave_application_approval'])->name('employee_leave_approval');
Route::post('/employee/reject_leaveapplication/{leave_application_rn}', [EmployeeLeaveApplicationController::class, 'employee_leave_application_rejection'])->name('employee_leave_rejection');
Route::post('/employee/cancel_leaveapplication/{leave_application_rn}', [EmployeeLeaveApplicationController::class, 'employee_leave_application_cancellation'])->name('employee_leave_cancellation');


/*
|
|--------------------------------------------------------------------------
| HR Staff Profile Routes
|--------------------------------------------------------------------------
|
|
*/
Route::get('/hr/dashboard', [HrStaffPageController::class, 'hrstaff_dashboard'])->name('hrstaff_dashboard');
Route::get('/hr/dashboard/{fiscal_year}', [HrStaffPageController::class, 'hrstaff_fy_dashboard'])->name('hrstaff_fy_dashboard');
Route::get('/hr/employee_management/employees/grid', [HrStaffPageController::class, 'hrstaff_employee_management_employees_grid'])->name('hrstaff_employees_grid');
Route::get('/hr/employee_management/employees/list', [HrStaffPageController::class, 'hrstaff_employee_management_employees_list'])->name('hrstaff_employees_list');
Route::get('/hr/employee_management/employees/grid/search', [HrStaffPageController::class, 'hrstaff_employee_management_employees_grid_search'])->name('hrstaff_employees_grid_search');
Route::get('/hr/employee_management/employees/list/search', [HrStaffPageController::class, 'hrstaff_employee_management_employees_list_search'])->name('hrstaff_employees_list_search');
Route::get('/hr/employee_management/employees/regular/grid', [HrStaffPageController::class, 'hrstaff_employee_management_regular_grid'])->name('hrstaff_employees_regular_grid');
Route::get('/hr/employee_management/employees/regular/list', [HrStaffPageController::class, 'hrstaff_employee_management_regular_list'])->name('hrstaff_employees_regular_list');
Route::get('/hr/employee_management/employees/probationary/grid', [HrStaffPageController::class, 'hrstaff_employee_management_probationary_grid'])->name('hrstaff_employees_probi_grid');
Route::get('/hr/employee_management/employees/probationary/list', [HrStaffPageController::class, 'hrstaff_employee_management_probationary_list'])->name('hrstaff_employees_probi_list');
// Route::post('/hr/create-user', [UserManagementController::class, 'create_user']);
// Route::put('/hr/update-user/{user_id}/{employee_id}/{employee_position_id}', [UserManagementController::class, 'update_user']);
// Route::patch('/hr/update-user/{user_id}/{employee_id}/{employee_position_id}', [UserManagementController::class, 'update_user'])->name('update_user');
Route::get('/hr/profile', [HrStaffPageController::class, 'hrstaff_visit_profile'])->name('hrstaff_profile');
Route::get('/hr/profile/update', [HrStaffPageController::class, 'hrstaff_visit_profile_update'])->name('hrstaff_profile_update');

Route::get('/addAccount/getSubdepartment/{id}', [AccountManagementController::class, 'GetSubdepartmentFromDepartment'])->name('addAccount_getSubdepart');
Route::get('/addAccount/getPosition/{id}', [AccountManagementController::class, 'GetPositionFromSubdepartment'])->name('addAccount_getPosition');

Route::get('/hr/leave_management/menu', [HrStaffLeavePageController::class, 'hrstaff_leave_menu'])->name('hrstaff_leave_menu');
Route::get('/hr/leave_management', [HrStaffLeavePageController::class, 'hrstaff_leave_management'])->name('hrstaff_leave_management');
Route::get('/hr/leave_management/all/{fiscal_year}', [HrStaffLeavePageController::class, 'hrstaff_fy_leave_management'])->name('hrstaff_fy_leave_management');
Route::get('/hr/leave_management/search/', [HrStaffLeavePageController::class, 'hrstaff_leave_management_search'])->name('hrstaff_leave_management_search');
Route::get('/hr/leave_management/leave_credits', [HrStaffLeavePageController::class, 'hrstaff_leave_credits'])->name('hrstaff_leave_credits');
Route::get('/hr/leave_management/leave_credits/{fiscal_year}', [HrStaffLeavePageController::class, 'hrstaff_fy_leave_credits'])->name('hrstaff_fy_leave_credits');
Route::get('/hr/leave_management/leave_credits/search', [HrStaffLeavePageController::class, 'hrstaff_leave_credits_search'])->name('hrstaff_leave_credits_search');
Route::get('/hr/leave_management/leave_details/{leave_application_rn}', [HrStaffLeavePageController::class, 'hr_leaveDetailsPage'])->name('hr_leave_details_page');
Route::get('/hr/leave_management/pending_approval', [HrStaffLeavePageController::class, 'hrstaff_leave_pending_approval'])->name('hrstaff_leave_pending_approval');
Route::get('/hr/leave_management/pending_availment', [HrStaffLeavePageController::class, 'hrstaff_leave_pending_availment'])->name('hrstaff_leave_pending_availment');
Route::get('/hr/leave_management/approved', [HrStaffLeavePageController::class, 'hrstaff_leave_approved'])->name('hrstaff_leave_approved');
Route::get('/hr/leave_management/cancelled', [HrStaffLeavePageController::class, 'hrstaff_leave_cancelled'])->name('hrstaff_leave_cancelled');
Route::get('/hr/leave_management/rejected', [HrStaffLeavePageController::class, 'hrstaff_leave_rejected'])->name('hrstaff_leave_rejected');
Route::get('/hr/leave_management/leavetypes', [HrStaffLeavePageController::class, 'hrstaff_leave_types'])->name('hrstaff_leave_types');
// Route::post('/hr/create_leavetypes', [LeaveTypesController::class, 'create_leavetypes'])->name('create_leavetypes');
// Route::get('/hr/update_leavetypes/{leavetype_id}', [LeaveTypesController::class, 'update_leavetypes'])->name('update_leavetypes');
// Route::get('/hr/delete_leavetypes/{leavetype_id}', [LeaveTypesController::class, 'delete_leavetypes'])->name('delete_leavetypes');
Route::post('/hr/create_leavecredits', [LeaveCreditController::class, 'create_leavecredits'])->name('create_leavecredits');
// Route::get('/hr/update_leavecredits/{leavecredit_id}', [LeaveCreditController::class, 'update_leavecredits'])->name('update_leavecredits');
Route::post('/hr/create_leavecredits', [LeaveCreditController::class, 'create_leavecredits'])->name('create_leavecredits');
Route::post('/hr/update_leavecredits/{leavecredit_id}', [LeaveCreditController::class, 'update_leavecredits'])->name('update_leavecredits');
Route::post('/hr/create_leaveapplication', [LeaveApplicationController::class, 'create_leaveapplication'])->name('create_leaveapplication');
Route::post('/hr/update_leaveapplication/{leave_application_rn}', [LeaveApplicationController::class, 'update_leaveapplication'])->name('update_leaveapplication');
Route::post('/hr/leave_management/approval/{leave_application_rn}', [LeaveApplicationController::class, 'leave_application_approval'])->name('leave_application_approval');
Route::post('/hr/leave_management/rejection/{leave_application_rn}', [LeaveApplicationController::class, 'leave_application_rejection'])->name('leave_application_rejection');
Route::post('/hr/leave_management/cancellation/{leave_application_rn}', [LeaveApplicationController::class, 'leave_application_cancellation'])->name('leave_application_cancellation');

Route::get('/create_leave/getLeaveType/{id}', [LeaveApplicationController::class, 'GetLeaveTypeFromEmployee'])->name('createLeave.getLeaveType');


Route::get('/hr/user/profile/{username}', [HrStaffPageController::class, 'visit_profile_view'])->name('user_profile');
Route::get('/hr/user/update/{username}', [HrStaffPageController::class, 'visit_profile_update'])->name('visit_user_update');
Route::get('/hr/user/profile/leave/{username}', [HrStaffPageController::class, 'visit_profile_leave_view'])->name('user_profile_leave');
Route::get('leave/credits/export', [LeaveCreditController::class, 'export'])->name('export');


/*
|
|--------------------------------------------------------------------------
| Admin Profile Routes
|--------------------------------------------------------------------------
|
|
*/
Route::get('/admin/login', [Page_Controller::class, 'admin_login_view']);
Route::get('/admin/dashboard', [AdminDashboard::class, 'admin_dashboard'])->name('admin_dashboard');
Route::get('/admin/organization/menu', [Page_Controller::class, 'admin_organization_menu'])->name('admin_org_menu');
Route::get('/admin/policy/view', [Page_Controller::class, 'admin_policy_view']);
Route::get('/admin/policy/create', [Page_Controller::class, 'admin_policy_create']);
Route::get('/admin/policy/update', [Page_Controller::class, 'admin_policy_update']);
Route::get('/admin/policy/menu', [Page_Controller::class, 'admin_policy_menu'])->name('admin_policy_menu');
Route::get('/admin/login-logs', [AdminPageController::class, 'admin_login_logs_view'])->name('admin_login_logs');

Route::controller(AdminPageController::class)->group(function (){
    Route::get( '/admin/accounts/active/grid', 'admin_accounts_active_grid' )->name('admin.active.grid');
});
Route::get('/admin/accounts/grid', [AdminPageController::class, 'admin_accounts_grid'])->name('admin_accounts_grid');
Route::get('/admin/accounts/list', [AdminPageController::class, 'admin_accounts_list'])->name('admin_accounts_list');
Route::get('/admin/accounts/grid/search', [AdminPageController::class, 'admin_accounts_search_grid'])->name('admin_accounts_search_grid');
Route::post('/admin/accounts/employee/create', [AccountManagementController::class, 'admin_create_employee'])->name('admin_create_employee');
Route::post('/admin/accounts/create', [AccountManagementController::class, 'admin_create_account'])->name('admin_create_account');
Route::post('/admin/accounts/update/user/profile_photo/{username}', [AccountManagementController::class, 'update_profile_photo'])->name('admin_update_profile_photo');
Route::get('/admin/accounts/{username}', [AdminPageController::class, 'admin_visit_employee_view'])->name('admin_visit_employee_view');
Route::get('/admin/accounts/admin/{username}', [AdminPageController::class, 'admin_visit_account_view'])->name('admin_visit_account_view');
Route::get('/admin/accounts/update_view/{username}', [AdminPageController::class, 'admin_visit_account_update_view'])->name('admin_visit_account_update_view');
Route::get('/admin/accounts/update/{username}', [AdminPageController::class, 'admin_update_employee_view'])->name('admin_update_employee_view');
Route::post('/admin/accounts/update/{user_id}/{employee_id}', [AccountManagementController::class, 'admin_update_employee'])->name('admin_update_employee');
Route::post('/admin/accounts/admin/update/{username}', [AccountManagementController::class, 'update_admin_account'])->name('update_admin_account');
Route::get('/admin/accounts/visit/reset_password/{username}', [AccountManagementController::class, 'account_reset_password'])->name('account_reset_password');
Route::get('/admin/accounts/admin/reset_password/{username}', [AccountManagementController::class, 'admin_account_reset_password'])->name('admin_account_reset_password');
Route::get('/admin/accounts/account_deactivate/{username}', [AccountManagementController::class, 'account_deactivate'])->name('account_deactivate');
Route::get('/admin/accounts/account_activate/{username}', [AccountManagementController::class, 'account_activate'])->name('account_activate');
Route::get('/admin/accounts/visit/leave/{username}', [AdminLeaveManagementController::class, 'visit_employee_leave_ms'])->name('visit_employee_leave_ms_view');
Route::get('/admin/profile', [AdminPageController::class, 'admin_visit_profile'])->name('admin_profile');
Route::get('/admin/profile/update/view', [AdminPageController::class, 'admin_visit_profile_update'])->name('admin_profile_update_view');
Route::patch('/admin/profile/update', [AccountManagementController::class, 'update_admin_profile'])->name('admin_profile_update');

Route::get('/admin/organization/departments/list', [DepartmentController::class, 'admin_organization_departments_list'])->name('admin_departments_list');
Route::get('/admin/organization/departments/grid', [DepartmentController::class, 'admin_organization_departments_grid'])->name('admin_departments_grid');
Route::get('/admin/organization/department/profile', [DepartmentController::class, 'admin_organization_department_profile'])->name('admin_departments_profile');
Route::post('/organization/create-department', [DepartmentController::class, 'create_department'])->name('admin_create_department');
// Route::put('/organization/update-department/{id}', [DepartmentController::class, 'update_department']);
Route::get('/organization/update-department/{id}', [DepartmentController::class, 'update_department'])->name('admin_update_department');
// Route::put('/organization/delete-department/{id}', [DepartmentController::class, 'delete_department']);
Route::get('/organization/delete-department/{id}', [DepartmentController::class, 'delete_department'])->name('admin_delete_department');

Route::get('/admin/organization/subdepartments/list', [SubDepartmentController::class, 'admin_organization_subdepartments_list'])->name('admin_subdepartments_list');
Route::get('/admin/organization/subdepartments/grid', [SubDepartmentController::class, 'admin_organization_subdepartments_grid'])->name('admin_subdepartments_grid');
Route::post('/organization/create_subdepartment', [SubDepartmentController::class, 'create_subdepartment'])->name('admin_create_subdepartment');
// Route::put('/organization/update_subdepartment/{id}', [SubDepartmentController::class, 'update_subdepartment']);
Route::get('/organization/update_subdepartment/{id}', [SubDepartmentController::class, 'update_subdepartment'])->name('admin_update_subdepartment');
// Route::put('/organization/delete_subdepartment/{id}', [SubDepartmentController::class, 'delete_subdepartment']);
Route::get('/organization/delete_subdepartment/{id}', [SubDepartmentController::class, 'delete_subdepartment'])->name('admin_delete_subdepartment');

Route::get('/admin/organization/positions/grid', [PositionController::class, 'admin_organization_positions_grid'])->name('admin_positions_grid');
Route::get('/admin/organization/positions/list', [PositionController::class, 'admin_organization_positions_list'])->name('admin_positions_list');
Route::post('/organization/create_position', [PositionController::class, 'create_position'])->name('admin_create_position');
Route::post('/organization/create_position_title', [PositionController::class, 'create_position_title'])->name('admin_create_position_title');
Route::get('/organization/update_position/{id}', [PositionController::class, 'update_position'])->name('admin_update_position');
// Route::put('/organization/delete_position/{id}', [PositionController::class, 'delete_position']);
Route::get('/organization/delete_position/{id}', [PositionController::class, 'delete_position'])->name('admin_delete_position');

Route::get('/admin/organization/area_of_assignments/grid', [AreaOfAssignmentController::class, 'admin_organization_areaofassignemnts_grid'])->name('admin_areaofassignemnts_grid');
Route::get('/admin/organization/area_of_assignments/list', [AreaOfAssignmentController::class, 'admin_organization_areaofassignemnts_list'])->name('admin_areaofassignemnts_list');
Route::get('/admin/organization/area_of_assignments/profile/{id}', [AreaOfAssignmentController::class, 'admin_organization_areaofassignemnts_profile'])->name('admin_areaofassignemnts_profile');
Route::post('/organization/create_area_of_assignments', [AreaOfAssignmentController::class, 'create_area_of_assignments'])->name('admin_create_areaofassignemnt');
// Route::put('/organization/update_area_of_assignments/{id}', [AreaOfAssignmentController::class, 'update_area_of_assignments']);
Route::get('/organization/update_area_of_assignments/{id}', [AreaOfAssignmentController::class, 'update_area_of_assignments'])->name('admin_update_areaofassignemnt');
// Route::put('/organization/delete_area_of_assignments/{id}', [AreaOfAssignmentController::class, 'delete_area_of_assignments']);
Route::get('/organization/delete_area_of_assignments/{id}', [AreaOfAssignmentController::class, 'delete_area_of_assignments'])->name('admin_delete_areaofassignemnt');

Route::controller(AdminLeavePageController::class)->group(function (){
    Route::get( '/admin/leave-menu', 'admin_leave_menu' )->name('admin.leave.menu');
    Route::get( '/admin/leave-types', 'admin_leave_types' )->name('admin.leave.types');
    Route::get( '/admin/fiscal-years', 'admin_fiscal_years' )->name('admin.fiscal.years');
});
Route::controller(AdminLeaveMaintenanceController::class)->group(function (){
    Route::post( '/admin/create_leavetype', 'create_leavetypes' )->name('admin.create.leavetype');
    Route::get( '/admin/update_leavetype/{leavetype_id}', 'update_leavetypes')->name('admin.update.leavetype');
    Route::get( '/admin/delete_leavetype/{leavetype_id}', 'delete_leavetypes')->name('admin.delete.leavetype');
});

Route::get('/admin/system_settings', [SystemSettingsController::class, 'system_settings_view'])->name('admin_system_settings');


//Auth
Auth::routes();
Route::post('/admin_login', [LoginController::class, 'admin_login'])->name('admin_login');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
