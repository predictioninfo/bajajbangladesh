<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckStatus;

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

Route::get('/logintemp', function () {
    return view('logintemp');
});

Route::get('/', function () {

    return view('index');
});



Route::get('/org-chart', [App\Http\Controllers\DashboardController::class, 'orgChart'])->name('org-charts');

//Auth::routes();
Auth::routes(['register' => false]);

//Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware([CheckStatus::class, 'auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::get('/tree', [App\Http\Controllers\DashboardController::class, 'Tree'])->name('trees');
    Route::get('/get-data', [App\Http\Controllers\DashboardController::class, 'getData'])->name('get-datas');
    Route::get('/company-organogram', [App\Http\Controllers\DashboardController::class, 'organogram'])->name('company-organograms');

    //For Template Header
    Route::get('/template-header', [App\Http\Controllers\HeaderController::class, 'index'])->name('headers');
    Route::post('/template-header-add', [App\Http\Controllers\HeaderController::class, 'headerAdd'])->name('add-headers');
    Route::post('/header-show', [App\Http\Controllers\HeaderController::class, 'headerShow'])->name('header-show');
    Route::post('/update-header', [App\Http\Controllers\HeaderController::class, 'headerUpdate'])->name('update-header');
    Route::get('/template-header-delete/{id}', [App\Http\Controllers\HeaderController::class, 'headerDelete'])->name('delete-headers');

    //For Template Footer
    Route::get('/template-footer', [App\Http\Controllers\FooterController::class, 'footer'])->name('footers');
    Route::post('/template-footer-add', [App\Http\Controllers\FooterController::class, 'footerAdd'])->name('add-footers');
    Route::post('/template-footer/{id}', [App\Http\Controllers\FooterController::class, 'footerUpdate'])->name('update-footers');
    Route::get('/template-footer-delete/{id}', [App\Http\Controllers\FooterController::class, 'footerDelete'])->name('delete-footers');


    Route::get('/appointment-template', [App\Http\Controllers\AppointmentTemplateController::class, 'index'])->name('appointment-templates');
    Route::get('/appointment-create', [App\Http\Controllers\AppointmentTemplateController::class, 'create'])->name('appointment-creates');
    Route::post('/appointment-add', [App\Http\Controllers\AppointmentTemplateController::class, 'add'])->name('appointment-adds');
    Route::get('/appointment-show/{id}', [App\Http\Controllers\AppointmentTemplateController::class, 'show'])->name('appointment-shows');
    Route::get('/appointment-delete/{id}', [App\Http\Controllers\AppointmentTemplateController::class, 'delete'])->name('appointment-deletes');
    Route::get('/appointment-customize/{id}', [App\Http\Controllers\AppointmentTemplateController::class, 'Customize'])->name('appointment-customizes');
    Route::get('/appointment-edit/{id}', [App\Http\Controllers\AppointmentTemplateController::class, 'Edit'])->name('appointment-edits');
    Route::post('/edit-appointment/{id}', [App\Http\Controllers\AppointmentTemplateController::class, 'appointmentEdit'])->name('edit-appointments');
    Route::post('/appointment-add-customize', [App\Http\Controllers\AppointmentTemplateController::class, 'CustomizeAdd'])->name('appointment-add-customizes');
    Route::get('/appointment-template-downlaod/{id}', [App\Http\Controllers\AppointmentTemplateController::class, 'downloadTemplate'])->name('appointment-template-downlaods');
    Route::get('/appointment-letter-download', [App\Http\Controllers\AppointmentTemplateController::class, 'appointmentLetterDownlaod'])->name('appointment-letter-downloads');


    Route::get('/warning-letter-format', [App\Http\Controllers\WarningLetterFormatController::class, 'index'])->name('warning-letter-formats');
    Route::get('/warning-letter-format-create', [App\Http\Controllers\WarningLetterFormatController::class, 'create'])->name('warning-letter-format-creates');
    Route::post('/warning-letter-format-add', [App\Http\Controllers\WarningLetterFormatController::class, 'addWarningLetter'])->name('warning-letter-format-adds');
    Route::post('/warning-letter-format-edit/{id}', [App\Http\Controllers\WarningLetterFormatController::class, 'editWarningLetter'])->name('warning-letter-format-edits');
    Route::get('/warning-letter-edit/{id}', [App\Http\Controllers\WarningLetterFormatController::class, 'edit'])->name('warning-letter-edits');
    Route::get('/warning-letter-show/{id}', [App\Http\Controllers\WarningLetterFormatController::class, 'show'])->name('warning-letter-shows');
    Route::get('/warning-letter-delete/{id}', [App\Http\Controllers\WarningLetterFormatController::class, 'delete'])->name('warning-letter-deletes');
    Route::any('/warning-letter-download/{id}', [App\Http\Controllers\WarningLetterFormatController::class, 'warningLetterDownlaod'])->name('warning-letter-downloads');

    Route::get('/probation-letter-formats', [App\Http\Controllers\ProbationLetterFormatController::class, 'index'])->name('probation-letter-formats');
    Route::post('/probation-letter-format-add', [App\Http\Controllers\ProbationLetterFormatController::class, 'addProbitionLetter'])->name('probation-letter-format-adds');
    Route::post('/probation-letter-format-edit/{id}', [App\Http\Controllers\ProbationLetterFormatController::class, 'editProbitionLetter'])->name('probation-letter-format-edits');
    Route::get('/probation-letter-edit/{id}', [App\Http\Controllers\ProbationLetterFormatController::class, 'edit'])->name('probation-letter-edits');
    Route::get('/probation-letter-show/{id}', [App\Http\Controllers\ProbationLetterFormatController::class, 'show'])->name('probation-letter-shows');
    Route::get('/probation-letter-delete/{id}', [App\Http\Controllers\ProbationLetterFormatController::class, 'delete'])->name('probation-letter-deletes');
    Route::get('/probation-letter-download', [App\Http\Controllers\ProbationLetterFormatController::class, 'probationLetterDownlaod'])->name('probation-letter-downloads');

    //Salary Increment Letter Template Route
    Route::get('/salary-increment-letter-template', [App\Http\Controllers\SalaryIncrementLetterController::class, 'index'])->name('salary-increment-letter-templates');
    Route::post('/salary-increment-format-add', [App\Http\Controllers\SalaryIncrementLetterController::class, 'addSalaryIncrementLetter'])->name('salary-increment-format-adds');
    Route::post('/salary-increment-format-edit/{id}', [App\Http\Controllers\SalaryIncrementLetterController::class, 'editSalaryIncrementLetter'])->name('salary-increment-format-edits');
    Route::get('/salary-increment-edit/{id}', [App\Http\Controllers\SalaryIncrementLetterController::class, 'edit'])->name('salary-increment-edits');
    Route::get('/salary-increment-show/{id}', [App\Http\Controllers\SalaryIncrementLetterController::class, 'show'])->name('salary-increment-shows');
    Route::get('/salary-increment-delete/{id}', [App\Http\Controllers\SalaryIncrementLetterController::class, 'delete'])->name('salary-increment-deletes');
    Route::post('/salary-increment-download/{id}', [App\Http\Controllers\SalaryIncrementLetterController::class, 'salaryIncrementLetterDownlaod'])->name('salary-increment-downloads');


    Route::any('/non-objection-certificate', [App\Http\Controllers\NonObjectionCertificateController::class, 'index'])->name('non-objection-certificates');
    Route::any('/noc-create', [App\Http\Controllers\NonObjectionCertificateController::class, 'create'])->name('noc-creates');
    Route::any('/noc-add', [App\Http\Controllers\NonObjectionCertificateController::class, 'addNoc'])->name('noc-adds');
    Route::any('/noc-edit/{id}', [App\Http\Controllers\NonObjectionCertificateController::class, 'editNoc'])->name('noc-edits');
    Route::any('/noc-update/{id}', [App\Http\Controllers\NonObjectionCertificateController::class, 'updateNoc'])->name('noc-update');
    Route::any('/noc-delete/{id}', [App\Http\Controllers\NonObjectionCertificateController::class, 'deleteNoc'])->name('noc-delete');
    Route::any('/noc-show/{id}', [App\Http\Controllers\NonObjectionCertificateController::class, 'showNoc'])->name('noc-show');


    Route::any('/resignation-letter-format', [App\Http\Controllers\ResignationLetterController::class, 'index'])->name('resignation-letter-formats');
    Route::any('/resignation-letter-format-create', [App\Http\Controllers\ResignationLetterController::class, 'create'])->name('resignation-letter-format-creates');
    Route::any('/resignation-letter-format-add', [App\Http\Controllers\ResignationLetterController::class, 'addResignationLetter'])->name('resignation-letter-format-adds');
    Route::any('/resignation-letter-format-edit/{id}', [App\Http\Controllers\ResignationLetterController::class, 'edit'])->name('resignation-letter-format-edits');
    Route::any('/resignation-letter-format-update/{id}', [App\Http\Controllers\ResignationLetterController::class, 'editResignationLetter'])->name('resignation-letter-format-updates');
    Route::any('/resignation-letter-show/{id}', [App\Http\Controllers\ResignationLetterController::class, 'show'])->name('resignation-letter-shows');
    Route::any('/resignation-letter-delete/{id}', [App\Http\Controllers\ResignationLetterController::class, 'delete'])->name('resignation-letter-deletes');
    // Route::any('/warning-letter-download', [App\Http\Controllers\WarningLetterFormatController::class, 'warningLetterDownlaod'])->name('warning-letter-downloads');

    Route::any('/salary-certificate-format', [App\Http\Controllers\SalaryCertificateController::class, 'index'])->name('salary-certificate-formats');
    Route::any('/salary-certificate-format-create', [App\Http\Controllers\SalaryCertificateController::class, 'create'])->name('salary-certificate-format-creates');
    Route::any('/salary-certificate-format-add', [App\Http\Controllers\SalaryCertificateController::class, 'addSalaryCertificateLetter'])->name('salary-certificate-format-adds');
    Route::any('/salary-certificate-edit/{id}', [App\Http\Controllers\SalaryCertificateController::class, 'edit'])->name('salary-certificate-edits');
    Route::any('/salary-certificate-format-edit/{id}', [App\Http\Controllers\SalaryCertificateController::class, 'editSalaryCertificate'])->name('salary-certificate-format-edits');
    Route::any('/salary-certificate-format-update/{id}', [App\Http\Controllers\SalaryCertificateController::class, 'editResignationLetter'])->name('salary-certificate-format-updates');
    Route::any('/salary-certificate-show/{id}', [App\Http\Controllers\SalaryCertificateController::class, 'show'])->name('salary-certificate-shows');
    Route::any('/salary-certificate-delete/{id}', [App\Http\Controllers\SalaryCertificateController::class, 'delete'])->name('salary-certificate-deletes');

    Route::any('/salary-certificate-download', [App\Http\Controllers\SalaryCertificateController::class, 'salaryCertificateDownload'])->name('salary-certificate-downloads');

    //Contact renewal letter Template

    Route::any('/contact-renewal-letter-template', [App\Http\Controllers\ContactRenewalLetterTemplateController::class, 'index'])->name('contact-renewal-letter-templates');
    Route::any('/contact-renewal-letter-template-create', [App\Http\Controllers\ContactRenewalLetterTemplateController::class, 'create'])->name('contact-renewal-letter-template-creates');
    Route::any('/contact-renewal-letter-template-add', [App\Http\Controllers\ContactRenewalLetterTemplateController::class, 'addContactRenewalLetter'])->name('contact-renewal-letter-template-adds');
    Route::any('/contact-renewal-letter-template-edit/{id}', [App\Http\Controllers\ContactRenewalLetterTemplateController::class, 'edit'])->name('contact-renewal-letter-template-edits');
    Route::any('/contact-renewal-letter-template-update/{id}', [App\Http\Controllers\ContactRenewalLetterTemplateController::class, 'editContactRenewalLetter'])->name('contact-renewal-letter-template-updates');
    Route::any('/contact-renewal-letter-template-show/{id}', [App\Http\Controllers\ContactRenewalLetterTemplateController::class, 'show'])->name('contact-renewal-letter-template-shows');
    Route::any('/contact-renewal-letter-template-delete/{id}', [App\Http\Controllers\ContactRenewalLetterTemplateController::class, 'delete'])->name('contact-renewal-letter-template-deletes');
    Route::any('/contact-renewal-letter-template-download/{id}', [App\Http\Controllers\ContactRenewalLetterTemplateController::class, 'contactRenewalLetterDownlaod'])->name('contact-renewal-letter-template-downloads');

    //End contact renewal letter Template


});


//Super Admin Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {

    Route::get('/signature', [App\Http\Controllers\CustomizeSettingController::class, 'approvalIndex'])->name('signatures')->middleware(CheckStatus::class, 'auth');
    Route::post('/add-signature', [App\Http\Controllers\SignatureController::class, 'addsignature'])->name('add-signatures')->middleware(CheckStatus::class, 'auth');
    Route::post('/update-signature', [App\Http\Controllers\SignatureController::class, 'Updatesignature'])->name('update-signatures')->middleware(CheckStatus::class, 'auth');
    Route::get('/signature/{id}', [App\Http\Controllers\SignatureController::class, 'SignatureDelete'])->name('delete-signatures')->middleware(CheckStatus::class, 'auth');

    Route::post('/signature-approve', [App\Http\Controllers\SignatureController::class, 'Signatureapprove'])->name('approve-signatures')->middleware(CheckStatus::class, 'auth');

    Route::get('/company-list', [App\Http\Controllers\CompanyController::class, 'companyProfileIndex'])->name('company-lists')->middleware(comapnylist::class, 'comapnylist');
    Route::post('/add-company', [App\Http\Controllers\CompanyController::class, 'companyAdd'])->name('add-companies');
    Route::get('/package-list', [App\Http\Controllers\PackageController::class, 'packageIndex'])->name('package-lists')->middleware(packagelist::class, 'packagelist');
    Route::post('/package-by-id', [App\Http\Controllers\PackageController::class, 'packageById'])->name('package-by-ids');
    Route::get('/package-permissions/{id}/package/{package_name}', [App\Http\Controllers\PermissionController::class, 'packagePermissionIndex'])->name('package-permissions');
    Route::post('/add-package', [App\Http\Controllers\PackageController::class, 'packageAdd'])->name('add-packages');
    Route::post('/update-package', [App\Http\Controllers\PackageController::class, 'packagelUpdate'])->name('update-package');

    Route::post('/package-permission-giving', [App\Http\Controllers\PermissionController::class, 'packageGivingPermission'])->name('package-permission-givings');

    Route::get('/delete-package/delete/{id}', [App\Http\Controllers\PackageController::class, 'deletePackage'])->name('delete-package');
});

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/group-of-company-list', [App\Http\Controllers\CompanyController::class, 'groupOfCompanyProfileIndex'])->name('group-of-company-lists');
    Route::post('/add-sister-concern', [App\Http\Controllers\CompanyController::class, 'sisterConcernAdd'])->name('add-sister-concerns');
    Route::post('/company-by-id', [App\Http\Controllers\CompanyController::class, 'companyById'])->name('company-by-ids');
    Route::post('/update-company', [App\Http\Controllers\CompanyController::class, 'companyUpdate'])->name('update-companies');
    Route::get('/delete-company/delete/{id}', [App\Http\Controllers\CompanyController::class, 'deleteCompany'])->name('delete-companies');
});
//Super Admin Module routes end here
//User Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    //new code
    Route::get('/user-list', [App\Http\Controllers\UserController::class, 'index'])->name('user-lists');
    Route::get('/inactive-user-list', [App\Http\Controllers\UserController::class, 'inactiveUserList'])->name('inactive-user-lists');
    //old code
    // Route::get('/user-list', [App\Http\Controllers\UserController::class, 'index'])->name('user-lists')->middleware(userlist::class, 'userlist');
    // Route::get('/inactive-user-list', [App\Http\Controllers\UserController::class, 'inactiveUserList'])->name('inactive-user-lists')->middleware(userlist::class, 'userlist');
    //Route::get('/user-list', [App\Http\Controllers\UserController::class, 'index'])->name('user-lists');
    Route::get('/assigning-role', [App\Http\Controllers\UserController::class, 'assigningRoleIndex'])->name('assigning-roles')->middleware(assigningrole::class, 'assigningrole');
    Route::get('/get-user-list', [App\Http\Controllers\UserController::class, 'userListdataFatch'])->name('get-user-lists');
    Route::get('/users-assigned-roles/assined/{user_id}/role/{role_id}',  [App\Http\Controllers\UserController::class, 'assinedRole'])->name('users-assigned-roles');
    Route::get('/user/delete/{id}',  [App\Http\Controllers\UserController::class, 'deleteUser'])->name('delete-user');
    Route::get('/user/active/{id}/active',  [App\Http\Controllers\EmployeeController::class, 'activeUser'])->name('active-users');
    Route::post('/user/inactive/{id}/inactive',  [App\Http\Controllers\EmployeeController::class, 'inactiveUser'])->name('inactive-users');
    Route::get('/ban-id-card/{id}/ban',  [App\Http\Controllers\EmployeeController::class, 'banIdCard'])->name('ban-id-cards');
    Route::get('/approve-id-card/{id}/approve',  [App\Http\Controllers\EmployeeController::class, 'approveIdCard'])->name('approve-id-cards');
});

//User Module routes end here

//Employee Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-list', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee-lists')->middleware(employeelist::class, 'employeelist');
    Route::get('/employee-create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee-add')->middleware(CheckStatus::class, 'auth');
    Route::post('/add-employee', [App\Http\Controllers\EmployeeController::class, 'employeeStore'])->name('employees-store')->middleware(CheckStatus::class, 'auth');
    Route::get('/edit-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'employeeEdit'])->name('employee-edit')->middleware(CheckStatus::class, 'auth');
    Route::post('/update-employee', [App\Http\Controllers\EmployeeController::class, 'employeeUpdate'])->name('employees-updates')->middleware(CheckStatus::class, 'auth');
    Route::post('/employee-attendances', [App\Http\Controllers\EmployeeController::class, 'employeeAttandance'])->name('employee-attendance');
    Route::post('/check-data', [EmployeeController::class, 'checkData'])->name('check.data')->middleware(CheckStatus::class, 'auth');
    Route::post('/check-id', [EmployeeController::class, 'checkId'])->name('check.id')->middleware(CheckStatus::class, 'auth');
    Route::post('/check-username', [EmployeeController::class, 'checkUserName'])->name('check-username')->middleware(CheckStatus::class, 'auth');

    //Route::post('/employee-attendances', [App\Http\Controllers\EmployeeController::class, 'userLocationWiseAttendance'])->name('employee-attendance');
    Route::post('/employee-ip-based-attendance', [App\Http\Controllers\EmployeeController::class, 'employeeIpBasedAttandance'])->name('employee-ip-based-attendances');
    Route::get('/non-permanent-employee', [App\Http\Controllers\EmployeeController::class, 'nonPermanentEmployeeIndex'])->name('non-permanent-employees');
    Route::get('/contact-renewal-letter-list', [App\Http\Controllers\ContactRenewalLetterController::class, 'index'])->name('contact-renewal-letter-lists');

    Route::any('/noc-employee', [App\Http\Controllers\NocEmployeeController::class, 'nocEmployeeIndex'])->name('noc-employees');
    Route::any('/add-noc-employee', [App\Http\Controllers\NocEmployeeController::class, 'nocEmployeeAdd'])->name('add-noc-employee');
    Route::any('/edit-noc-employee', [App\Http\Controllers\NocEmployeeController::class, 'nocEmployeeEdit'])->name('edit-noc-employee');
    Route::any('/update-noc-employee', [App\Http\Controllers\NocEmployeeController::class, 'nocEmployeeUpdate'])->name('update-noc-employee');
    Route::any('/show-noc-employee',  [App\Http\Controllers\NocEmployeeController::class, 'nocEmployeeShow'])->name('show-noc-employee');
    Route::any('/pdf-noc-employee/{id}',  [App\Http\Controllers\NocEmployeeController::class, 'nocEmployeePdf'])->name('pdf-noc-employee');
    Route::any('/delete-noc-employee/{id}',  [App\Http\Controllers\NocEmployeeController::class, 'nocEmployeeDeletet'])->name('delete-noc-employee');
    Route::any('/unacceptable-noc/{id}',  [App\Http\Controllers\NocEmployeeController::class, 'nocUnacceptable'])->name('unacceptable-noc');

    Route::any('/approve-noc-request', [App\Http\Controllers\NocEmployeeController::class, 'nocRequestApprove'])->name('approve-noc-request');
    Route::any('/disapprove-noc-request/{id}', [App\Http\Controllers\NocEmployeeController::class, 'nocRequestDisapprove'])->name('disapprove-noc-request');


    Route::any('/all-noc-employee-pdf',  [App\Http\Controllers\NocEmployeeController::class, 'allNocEmployeePdf'])->name('all-noc-employee-pdf');
    Route::any('/noc-approval-index',  [App\Http\Controllers\NocEmployeeController::class, 'NocApprovalIndex'])->name('noc-approval-index');
    Route::any('/noc-approval-request',  [App\Http\Controllers\NocEmployeeController::class, 'NocApprovalRequest'])->name('noc-approval-request');
    Route::any('/noc-approval-request-edit',  [App\Http\Controllers\NocEmployeeController::class, 'NocApprovalRequestEdit'])->name('noc-approval-request-edit');
    Route::any('/update-approval-request', [App\Http\Controllers\NocEmployeeController::class, 'approvalRequestUpdate'])->name('update-approval-request');
    Route::any('/show-noc-request',  [App\Http\Controllers\NocEmployeeController::class, 'nocRequestShow'])->name('show-noc-request');
    Route::any('/pdf-noc-request/{id}',  [App\Http\Controllers\NocEmployeeController::class, 'nocRequestPdf'])->name('pdf-noc-request');
    Route::any('/delete-noc-request/{id}',  [App\Http\Controllers\NocEmployeeController::class, 'nocRequestDeletet'])->name('delete-noc-request');
    //Route::get('/edit-employee/{id}', [App\Http\Controllers\EmployeeController::class, 'employeeStore'])->name('employees-store');
    //Route::get('/import-employees', [App\Http\Controllers\EmployeeController::class, 'index'])->name('import-employee');
});
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::post('/renew-employee', [App\Http\Controllers\EmployeeController::class, 'employeeRenew'])->name('employees-renews');
    Route::post('/bulk-renew-employee', [App\Http\Controllers\EmployeeController::class, 'employeeBulkRenew'])->name('bulk-renew-employees');
    Route::post('/non-permanent-employee', [App\Http\Controllers\EmployeeController::class, 'employeeFilteringBulkRenew'])->name('employee-bulk-renew-filterings');

    Route::get('/userbangladetails/{id}', [App\Http\Controllers\EmployeeDetailController::class, 'addBanglaDeatil'])->name('addBanglaDeatils');
    Route::post('/user-input-bangla', [App\Http\Controllers\EmployeeDetailController::class, 'banglaDeatils'])->name('user-input-banglas');
    Route::post('/user-input-bangla-update', [App\Http\Controllers\EmployeeDetailController::class, 'banglaDeatilUpdate'])->name('user-input-bangla-updates');

    // Route::get('/employee-nominee-list', [App\Http\Controllers\NomineeController::class, 'index'])->name('employee-nominee-lists');
    // Route::post('/nominee-add', [App\Http\Controllers\NomineeController::class, 'addNominee'])->name('nominee-adds');
    // Route::get('/nominee-update/{id}', [App\Http\Controllers\NomineeController::class, 'editNominee'])->name('nominee-edit');
    // Route::post('/nominee-update', [App\Http\Controllers\NomineeController::class, 'updateNominee'])->name('nominee-updates');
    // Route::get('/delete-nominee/{id}', [App\Http\Controllers\NomineeController::class, 'deleteNominee'])->name('delete-nominee');

    Route::post('/add-admin', [App\Http\Controllers\EmployeeController::class, 'adminStore'])->name('admin-store');
    Route::post('/user-by-id', [App\Http\Controllers\EmployeeController::class, 'userById'])->name('user-by-ids');

    Route::get('/password-change', [App\Http\Controllers\EmployeeController::class, 'passwordChangeIndex'])->name('password-changes');

    //Route::get('/user-setting-panel-logout', [App\Http\Controllers\UserController::class, 'sessionLogOutForUserPanel'])->name('user-setting-panel-logouts');

    Route::get('file-import-export', [App\Http\Controllers\EmployeeController::class, 'fileImportExport'])->name('import-employee');
    Route::post('file-import', [App\Http\Controllers\EmployeeController::class, 'fileImport'])->name('file-import');
    Route::get('file-export', [App\Http\Controllers\EmployeeController::class, 'fileExport'])->name('file-export');
    //Employee Module routes end here

    ##############################Employee Setting Module routes start from here##################################################################
    ##############################################################################################################################################

    Route::get('/employee-detail/{id}', [App\Http\Controllers\EmployeeSetupController::class, 'employeeDetailDashboardIndex'])->name('employee-details');
});

//Employee Setting Profile Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-profile', [App\Http\Controllers\EmployeeSetupController::class, 'employeeProfileIndex'])->name('employee-profiles')->middleware(CheckStatus::class, 'auth');
    Route::post('/employee-profile-photo-update', [App\Http\Controllers\EmployeeSetupController::class, 'employeeProfilePhotoUpdate'])->name('employee-profile-photo-updates');
});
//Employee Setting Profile Module routes end here

//Employee Setting General Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-basic-info', [App\Http\Controllers\GeneralController::class, 'employeeBasicInfoIndex'])->name('employee-basic-infos');
    Route::post('/update-employee-basic-info', [App\Http\Controllers\BasicInfoController::class, 'updateEmployeeBasicInfo'])->name('update-employee-basic-infos');
    Route::post('/update-employee-present-address', [App\Http\Controllers\BasicInfoController::class, 'updateEmployeePresentAddress'])->name('update-employee-present-address');
    Route::post('/update-employee-permanent-address', [App\Http\Controllers\BasicInfoController::class, 'updateEmployeePermanentAddress'])->name('update-employee-permanent-address');
    Route::post('/update-employee-job-location', [App\Http\Controllers\BasicInfoController::class, 'updateEmployeeJobLocation'])->name('update-employee-job-location');
    Route::post('/update-employee-company-infos', [App\Http\Controllers\BasicInfoController::class, 'updateEmployeeCompanyInfo'])->name('update-employee-company-infos');
    Route::post('/update-employee-previous-company-infos', [App\Http\Controllers\BasicInfoController::class, 'updateEmployeePreviousCompanyInfo'])->name('update-employee-previous-company-infos');
    Route::post('/update-employee-parental-infos', [App\Http\Controllers\BasicInfoController::class, 'updateEmployeeParentalInfo'])->name('update-employee-parental-infos');
    Route::post('/update-employee-basic-info-bangla', [App\Http\Controllers\BasicInfoController::class, 'updateEmployeeBasicInfoBangla'])->name('update-employee-basic-info-bangla');
    Route::post('/update-certificate-letter', [App\Http\Controllers\BasicInfoController::class, 'updateCertificateLetter'])->name('update-certificate-letter');
    //employee signature
    Route::get('/employee-signatures', [App\Http\Controllers\BasicInfoController::class, 'Signature'])->name('employee-signature');
    Route::post('/employee-signature-upload', [App\Http\Controllers\BasicInfoController::class, 'signatureupload'])->name('employee-signature-uploads');
    //end employee signature

    Route::post('/updated-by-employee-basic-info', [App\Http\Controllers\BasicInfoController::class, 'updatedByEmployeeBasicInfo'])->name('updated-by-employee-basic-infos');
    Route::get('/employee-immigration', [App\Http\Controllers\GeneralController::class, 'employeeImmigrationIndex'])->name('employee-immigrations');
    Route::post('/add-immigrant-employee', [App\Http\Controllers\ImmigrantController::class, 'immigrantEmployeeAdd'])->name('add-immigrant-employees');
    Route::post('/update-employee-immigrant', [App\Http\Controllers\ImmigrantController::class, 'employeeImmigrantUpdate'])->name('update-employee-immigrants');
    Route::get('/delete-employee-immigrant/delete/{id}', [App\Http\Controllers\ImmigrantController::class, 'deleteEmployeeImmigrant'])->name('delete-employee-immigrants');
});
Route::post('/employee-immigrant-by-id', [App\Http\Controllers\ImmigrantController::class, 'employeeImmigrantById'])->name('employee-immigrant-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-emergency-contact', [App\Http\Controllers\GeneralController::class, 'employeeEmergencyContactIndex'])->name('employee-emergency-contacts');
    Route::post('/add-emergency-contact-employee', [App\Http\Controllers\EmergencyContactController::class, 'emergencyContactEmployeeAdd'])->name('add-emergency-contact-employees');
    Route::post('/update-employee-emergency-contact', [App\Http\Controllers\EmergencyContactController::class, 'employeeEmergencyContactUpdate'])->name('update-employee-emergency-contacts');
    Route::get('/delete-employee-emergency-contact/delete/{id}', [App\Http\Controllers\EmergencyContactController::class, 'deleteEmployeeEmergencyContact'])->name('delete-employee-emergency-contacts');



    Route::get('/employee-salary-remunaration', [App\Http\Controllers\EmployeeSetupController::class, 'SalaryRemuneration'])->name('employee-salary-remunarations');

    Route::post('/add-salary-remunaration', [App\Http\Controllers\GeneralController::class, 'addSalaryRemunaration'])->name('add-salary-remunarations');
});

Route::post('/employee-emergency-contact-by-id', [App\Http\Controllers\EmergencyContactController::class, 'employeeEmergencyContactById'])->name('employee-emergency-contact-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-social-profile', [App\Http\Controllers\GeneralController::class, 'employeeSocialProfileIndex'])->name('employee-social-profiles');
    Route::post('/add-emergency-social-profile', [App\Http\Controllers\SocialProfileController::class, 'socialProfileEmployeeAdd'])->name('add-social-profile-employees');
    Route::post('/update-employee-social-profile', [App\Http\Controllers\SocialProfileController::class, 'employeeSocialProfileUpdate'])->name('update-employee-social-profiles');
    Route::get('/delete-employee-social-profile/delete/{id}', [App\Http\Controllers\SocialProfileController::class, 'deleteEmployeeSocialProfile'])->name('delete-employee-social-profiles');
});

Route::post('/employee-social-profile-by-id', [App\Http\Controllers\SocialProfileController::class, 'employeeSocialProfileById'])->name('employee-social-profile-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-document', [App\Http\Controllers\GeneralController::class, 'employeeDocumentIndex'])->name('employee-documents');
    Route::post('/add-emergency-document', [App\Http\Controllers\DocumentController::class, 'documentAddByEmployee'])->name('add-document-employees')->middleware(CheckStatus::class, 'auth');
    Route::post('/update-employee-document', [App\Http\Controllers\DocumentController::class, 'employeeDocumentUpdate'])->name('update-employee-documents')->middleware(CheckStatus::class, 'auth');
    Route::get('/delete-employee-document/delete/{id}', [App\Http\Controllers\DocumentController::class, 'deleteEmployeeDocument'])->name('delete-employee-documents')->middleware(CheckStatus::class, 'auth');
});

Route::post('/employee-document-by-id', [App\Http\Controllers\DocumentController::class, 'employeeDocumentById'])->name('employee-document-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-qualification', [App\Http\Controllers\GeneralController::class, 'employeeQualificationIndex'])->name('employee-qualifications');
    Route::post('/add-employee-qualification', [App\Http\Controllers\QualificationController::class, 'qualificationEmployeeAdd'])->name('add-qualification-employees');
    Route::post('/update-employee-qualification', [App\Http\Controllers\QualificationController::class, 'employeeQualificationUpdate'])->name('update-employee-qualifications');
    Route::get('/delete-employee-qualification/delete/{id}', [App\Http\Controllers\QualificationController::class, 'deleteEmployeeQualification'])->name('delete-employee-qualifications');
});

Route::post('/employee-qualification-by-id', [App\Http\Controllers\QualificationController::class, 'employeeQualificationById'])->name('employee-qualification-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-work-experience', [App\Http\Controllers\GeneralController::class, 'employeeWorkExperirenceIndex'])->name('employee-work-experiences');
    Route::post('/add-emergency-work-experience', [App\Http\Controllers\WorkExperienceController::class, 'workExperirenceEmployeeAdd'])->name('add-work-experience-employees');
    Route::post('/update-employee-work-experience', [App\Http\Controllers\WorkExperienceController::class, 'employeeWorkExperirenceUpdate'])->name('update-employee-work-experiences');
    Route::get('/delete-employee-work-experience/delete/{id}', [App\Http\Controllers\WorkExperienceController::class, 'deleteEmployeeWorkExperirence'])->name('delete-employee-work-experiences');

    Route::any('/experience-template', [App\Http\Controllers\experienceLetterController::class, 'index'])->name('experience-templates');
    Route::any('/create-experience-template', [App\Http\Controllers\experienceLetterController::class, 'experienceLetterCreate'])->name('create-experience-templates');
    Route::any('/add-experience-template', [App\Http\Controllers\experienceLetterController::class, 'experienceLetterAdd'])->name('add-experience-templates');
    Route::any('/experience-show', [App\Http\Controllers\experienceLetterController::class, 'experienceLetterShow'])->name('experience-show');
    Route::any('/change-experience-letter', [App\Http\Controllers\experienceLetterController::class, 'experienceChange'])->name('change-experience-letter');
    Route::get('/experience-template-delete/{id}',  [App\Http\Controllers\experienceLetterController::class, 'experienceLetterDelete'])->name('experience-template-delete');
    Route::any('/employee-experience-template-download', [App\Http\Controllers\experienceLetterController::class, 'experienceLetterDownload'])->name('employee-experience-template-download');
    Route::get('/employee-details-download', [App\Http\Controllers\PersonalDetailsDownloadController::class, 'personalDetailsDownload'])->name('employee-details-download');
    Route::any('/employee-personal-details-download', [App\Http\Controllers\PersonalDetailsDownloadController::class, 'personalDetailsShow'])->name('employee-personal-details-download');
});

Route::post('/employee-work-experience-by-id', [App\Http\Controllers\WorkExperienceController::class, 'employeeWorkExperirenceById'])->name('employee-work-experience-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-appointment-letter', [App\Http\Controllers\AppointmentLetterController::class, 'employeeAppointmentLetterGenerate'])->name('employee-appointment-letters');
    Route::get('/employee-id-card-download', [App\Http\Controllers\IdCardController::class, 'employeeIdCardDownload'])->name('employee-id-card-downloads');
});
Route::get('/idcard', [App\Http\Controllers\IdCardController::class, 'employeeIdCard'])->name('id-cards');


Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-bank-account', [App\Http\Controllers\GeneralController::class, 'employeeBankAccountIndex'])->name('employee-bank-accounts');
    Route::post('/add-employee-bank-account', [App\Http\Controllers\BankAccountController::class, 'addEmployeeBankAccount'])->name('add-employee-bank-accounts');
    Route::post('/update-employee-bank-account/{id}', [App\Http\Controllers\BankAccountController::class, 'employeeBankAccountUpdate'])->name('update-employee-bank-accounts');
    Route::get('/delete-employee-bank-account/delete/{id}', [App\Http\Controllers\BankAccountController::class, 'deleteEmployeeBankAccount'])->name('delete-employee-bank-accounts');
});

Route::get('/employee-password-change', [App\Http\Controllers\GeneralController::class, 'employeePasswordChangeIndex'])->name('employee-password-changes');
Route::post('/update-employee-password', [App\Http\Controllers\EmployeeController::class, 'employeePasswordUpdate'])->name('update-employee-passwords');


Route::post('/employee-bank-account-by-id', [App\Http\Controllers\BankAccountController::class, 'employeeBankAccountById'])->name('employee-bank-account-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-pf-bank-accounts', [App\Http\Controllers\GeneralController::class, 'employeePfBankAccountIndex'])->name('employee-pf-bank-accounts');
    Route::post('/add-pf-employee-bank-account', [App\Http\Controllers\BankAccountController::class, 'addEmployeePfBankAccount'])->name('add-pf-employee-bank-accounts');
    Route::post('/update-employee-pf-bank-account', [App\Http\Controllers\BankAccountController::class, 'employeePfBankAccountUpdate'])->name('update-employee-pf-bank-accounts');
    Route::get('/delete-employee-pf-bank-account/delete/{id}', [App\Http\Controllers\BankAccountController::class, 'deleteEmployeePfBankAccount'])->name('delete-employee-pf-bank-accounts');
});

Route::post('/employee-pf-bank-account-by-id', [App\Http\Controllers\BankAccountController::class, 'employeePfBankAccountById'])->name('employee-pf-bank-account-by-ids');
//Employee Setting General Module routes end here


//Employee Setting Salary Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-total-salary', [App\Http\Controllers\EmployeeSetupController::class, 'employeeTotalSalaryIndex'])->name('employee-total-salaries');
    Route::post('/add-employee-gross-salary', [App\Http\Controllers\GeneralController::class, 'addEmployeeGrossSalary'])->name('add-employee-gross-salaries');
    Route::post('/update-employee-gross-salary', [App\Http\Controllers\GeneralController::class, 'employeeGrossSalaryUpdate'])->name('update-employee-gross-salaries');
    Route::get('/delete-employee-gross-salary/delete/{id}', [App\Http\Controllers\GeneralController::class, 'deleteEmployeeGrossSalary'])->name('delete-employee-gross-salaries');
});

Route::post('/employee-gross-salary-by-id', [App\Http\Controllers\GeneralController::class, 'employeeGrossSalaryById'])->name('employee-gross-salary-by-id');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    //Employee Setting hourly Salary Module routes start from here

    Route::get('/employee-hourly-total-salary', [App\Http\Controllers\HourlySalaryConfigController::class, 'employeeHourlyTotalSalaryIndex'])->name('employee-hourly-total-salaries');
    Route::post('/add-employee-hourly-salary', [App\Http\Controllers\HourlySalaryConfigController::class, 'addEmployeeHourlySalary'])->name('add-employee-hourly-salaries');
    Route::post('/hourly-salary-config-by-id', [App\Http\Controllers\HourlySalaryConfigController::class, 'hourlySalaryConfigById'])->name('hourly-salary-config-by-ids');
    Route::post('/update-employee-hourly-salary', [App\Http\Controllers\HourlySalaryConfigController::class, 'employeeHourlySalaryUpdate'])->name('update-employee-hourly-salary');
    Route::get('/delete-hourly-employee-gross-salary/delete/{id}', [App\Http\Controllers\HourlySalaryConfigController::class, 'deleteEmployeeHourlyGrossSalary'])->name('delete-hourly-employee-gross-salaries');

    //Employee Setting hourly Salary Module routes end


    Route::get('/employee-allowance', [App\Http\Controllers\EmployeeSetupController::class, 'employeeAllowanceIndex'])->name('employee-allowances');
});

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-commission', [App\Http\Controllers\EmployeeSetupController::class, 'employeeCommissionIndex'])->name('employee-commissions');
    Route::post('/add-employee-commission', [App\Http\Controllers\CommissionController::class, 'addEmployeeCommission'])->name('add-employee-commissions');
    Route::post('/update-employee-commission', [App\Http\Controllers\CommissionController::class, 'employeeCommissionUpdate'])->name('/update-employee-commissions');
    Route::get('/delete-employee-commission/delete/{id}', [App\Http\Controllers\CommissionController::class, 'deleteEmployeeCommission'])->name('delete-employee-commissions');
});

Route::post('/employee-commission-by-id', [App\Http\Controllers\CommissionController::class, 'employeeCommissionById'])->name('employee-commission-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-loan', [App\Http\Controllers\EmployeeSetupController::class, 'employeeLoanIndex'])->name('employee-loans');
    Route::post('/add-employee-loan', [App\Http\Controllers\LoanController::class, 'addEmployeeLoan'])->name('add-employee-loans');
    Route::post('/update-employee-loan', [App\Http\Controllers\LoanController::class, 'employeeLoanUpdate'])->name('update-employee-loans');
    Route::get('/delete-employee-loan/delete/{id}', [App\Http\Controllers\LoanController::class, 'deleteEmployeeLoan'])->name('delete-employee-loans');
});

Route::post('/employee-loan-by-id', [App\Http\Controllers\LoanController::class, 'employeeLoanById'])->name('employee-loan-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-statutory-deduction', [App\Http\Controllers\EmployeeSetupController::class, 'employeeSatatutoryDeductionIndex'])->name('employee-statutory-deductions');
    Route::post('/add-employee-statutory-deduction', [App\Http\Controllers\StatutoryDeductionController::class, 'addEmployeeSatatutoryDeduction'])->name('add-employee-statutory-deductions');
    Route::post('/update-employee-statutory-deduction', [App\Http\Controllers\StatutoryDeductionController::class, 'employeeSatatutoryDeductionUpdate'])->name('/update-employee-statutory-deductions');
    Route::get('/delete-employee-statutory-deduction/delete/{id}', [App\Http\Controllers\StatutoryDeductionController::class, 'deleteEmployeeSatatutoryDeduction'])->name('delete-employee-statutory-deductions');
});


Route::post('/employee-statutory-deduction-by-id', [App\Http\Controllers\StatutoryDeductionController::class, 'employeeSatatutoryDeductionById'])->name('employee-statutory-deduction-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-other-payment', [App\Http\Controllers\EmployeeSetupController::class, 'employeeOtherPaymentIndex'])->name('employee-other-payments');
    Route::post('/add-employee-other-payment', [App\Http\Controllers\OtherPaymentController::class, 'addEmployeeOtherPayment'])->name('add-employee-other-payments');
    Route::post('/update-employee-other-payment', [App\Http\Controllers\OtherPaymentController::class, 'employeeOtherPaymentUpdate'])->name('/update-employee-other-payments');
    Route::get('/delete-employee-other-payment/delete/{id}', [App\Http\Controllers\OtherPaymentController::class, 'deleteEmployeeOtherPayment'])->name('delete-employee-other-payments');
});

Route::post('/employee-other-payment-by-id', [App\Http\Controllers\OtherPaymentController::class, 'employeeOtherPaymentById'])->name('employee-other-payment-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-over-time', [App\Http\Controllers\EmployeeSetupController::class, 'employeeOverTimeIndex'])->name('employee-over-times');
    Route::post('/add-employee-over-time', [App\Http\Controllers\OverTimeController::class, 'addEmployeeOverTime'])->name('add-employee-over-times');
    Route::post('/update-employee-over-time', [App\Http\Controllers\OverTimeController::class, 'employeeOverTimeUpdate'])->name('/update-employee-over-times');
    Route::get('/delete-employee-over-time/delete/{id}', [App\Http\Controllers\OverTimeController::class, 'deleteEmployeeOverTime'])->name('delete-employee-over-times');


    Route::post('/employee-over-time-by-id', [App\Http\Controllers\OverTimeController::class, 'employeeOverTimeById'])->name('employee-over-time-by-ids');

    Route::get('/employee-mobile-bill', [App\Http\Controllers\EmployeeSetupController::class, 'employeeMobileBill'])->name('employee-mobile-bills');
    Route::post('/add-employee-mobile-bill', [App\Http\Controllers\GeneralController::class, 'addEmployeeMobileBill'])->name('add-employee-mobile-bills');
    Route::post('/employee-mobile-bill-by-id', [App\Http\Controllers\GeneralController::class, 'employeeMobileBillById'])->name('employee-mobile-bill-by-ids');
    Route::post('/update-employee-mobile-bill', [App\Http\Controllers\GeneralController::class, 'employeeMobileBillUpdate'])->name('update-employee-mobile-bills');
    Route::get('/delete-employee-mobile-bill/delete/{id}', [App\Http\Controllers\GeneralController::class, 'deleteEmployeeMobileBill'])->name('delete-employee-mobile-bills');

    Route::get('/employee-lunch-bill', [App\Http\Controllers\EmployeeSetupController::class, 'employeeLunchBill'])->name('employee-lunch-bills');

    Route::get('/employee-transport-allowance', [App\Http\Controllers\EmployeeSetupController::class, 'employeeTaDa'])->name('employee-transport-allowances');
    Route::post('/add-employee-transport-allowance', [App\Http\Controllers\GeneralController::class, 'addEmployeeTaDa'])->name('add-employee-transport-allowances');
    Route::post('/employee-transport-allowance-by-id', [App\Http\Controllers\GeneralController::class, 'employeeTaDaById'])->name('employee-mobile-billtransport-allowance-by-ids');
    Route::post('/update-employee-transport-allowance', [App\Http\Controllers\GeneralController::class, 'employeeTaDaUpdate'])->name('update-employee-transport-allowances');
    Route::get('/delete-employee-transport-allowance/delete/{id}', [App\Http\Controllers\GeneralController::class, 'deleteEmployeeTaDa'])->name('delete-employee-transport-allowances');
});

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-pension', [App\Http\Controllers\EmployeeSetupController::class, 'employeePensionIndex'])->name('employee-pensions');
    Route::post('/add-employee-pension', [App\Http\Controllers\PensionController::class, 'addEmployeePension'])->name('add-employee-pensions');
    Route::post('/update-employee-pension', [App\Http\Controllers\PensionController::class, 'employeePensionUpdate'])->name('update-employee-pensions');
    Route::get('/delete-employee-pension/delete/{id}', [App\Http\Controllers\PensionController::class, 'deleteEmployeePension'])->name('delete-employee-pensions');
});

Route::post('/employee-pension-by-id', [App\Http\Controllers\PensionController::class, 'employeePensionById'])->name('employee-pension-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-report-to-config', [App\Http\Controllers\EmployeeSetupController::class, 'employeeReportToIndex'])->name('employee-report-to-configs');
    Route::get('/set-employee-report-to-id/{id}', [App\Http\Controllers\EmployeeSetupController::class, 'employeeReportToSetup'])->name('set-employee-report-to-ids');
});

Route::middleware([CheckStatus::class])->group(function () {
    Route::get('/employee-support-tickets', [App\Http\Controllers\EmployeeSetupController::class, 'employeeSupportTicketIndex'])->name('employee-support-ticket');
    Route::post('/add-employee-support-ticket',  [App\Http\Controllers\SupportTicketController::class, 'employeeSupportTicketAdd'])->name('add-employee-support-tickets');
    Route::post('/update-employee-support-ticket',  [App\Http\Controllers\SupportTicketController::class, 'employeeSupportTicketUpdate'])->name('update-employee-support-tickets');
    Route::get('/delete-employee-support-ticket/{id}',  [App\Http\Controllers\SupportTicketController::class, 'deleteEmployeeSupportTicket'])->name('delete-employee-support-tickets');
});

Route::post('/employee-support-ticket-by-id',  [App\Http\Controllers\SupportTicketController::class, 'employeeSupportTicketById'])->name('employee-support-ticket-by-ids');
//Employee Setting Salary Module routes end here

//Employee Setting CORE HR Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-core-hr', [App\Http\Controllers\EmployeeSetupController::class, 'employeeCoreHrIndex'])->name('employee-core-hrs');
    Route::get('/employee-promotions', [App\Http\Controllers\CoreHrController::class, 'employeePromotionIndex'])->name('employee-promotion');
    Route::get('/employee-awards', [App\Http\Controllers\CoreHrController::class, 'employeeAwardIndex'])->name('employee-award');
    Route::get('/employee-travels', [App\Http\Controllers\CoreHrController::class, 'employeeTravelIndex'])->name('employee-travel');
    Route::get('/employee-transfers', [App\Http\Controllers\CoreHrController::class, 'employeeTransferIndex'])->name('employee-transfer');
    Route::get('/employee-resignations', [App\Http\Controllers\CoreHrController::class, 'employeeResignationIndex'])->name('employee-resignation');
    Route::get('/employee-complaints', [App\Http\Controllers\CoreHrController::class, 'employeeComplaintIndex'])->name('employee-complaint');
    Route::get('/employee-warnings', [App\Http\Controllers\CoreHrController::class, 'employeeWarningIndex'])->name('employee-warning');
    Route::get('/employee-terminations', [App\Http\Controllers\CoreHrController::class, 'employeeTerminationIndex'])->name('employee-termination');
    Route::get('/employee-trainings', [App\Http\Controllers\CoreHrController::class, 'employeeTrainingIndex'])->name('employee-training');
    Route::post('/employee-add-complaint',  [App\Http\Controllers\ComplaintController::class, 'EmployeeComplaintAdd'])->name('employee-add-complaints');

    Route::post('/employee-resignations-add', [App\Http\Controllers\EmployeeSetupController::class, 'employeeResignationAdd'])->name('employee-resignation-adds');
    //Employee Setting CORE HR Module routes end here

    //Employee Setting Leave Module routes start from here
    Route::get('/employee-leave', [App\Http\Controllers\EmployeeSetupController::class, 'employeeLeaveIndex'])->name('employee-leaves');
    //Employee Setting Leave Module routes end here

    //Employee Setting Provident Fund Module routes start from here
    Route::get('/employee-pf-config', [App\Http\Controllers\EmployeeSetupController::class, 'employeePfConfigIndex'])->name('employee-pf-configs');
    Route::post('/employee-pf-update', [App\Http\Controllers\EmployeeSetupController::class, 'employeePfUpdate'])->name('employee-pf-updates');
    //Employee Setting Provident Fund Module routes end here
});

//Employee Setting Project Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-project', [App\Http\Controllers\EmployeeSetupController::class, 'employeeProjectIndex'])->name('employee-projects');
    Route::post('/add-employee-projects', [App\Http\Controllers\ProjectController::class, 'employeeSetupProjectStore'])->name('add-employee-projects');
    Route::post('/update-employee-project', [App\Http\Controllers\ProjectController::class, 'updateEmployeeSetupProject'])->name('update-employee-projects');
    Route::get('/employee-project/delete/{id}', [App\Http\Controllers\ProjectController::class, 'deleteEmployeeSetupProject'])->name('delete-employee-projects');

    Route::get('/employee-event', [App\Http\Controllers\EmployeeSetupController::class, 'employeeEventIndex'])->name('employee-events');
    Route::get('/employee-meeting', [App\Http\Controllers\EmployeeSetupController::class, 'employeeMeetingIndex'])->name('employee-meetings');
});

Route::post('/employee-project-by-id', [App\Http\Controllers\ProjectController::class, 'employeeSetupProjectById'])->name('employee-project-by-ids');
//Employee Setting Project Module routes end here

//Employee Setting Task Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-task', [App\Http\Controllers\EmployeeSetupController::class, 'employeeTaskIndex'])->name('employee-tasks');
    Route::post('/add-employee-task', [App\Http\Controllers\TaskController::class, 'employeeSetupTaskStore'])->name('add-employee-tasks');
    Route::post('/update-task-project', [App\Http\Controllers\TaskController::class, 'updateEmployeeSetupTask'])->name('update-employee-tasks');
    Route::get('/employee-task/delete/{id}', [App\Http\Controllers\TaskController::class, 'deleteEmployeeSetupTask'])->name('delete-employee-tasks');
});

Route::post('/employee-task-by-id', [App\Http\Controllers\TaskController::class, 'employeeSetupTaskById'])->name('employee-task-by-ids');
//Employee Setting Task Module routes end here

//Employee Setting Pay-Slip Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/employee-pay-slip', [App\Http\Controllers\EmployeeSetupController::class, 'employeePaySlipIndex'])->name('employee-pay-slips');
    Route::get('/tax-accountable', [App\Http\Controllers\EmployeeSetupController::class, 'taxAccountable'])->name('tax-accountables');
    Route::get('/employee-salary-sheet-approve', [App\Http\Controllers\EmployeeSetupController::class, 'employeeSalarySheetApprove'])->name('employee-salary-sheet-approves');
    Route::post('/review-salary-sheet', [App\Http\Controllers\EmployeeSetupController::class, 'reviewSalarySheetApproval'])->name('review-salary-sheets');
});
Route::post('/pay-slip-download', [App\Http\Controllers\PayrollController::class, 'employeePaySlipDownload'])->name('pay-slip-downloads');
Route::post('/promotion-letter-download', [App\Http\Controllers\PromotionController::class, 'promotionLetterDownload'])->name('promotion-letter-downloads');
//Employee Setting Pay-Slip Module routes end here
#############################Employee Setting Module routes end here#########################################################################
#########################################################################################################################################

//Customize Module routes start from here
Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/role', [App\Http\Controllers\CustomizeSettingController::class, 'roleIndex'])->name('roles')->middleware(role::class, 'role');
    Route::post('/add-role', [App\Http\Controllers\RoleController::class, 'roleStore'])->name('add-roles')->middleware(CheckStatus::class, 'auth');
    Route::post('/update-role', [App\Http\Controllers\RoleController::class, 'updateRole'])->name('update-roles')->middleware(CheckStatus::class, 'auth');
    Route::get('/role/delete/{id}',  [App\Http\Controllers\RoleController::class, 'deleteRole'])->name('delete-roles')->middleware(CheckStatus::class, 'auth');
});

Route::post('/role-by-id', [App\Http\Controllers\RoleController::class, 'roleById'])->name('role-by-ids');

Route::middleware([CheckStatus::class, 'auth'])->group(function () {
    Route::get('/role-access-permission/{id}/rolename/{roles_name}',  [App\Http\Controllers\CustomizeSettingController::class, 'accessPermissionIndex'])->name('role-access-permissions');
    Route::get('/access-permission', [App\Http\Controllers\CustomizeSettingController::class, 'accessPermissionIndex'])->name('access-permissions');
    Route::post('/permission-giving', [App\Http\Controllers\PermissionController::class, 'givingPermission'])->name('permission-givings');

    //Route::get('/general-setting', [App\Http\Controllers\CustomizeSettingController::class, 'generalIndex'])->name('general-settings');
    Route::get('/mail-setting', [App\Http\Controllers\CustomizeSettingController::class, 'mailIndex'])->name('mail-settings');
    Route::get('/language-settings', [App\Http\Controllers\CustomizeSettingController::class, 'languageIndex'])->name('language-settings');

    Route::get('/variable-types', [App\Http\Controllers\CustomizeSettingController::class, 'variableTypeIndex'])->name('variable-type')->middleware(variabletype::class, 'variabletype');
    Route::post('/add-award-type', [App\Http\Controllers\VariableTypeController::class, 'awardTypeAdd'])->name('add-award-types')->middleware(variabletype::class, 'variabletype');
    Route::post('/add-warning-type', [App\Http\Controllers\VariableTypeController::class, 'warningTypeAdd'])->name('add-warning-types')->middleware(variabletype::class, 'variabletype');
    Route::post('/add-termination-type', [App\Http\Controllers\VariableTypeController::class, 'terminationTypeAdd'])->name('add-termination-types')->middleware(variabletype::class, 'variabletype');
    Route::post('/add-job-status-type', [App\Http\Controllers\VariableTypeController::class, 'jobStatusTypeAdd'])->name('add-job-status-types')->middleware(variabletype::class, 'variabletype');
    Route::post('/add-office-shift-type', [App\Http\Controllers\VariableTypeController::class, 'officeShiftTypeAdd'])->name('add-office-shift-types')->middleware(variabletype::class, 'variabletype');
    Route::post('/add-documnet-type', [App\Http\Controllers\VariableTypeController::class, 'documentTypeAdd'])->name('add-documnet-types')->middleware(variabletype::class, 'variabletype');

    Route::post('/variable-type-by-id',  [App\Http\Controllers\VariableTypeController::class, 'variableTypeById'])->name('variable-type-by-ids');
    Route::post('/update-variable-type',  [App\Http\Controllers\VariableTypeController::class, 'variableTypeUpdate'])->name('update-variable-types')->middleware(variabletype::class, 'variabletype');
    Route::get('/variable-type/delete/{id}',  [App\Http\Controllers\VariableTypeController::class, 'deleteVariableType'])->name('delete-variable-types')->middleware(variabletype::class, 'variabletype');

    Route::get('/variable-methods', [App\Http\Controllers\CustomizeSettingController::class, 'variableMethodIndex'])->name('variable-method')->middleware(variablemethod::class, 'variablemethod');
    Route::post('/add-arrangement-method', [App\Http\Controllers\VariableMethodController::class, 'arrangementMethodAdd'])->name('add-arrangement-methods')->middleware(variablemethod::class, 'variablemethod');
    Route::post('/add-payment-type-method', [App\Http\Controllers\VariableMethodController::class, 'paymentMethodAdd'])->name('add-payment-type-methods')->middleware(variablemethod::class, 'variablemethod');
    Route::post('/add-qualification-method', [App\Http\Controllers\VariableMethodController::class, 'qualificationMethodAdd'])->name('add-qualification-methods')->middleware(variablemethod::class, 'variablemethod');
    Route::post('/add-job-category-method', [App\Http\Controllers\VariableMethodController::class, 'jobCategoryAdd'])->name('add-job-category-methods')->middleware(variablemethod::class, 'variablemethod');
    Route::post('/add-job-location-method', [App\Http\Controllers\VariableMethodController::class, 'jobLocationAdd'])->name('add-job-location-methods')->middleware(variablemethod::class, 'variablemethod');
    Route::post('/variable-method-by-id',  [App\Http\Controllers\VariableMethodController::class, 'variableMethodById'])->name('variable-method-by-ids');
    Route::post('/update-variable-method',  [App\Http\Controllers\VariableMethodController::class, 'variableMethodUpdate'])->name('update-variable-methods')->middleware(variablemethod::class, 'variablemethod');
    Route::get('/variable-method/delete/{id}',  [App\Http\Controllers\VariableMethodController::class, 'deleteVariableMethod'])->name('delete-variable-methods')->middleware(variablemethod::class, 'variablemethod');

    Route::get('/company-bank-account',  [App\Http\Controllers\CompanyBankAccountController::class, 'index'])->name('company-bank-accounts');
    Route::post('/add-company-bank-account',  [App\Http\Controllers\CompanyBankAccountController::class, 'addBankAccount'])->name('add-company-bank-accounts');
    Route::post('/edit-company-bank-account/{id}',  [App\Http\Controllers\CompanyBankAccountController::class, 'editBankAccount'])->name('edit-company-bank-accounts');
    Route::get('/delete-company-bank-account/{id}',  [App\Http\Controllers\CompanyBankAccountController::class, 'deleteBankAccount'])->name('delete-company-bank-accounts');

    Route::get('/communication-company-bank-account',  [App\Http\Controllers\CompanyBankAccountCommunicationController::class, 'index'])->name('communication-company-bank-accounts');
    Route::post('/add-communication-company-bank-account',  [App\Http\Controllers\CompanyBankAccountCommunicationController::class, 'addBankAccountCommunication'])->name('add-communication-company-bank-accounts');
    Route::post('/edit-communication-company-bank-account/{id}',  [App\Http\Controllers\CompanyBankAccountCommunicationController::class, 'editBankAccountCommunication'])->name('edit-communication-company-bank-accounts');
    Route::get('/delete-communication-company-bank-account/{id}',  [App\Http\Controllers\CompanyBankAccountCommunicationController::class, 'deleteBankAccountCommunication'])->name('delete-communication-company-bank-accounts');

    Route::get('/upazilas', [App\Http\Controllers\UpazilaController::class, 'upazilaIndex'])->name('upazila');
    Route::post('/add-upazilas', [App\Http\Controllers\UpazilaController::class, 'upazilasAdd'])->name('add-upazila');
    Route::post('/upazila-type-by-id',  [App\Http\Controllers\UpazilaController::class, 'upazilaById'])->name('upazila-by-ids');
    Route::post('/update-upazila',  [App\Http\Controllers\UpazilaController::class, 'upazilaUpdate'])->name('update-upazila');
    Route::get('/upazila/delete/{id}',  [App\Http\Controllers\UpazilaController::class, 'deleteUpazila'])->name('delete-upazila');

    Route::get('/unions', [App\Http\Controllers\UnionController::class, 'unionIndex'])->name('union');
    Route::post('/add-union', [App\Http\Controllers\UnionController::class, 'unionAdd'])->name('add-union');
    Route::post('/union-type-by-id',  [App\Http\Controllers\UnionController::class, 'unionById'])->name('union-by-ids');
    Route::post('/update-union',  [App\Http\Controllers\UnionController::class, 'unionUpdate'])->name('update-union');
    Route::get('/union/delete/{id}',  [App\Http\Controllers\UnionController::class, 'deleteUnion'])->name('delete-union');
    Route::post('/search-route-for-unions',  [App\Http\Controllers\UnionController::class, 'searchUnion'])->name('search-route-for-unions');

    Route::get('/ip-setting', [App\Http\Controllers\CustomizeSettingController::class, 'ipIndex'])->name('ip-settings');
    Route::get('/tax-config', [App\Http\Controllers\CustomizeSettingController::class, 'taxCofigIndex'])->name('tax-configs')->middleware(TaxConfigure::class, 'TaxConfigure');

    Route::any('/minimum-tax-config', [App\Http\Controllers\CustomizeSettingController::class, 'minimumTaxConfig'])->name('minimum-tax-configs')->middleware(TaxConfigure::class, 'TaxConfigure');

    Route::any('/add-minimum-tax-config', [App\Http\Controllers\TaxConfigController::class, 'addMinuimumTaxCofig'])->name('add-minimum-tax-configs')->middleware(TaxConfigure::class, 'TaxConfigure');

    Route::post('/add-tax-config', [App\Http\Controllers\TaxConfigController::class, 'addTaxCofig'])->name('add-tax-configs')->middleware(TaxConfigure::class, 'TaxConfigure');
    Route::post('/tax-config-by-id', [App\Http\Controllers\TaxConfigController::class, 'taxConfigById'])->name('tax-config-by-ids');
    Route::post('/update-tax-config', [App\Http\Controllers\TaxConfigController::class, 'updateTaxConfig'])->name('update-tax-configs')->middleware(TaxConfigure::class, 'TaxConfigure');
    Route::get('/tax-config/delete/{id}',  [App\Http\Controllers\TaxConfigController::class, 'deleteTaxConfig'])->name('delete-tax-configs')->middleware(TaxConfigure::class, 'TaxConfigure');

    Route::get('/salary-config', [App\Http\Controllers\CustomizeSettingController::class, 'salaryConfigIndex'])->name('salary-configs')->middleware(SalaryConfigure::class, 'SalaryConfigure');
    Route::post('/add-salary-config', [App\Http\Controllers\SalaryConfigController::class, 'addSalaryConfig'])->name('add-salary-configs')->middleware(SalaryConfigure::class, 'SalaryConfigure');
    Route::post('/salary-config-by-id', [App\Http\Controllers\SalaryConfigController::class, 'salaryConfigById'])->name('salary-config-by-ids');
    Route::post('/update-salary-config', [App\Http\Controllers\SalaryConfigController::class, 'updateSalaryConfig'])->name('update-salary-configs')->middleware(SalaryConfigure::class, 'SalaryConfigure');
    Route::get('/salary-config/delete/{id}',  [App\Http\Controllers\SalaryConfigController::class, 'deleteSalaryConfig'])->name('delete-salary-configs')->middleware(SalaryConfigure::class, 'SalaryConfigure');
    Route::get('/salary-component', [App\Http\Controllers\CustomizeSettingController::class, 'salaryComponentIndex'])->name('salary-components')->middleware(SalaryConfigure::class, 'SalaryConfigure');
    Route::get('/festival-month', [App\Http\Controllers\CustomizeSettingController::class, 'festivalIndex'])->name('festival-months')->middleware(Festival::class, 'Festival');
    Route::post('/add-festival', [App\Http\Controllers\FestivalBonusController::class, 'addFestival'])->name('add-festivals')->middleware(Festival::class, 'Festival');
    Route::post('/festival-by-id', [App\Http\Controllers\FestivalBonusController::class, 'festivalById'])->name('festival-by-ids');
    Route::post('/update-festival', [App\Http\Controllers\FestivalBonusController::class, 'festivalUpdate'])->name('update-festivals')->middleware(Festival::class, 'Festival');
    Route::get('/festival/delete/{id}',  [App\Http\Controllers\FestivalBonusController::class, 'deleteFestival'])->name('delete-festivals')->middleware(Festival::class, 'Festival');

    Route::any('/festival-config', [App\Http\Controllers\CustomizeSettingController::class, 'festivalConfigIndex'])->name('festival-configs')->middleware(Festival::class, 'Festival');
    Route::any('/add-festival-config', [App\Http\Controllers\FestivalConfigController::class, 'addFestivalConfig'])->name('add-festival-configs')->middleware(Festival::class, 'Festival');
    Route::post('/update-festival-config', [App\Http\Controllers\FestivalConfigController::class, 'festivalConfigUpdate'])->name('update-festival-configs')->middleware(Festival::class, 'Festival');
    Route::get('/festival-config-delete/{id}',  [App\Http\Controllers\FestivalConfigController::class, 'deleteFestivalConfig'])->name('delete-festival-configs')->middleware(Festival::class, 'Festival');

    Route::get('/yearly-festival-bonus-config',  [App\Http\Controllers\YearlyFestivalBonusController::class, 'yearlyFestivalBonusIndex'])->name('yearly-festival-bonus-configs');
    Route::post('/add-yearly-festival-bonus-config',  [App\Http\Controllers\YearlyFestivalBonusController::class, 'addYearlyFestivalBonus'])->name('add-yearly-festival-bonus-configs');
    Route::post('/update-yearly-bonus-config',  [App\Http\Controllers\YearlyFestivalBonusController::class, 'updateYearlyFestivalBonus'])->name('update-yearly-bonus-configs');
    Route::get('/yearly-festival-bonus-delete/{id}',  [App\Http\Controllers\YearlyFestivalBonusController::class, 'deletYearlyFestivalBonus'])->name('yearly-festival-bonus-delete');


    Route::get('/over-time-config',  [App\Http\Controllers\CustomizeSettingController::class, 'overTimeIndex'])->name('over-time-configs')->middleware(OverTimeConfig::class, 'OverTimeConfig');
    Route::post('/add-over-time-config',  [App\Http\Controllers\OvertimeConfigController::class, 'configOverTime'])->name('add-over-time-configs')->middleware(OverTimeConfig::class, 'OverTimeConfig');
    Route::post('/edit-over-time-config',  [App\Http\Controllers\OvertimeConfigController::class, 'updateConfigOverTime'])->name('edit-over-time-configs')->middleware(OverTimeConfig::class, 'OverTimeConfig');
    Route::get('/delete-over-time-config/{id}',  [App\Http\Controllers\OvertimeConfigController::class, 'deleteConfigOverTime'])->name('delete-over-time-configs')->middleware(OverTimeConfig::class, 'OverTimeConfig');
    Route::get('/late-time-config',  [App\Http\Controllers\CustomizeSettingController::class, 'lateTimeIndex'])->name('late-time-configs')->middleware(LateTimeConfig::class, 'LateTimeConfig');
    Route::post('/add-late-time-config',  [App\Http\Controllers\LatetimeConfigController::class, 'configLatetime'])->name('add-late-time-configs')->middleware(LateTimeConfig::class, 'LateTimeConfig');
    Route::post('/late-time-config-by-id',  [App\Http\Controllers\LatetimeConfigController::class, 'configLatetimeById'])->name('late-time-config-by-id');
    Route::post('/update-late-time-config',  [App\Http\Controllers\LatetimeConfigController::class, 'updateConfigLatetime'])->name('update-late-time-configs')->middleware(LateTimeConfig::class, 'LateTimeConfig');
    Route::get('/delete-late-time-config/{id}',  [App\Http\Controllers\LatetimeConfigController::class, 'deleteConfigLatetime'])->name('delete-late-time-configs')->middleware(LateTimeConfig::class, 'LateTimeConfig');

    Route::any('/late-time-salary-config',  [App\Http\Controllers\LateTimeSalaryConfigController::class, 'index'])->name('late-time-salary-configs');
    Route::any('/add-late-time-salary-config',  [App\Http\Controllers\LateTimeSalaryConfigController::class, 'add'])->name('add-late-time-salary-configs');
    Route::any('/delete-late-time-salary-config',  [App\Http\Controllers\LateTimeSalaryConfigController::class, 'delete'])->name('delete-late-time-salary-configs');



    Route::get('/company-pf-config',  [App\Http\Controllers\CustomizeSettingController::class, 'companyPfConfigIndex'])->name('company-pf-configs')->middleware(companypf::class, 'companypf');
    Route::post('/add-company-pf-config',  [App\Http\Controllers\ProvidentfundConfigController::class, 'addCompanyProvidentfundConfig'])->name('add-company-pf-configs')->middleware(companypf::class, 'companypf');
    Route::post('/company-pf-config-by-id',  [App\Http\Controllers\ProvidentfundConfigController::class, 'companyProvidentfundConfigById'])->name('company-pf-config-config-by-ids');
    Route::post('/update-company-pf-config',  [App\Http\Controllers\ProvidentfundConfigController::class, 'companyProvidentfundConfigUpdate'])->name('update-company-pf-configs')->middleware(companypf::class, 'companypf');
    Route::get('/delete-company-pf-config/{id}',  [App\Http\Controllers\ProvidentfundConfigController::class, 'deleteCompanyProvidentfundConfig'])->name('delete-company-pf-configs')->middleware(companypf::class, 'companypf');


    Route::get('/minimum-house-rent-non-taxable',  [App\Http\Controllers\CustomizeSettingController::class, 'minimumHouseRentNonTaxable'])->name('minimum-house-rent-non-taxables');

    Route::any('/minimum-house-rent-non-taxable-add',  [App\Http\Controllers\HouseRentNonTaxableRangeYearlyController::class, 'add'])->name('minimum-house-rent-non-taxable-adds');

    Route::get('/minimum-medical-allowance-non-taxable',  [App\Http\Controllers\CustomizeSettingController::class, 'minimumMedicalAllowanceTaxable'])->name('minimum-medical-allowance-non-taxables');

    Route::any('/minimum-medical-allowance-non-taxable-add',  [App\Http\Controllers\MedicalAllowanceNonTaxableRangeYearlyController::class, 'add'])->name('minimum-medical-allowance-non-taxable-adds');


    Route::get('/minimum-conveyance-allowance-non-taxable',  [App\Http\Controllers\CustomizeSettingController::class, 'conveyanceMedicalAllowanceTaxable'])->name('minimum-conveyance-allowance-non-taxables');

    Route::any('/minimum-conveyance-allowance-non-taxable-add',  [App\Http\Controllers\ConveyanceAllowanceNonTaxableRangeYearlyController::class, 'add'])->name('minimum-conveyance-allowance-non-taxable-adds');



    //Customize Module routes end here

    //Core HR Module routes start from here
    Route::get('/promotions', [App\Http\Controllers\CoreHrController::class, 'promotionIndex'])->name('promotion')->middleware(promotion::class, 'promotion');
    Route::post('/add-promotion',  [App\Http\Controllers\PromotionController::class, 'promotionAdd'])->name('add-promotions')->middleware(promotion::class, 'promotion');
    Route::post('/promotion-by-id',  [App\Http\Controllers\PromotionController::class, 'promotionById'])->name('promotion-by-ids');
    Route::post('/update-promotion',  [App\Http\Controllers\PromotionController::class, 'promotionUpdate'])->name('update-promotions')->middleware(promotion::class, 'promotion');
    Route::get('/delete-promotion/{id}',  [App\Http\Controllers\PromotionController::class, 'deletePromotion'])->name('delete-promotions')->middleware(promotion::class, 'promotion');


    Route::get('/employee_increment', [App\Http\Controllers\CoreHrController::class, 'employeeIncrementIndex'])->name('employee_increment');
    Route::post('/add-increment',  [App\Http\Controllers\EmployeeIncrementController::class, 'incrementAdd'])->name('add-increments');
    Route::post('/increment-by-id',  [App\Http\Controllers\EmployeeIncrementController::class, 'incrementById'])->name('increment-by-ids');
    Route::post('/update-increment',  [App\Http\Controllers\EmployeeIncrementController::class, 'incrementUpdate'])->name('update-increments');
    Route::get('/delete-increment/{id}',  [App\Http\Controllers\EmployeeIncrementController::class, 'deleteIncrement'])->name('delete-increments');

    //Probation HR Module routes start from here
    Route::any('/probation-employee', [App\Http\Controllers\ProbationController::class, 'employeeProbationIndex'])->name('probation-employees');
    Route::any('/probation-employee-recommendation/{id}', [App\Http\Controllers\ProbationController::class, 'employeeProbationRecommendation'])->name('probation-employee-recommendation');
    Route::any('/recommendation-employee', [App\Http\Controllers\ProbationController::class, 'employeeRecommendationIndex'])->name('recommendation-employees');
    Route::any('/review-employee', [App\Http\Controllers\ProbationController::class, 'employeeReviewIndex'])->name('review-employee');
    Route::any('/review-show', [App\Http\Controllers\ProbationController::class, 'employeeReviewShow'])->name('review-show');
    Route::any('/update-review-employee', [App\Http\Controllers\ProbationController::class, 'employeeReviewUpdate'])->name('update-review-employee');
    Route::any('/recommendation-approve', [App\Http\Controllers\ProbationController::class, 'employeeRecommendationApprove'])->name('recommendation-approve');
    Route::any('/recommendation-download/{id}', [App\Http\Controllers\ProbationController::class, 'employeeRecommendationDownload'])->name('recommendation-download');


    Route::get('/awards', [App\Http\Controllers\CoreHrController::class, 'awardIndex'])->name('award')->middleware(award::class, 'award');
    Route::post('/add-award',  [App\Http\Controllers\AwardController::class, 'awardAdd'])->name('add-awards')->middleware(award::class, 'award');
    Route::post('/award-by-id',  [App\Http\Controllers\AwardController::class, 'awardById'])->name('award-by-ids');
    Route::post('/update-award',  [App\Http\Controllers\AwardController::class, 'awardUpdate'])->name('update-awards')->middleware(award::class, 'award');
    Route::get('/delete-award/{id}',  [App\Http\Controllers\AwardController::class, 'deleteAward'])->name('delete-awards')->middleware(award::class, 'award');


    Route::get('/travels', [App\Http\Controllers\CoreHrController::class, 'travelIndex'])->name('travel')->middleware(travel::class, 'travel');
    Route::post('/add-travel',  [App\Http\Controllers\TravelController::class, 'travelAdd'])->name('add-travels')->middleware(CheckStatus::class, 'auth');
    Route::post('/travel-by-id',  [App\Http\Controllers\TravelController::class, 'travelById'])->name('travel-by-ids');
    Route::post('/update-travel',  [App\Http\Controllers\TravelController::class, 'travelUpdate'])->name('update-travels')->middleware(CheckStatus::class, 'auth');
    Route::get('/delete-travel/{id}',  [App\Http\Controllers\TravelController::class, 'deleteTravel'])->name('delete-travels')->middleware(travel::class, 'travel');

    Route::get('/transfers', [App\Http\Controllers\CoreHrController::class, 'transferIndex'])->name('transfer')->middleware(transfer::class, 'transfer');
    Route::post('/transfer-letter-download/{id}', [App\Http\Controllers\TransferController::class, 'transferletter'])->name('transfer-letter-downloads')->middleware(CheckStatus::class, 'auth');

    Route::post('/add-transfer',  [App\Http\Controllers\TransferController::class, 'transferAdd'])->name('add-transfers')->middleware(transfer::class, 'transfer');
    Route::post('/transfer-by-id',  [App\Http\Controllers\TransferController::class, 'transferById'])->name('transfer-by-ids');
    Route::post('/update-transfer',  [App\Http\Controllers\TransferController::class, 'transferUpdate'])->name('update-transfers')->middleware(transfer::class, 'transfer');
    Route::get('/delete-transfer/{id}',  [App\Http\Controllers\TransferController::class, 'deleteTransfer'])->name('delete-transfers')->middleware(transfer::class, 'transfer');

    Route::get('/resignations', [App\Http\Controllers\CoreHrController::class, 'resignationIndex'])->name('resignation')->middleware(CheckStatus::class, 'auth');
    Route::any('/resignation-letter-download/{id}', [App\Http\Controllers\ResignationController::class, 'ResignationLetterDownload'])->name('resignation-letter-downloads')->middleware(CheckStatus::class, 'auth');

    Route::any('/resignation-acception-letter-download/{id}', [App\Http\Controllers\ResignationController::class, 'ResignationLetterAcceptanceDownload'])->name('resignation-acception-letter-downloads')->middleware(CheckStatus::class, 'auth');

    Route::post('/add-resignation',  [App\Http\Controllers\ResignationController::class, 'resignationAdd'])->name('add-resignations')->middleware(regignation::class, 'regignation');
    Route::post('/resignation-by-id',  [App\Http\Controllers\ResignationController::class, 'resignationById'])->name('resignation-by-ids');
    Route::post('/update-resignation',  [App\Http\Controllers\ResignationController::class, 'resignationUpdate'])->name('update-resignations')->middleware(regignation::class, 'regignation');
    Route::get('/delete-resignation/{id}',  [App\Http\Controllers\ResignationController::class, 'deleteResignation'])->name('delete-resignations')->middleware(regignation::class, 'regignation');
    Route::post('/approve-resignation/{id}',  [App\Http\Controllers\ResignationController::class, 'approveResignation'])->name('approve-resignations')->middleware(regignation::class, 'regignation');

    Route::get('/complaints', [App\Http\Controllers\CoreHrController::class, 'complaintIndex'])->name('complaint')->middleware(complimant::class, 'complimant');
    Route::post('/add-complaint',  [App\Http\Controllers\ComplaintController::class, 'complaintAdd'])->name('add-complaints')->middleware(complimant::class, 'complimant');
    Route::post('/complaint-by-id',  [App\Http\Controllers\ComplaintController::class, 'complaintById'])->name('complaint-by-ids');
    Route::post('/update-complaint',  [App\Http\Controllers\ComplaintController::class, 'complaintUpdate'])->name('update-complaints')->middleware(complimant::class, 'complimant');
    Route::get('/delete-complaint/{id}',  [App\Http\Controllers\ComplaintController::class, 'deleteComplaint'])->name('delete-complaints')->middleware(complimant::class, 'complimant');

    Route::get('/warnings', [App\Http\Controllers\CoreHrController::class, 'warningIndex'])->name('warning')->middleware(warning::class, 'warning');
    Route::post('/add-warning',  [App\Http\Controllers\WarningController::class, 'warningAdd'])->name('add-warnings')->middleware(warning::class, 'warning');
    Route::post('/warning-by-id',  [App\Http\Controllers\WarningController::class, 'warningById'])->name('warning-by-ids');
    Route::post('/update-warning',  [App\Http\Controllers\WarningController::class, 'warningUpdate'])->name('update-warnings')->middleware(warning::class, 'warning');
    Route::get('/delete-warning/{id}',  [App\Http\Controllers\WarningController::class, 'deleteWarning'])->name('delete-warnings')->middleware(warning::class, 'warning');

    Route::get('/terminations', [App\Http\Controllers\CoreHrController::class, 'terminationIndex'])->name('termination')->middleware(termination::class, 'termination');
    Route::any('/termination-letter-download/{id}', [App\Http\Controllers\TerminationController::class, 'terminationLetter'])->name('termination-letter-downloads')->middleware(termination::class, 'termination');
    Route::post('/add-termination',  [App\Http\Controllers\TerminationController::class, 'terminationAdd'])->name('add-terminations')->middleware(termination::class, 'termination');
    Route::post('/termination-by-id',  [App\Http\Controllers\TerminationController::class, 'terminationById'])->name('termination-by-ids');
    Route::post('/update-termination',  [App\Http\Controllers\TerminationController::class, 'terminationUpdate'])->name('update-terminations')->middleware(termination::class, 'termination');
    Route::get('/delete-termination/{id}',  [App\Http\Controllers\TerminationController::class, 'deleteTermination'])->name('delete-terminations')->middleware(termination::class, 'termination');

    Route::get('/provident-fund-members', [App\Http\Controllers\CoreHrController::class, 'providentFundMemberIndex'])->name('provident-fund-member')->middleware(eligiblepfmember::class, 'eligiblepfmember');
    Route::get('/send-membership-proposal/{id}', [App\Http\Controllers\ProvidentfundMemberController::class, 'sendMembershipProposal'])->name('send-membership-proposals');
    Route::get('/take-pf-membership', [App\Http\Controllers\CoreHrController::class, 'takePfMembership'])->name('take-pf-memberships');
    Route::get('/pf-membership-taken/{id}', [App\Http\Controllers\ProvidentfundMemberController::class, 'pfMembershipTaken'])->name('pf-membership-takens');

    Route::get('/pf-bank-account', [App\Http\Controllers\CoreHrController::class, 'pFBankAccountIndex'])->name('pf-bank-accounts')->middleware(PfBankAccount::class, 'PfBankAccount');
    Route::post('/add-pf-bank-account', [App\Http\Controllers\BankAccountController::class, 'addPfBankAccount'])->name('add-pf-bank-accounts')->middleware(PfBankAccount::class, 'PfBankAccount');
    Route::post('/update-pf-bank-account', [App\Http\Controllers\BankAccountController::class, 'pFBankAccountUpdate'])->name('update-pf-bank-accounts')->middleware(PfBankAccount::class, 'PfBankAccount');
    Route::get('/delete-pf-bank-account/delete/{id}', [App\Http\Controllers\BankAccountController::class, 'deletePfBankAccount'])->name('delete-pf-bank-accounts')->middleware(PfBankAccount::class, 'PfBankAccount');

    Route::get('/employee-salary-increment', [App\Http\Controllers\CoreHrController::class, 'salaryIncrementIndex'])->name('employee-salary-increments');
    Route::post('/give-employee-increment', [App\Http\Controllers\SalaryIncrementController::class, 'giveEmployeeIncrement'])->name('give-employee-increments');
    Route::post('/update-employee-increment', [App\Http\Controllers\SalaryIncrementController::class, 'updateEmployeeIncrement'])->name('update-employee-increments');
    Route::get('/delete-employee-increment/delete/{id}', [App\Http\Controllers\SalaryIncrementController::class, 'deleteEmployeeIncrement'])->name('delete-employee-increments');
    //Core HR Module routes end here

    //Organization Module routes start from here
    // Route::get('/company-organogram', [App\Http\Controllers\OrganizationController::class, 'companyOrganogramIndex'])->name('company-organograms');
    Route::get('/organization-configaration', [App\Http\Controllers\OrganizationCofigarationController::class, 'grade'])->name('organization-configarations');

    Route::any('/apporove-with-out-payments-sheet/{id}', [App\Http\Controllers\EmployeeSetupController::class, 'approveSalarySheet'])->name('apporove-with-out-payments-sheets');

    Route::get('/man-power-setup', [App\Http\Controllers\ManPowerController::class, 'manPower'])->name('man-power');
    Route::post('/create-man-power', [App\Http\Controllers\ManPowerController::class, 'createMananPower'])->name('create-man-power');
    Route::post('/man-power-by-id',  [App\Http\Controllers\ManPowerController::class, 'manPowerById'])->name('man-power-by-ids');
    Route::post('/update-man-power',  [App\Http\Controllers\ManPowerController::class, 'UpdateManPower'])->name('update-man-power');
    Route::get('/man-power-delete/{id}',  [App\Http\Controllers\ManPowerController::class, 'DeleteManPower'])->name('man-power-delete');


    Route::get('/download-man-power-report', [App\Http\Controllers\ManPowerController::class, 'DownloadManPowerReport'])->name('download-man-power-report');

    Route::post('/add-recommendation', [App\Http\Controllers\OrganizationCofigarationController::class, 'addRecommendation'])->name('add-recommendations');
    Route::get('/delete-recommendation/{id}', [App\Http\Controllers\OrganizationCofigarationController::class, 'deletRecommendation'])->name('delete-recommendations');
    Route::post('/recommendation-by-id',  [App\Http\Controllers\OrganizationCofigarationController::class, 'recommendationById'])->name('recommendation-by-ids');
    Route::post('/update-recommendation',  [App\Http\Controllers\OrganizationCofigarationController::class, 'updateRecommendation'])->name('update-recommendations')->middleware(warning::class, 'warning');

    Route::post('/add-grade', [App\Http\Controllers\OrganizationCofigarationController::class, 'addGrade'])->name('add-grades');
    Route::post('/edit-grade', [App\Http\Controllers\OrganizationCofigarationController::class, 'editGrade'])->name('edit-grades');
    Route::get('/delete-grade/{id}', [App\Http\Controllers\OrganizationCofigarationController::class, 'deleteGrade'])->name('delete-grades');
    Route::post('/add-grade-label', [App\Http\Controllers\OrganizationCofigarationController::class, 'addGradeLabel'])->name('add-grade-labels');
    Route::post('/add-grade-setup', [App\Http\Controllers\OrganizationCofigarationController::class, 'addGradeSetup'])->name('add-grade-setups');
    Route::post('/edit-grade-setup', [App\Http\Controllers\OrganizationCofigarationController::class, 'editGradeSetup'])->name('edit-grade-setups');
    Route::post('/update-grade-setup', [App\Http\Controllers\OrganizationCofigarationController::class, 'updateGradeSetup'])->name('update-grade-setup');
    Route::get('/delete-grade-setup/{id}', [App\Http\Controllers\OrganizationCofigarationController::class, 'deleteGradeSetup'])->name('delete-grade-setups');

    Route::get('/company', [App\Http\Controllers\OrganizationController::class, 'companyIndex'])->name('companies')->middleware(Company::class, 'Company');
    Route::post('/company-update', [App\Http\Controllers\CompanyController::class, 'companyUpdate'])->name('company-updates')->middleware(Company::class, 'Company');
    Route::get('/department', [App\Http\Controllers\OrganizationController::class, 'departmentIndex'])->name('departments')->middleware(department::class, 'department');
    Route::post('/add-department', [App\Http\Controllers\DepartmentController::class, 'addDepartment'])->name('add-departments')->middleware(department::class, 'department');
    Route::post('/update-department', [App\Http\Controllers\DepartmentController::class, 'updateDepartment'])->name('update-departments')->middleware(department::class, 'department');
    Route::get('/department/delete/{id}',  [App\Http\Controllers\DepartmentController::class, 'deleteDepartment'])->name('delete-departments')->middleware(department::class, 'department');
    Route::get('/allowance-head', [App\Http\Controllers\OrganizationController::class, 'allowanceIndex'])->name('allowance-heads')->middleware(allowancehead::class, 'allowancehead');
    Route::post('/add-allowance-head', [App\Http\Controllers\AllowanceHeadController::class, 'addAllowance'])->name('add-allowance-heads')->middleware(allowancehead::class, 'allowancehead');
    Route::post('/update-allowance-head', [App\Http\Controllers\AllowanceHeadController::class, 'updateAllowance'])->name('update-allowance-heads')->middleware(allowancehead::class, 'allowancehead');
    Route::get('/allowance-head/delete/{id}', [App\Http\Controllers\AllowanceHeadController::class, 'deleteAllowance'])->name('delete-allowance-heads')->middleware(allowancehead::class, 'allowancehead');
    Route::get('/location', [App\Http\Controllers\OrganizationController::class, 'index'])->name('locations');
    Route::get('/attandance-location', [App\Http\Controllers\OrganizationController::class, 'index'])->name('attandance-locations');
    Route::get('/login-history', [App\Http\Controllers\OrganizationController::class, 'index'])->name('login-histories');
    Route::get('/login-id-location', [App\Http\Controllers\OrganizationController::class, 'index'])->name('login-id-locations');
    Route::get('/region', [App\Http\Controllers\OrganizationController::class, 'regionIndex'])->name('regions')->middleware(region::class, 'region');
    Route::post('/add-region', [App\Http\Controllers\RegionController::class, 'addRegion'])->name('add-regions')->middleware(region::class, 'region');
    Route::post('/update-region', [App\Http\Controllers\RegionController::class, 'updateRegion'])->name('update-regions')->middleware(region::class, 'region');
    Route::get('/region/delete/{id}', [App\Http\Controllers\RegionController::class, 'deleteRegion'])->name('delete-regions')->middleware(region::class, 'region');
    Route::post('/loaction-one', [App\Http\Controllers\RegionController::class, 'LocationCustomize'])->name('loaction-ones')->middleware(region::class, 'region');
    Route::get('/area', [App\Http\Controllers\OrganizationController::class, 'areaIndex'])->name('areas')->middleware(area::class, 'area');
    Route::post('/add-area', [App\Http\Controllers\AreaController::class, 'addArea'])->name('add-areas')->middleware(area::class, 'area');
    Route::post('/update-area', [App\Http\Controllers\AreaController::class, 'updateArea'])->name('update-areas')->middleware(area::class, 'area');
    Route::get('/area/delete/{id}', [App\Http\Controllers\AreaController::class, 'deleteArea'])->name('delete-areas')->middleware(area::class, 'area');
    Route::post('/loaction-two', [App\Http\Controllers\AreaController::class, 'LocationCustomize'])->name('loaction-twos')->middleware(area::class, 'area');
    Route::get('/territory', [App\Http\Controllers\OrganizationController::class, 'territoryIndex'])->name('territories')->middleware(territory::class, 'territory');
    Route::post('/add-territory', [App\Http\Controllers\TerritoryController::class, 'addTerritory'])->name('add-territories')->middleware(territory::class, 'territory');
    Route::post('/update-territory', [App\Http\Controllers\TerritoryController::class, 'updateTerritory'])->name('update-territories')->middleware(territory::class, 'territory');
    Route::get('/territory/delete/{id}', [App\Http\Controllers\TerritoryController::class, 'deleteTerritory'])->name('delete-territories')->middleware(territory::class, 'territory');
    Route::get('/territory/edit/{id}', [App\Http\Controllers\TerritoryController::class, 'editTerritory'])->name('edit-territories')->middleware(territory::class, 'territory');
    Route::post('/loaction-three', [App\Http\Controllers\TerritoryController::class, 'LocationCustomize'])->name('loaction-threes')->middleware(territory::class, 'territory');
    Route::get('/town', [App\Http\Controllers\OrganizationController::class, 'townIndex'])->name('towns')->middleware(Town::class, 'Town');
    Route::post('/add-town', [App\Http\Controllers\TownController::class, 'addTown'])->name('add-towns')->middleware(Town::class, 'Town');
    Route::post('/update-town', [App\Http\Controllers\TownController::class, 'updateTown'])->name('update-towns')->middleware(Town::class, 'Town');
    Route::get('/town/delete/{id}', [App\Http\Controllers\TownController::class, 'deleteTown'])->name('delete-towns')->middleware(Town::class, 'Town');
    Route::get('/town/edit/{id}', [App\Http\Controllers\TownController::class, 'editTown'])->name('edit-towns')->middleware(Town::class, 'Town');
    Route::post('/loaction-four', [App\Http\Controllers\TownController::class, 'LocationCustomize'])->name('loaction-fours')->middleware(Town::class, 'Town');
    Route::get('/db-house', [App\Http\Controllers\OrganizationController::class, 'dbHouseIndex'])->name('db-houses')->middleware(dbhouse::class, 'dbhouse');
    Route::post('/add-db-house', [App\Http\Controllers\DbHouseController::class, 'addDbHouse'])->name('add-db-houses')->middleware(dbhouse::class, 'dbhouse');
    Route::post('/update-db-house', [App\Http\Controllers\DbHouseController::class, 'updateDbHouse'])->name('update-db-houses')->middleware(dbhouse::class, 'dbhouse');
    Route::get('/db-house/delete/{id}', [App\Http\Controllers\DbHouseController::class, 'deleteDbHouse'])->name('delete-db-houses')->middleware(dbhouse::class, 'dbhouse');
    Route::get('/db-house/edit/{id}', [App\Http\Controllers\DbHouseController::class, 'editDbHouse'])->name('edit-db-houses')->middleware(dbhouse::class, 'dbhouse');
    Route::post('/loaction-five', [App\Http\Controllers\DbHouseController::class, 'LocationCustomize'])->name('loaction-fives')->middleware(dbhouse::class, 'dbhouse');
    //Location6
    Route::get('/location-six', [App\Http\Controllers\OrganizationController::class, 'locationSixIndex'])->name('location-sixes');
    Route::post('/add-location-six', [App\Http\Controllers\Locatoion6Controller::class, 'addLocation'])->name('add-location-sixes');
    Route::post('/update-location-six', [App\Http\Controllers\Locatoion6Controller::class, 'updateLocation'])->name('update-location-sixes');
    Route::get('/location-six/delete/{id}', [App\Http\Controllers\Locatoion6Controller::class, 'deleteLocation'])->name('delete-location-sixes');
    Route::get('/location-six/edit/{id}', [App\Http\Controllers\Locatoion6Controller::class, 'editLocationSix'])->name('edit-location-sixes');
    Route::post('/loaction-six', [App\Http\Controllers\Locatoion6Controller::class, 'LocationCustomize'])->name('loaction-sixes');
    //end location6

    //Location7
    Route::get('/location-seven', [App\Http\Controllers\OrganizationController::class, 'locationSevenIndex'])->name('location-sevens');
    Route::post('/add-location-seven', [App\Http\Controllers\LocatoionsevenController::class, 'addLocation'])->name('add-location-sevenes');
    Route::post('/update-location-seven', [App\Http\Controllers\LocatoionsevenController::class, 'updateLocation'])->name('update-location-sevenes');
    Route::get('/location-seven/delete/{id}', [App\Http\Controllers\LocatoionsevenController::class, 'deleteLocation'])->name('delete-location-sevenes');
    Route::get('/location-seven/edit/{id}', [App\Http\Controllers\LocatoionsevenController::class, 'editLocationSeven'])->name('edit-location-sevenes');
    Route::post('/loaction-seven', [App\Http\Controllers\LocatoionsevenController::class, 'LocationCustomize'])->name('loaction-sevenes');
    //end location7
    //Location8
    Route::get('/location-eight', [App\Http\Controllers\OrganizationController::class, 'locationEightIndex'])->name('location-eights');
    Route::post('/add-location-eight', [App\Http\Controllers\LocationeightController::class, 'addLocation'])->name('add-location-eights');
    Route::post('/update-location-eight', [App\Http\Controllers\LocationeightController::class, 'updateLocation'])->name('update-location-eights');
    Route::get('/location-eight/delete/{id}', [App\Http\Controllers\LocationeightController::class, 'deleteLocation'])->name('delete-location-eights');
    Route::get('/location-eight/edit/{id}', [App\Http\Controllers\LocationeightController::class, 'editLocationEight'])->name('edit-location-eights');
    Route::post('/loaction-eight', [App\Http\Controllers\LocationeightController::class, 'LocationCustomize'])->name('loaction-eights');
    //end location8
    //Location9
    Route::get('/location-nine', [App\Http\Controllers\OrganizationController::class, 'locationNineIndex'])->name('location-nines');
    Route::post('/add-location-nine', [App\Http\Controllers\LocationnineController::class, 'addLocation'])->name('add-location-nines');
    Route::post('/update-location-nine', [App\Http\Controllers\LocationnineController::class, 'updateLocation'])->name('update-location-nines');
    Route::get('/location-nine/delete/{id}', [App\Http\Controllers\LocationnineController::class, 'deleteLocation'])->name('delete-location-nines');
    Route::get('/location-nine/edit/{id}', [App\Http\Controllers\LocationnineController::class, 'editLocationNine'])->name('edit-location-nines');
    Route::post('/loaction-nine', [App\Http\Controllers\LocationnineController::class, 'LocationCustomize'])->name('loaction-nines');
    //end location9
    //Location10
    Route::get('/location-ten', [App\Http\Controllers\OrganizationController::class, 'locationTenIndex'])->name('location-tens');
    Route::post('/add-location-ten', [App\Http\Controllers\LocationtenController::class, 'addLocation'])->name('add-location-tens');
    Route::post('/update-location-ten', [App\Http\Controllers\LocationtenController::class, 'updateLocation'])->name('update-location-tens');
    Route::get('/location-ten/delete/{id}', [App\Http\Controllers\LocationtenController::class, 'deleteLocation'])->name('delete-location-tens');
    Route::get('/location-ten/edit/{id}', [App\Http\Controllers\LocationtenController::class, 'editLocationTen'])->name('edit-location-tens');
    Route::post('/loaction-ten', [App\Http\Controllers\LocationtenController::class, 'LocationCustomize'])->name('loaction-tens');
    //end location10
    //Location11
    Route::get('/location-eleven', [App\Http\Controllers\OrganizationController::class, 'locationElevenIndex'])->name('location-elevens');
    Route::post('/add-location-eleven', [App\Http\Controllers\LocationelevenController::class, 'addLocation'])->name('add-location-elevens');
    Route::post('/update-location-eleven', [App\Http\Controllers\LocationelevenController::class, 'updateLocation'])->name('update-location-elevens');
    Route::get('/location-eleven/delete/{id}', [App\Http\Controllers\LocationelevenController::class, 'deleteLocation'])->name('delete-location-elevens');
    Route::get('/location-eleven/edit/{id}', [App\Http\Controllers\LocationelevenController::class, 'editLocationEleven'])->name('edit-location-elevens');
    Route::post('/loaction-eleven', [App\Http\Controllers\LocationelevenController::class, 'LocationCustomize'])->name('loaction-elevens');
    //end location11
    Route::get('/location-customize', [App\Http\Controllers\LocatoinCustomizeController::class, 'locationCustomize'])->name('location-customizes');

    Route::get('/designation', [App\Http\Controllers\OrganizationController::class, 'designationIndex'])->name('designations')->middleware(designation::class, 'designation');
    Route::post('/add-designation', [App\Http\Controllers\DesignationController::class, 'addDesignation'])->name('add-designations')->middleware(designation::class, 'designation');
    Route::post('/update-designation', [App\Http\Controllers\DesignationController::class, 'updateDesignation'])->name('update-designations')->middleware(designation::class, 'designation');
    Route::get('/designation/delete/{id}', [App\Http\Controllers\DesignationController::class, 'deleteDesignation'])->name('delete-designations')->middleware(designation::class, 'designation');
    Route::get('/announcements', [App\Http\Controllers\OrganizationController::class, 'announcementIndex'])->name('announcement')->middleware(CheckStatus::class, 'auth');
    Route::post('/add-announcement', [App\Http\Controllers\AnnouncementController::class, 'addAnnouncement'])->name('add-announcements')->middleware(CheckStatus::class, 'auth');
    Route::post('/update-announcement', [App\Http\Controllers\AnnouncementController::class, 'updateAnnouncement'])->name('update-announcements')->middleware(CheckStatus::class, 'auth');
    Route::get('/announcement/delete/{id}', [App\Http\Controllers\AnnouncementController::class, 'deleteAnnouncement'])->name('delete-announcements')->middleware(CheckStatus::class, 'auth');
    Route::get('/company-policies', [App\Http\Controllers\OrganizationController::class, 'policyIndex'])->name('company-policy')->middleware(CompanyPolicy::class, 'CompanyPolicy');
    Route::post('/add-company-policies', [App\Http\Controllers\PolicyController::class, 'addPolicy'])->name('add-company-policy')->middleware(CompanyPolicy::class, 'CompanyPolicy');
    Route::post('/update-company-policies', [App\Http\Controllers\PolicyController::class, 'updatePolicy'])->name('update-company-policy')->middleware(CompanyPolicy::class, 'CompanyPolicy');
    Route::get('/company-policies/delete/{id}', [App\Http\Controllers\PolicyController::class, 'deletePolicy'])->name('delete-company-policy')->middleware(CompanyPolicy::class, 'CompanyPolicy');

    Route::any('/lunch-bill', [App\Http\Controllers\LunchController::class, 'index'])->name('lunch-bills');
    Route::any('/add-lunch-bill', [App\Http\Controllers\LunchController::class, 'addLunchBill'])->name('add-lunch-bills');
    Route::any('/update-lunch-bill/{id}', [App\Http\Controllers\LunchController::class, 'updateLunchBill'])->name('update-lunch-bills');
    Route::any('/delete-lunch-bill/{id}', [App\Http\Controllers\LunchController::class, 'deleteLunchBill'])->name('delete-lunch-bills');

    //Organization Module routes end here

    //Time sheets Module routes start from here
    Route::get('/attendance', [App\Http\Controllers\TimesheetController::class, 'attendanceIndex'])->name('attendance')->middleware(Attendance::class, 'Attendance');
    Route::post('/date-wise-all-attendances', [App\Http\Controllers\AttendanceController::class, 'dateWiseAllAttendance'])->name('date-wise-all-attendance')->middleware(DateWiseAttendance::class, 'DateWiseAttendance');
    Route::get('/date-wise-attendances', [App\Http\Controllers\TimesheetController::class, 'dateWiseAttendanceIndex'])->name('date-wise-attendance')->middleware(DateWiseAttendance::class, 'DateWiseAttendance');


    Route::post('/date-wise-employee-attendances', [App\Http\Controllers\AttendanceController::class, 'dateWiseEmployeeAttendance'])->name('date-wise-employee-attendance');
    Route::get('/date-wise-attendances-download', [App\Http\Controllers\AttendanceController::class, 'dateWiseAttendanceDownload'])->name('date-wise-attendance-download');

    Route::get('/monthly-attendances', [App\Http\Controllers\TimesheetController::class, 'monthWiseAttendanceIndex'])->name('monthly-attendance')->middleware(MonthlyAttendance::class, 'MonthlyAttendance');
    Route::any('/month-wise-employee-attendances', [App\Http\Controllers\AttendanceController::class, 'monthWiseEmployeeAttendance'])->name('month-wise-employee-attendance');
    Route::get('/update-attendances', [App\Http\Controllers\TimesheetController::class, 'updateAttendanceIndex'])->name('update-attendance')->middleware(UpdateAttendance::class, 'UpdateAttendance');
    Route::post('/update-attendances', [App\Http\Controllers\TimesheetController::class, 'updateAttendanceEmployeeDateWiseSearch'])->name('update-date-wise-employee-attendance-searches');


    Route::any('/set-ip', [App\Http\Controllers\DeviceConfigureController::class, 'setIp'])->name('set-ip');
    Route::any('/add-device-ip', [App\Http\Controllers\DeviceConfigureController::class, 'addDeviceIp'])->name('add-device-ip');
    Route::any('/ip-by-id', [App\Http\Controllers\DeviceConfigureController::class, 'ipById'])->name('ip-by-id');
    Route::any('/ip-update', [App\Http\Controllers\DeviceConfigureController::class, 'ipUpdate'])->name('ip-update');
    Route::any('/delete-ip', [App\Http\Controllers\DeviceConfigureController::class, 'ipDelete'])->name('delete-ip');

    Route::any('/token-list', [App\Http\Controllers\DeviceConfigureController::class, 'tokenGenerate'])->name('token-list');
    Route::any('/token-generate', [App\Http\Controllers\DeviceConfigureController::class, 'addDeviceToken'])->name('token-generate');
    Route::any('/token-by-id', [App\Http\Controllers\DeviceConfigureController::class, 'tokenById'])->name('token-by-id');
    Route::any('/token-update', [App\Http\Controllers\DeviceConfigureController::class, 'tokenByUpdate'])->name('token-update');

    Route::any('/device-area', [App\Http\Controllers\DeviceConfigureController::class, 'deviceArea'])->name('device-area');
    Route::any('/add-device-area', [App\Http\Controllers\DeviceConfigureController::class, 'deviceAreaAdd'])->name('add-device-area');
    Route::any('/device-area-by-id', [App\Http\Controllers\DeviceConfigureController::class, 'deviceAreaById'])->name('device-area-by-id');
    Route::any('/device-area-update', [App\Http\Controllers\DeviceConfigureController::class, 'deviceAreaByUpdate'])->name('device-area-update');
    Route::any('/delete-device-area', [App\Http\Controllers\DeviceConfigureController::class, 'deviceAreaDelete'])->name('delete-device-area');
    // Route::any('/device-area-list', [App\Http\Controllers\DeviceConfigureController::class, 'getDeviceAreaList'])->name('device-area-list');

    Route::any('/device-list', [App\Http\Controllers\DeviceConfigureController::class, 'deviceList'])->name('device-list');
    Route::any('/device-re-boot', [App\Http\Controllers\DeviceConfigureController::class, 'deviceReBoot'])->name('device-re-boot');

    Route::any('/employee-with-fp', [App\Http\Controllers\DeviceConfigureController::class, 'employeeWithFp'])->name('employee-with-fp');
    Route::any('/get-device-area', [App\Http\Controllers\DeviceConfigureController::class, 'getDeviceArea'])->name('get-device-area');
    Route::any('/add-employee-with-fp', [App\Http\Controllers\DeviceConfigureController::class, 'employeeWithFpAdd'])->name('add-employee-with-fp');

    Route::any('/delete-employee-with-fp', [App\Http\Controllers\DeviceConfigureController::class, 'deleteEmployeeWithFp'])->name('delete-employee-with-fp');

    Route::any('/employee-without-fp', [App\Http\Controllers\DeviceConfigureController::class, 'employeeWithoutFp'])->name('employee-without-fp');


    //Route::get('/add-attendances', [App\Http\Controllers\TimesheetController::class, 'addAttendanceIndex'])->name('add-attendance');
    Route::post('/add-attendances', [App\Http\Controllers\TimesheetController::class, 'addAttendanceEmployeeDateWiseSearch'])->name('add-date-wise-employee-attendance-searches');

    Route::post('/add-date-wise-employee-attendance', [App\Http\Controllers\AttendanceController::class, 'addAttendanceEmployeeDateWise'])->name('add-date-wise-employee-attendances');
    Route::post('/update-date-wise-employee-attendance', [App\Http\Controllers\AttendanceController::class, 'updateAttendanceEmployeeDateWise'])->name('update-date-wise-employee-attendances');
    Route::get('/delete-attendances/delete/{id}', [App\Http\Controllers\AttendanceController::class, 'deleteAttendanceEmployeeDateWise'])->name('delete-attendances');
    Route::get('/import-attendances', [App\Http\Controllers\TimesheetController::class, 'importAttendanceIndex'])->name('import-attendance')->middleware(ImportAttendance::class, 'ImportAttendance');
    Route::get('/office-shift', [App\Http\Controllers\TimesheetController::class, 'officeShiftIndex'])->name('office-shifts')->middleware(Officeshift::class, 'Officeshift');
    Route::post('/update-shift', [App\Http\Controllers\OfficeShiftController::class, 'updateOfficeShift'])->name('update-shifts')->middleware(Officeshift::class, 'Officeshift');
    Route::post('/add-shift', [App\Http\Controllers\OfficeShiftController::class, 'addOfficeShift'])->name('add-shifts')->middleware(Officeshift::class, 'Officeshift');
    Route::get('/shift/delete/{id}', [App\Http\Controllers\OfficeShiftController::class, 'deleteOfficeShift'])->name('delete-office-shifts')->middleware(Officeshift::class, 'Officeshift');
    Route::get('/manage-weekly-holiday', [App\Http\Controllers\TimesheetController::class, 'manageWeeklyHolidayIndex'])->name('manage-weekly-holidays')->middleware(weeklyHoliday::class, 'weeklyHoliday');
    Route::post('/add-weekly-holiday', [App\Http\Controllers\HolidayController::class, 'manageWeeklyHolidayStore'])->name('add-weekly-holidays')->middleware(weeklyHoliday::class, 'weeklyHoliday');
    Route::post('/edit-weekly-holiday', [App\Http\Controllers\HolidayController::class, 'editWeeklyHoliday'])->name('edit-weekly-holidays')->middleware(weeklyHoliday::class, 'weeklyHoliday');
    Route::post('/update-weekly-holiday', [App\Http\Controllers\HolidayController::class, 'updateWeeklyHoliday'])->name('update-weekly-holidays')->middleware(weeklyHoliday::class, 'weeklyHoliday');
    Route::post('/delete-weekly-holiday', [App\Http\Controllers\HolidayController::class, 'deleteWeeklyHoliday'])->name('delete-weekly-holidays')->middleware(weeklyHoliday::class, 'weeklyHoliday');
    Route::get('/manage-other-holiday', [App\Http\Controllers\TimesheetController::class, 'manageOtherHolidayIndex'])->name('manage-other-holidays')->middleware(otherHoliday::class, 'otherHoliday');
    Route::post('/add-other-holiday', [App\Http\Controllers\HolidayController::class, 'manageOtherHolidayStore'])->name('add-other-holidays')->middleware(otherHoliday::class, 'otherHoliday');
    Route::post('/edit-other-holiday-getting', [App\Http\Controllers\HolidayController::class, 'editOtherHolidayGetting'])->name('edit-other-holiday-gettings')->middleware(otherHoliday::class, 'otherHoliday');
    Route::post('/edit-company-other-holiday', [App\Http\Controllers\HolidayController::class, 'editCompanyOtherHoliday'])->name('edit-other-holidays')->middleware(otherHoliday::class, 'otherHoliday');
    Route::get('/delete-other-holiday/{id}', [App\Http\Controllers\HolidayController::class, 'deleteOtherHoliday'])->name('delete-other-holidays')->middleware(otherHoliday::class, 'otherHoliday');
    Route::get('/manage-leave-type', [App\Http\Controllers\TimesheetController::class, 'manageLeaveTypeIndex'])->name('manage-leave-types')->middleware(manageLeaveType::class, 'manageLeaveType');
    Route::post('/add-leave-type', [App\Http\Controllers\LeaveTypeController::class, 'leaveTypeStore'])->name('add-leave-types')->middleware(manageLeaveType::class, 'manageLeaveType');
    Route::post('/leave-type-by-id', [App\Http\Controllers\LeaveTypeController::class, 'leaveTypeById'])->name('leave-type-by-ids');
    Route::post('/update-leave-type', [App\Http\Controllers\LeaveTypeController::class, 'updateLeaveType'])->name('update-leave-types')->middleware(manageLeaveType::class, 'manageLeaveType');
    Route::get('/delete-leave-type/{id}', [App\Http\Controllers\LeaveTypeController::class, 'deleteLeaveType'])->name('delete-leave-types')->middleware(manageLeaveType::class, 'manageLeaveType');
    Route::get('/manage-leaves', [App\Http\Controllers\TimesheetController::class, 'manageLeaveIndex'])->name('manage-leave')->middleware(manageLeave::class, 'manageLeave');
    Route::any('/remaining-total-leaves-by-employee', [App\Http\Controllers\TimesheetController::class, 'remainingLeaves'])->name('remaining-total-leaves-by-employee')->middleware(manageLeave::class, 'manageLeave');
    Route::any('/remaining-total-leaves', [App\Http\Controllers\TimesheetController::class, 'remainingTotalLeaves'])->name('remaining-total-leaves')->middleware(manageLeave::class, 'manageLeave');

    Route::get('/approve-manage-leaves', [App\Http\Controllers\TimesheetController::class, 'approveManageLeaveIndex'])->name('approve-manage-leave')->middleware(manageLeave::class, 'manageLeave');
    Route::get('/pending-manage-leaves', [App\Http\Controllers\TimesheetController::class, 'pendingManageLeaveIndex'])->name('pending-manage-leave')->middleware(manageLeave::class, 'manageLeave');

    Route::post('/add-leave', [App\Http\Controllers\LeaveController::class, 'leaveStore'])->name('add-leaves')->middleware(manageLeave::class, 'manageLeave');
    Route::post('/leave-details-by-id', [App\Http\Controllers\LeaveController::class, 'leaveDetailsById'])->name('leave-details-by-ids');
    Route::get('/delete-leave/{id}', [App\Http\Controllers\LeaveController::class, 'deleteLeave'])->name('delete-leaves')->middleware(manageLeave::class, 'manageLeave');

    Route::get('/approve-leave', [App\Http\Controllers\TimesheetController::class, 'approveLeaveIndex'])->name('approve-leaves')->middleware(CheckStatus::class, 'auth');
    Route::any('/show-approve-leave',  [App\Http\Controllers\TimesheetController::class, 'approveLeaveShow'])->name('show-approve-leave');

    Route::get('/approve-travel', [App\Http\Controllers\TimesheetController::class, 'approveTravelIndex'])->name('approve-travels')->middleware(CheckStatus::class, 'auth');
    Route::get('/manage-travel', [App\Http\Controllers\TimesheetController::class, 'ManageTravelIndex'])->name('manage-travels')->middleware(CheckStatus::class, 'auth');
    Route::get('/approve-leave-request/{id}/{leave_approver_id}', [App\Http\Controllers\LeaveController::class, 'approveLeave'])->name('approve-leave-requests')->middleware(CheckStatus::class, 'auth');
    Route::post('/edit-and-approve-leave-request', [App\Http\Controllers\LeaveController::class, 'editAndApproveLeave'])->name('edit-and-approve-leave-requests')->middleware(CheckStatus::class, 'auth');
    //Time sheets Module routes end here

    Route::post('import-attendances', [App\Http\Controllers\AttendanceController::class, 'fileImportAttendance'])->name('file-attendance-imports');
    Route::get('location-reset', [App\Http\Controllers\TimesheetController::class, 'locationResetIndex'])->name('location-resets');
    Route::get('compensatory-leave', [App\Http\Controllers\TimesheetController::class, 'compensatoryLeavesIndex'])->name('compensatory-leaves');
    Route::get('compensatory-leaves-approve', [App\Http\Controllers\TimesheetController::class, 'compensatoryLeavesApproveIndex'])->name('compensatory-leaves-approves');
    Route::get('approve-compensatory-leave/{id}', [App\Http\Controllers\CompensatoryLeaveController::class, 'compensatoryLeavesApprove'])->name('approve-compensatory-leaves');
    Route::post('set-compensatory-leave', [App\Http\Controllers\CompensatoryLeaveController::class, 'compensatoryLeavesSet'])->name('set-compensatory-leaves');
    Route::get('location-lock', [App\Http\Controllers\TimesheetController::class, 'locationLockIndex'])->name('location-locks');
    Route::post('update-attendance-location', [App\Http\Controllers\AttendanceController::class, 'updateAttendanceLocation'])->name('update-attendance-locations');
    Route::post('update-bulk-attendance-location', [App\Http\Controllers\AttendanceController::class, 'updateBulkAttendanceLocation'])->name('update-bulk-attendance-locations');


    //Payroll Module routes start from here
    Route::get('/new-payments', [App\Http\Controllers\PayrollController::class, 'newPaymentIndex'])->name('new-payment')->middleware(NewPayment::class, 'NewPayment');
    Route::post('new-payments', [App\Http\Controllers\PayrollController::class, 'newPaymentIndex'])->name('department-wise-employee-payments');
    Route::post('/salary-details-by-id', [App\Http\Controllers\PayrollController::class, 'salaryDetailsById'])->name('salary-details-by-ids');
    Route::post('/make-payment', [App\Http\Controllers\PayrollController::class, 'makePayment'])->name('make-payments')->middleware(NewPayment::class, 'NewPayment');
    Route::get('/payment-history', [App\Http\Controllers\PayrollController::class, 'paymentHistoryIndex'])->name('payment-histories')->middleware(NewPayment::class, 'NewPayment');
    Route::post('/department-and-month-wise-payment-history', [App\Http\Controllers\PayrollController::class, 'paymentHistorySearchIndex'])->name('department-and-month-wise-payment-histories');
    Route::post('/payment-history-delete', [App\Http\Controllers\PayrollController::class, 'paymentHistoryDelete'])->name('paymentDelete');

    Route::any('/month-wise-salary-sheet-generate-with-out-payment', [App\Http\Controllers\PayrollController::class, 'monthWiseSalarySheetGenerateWithOutPayment'])->name('month-wise-salary-sheet-generate-with-out-payments');
    Route::post('/with-out-payments-sheet-approve', [App\Http\Controllers\PayrollController::class, 'withOutPaymentSheetApprove'])->name('with-out-payments-sheet-approval');
    Route::post('/download-with-out-payments-sheet', [App\Http\Controllers\PayrollController::class, 'downloadwithOutPaymentSheet'])->name('download-with-out-payments-sheets');
    Route::post('/month-wise-salary-sheet-generate', [App\Http\Controllers\PayrollController::class, 'monthWiseSalarySheetGenerate'])->name('month-wise-salary-sheet-generates');
    Route::post('/month-wise-salary-sheet-generate-excel', [App\Http\Controllers\PayrollController::class, 'MonthWiseExcelSalarySheet'])->name('month-wise-salary-sheet-generate-exceles');
    Route::get('/pf-history', [App\Http\Controllers\PayrollController::class, 'pfHistoryIndex'])->name('pf-histories')->middleware(providentFundHistory::class, 'providentFundHistory');
    Route::post('/month-wise-pf-history', [App\Http\Controllers\PayrollController::class, 'monthWisePfHistoryIndex'])->name('month-wise-pf-histories')->middleware(providentFundHistory::class, 'providentFundHistory');
    Route::any('/salary-disburse', [App\Http\Controllers\SalaryDisbuseController::class, 'salaryDisburse'])->name('salary-disburses');
    Route::any('/search-salary-disburse', [App\Http\Controllers\SalaryDisbuseController::class, 'searchSalaryDisburse'])->name('search-salary-disburses');

    Route::any('/payment-festival-history-delete', [App\Http\Controllers\PayrollController::class, 'paymentFestivalHistoryDelete'])->name('paymentFestivalDelete');
    Route::any('/make-payment-festival', [App\Http\Controllers\PayrollController::class, 'paymentFestivalBounus'])->name('make-payment-festivals')->middleware(NewPayment::class, 'NewPayment');
    Route::get('/payment-festival-history', [App\Http\Controllers\PayrollController::class, 'FestivalBounusPaymentHistory'])->name('payment-festival-histories')->middleware(NewPayment::class, 'NewPayment');
    Route::any('/department-and-month-wise-payment-festival-history', [App\Http\Controllers\PayrollController::class, 'paymentFestivalHistorySearchIndex'])->name('department-and-month-wise-payment-festival-histories');
    Route::any('/festival-salary-disburse', [App\Http\Controllers\SalaryDisbuseController::class, 'festivalSalaryDisburse'])->name('festival-salary-disburses');
    Route::any('/festival-search-salary-disburse', [App\Http\Controllers\SalaryDisbuseController::class, 'searchFestivalSalaryDisburse'])->name('festival-search-salary-disburses');
    Route::any('/new-festival-payments', [App\Http\Controllers\FestivalConfigController::class, 'newFestivalPaymentIndex'])->name('new-festival-payment')->middleware(NewPayment::class, 'NewPayment');
    Route::post('/month-wise-festival-salary-sheet-generate', [App\Http\Controllers\PayrollController::class, 'MonthWiseFestivalSalarySheetGenerate'])->name('month-wise-festival-salary-sheet-generates');

    //Payroll Module routes end here
    //Performance Module routes start from here
    // Route::get('/goal-types', [App\Http\Controllers\PerformanceController::class, 'index'])->name('goal-type');
    // Route::get('/goal-tracking', [App\Http\Controllers\PerformanceController::class, 'index'])->name('goal-trackings');
    // Route::get('/indicator', [App\Http\Controllers\PerformanceController::class, 'index'])->name('indicators');
    // Route::get('/appraisal', [App\Http\Controllers\PerformanceController::class, 'index'])->name('appraisals');
    //Performance Module routes end here

    //Performance Module routes start from here
    Route::get('/performance-type-config/{id}', [App\Http\Controllers\PerformanceController::class, 'performanceFormIndex1'])->name('performance-type-configs');

    Route::get('/goal-types', [App\Http\Controllers\PerformanceController::class, 'goalTypeIndex'])->name('goal-type')->middleware(goaltype::class, 'goaltype');
    Route::post('/add-goal-type', [App\Http\Controllers\GoalTypeController::class, 'goalTypeAdd'])->name('add-goal-types')->middleware(goaltype::class, 'goaltype');
    Route::post('/goal-type-by-id', [App\Http\Controllers\GoalTypeController::class, 'goalTypeById'])->name('goal-type-by-ids');
    Route::post('/update-goal-type', [App\Http\Controllers\GoalTypeController::class, 'updateGoalType'])->name('update-goal-types')->middleware(goaltype::class, 'goaltype');
    Route::get('/delete-goal-type/{id}', [App\Http\Controllers\GoalTypeController::class, 'deleteGoalType'])->name('delete-goal-types')->middleware(goaltype::class, 'goaltype');

    Route::get('/goal-tracking', [App\Http\Controllers\PerformanceController::class, 'goalTrackingIndex'])->name('goal-trackings')->middleware(goaltracking::class, 'goaltracking');
    Route::post('/add-goal-tracking', [App\Http\Controllers\GoalTrackingController::class, 'goalTrackingAdd'])->name('add-goal-trackings')->middleware(goaltracking::class, 'goaltracking');
    Route::post('/goal-tracking-by-id', [App\Http\Controllers\GoalTrackingController::class, 'goalTrackingById'])->name('goal-tracking-by-ids');
    Route::post('/update-goal-tracking', [App\Http\Controllers\GoalTrackingController::class, 'updateGoalTracking'])->name('update-goal-trackings')->middleware(goaltracking::class, 'goaltracking');
    Route::get('/key-wise-goal-tracking/{slug}', [App\Http\Controllers\PerformanceController::class, 'keyWiseGoalTrackingIndex'])->name('key-wise-goal-trackings')->middleware(goaltracking::class, 'goaltracking');
    Route::get('/delete-goal-tracking/{id}', [App\Http\Controllers\GoalTrackingController::class, 'deleteGoalTracking'])->name('delete-goal-trackings')->middleware(goaltracking::class, 'goaltracking');

    Route::get('/objective', [App\Http\Controllers\PerformanceController::class, 'indicatorIndex'])->name('indicators')->middleware(kpiObjective::class, 'kpiObjective');
    Route::post('/add-objective', [App\Http\Controllers\ObjectiveController::class, 'objectiveAdd'])->name('add-objectives')->middleware(kpiObjective::class, 'kpiObjective');
    Route::post('/objective-by-id', [App\Http\Controllers\ObjectiveController::class, 'objectiveById'])->name('objective-by-ids');
    // Route::post('/update-objective', [App\Http\Controllers\ObjectiveController::class, 'updateObjective'])->name('update-objectives')->middleware(kpiObjective::class, 'kpiObjective');
    Route::get('/delete-objective/{id}', [App\Http\Controllers\ObjectiveController::class, 'deleteObjective'])->name('delete-objectives')->middleware(kpiObjective::class, 'kpiObjective');
    Route::get('/employee-objective', [App\Http\Controllers\EmployeeSetupController::class, 'employeePerformanceObjective'])->name('employee-objectives');
    Route::get('/employee-value', [App\Http\Controllers\valueConfigureController::class, 'employeePerformanceValue'])->name('employee-values');
    Route::get('/employee-result', [App\Http\Controllers\EmployeeSetupController::class, 'employeePerformanceResult'])->name('employee-results');

    Route::get('/supervisor-recommendation', [App\Http\Controllers\RecommendationController::class, 'recommendetionIndex'])->name('supervisor-recommendations');
    Route::post('/add-supervisor-recommendation', [App\Http\Controllers\RecommendationController::class, 'recommendationAdd'])->name('add-recommendations');
    Route::post('/update-supervisor-recommendation', [App\Http\Controllers\RecommendationController::class, 'updateRecommendation'])->name('update-recommendations');
    Route::get('/delete-recommendations/{id}', [App\Http\Controllers\RecommendationController::class, 'deleteRecommendation'])->name('delete-recommendations');

    // Route::post('/add-appraisal', [App\Http\Controllers\AppraisalController::class, 'appraisalAdd'])->name('add-appraisals');
    // Route::post('/appraisal-by-id', [App\Http\Controllers\AppraisalController::class, 'appraisalById'])->name('appraisals-by-ids');
    // Route::post('/update-appraisal', [App\Http\Controllers\AppraisalController::class, 'updateAppraisal'])->name('update-appraisals');
    // Route::get('/delete-appraisal/{id}', [App\Http\Controllers\AppraisalController::class, 'deleteAppraisal'])->name('delete-appraisals');

    Route::get('/objectives', [App\Http\Controllers\PerformanceController::class, 'objectiveTypeIndex'])->name('objectives-types')->middleware(kpiObjectivetypes::class, 'kpiObjectivetypes');
    Route::get('/performance-cofigaration', [App\Http\Controllers\PerformanceConfigarationController::class, 'performanceConfigaration'])->name('performance-configarations')->middleware(kpiObjectivetypes::class, 'kpiObjectivetypes');

    Route::post('/add-objective-types', [App\Http\Controllers\ObjectiveTypeController::class, 'objectiveTypeAdd'])->name('add-objective-types')->middleware(kpiObjectivetypes::class, 'kpiObjectivetypes');
    Route::post('/objective-type-by-id', [App\Http\Controllers\ObjectiveTypeController::class, 'objectiveTypeById'])->name('objective-type-by-ids');
    Route::post('/update-objective-type', [App\Http\Controllers\ObjectiveTypeController::class, 'updateObjectiveType'])->name('update-objective-types')->middleware(kpiObjectivetypes::class, 'kpiObjectivetypes');
    Route::get('/delete-objective-type/{id}', [App\Http\Controllers\ObjectiveTypeController::class, 'deleteObjectiveType'])->name('delete-objective-types')->middleware(kpiObjectivetypes::class, 'kpiObjectivetypes');

    Route::get('/objectives-point-config', [App\Http\Controllers\PerformanceController::class, 'objectivePointIndex'])->name('objectives-point-configs')->middleware(kpiObjectivetypes::class, 'kpiObjectivetypes');
    Route::post('/add-objective-point', [App\Http\Controllers\ObjectivePointConfigController::class, 'objectivePointAdd'])->name('add-objective-points');
    Route::post('/objective-point-by-id', [App\Http\Controllers\ObjectivePointConfigController::class, 'objectivePointConfigById'])->name('objective-point-by-ids');
    Route::post('/update-objective-point', [App\Http\Controllers\ObjectivePointConfigController::class, 'objectivePointUpdate'])->name('update-objective-points');
    Route::get('/delete-objective-point/{id}', [App\Http\Controllers\ObjectivePointConfigController::class, 'deleteObjectivePoint'])->name('delete-objective-points');

    Route::post('/add-rating-scales', [App\Http\Controllers\ObjectiveRatingScaleController::class, 'objectiveScaleAdd'])->name('add-rating-scale');
    Route::get('/delete-objective-points-scale/{id}', [App\Http\Controllers\ObjectiveRatingScaleController::class, 'deleteObjectivePointScale'])->name('delete-objective-points-scales');
    Route::post('/objective-point-scale-by-id', [App\Http\Controllers\ObjectiveRatingScaleController::class, 'objectivePointScaleById'])->name('objective-point-scale-by-ids');
    Route::post('/update-objective-scale-point', [App\Http\Controllers\ObjectiveRatingScaleController::class, 'objectivePointScaleUpdate'])->name('update-objective-scale-points');

    Route::get('/objectives-type-config', [App\Http\Controllers\ObjectiveTypeConfigController::class, 'objectiveTypeConfigIndex'])->name('objectives-type-configs');
    Route::get('/edit-objectives-type-config/{id}', [App\Http\Controllers\ObjectiveTypeConfigController::class, 'objectiveTypeConfigEdit'])->name('edit-objectives-type-configs');
    Route::get('/show-objectives-type-config/{id}', [App\Http\Controllers\ObjectiveTypeConfigController::class, 'objectiveTypeConfigShow'])->name('show-objectives-type-configs');
    Route::post('/update-objective-type-config/{id}', [App\Http\Controllers\ObjectiveTypeConfigController::class, 'updateObjectiveTypeConfig'])->name('update-objective-type-configs');

    Route::post('/add-objective-type-config', [App\Http\Controllers\ObjectiveTypeConfigController::class, 'objectiveTypeConfigAdd'])->name('add-objective-type-configs')->middleware(kpiObjectivetypeconfig::class, 'kpiObjectivetypeconfig');
    Route::post('/objectives-type-config-by-id', [App\Http\Controllers\ObjectiveTypeConfigController::class, 'objectiveTypeConfigById'])->name('objective-type-config-by-ids');
    Route::get('/delete-objective-type-config/{id}', [App\Http\Controllers\ObjectiveTypeConfigController::class, 'deleteObjectiveTypeConfig'])->name('delete-objective-type-configs')->middleware(kpiObjectivetypeconfig::class, 'kpiObjectivetypeconfig');

    Route::get('/yearly-review-config', [App\Http\Controllers\PerformanceController::class, 'yearlyReviewIndex'])->name('yearly-review-configs')->middleware(yearlyreviewconfig::class, 'yearlyreviewconfig');
    Route::post('/add-yearly-review-after-month', [App\Http\Controllers\YearlyReviewController::class, 'yearlyReviewAdd'])->name('add-yearly-review-after-months')->middleware(yearlyreviewconfig::class, 'yearlyreviewconfig');
    Route::post('/yearly-review-config-by-id', [App\Http\Controllers\YearlyReviewController::class, 'yearlyReviewById'])->name('yearly-review-config-by-ids');
    Route::post('/update-yearly-review-config', [App\Http\Controllers\YearlyReviewController::class, 'yearlyReviewUpdate'])->name('update-yearly-review-configs')->middleware(yearlyreviewconfig::class, 'yearlyreviewconfig');
    Route::get('/delete-yearly-review-config/{id}', [App\Http\Controllers\YearlyReviewController::class, 'yearlyReviewDelete'])->name('delete-yearly-review-configs')->middleware(yearlyreviewconfig::class, 'yearlyreviewconfig');

    Route::get('/performance-value-configure', [App\Http\Controllers\PerformanceController::class, 'performanceValueConfigure'])->name('performance-value-configures');
    Route::get('/performance-value-type-configure', [App\Http\Controllers\PerformanceController::class, 'performanceValueTypeConfigure'])->name('performance-value-type-configures');
    Route::get('/performance-value-type-configure-detail/{id}', [App\Http\Controllers\valueConfigureController::class, 'performanceValueTypeConfigureDetail'])->name('performance-value-type-configure-details');
    Route::get('/performance-value-type-view-detail/{id}', [App\Http\Controllers\valueConfigureController::class, 'performanceValueTypeViewDetail'])->name('performance-value-type-view-details');
    Route::get('/employee-performance-value-type-view-detail/{id}', [App\Http\Controllers\valueConfigureController::class, 'employeeperformanceValueTypeViewDetail'])->name('employee-performance-value-type-view-details');

    Route::get('/employee-performance-value-type-configure-detail/{id}', [App\Http\Controllers\valueConfigureController::class, 'employeePerformanceValueTypeConfigureDetail'])->name('employee-performance-value-type-configure-details');
    Route::get('/employee-objective-review/{id}', [App\Http\Controllers\PerformanceReviewController::class, 'employeePerformanceDetailsReview'])->name('employee-objective-reviews');
    Route::get('/objective-type-creates', [App\Http\Controllers\ObjectiveTypeConfigController::class, 'createObjctiveType'])->name('objective-type-creates');

    Route::post('/update-performance-value-type-configure-detail', [App\Http\Controllers\valueConfigureController::class, 'UpdatePerformanceValueTypeConfigureDetail'])->name('update-performance-value-type-configure-details');


    Route::get('/performance-value-type-details/{id}', [App\Http\Controllers\PerformanceController::class, 'performanceValueTypeDetail'])->name('performance-value-type-details');

    Route::post('/value-point-configure', [App\Http\Controllers\valueConfigureController::class, 'valuePointConfig'])->name('value-point-configures');
    Route::post('/update-value-point-configure/{id}', [App\Http\Controllers\valueConfigureController::class, 'valuePointConfigUpdate'])->name('update-value-point-configures');
    Route::get('/delete-value-point-configure/{id}', [App\Http\Controllers\valueConfigureController::class, 'valuePointConfigDelete'])->name('delete-value-point-configures');


    Route::post('/value-type', [App\Http\Controllers\valueConfigureController::class, 'valueType'])->name('value-types');
    Route::post('/update-value-type', [App\Http\Controllers\valueConfigureController::class, 'valueTypeUpdate'])->name('update-value-types');
    Route::get('/delete-value-type/{id}', [App\Http\Controllers\valueConfigureController::class, 'valueTypeDelete'])->name('delete-value-types');
    Route::post('/value-type-by-id', [App\Http\Controllers\valueConfigureController::class, 'valueTypeById'])->name('value-type-by-ids');

    Route::post('/value-type-detail', [App\Http\Controllers\valueConfigureController::class, 'valueTypeDetail'])->name('value-type-details');
    Route::post('/update-value-type-detail', [App\Http\Controllers\valueConfigureController::class, 'UpdateValueTypeDetail'])->name('update-value-type-details');
    Route::post('/value-type-detail-by-id', [App\Http\Controllers\valueConfigureController::class, 'valueTypDetailsById'])->name('value-type-detail-by-ids');

    Route::get('/delete-value-type-detail/{id}', [App\Http\Controllers\valueConfigureController::class, 'UpdateValueTypeDelete'])->name('delete-value-type-details');

    Route::post('/value-type-configure', [App\Http\Controllers\valueConfigureController::class, 'valueTypeConfig'])->name('value-type-configures');
    Route::post('/employee-value-type-configure', [App\Http\Controllers\valueConfigureController::class, 'employeevalueTypeConfig'])->name('employee-value-type-configures');
    Route::post('/update-value-review/{id}', [App\Http\Controllers\valueConfigureController::class, 'updateValueReview'])->name('update-value-reviews');

    Route::get('/promotion-demotion-point-config', [App\Http\Controllers\PerformanceController::class, 'promotionDemotionPointIndex'])->name('promotion-demotion-point-configs')->middleware(PDPointconfig::class, 'PDPointconfig');
    Route::post('/add-promotion-demotion-point-config', [App\Http\Controllers\PromotionDemotionPointController::class, 'promotionDemotionPointAdd'])->name('add-promotion-demotion-point-configs')->middleware(PDPointconfig::class, 'PDPointconfig');
    Route::post('/promotion-demotion-point-config-by-id', [App\Http\Controllers\PromotionDemotionPointController::class, 'promotionDemotionPointById'])->name('promotion-demotion-point-config-by-ids');
    Route::post('/update-promotion-demotion-point-config', [App\Http\Controllers\PromotionDemotionPointController::class, 'promotionDemotionPointUpdate'])->name('update-promotion-demotion-point-configs')->middleware(PDPointconfig::class, 'PDPointconfig');
    Route::get('/delete-promotion-demotion-point-config/{id}', [App\Http\Controllers\PromotionDemotionPointController::class, 'promotionDemotionPointDelete'])->name('delete-promotion-demotion-point-configs')->middleware(PDPointconfig::class, 'PDPointconfig');

    Route::get('/employee-performance-result', [App\Http\Controllers\PerformanceController::class, 'employeePerformanceResult'])->name('employee-performance-results');
    Route::post('/employee-performance-result-search', [App\Http\Controllers\PerformanceController::class, 'employeePerformanceResultsearch'])->name('employee-performance-result-searches');

    Route::get('/seats-allocation', [App\Http\Controllers\PerformanceController::class, 'seatsAllocationIndex'])->name('seats-allocations')->middleware(SeatsAllocation::class, 'SeatsAllocation');
    Route::post('/add-seats-allocation', [App\Http\Controllers\SeatAllocationController::class, 'seatsAllocationAdd'])->name('add-seats-allocations')->middleware(SeatsAllocation::class, 'SeatsAllocation');
    Route::post('/seats-allocation-by-id', [App\Http\Controllers\SeatAllocationController::class, 'seatsAllocationById'])->name('seats-allocation-by-ids');
    Route::post('/update-seats-allocation', [App\Http\Controllers\SeatAllocationController::class, 'seatsAllocationUpdate'])->name('update-seats-allocations')->middleware(SeatsAllocation::class, 'SeatsAllocation');
    Route::get('/delete-seats-allocation/{id}', [App\Http\Controllers\SeatAllocationController::class, 'seatsAllocationDelete'])->name('delete-seats-allocations')->middleware(SeatsAllocation::class, 'SeatsAllocation');

    Route::get('/performance-form', [App\Http\Controllers\PerformanceController::class, 'performanceFormIndex'])->name('performance-forms')->middleware(performanceform::class, 'performanceform');
    Route::get('/supervisor-marking', [App\Http\Controllers\PerformanceController::class, 'supervisorMarkingIndex'])->name('supervisor-markings');
    Route::post('/supervisor-mark-giving-page', [App\Http\Controllers\PerformanceController::class, 'supervisorMarkGivingIndex'])->name('supervisor-mark-giving-pages');
    Route::post('/update-employee-action-objective', [App\Http\Controllers\ObjectiveController::class, 'performanceFormIndex'])->name('update-employee-action-objectives');
    Route::post('/update-employee-action-objective', [App\Http\Controllers\ObjectiveController::class, 'updateEmployeeActionObjective'])->name('update-employee-action-objectives');
    Route::post('/update-supervisor-comment-objective', [App\Http\Controllers\ObjectiveController::class, 'updateSupervisorCommentObjective'])->name('update-supervisor-comment-objectives');
    Route::post('/update-supervisor-marking-objective', [App\Http\Controllers\ObjectiveController::class, 'updateSupervisorMarkingObjective'])->name('update-supervisor-marking-objectives');
    Route::post('/add-development-plan', [App\Http\Controllers\PerformanceController::class, 'addDevelopmentForm'])->name('add-development-plans');
    Route::post('/update-development-plan/{id}', [App\Http\Controllers\PerformanceController::class, 'updateDevelopmentForm'])->name('update-development-plans');
    Route::post('/supervisor-review-development/{id}', [App\Http\Controllers\PerformanceController::class, 'supervisorReviewDevelopment'])->name('supervisor-review-developments');
    Route::get('/performance-marking/{id}', [App\Http\Controllers\PerformanceReviewController::class, 'employeePerformanceMarking'])->name('performances-marking');
    Route::get('/employee-objective-review-view/{id}', [App\Http\Controllers\PerformanceReviewController::class, 'performanceReviewView'])->name('employee-objective-review-views');
    Route::get('/objective-review-view/{id}', [App\Http\Controllers\PerformanceReviewController::class, 'employeePerformanceReviewView'])->name('objective-review-views');
    Route::get('/employees-performance-review', [App\Http\Controllers\PerformanceReviewController::class, 'employeePerformanceReviewMarking'])->name('employee-performance-review');

    Route::post('/add-objective-plan', [App\Http\Controllers\PerformanceController::class, 'addObjectiveForm'])->name('add-objective-plans');
    Route::post('/add-performance-review', [App\Http\Controllers\PerformanceReviewController::class, 'addObjectiveReviewForm'])->name('add-performance-reviews');
    Route::get('/details-objective-plan/{id}', [App\Http\Controllers\PerformanceController::class, 'detailsObjective'])->name('details-objective-plans');
    Route::get('/objective-details-plans-view/{id}', [App\Http\Controllers\PerformanceController::class, 'detailsEmployeeObjectiveViews'])->name('objective-details-plans-views');
    Route::get('/details-objective-plans-view/{id}', [App\Http\Controllers\PerformanceController::class, 'employeeDetailsObjectiveViews'])->name('details-objective-plans-views');

    Route::get('/employee-details-objective-plan/{id}', [App\Http\Controllers\PerformanceController::class, 'employeeDetailsObjective'])->name('employee-details-objective-plans');
    Route::post('/employee-objective-comment/{id}', [App\Http\Controllers\PerformanceReviewController::class, 'employeeObjectiveReviewComments'])->name('employee-objective-comments');

    Route::get('/details-objective-plan-pdf/{id}', [App\Http\Controllers\PerformanceController::class, 'DetailsObjectivePdf'])->name('details-objective-plans-pdf');
    Route::get('/details-development-plan/{id}', [App\Http\Controllers\PerformanceController::class, 'detailsDevelopment'])->name('details-development-plans');
    Route::get('/employee-development-details-plans-view/{id}', [App\Http\Controllers\PerformanceController::class, 'employeeDetailsDevelopmentPlansView'])->name('employee-development-details-plans-views');
    Route::get('/details-development-plans-view/{id}', [App\Http\Controllers\PerformanceController::class, 'detailsDevelopmentPlansView'])->name('details-development-plans-views');
    Route::get('/employee-details-development-plan/{id}', [App\Http\Controllers\PerformanceController::class, 'employeeDetailsDevelopment'])->name('employee-details-development-plans');
    Route::get('/details-development-plan-pdf/{id}', [App\Http\Controllers\PerformanceController::class, 'DetailsDevelopmentPdf'])->name('details-development-plans-pdf');
    Route::post('/update-objective/{id}', [App\Http\Controllers\PerformanceController::class, 'updateObjective'])->name('update-objectives');
    Route::post('/update-performance-review/{id}', [App\Http\Controllers\PerformanceReviewController::class, 'updatePerformanceReview'])->name('update-performance-reviews');

    Route::post('/supervisor-review-objective/{id}', [App\Http\Controllers\PerformanceController::class, 'supervisorReviewObjective'])->name('supervisor-review-objectives');

    Route::get('/performance-report', [App\Http\Controllers\PerformanceReportController::class, 'index'])->name('performance-report');
    Route::get('/download-performance-report', [App\Http\Controllers\PerformanceReportController::class, 'DownloadPerformanceReport'])->name('download-performance-report');
    Route::get('/single-employee-performance-report-preview/{id}', [App\Http\Controllers\PerformanceReportController::class, 'singleEmployeePerformanceReportPreview'])->name('single-employee-performance-report-preview');
    Route::get('/single-employee-performance-report-download/{id}', [App\Http\Controllers\PerformanceReportController::class, 'singleEmployeePerformanceReportDwonload'])->name('single-employee-performance-report-download');

    Route::get('/performance-value', [App\Http\Controllers\PerformanceReportController::class, 'performanceValue'])->name('performance-value');
    Route::get('/download-performance-value', [App\Http\Controllers\PerformanceReportController::class, 'DownloadPerformanceValue'])->name('download-performance-value');
    Route::get('/single-performance-value-report/{id}', [App\Http\Controllers\PerformanceReportController::class, 'SinglePerformanceValueReport'])->name('single-performance-value-report');
    Route::get('/single-performance-value-preview/{id}', [App\Http\Controllers\PerformanceReportController::class, 'SinglePerformanceValuePreview'])->name('single-performance-value-preview');

    Route::get('/performance-point', [App\Http\Controllers\PerformanceReportController::class, 'performancePoint'])->name('performance-point');
    Route::get('/download-performance-point', [App\Http\Controllers\PerformanceReportController::class, 'downloadPerformancePoint'])->name('download-performance-point');
    Route::get('/single-performance-point-preview/{id}', [App\Http\Controllers\PerformanceReportController::class, 'SinglePerformancePointPreview'])->name('single-performance-point-preview');
    Route::get('/single-performance-point-report/{id}', [App\Http\Controllers\PerformanceReportController::class, 'SinglePerformancePointReport'])->name('single-performance-point-report');

    Route::get('/incomlete-performance', [App\Http\Controllers\PerformanceReportController::class, 'incompletePerformanceForm'])->name('incomlete-performance');
    Route::get('/incomlete-performance-list', [App\Http\Controllers\PerformanceReportController::class, 'incompletePerformanceList'])->name('incomlete-performance-list');

    Route::get('/get-department-infos/{id}', [App\Http\Controllers\PerformanceReportController::class, 'getDepartmentInfo'])->name('get-department-infos');
    Route::get('/get-designation-infos/{id}', [App\Http\Controllers\PerformanceReportController::class, 'getDesignationInfo'])->name('get-designation-infos');
    Route::get('/get-employees-infos/{id}', [App\Http\Controllers\PerformanceReportController::class, 'getEmployeeInfo'])->name('get-employees-infos');
    Route::get('/get-start-date-infos/{id}', [App\Http\Controllers\PerformanceReportController::class, 'getStartDateInfo'])->name('get-start-date-infos');
    Route::get('/get-end-date-infos/{id}', [App\Http\Controllers\PerformanceReportController::class, 'getEndDateInfo'])->name('get-end-date-infos');
    Route::get('/get-designation-wise-employee/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getDesignationWiseEmployee'])->name('get-designation-wise-employees');


    Route::get('/eligible-pd-employee', [App\Http\Controllers\PerformanceController::class, 'eligiblePdEmployeeIndex'])->name('eligible-pd-employees')->middleware(EligiblePDEmployees::class, 'EligiblePDEmployees');
    Route::get('/increment-config', [App\Http\Controllers\IncrementConfigController::class, 'annualIncrementConfig'])->name('increment-configs');
    Route::post('/add-increment-config', [App\Http\Controllers\IncrementConfigController::class, 'addAnnualIncrementConfig'])->name('add-increment-configs');
    Route::post('/update-increment-config', [App\Http\Controllers\IncrementConfigController::class, 'updateAnnualIncrementConfig'])->name('update-increment-configs');
    Route::post('/increment-point-config-by-id', [App\Http\Controllers\IncrementConfigController::class, 'incrementPointById'])->name('increment-point-config-by-ids');

    Route::get('/delete-increment-config/{id}', [App\Http\Controllers\IncrementConfigController::class, 'deleteAnnualIncrementConfig'])->name('delete-increment-configs');

    Route::get('/annual-increment', [App\Http\Controllers\PerformanceController::class, 'annualIncrementIndex'])->name('annual-increments')->middleware(AnnualIncrement::class, 'AnnualIncrement');
    Route::get('/add-annual-increment', [App\Http\Controllers\SalaryHistoryController::class, 'salaryIncremnt'])->name('add-annual-increments');
    Route::post('/add-customize-annual-increment', [App\Http\Controllers\SalaryHistoryController::class, 'customizeSalaryIncremnt'])->name('add-customize-increments');

    Route::get('/approval-increment', [App\Http\Controllers\PerformanceController::class, 'annualApproveIncrementIndex'])->name('approval-increments');
    Route::get('/add-annual-approve-increment', [App\Http\Controllers\SalaryHistoryController::class, 'salaryIncremntApprove'])->name('add-annual-approve-increments');
    Route::post('/add-customize-approval-increment', [App\Http\Controllers\SalaryHistoryController::class, 'salaryIncremntcustomizeApprove'])->name('add-customize-approval-increments');

    Route::get('/salary-history', [App\Http\Controllers\SalaryHistoryController::class, 'salaryHistory'])->name('salary-histories');
    Route::get('/employee-salary-history', [App\Http\Controllers\EmployeeSetupController::class, 'employeeSalaryHistory'])->name('employee-salary-histories');

    Route::post('/bulk-increment-approval', [App\Http\Controllers\SalaryHistoryController::class, 'bulkIncrementApprove'])->name('bulk-increment-approvals');
    Route::post('/giving-annual-salary-increment', [App\Http\Controllers\ObjectiveController::class, 'givingAnnualSalaryIncrement'])->name('giving-annual-salary-increments')->middleware(AnnualIncrement::class, 'AnnualIncrement');
    Route::post('/first-supervisor-promotion-approval', [App\Http\Controllers\ObjectiveController::class, 'firstSupervisorPromotionApproval'])->name('first-supervisor-promotion-approvals');
    Route::post('/second-supervisor-promotion-approval', [App\Http\Controllers\ObjectiveController::class, 'secondSupervisorPromotionApproval'])->name('second-supervisor-promotion-approvals');
    Route::post('/first-supervisor-annual-salary-increment-approval', [App\Http\Controllers\ObjectiveController::class, 'firstSupervisorAnnualSalaryIncrementApproval'])->name('first-supervisor-annual-salary-increment-approvals');
    Route::post('/second-supervisor-annual-salary-increment-approval', [App\Http\Controllers\ObjectiveController::class, 'secondSupervisorAnnualSalaryIncrementApproval'])->name('second-supervisor-annual-salary-increment-approvals');
    Route::post('/promotion-approval', [App\Http\Controllers\ObjectiveController::class, 'promotionApproval'])->name('promotion-approvals');
    //Route::post('/eligible-pd-employee', [App\Http\Controllers\ObjectiveController::class, 'updateSupervisorMarkingObjective'])->name('eligible-pd-employees');
    //Performance Module routes end here

    //HR Calendar Module routes start from here
    //Route::get('/hr-calendar', [App\Http\Controllers\HrCalendarController::class, 'index'])->name('hr-calendars');
    Route::get('fullcalender', [App\Http\Controllers\CompanyCalendarController::class, 'index'])->name('hr-calendars')->middleware(hrCalendar::class, 'hrCalendar');
    Route::get('full-employee-calendar', [App\Http\Controllers\CompanyCalendarController::class, 'employeeCalendarIndex'])->name('hr-employee-calendars');
    Route::post('/fullcalender-by-id', [App\Http\Controllers\CompanyCalendarController::class, 'companyCalenderById'])->name('fullcalender-by-ids');
    Route::post('fullcalenderAjax', [App\Http\Controllers\CompanyCalendarController::class, 'ajax']);
    //HR Calendar Module routes end here

    //HR Reports Module routes start from here
    Route::get('/attendance-report', [App\Http\Controllers\HrReportController::class, 'attendanceReportIndex'])->name('attandance-reports')->middleware(attendanceReport::class, 'attendanceReport');
    Route::post('/attendance-report', [App\Http\Controllers\HrReportController::class, 'dateWiseEmployeeAttendanceReport'])->name('date-wise-attendance-reports')->middleware(attendanceReport::class, 'attendanceReport');
    Route::get('/training-report', [App\Http\Controllers\HrReportController::class, 'index'])->name('training-reports')->middleware(CheckStatus::class, 'auth');
    Route::get('/project-report', [App\Http\Controllers\HrReportController::class, 'projectReportIndex'])->name('project-reports')->middleware(ProjectReport::class, 'ProjectReport');
    Route::get('/task-report', [App\Http\Controllers\HrReportController::class, 'taskReportIndex'])->name('task-reports')->middleware(TaskReport::class, 'TaskReport');

    Route::get('/employee-report', [App\Http\Controllers\HrReportController::class, 'employeeReportIndex'])->name('employee-reports')->middleware(EmployeeReport::class, 'EmployeeReport');
    Route::post('/employee-report', [App\Http\Controllers\HrReportController::class, 'employeeReportFiltering'])->name('employee-report-filterings')->middleware(EmployeeReport::class, 'EmployeeReport');
    Route::post('/employee-report-download/{id}', [App\Http\Controllers\HrReportController::class, 'employeeReportDownload'])->name('employee-report-downloads')->middleware(CheckStatus::class, 'auth');

    Route::get('/account-report', [App\Http\Controllers\HrReportController::class, 'index'])->name('account-reports')->middleware(CheckStatus::class, 'auth');
    Route::get('/expense-report', [App\Http\Controllers\HrReportController::class, 'index'])->name('expense-reports')->middleware(CheckStatus::class, 'auth');
    Route::get('/deposite-report', [App\Http\Controllers\HrReportController::class, 'index'])->name('deposite-reports')->middleware(CheckStatus::class, 'auth');
    Route::get('/transaction-report', [App\Http\Controllers\HrReportController::class, 'index'])->name('transaction-reports')->middleware(CheckStatus::class, 'auth');
    Route::get('/pf-report', [App\Http\Controllers\HrReportController::class, 'pfReportIndex'])->name('pf-reports')->middleware(pfreport::class, 'pfreport');

    Route::get('/psr-master-report', [App\Http\Controllers\HrReportController::class, 'psrMasterReport'])->name('psr-master-reports');
    Route::get('/psr-master-report-download', [App\Http\Controllers\HrReportController::class, 'psrMasterExcelReportDownload'])->name('psr-master-report-downloads')->middleware(CheckStatus::class, 'auth');
    Route::get('/separation-report', [App\Http\Controllers\HrReportController::class, 'separationReport'])->name('separation-reports');
    Route::get('/separation-report-downlaod', [App\Http\Controllers\HrReportController::class, 'separationReportDownlaod'])->name('separation-report-downlaods');
    Route::get('/active-psr-report', [App\Http\Controllers\HrReportController::class, 'activePsr'])->name('active-psr-reports');
    Route::get('/active-psr-report-download', [App\Http\Controllers\HrReportController::class, 'activePsrExcelReportDownload'])->name('active-psr-report-downloads')->middleware(CheckStatus::class, 'auth');
    Route::get('/psr-recruitment-summary', [App\Http\Controllers\HrReportController::class, 'PsrRecruitmentSummary'])->name('psr-recruitment-summary')->middleware(CheckStatus::class, 'auth');
    Route::get('/psr-recruitment-summary-report-downloads', [App\Http\Controllers\HrReportController::class, 'PsrRecruitmentSummaryReportDownload'])->name('psr-recruitment-summary-report-downloads')->middleware(CheckStatus::class, 'auth');
    Route::get('/orientation-selected-report', [App\Http\Controllers\HrReportController::class, 'orientationSelected'])->name('orientation-selected-reports');
    Route::post('/orientation-selected-report-download', [App\Http\Controllers\HrReportController::class, 'orientationSelectedDownload'])->name('orientation-selected-download-reports');

    //Route::get('/pension-report', [App\Http\Controllers\HrReportController::class, 'index'])->name('pension-reports');
    //HR Reports Module routes end here

    // //Recruitment Module routes start from here
    // Route::get('/job-post', [App\Http\Controllers\RecruitmentController::class, 'index'])->name('job-posts');
    // Route::get('/job-candidates', [App\Http\Controllers\RecruitmentController::class, 'index'])->name('job-candidate');
    // Route::get('/job-interview', [App\Http\Controllers\RecruitmentController::class, 'index'])->name('job-interviews');
    // Route::get('/job-portal', [App\Http\Controllers\RecruitmentController::class, 'index'])->name('job-portals');
    // //Recruitment Module routes end here

    // //Training Module routes start from here
    // Route::get('/training-list', [App\Http\Controllers\TrainingController::class, 'index'])->name('training-lists');
    // Route::get('/training-type', [App\Http\Controllers\TrainingController::class, 'index'])->name('training-types');
    // Route::get('/trainers', [App\Http\Controllers\TrainingController::class, 'index'])->name('trainer');
    // //Training Module routes end here



    //Training Module routes start from here
    Route::get('/training-type', [App\Http\Controllers\TrainingController::class, 'trainingTypeIndex'])->name('training-types')->middleware(trainingtype::class, 'trainingtype');
    Route::post('/add-training-type', [App\Http\Controllers\TrainingTypeController::class, 'trainingTypeAdd'])->name('add-training-types')->middleware(trainingtype::class, 'trainingtype');
    Route::post('/training-type-by-id', [App\Http\Controllers\TrainingTypeController::class, 'trainingTypeById'])->name('training-type-by-ids');
    Route::post('/update-training-type', [App\Http\Controllers\TrainingTypeController::class, 'trainingTypeUpdate'])->name('update-training-types')->middleware(trainingtype::class, 'trainingtype');
    Route::get('/delete-training-type/{id}',  [App\Http\Controllers\TrainingTypeController::class, 'trainingTypeDelete'])->name('delete-training-types')->middleware(trainingtype::class, 'trainingtype');

    Route::get('/trainers', [App\Http\Controllers\TrainingController::class, 'trainerIndex'])->name('trainer')->middleware(trainers::class, 'trainers');
    Route::post('/add-trainer', [App\Http\Controllers\TrainerController::class, 'trainerAdd'])->name('add-trainers')->middleware(trainers::class, 'trainers');
    Route::post('/trainer-by-id', [App\Http\Controllers\TrainerController::class, 'trainerById'])->name('trainer-by-ids');
    Route::post('/update-trainer', [App\Http\Controllers\TrainerController::class, 'trainerUpdate'])->name('update-trainers')->middleware(trainers::class, 'trainers');
    Route::get('/delete-trainer/{id}',  [App\Http\Controllers\TrainerController::class, 'trainerDelete'])->name('delete-trainers')->middleware(trainers::class, 'trainers');

    Route::get('/training-list', [App\Http\Controllers\TrainingController::class, 'trainingListIndex'])->name('training-lists')->middleware(traininglist::class, 'traininglist');
    Route::post('/add-training-list', [App\Http\Controllers\TrainingController::class, 'trainingAdd'])->name('add-training-lists')->middleware(traininglist::class, 'traininglist');
    Route::post('/training-list-by-id', [App\Http\Controllers\TrainingController::class, 'trainingById'])->name('training-list-by-ids');
    Route::post('/update-training-list', [App\Http\Controllers\TrainingController::class, 'trainingUpdate'])->name('update-training-lists')->middleware(traininglist::class, 'traininglist');
    Route::get('/delete-training-list/{id}',  [App\Http\Controllers\TrainingController::class, 'trainingDelete'])->name('delete-training-lists')->middleware(traininglist::class, 'traininglist');
    //Training Module routes end here

    //Events and Meetings Module routes start from here
    Route::get('/events', [App\Http\Controllers\EventAndMeetingController::class, 'ebventIndex'])->name('event')->middleware(events::class, 'events');
    Route::post('/add-event',  [App\Http\Controllers\EventController::class, 'eventAdd'])->name('add-events')->middleware(events::class, 'events');
    Route::post('/event-by-id',  [App\Http\Controllers\EventController::class, 'eventById'])->name('event-by-ids');
    Route::post('/update-event',  [App\Http\Controllers\EventController::class, 'eventUpdate'])->name('update-events')->middleware(events::class, 'events');
    Route::get('/delete-event/{id}',  [App\Http\Controllers\EventController::class, 'deleteEvent'])->name('delete-events')->middleware(events::class, 'events');

    Route::get('/meetings', [App\Http\Controllers\EventAndMeetingController::class, 'meetingIndex'])->name('meeting')->middleware(meetings::class, 'meetings');
    Route::post('/add-meeting',  [App\Http\Controllers\MeetingController::class, 'meetingAdd'])->name('add-meetings')->middleware(meetings::class, 'meetings');
    Route::post('/meeting-by-id',  [App\Http\Controllers\MeetingController::class, 'meetingById'])->name('meeting-by-ids');
    Route::post('/update-meeting',  [App\Http\Controllers\MeetingController::class, 'meetingUpdate'])->name('update-meetings')->middleware(meetings::class, 'meetings');
    Route::get('/delete-meeting/{id}',  [App\Http\Controllers\MeetingController::class, 'deleteMeeting'])->name('delete-meetings')->middleware(meetings::class, 'meetings');
    //Events and Meetings Module routes end here

    //Project Management Module routes start from here
    Route::get('/projects', [App\Http\Controllers\ProjectManagementController::class, 'projectIndex'])->name('project')->middleware(Project::class, 'Project');
    Route::post('/add-projects', [App\Http\Controllers\ProjectController::class, 'projectStore'])->name('add-projects')->middleware(Project::class, 'Project');
    Route::post('/project-by-id', [App\Http\Controllers\ProjectController::class, 'projectById'])->name('project-by-ids');
    Route::post('/update-project', [App\Http\Controllers\ProjectController::class, 'updateProject'])->name('update-projects')->middleware(Project::class, 'Project');
    Route::get('/project/delete/{id}', [App\Http\Controllers\ProjectController::class, 'deleteProject'])->name('delete-projects')->middleware(Project::class, 'Project');

    Route::get('/tasks', [App\Http\Controllers\ProjectManagementController::class, 'taskIndex'])->name('task')->middleware(Task::class, 'Task');
    Route::post('/add-task', [App\Http\Controllers\TaskController::class, 'taskStore'])->name('add-tasks')->middleware(Task::class, 'Task');
    Route::post('/task-by-id', [App\Http\Controllers\TaskController::class, 'taskById'])->name('task-by-ids');
    Route::post('/update-task', [App\Http\Controllers\TaskController::class, 'updateTask'])->name('update-tasks')->middleware(Task::class, 'Task');
    Route::get('/task/delete/{id}', [App\Http\Controllers\TaskController::class, 'deleteTask'])->name('delete-tasks')->middleware(Task::class, 'Task');

    Route::get('/clients', [App\Http\Controllers\ProjectManagementController::class, 'clientIndex'])->name('client');
    Route::get('/invoice', [App\Http\Controllers\ProjectManagementController::class, 'invoiceIndex'])->name('invoices');
    Route::get('/tax-type', [App\Http\Controllers\ProjectManagementController::class, 'taxTypeIndex'])->name('tax-types');
    //Project Management Module routes end here

    //Support Tickets Module routes start from here
    Route::get('/support-tickets', [App\Http\Controllers\SupportTicketController::class, 'supportTicketIndex'])->name('support-ticket')->middleware(SupportTicket::class, 'SupportTicket');
    Route::post('/add-support-ticket',  [App\Http\Controllers\SupportTicketController::class, 'supportTicketAdd'])->name('add-support-tickets')->middleware(SupportTicket::class, 'SupportTicket');
    Route::post('/support-ticket-by-id',  [App\Http\Controllers\SupportTicketController::class, 'supportTicketById'])->name('support-ticket-by-ids');
    Route::post('/update-support-ticket',  [App\Http\Controllers\SupportTicketController::class, 'supportTicketUpdate'])->name('update-support-tickets')->middleware(SupportTicket::class, 'SupportTicket');
    Route::get('/delete-support-ticket/{id}',  [App\Http\Controllers\SupportTicketController::class, 'deleteSupportTicket'])->name('delete-support-tickets')->middleware(SupportTicket::class, 'SupportTicket');
    //Support Tickets  Module routes end here

    //Assets Module routes start from here
    Route::get('/asset-categories', [App\Http\Controllers\AssetController::class, 'assetCategoryIndex'])->name('asset-category')->middleware(AssestCategories::class, 'AssestCategories');
    Route::post('/add-asset-category',  [App\Http\Controllers\AssetCategoryController::class, 'assetCategoryAdd'])->name('add-asset-categories')->middleware(AssestCategories::class, 'AssestCategories');
    Route::post('/asset-category-by-id',  [App\Http\Controllers\AssetCategoryController::class, 'assetCategoryById'])->name('asset-category-by-ids');
    Route::post('/update-asset-category',  [App\Http\Controllers\AssetCategoryController::class, 'assetCategoryUpdate'])->name('update-asset-categories')->middleware(AssestCategories::class, 'AssestCategories');
    Route::get('/delete-asset-category/{id}',  [App\Http\Controllers\AssetCategoryController::class, 'deleteAssetCategory'])->name('delete-asset-categories')->middleware(AssestCategories::class, 'AssestCategories');


    Route::get('/assets', [App\Http\Controllers\AssetController::class, 'assetIndex'])->name('asset')->middleware(Assest::class, 'Assest');
    Route::post('/add-asset',  [App\Http\Controllers\AssetController::class, 'assetAdd'])->name('add-assets')->middleware(Assest::class, 'Assest');
    Route::post('/asset-by-id',  [App\Http\Controllers\AssetController::class, 'assetById'])->name('asset-by-ids');
    Route::post('/update-asset',  [App\Http\Controllers\AssetController::class, 'assetUpdate'])->name('update-assets')->middleware(Assest::class, 'Assest');
    Route::get('/delete-asset/{id}',  [App\Http\Controllers\AssetController::class, 'deleteAsset'])->name('delete-assets')->middleware(Assest::class, 'Assest');
    //Assets Module routes end here


    //File Manager Module routes start from here
    Route::get('/file-manager', [App\Http\Controllers\FileManagerController::class, 'FileManagerIndex'])->name('file-managers')->middleware(FileManager::class, 'FileManager');
    Route::post('/add-file-manager',  [App\Http\Controllers\FileManagerController::class, 'fileManagerAdd'])->name('add-file-managers')->middleware(FileManager::class, 'FileManager');
    Route::post('/file-manager-by-id',  [App\Http\Controllers\FileManagerController::class, 'fileManagerById'])->name('file-manager-by-ids');
    Route::post('/update-file-manager',  [App\Http\Controllers\FileManagerController::class, 'fileManagerUpdate'])->name('update-file-managers')->middleware(FileManager::class, 'FileManager');
    Route::get('/delete-file-manager/{id}',  [App\Http\Controllers\FileManagerController::class, 'deleteFileManager'])->name('delete-file-managers')->middleware(FileManager::class, 'FileManager');

    Route::get('/official-documents', [App\Http\Controllers\FileManagerController::class, 'officialDocumentIndex'])->name('official-document')->middleware(OfficialDocuments::class, 'OfficialDocuments');
    Route::post('/add-official-document',  [App\Http\Controllers\DocumentController::class, 'documentEmployeeAdd'])->name('add-official-documents')->middleware(OfficialDocuments::class, 'OfficialDocuments');

    Route::get('/file-configuration', [App\Http\Controllers\FileManagerController::class, 'fileConfigureIndex'])->name('file-configurations')->middleware(FileConfigure::class, 'FileConfigure');
    Route::post('/add-file-config',  [App\Http\Controllers\FileConfigController::class, 'fileConfigAdd'])->name('add-file-configs')->middleware(FileConfigure::class, 'FileConfigure');
    Route::get('/delete-file-config/{id}',  [App\Http\Controllers\FileConfigController::class, 'deleteFileConfig'])->name('delete-file-configs')->middleware(FileConfigure::class, 'FileConfigure');
    //File Manager  Module routes end here

    //Zoom Module routes start from here
    Route::get('/zoom-meeting', [App\Http\Controllers\ZoomController::class, 'index'])->name('zoom-meetings');
    //Zoom Module routes end here

    //Activity Log Module routes start from here
    //Route::get('/activity-log', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity-logs');
    Route::get('/activity-log', [App\Http\Controllers\ActivityLogController::class, 'index'])->name('activity-logs');
    //Activity Log Module routes end here

    //Chat Module routes start from here
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chats');
    //Chat Module routes end here

    //Prayer and lunch Module routes start from here
    Route::get('/prayer-and-lunch-time', [App\Http\Controllers\PrayerAndLunchController::class, 'index'])->name('prayer-and-lunch');
    //Prayer and lunch Module routes end here

    //Dependent Dropdown routes start from here
    Route::get('/get-department/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getDepartment'])->name('get-departments');
    Route::get('/get-designation/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getDesignation'])->name('get-designations');
    Route::get('/get-obj-designation/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getObjDesignation'])->name('get-obj-designation');
    Route::get('/designation/{id}', [App\Http\Controllers\DependentDropdownController::class, 'Designation'])->name('designation');
    Route::get('/get-designation-with-vacancy/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getDesignationWithVacancy'])->name('get-designation-with-vacancy');
    Route::get('/get-grade/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getGrade'])->name('get-grade');
    Route::get('/get-grade-for-employee-insert/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getGradeForEmployeeInsert'])->name('get-grade-for-employee-insert');
    Route::get('/get-grade-emplyee/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getGradeEmployee'])->name('get-grade-emplyees');

    Route::get('/get-number-of-employee/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getNumberOfEmployee'])->name('get-number-of-employee');


    Route::get('/get-office-shift/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getOfficeShift'])->name('get-office-shifts');
    Route::get('/get-area/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getArea'])->name('get-areas');
    Route::get('/get-territory/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getTerritory'])->name('get-territories');
    Route::get('/get-town/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getTown'])->name('get-towns');
    Route::get('/get-db-house/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getDbHouse'])->name('get-db-houses');
    Route::get('/get-location-six/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getLocationsix'])->name('get-location-six');
    Route::get('/get-location-seven/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getLocationseven'])->name('get-location-seven');
    Route::get('/get-location-eight/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getLocationeight'])->name('get-location-eight');
    Route::get('/get-location-nine/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getLocationnine'])->name('get-location-nine');
    Route::get('/get-location-ten/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getLocationten'])->name('get-location-ten');
    Route::get('/get-location-eleven/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getLocationeleven'])->name('get-location-eleven');
    Route::get('/get-employee/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getEmployee'])->name('get-db-houses');
    Route::get('/get-department-wise-employee/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getDepartmentWiseEmployee'])->name('get-department-wise-employees');
    Route::get('/get-department-wise-employee-increment/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getDepartmentWiseEmployeeIncrement'])->name('get-department-wise-employee-increment');
    Route::get('/get-employee-gross-salary/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getEmployeeGrossSalary'])->name('get-employee-gross-salaries');
    Route::get('/get-objective-type/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getObjectiveType'])->name('get-objective-types');
    Route::get('/objective-type', [App\Http\Controllers\DependentDropdownController::class, 'objectiveType'])->name('objective-types');
    Route::get('/get-value-type', [App\Http\Controllers\DependentDropdownController::class, 'getValueType'])->name('get-value-types');

    //Route::get('/get-by-employee-id/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('/get-by-employee-ids');
    //Route::get('/get-report-to-employee/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getReportToEmployee'])->name('get-report-to-employees');
    //Dependent Dropdown routes end here
    Route::get('/get-district/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getDistrict'])->name('get-districts');
    Route::get('/get-upazila/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getUpazila'])->name('get-upazilas');
    Route::get('/get-union/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getUnion'])->name('get-unions');
    Route::get('/get-employee-for-resignation/{id}', [App\Http\Controllers\DependentDropdownController::class, 'getForResignationEmployee'])->name('get-employee-for-resignation');
    //bulkdelete routes start from here
    Route::post('/bulk-delete-employee', [App\Http\Controllers\EmployeeController::class, 'employeeBulkDelete'])->name('bulk-delete-employees')->middleware(CheckStatus::class, 'auth');
    Route::post('/bulk-restore-employee', [App\Http\Controllers\EmployeeController::class, 'employeeBulkRestore'])->name('bulk-restore-employees')->middleware(CheckStatus::class, 'auth');

    Route::post('/bulk-delete-tax-config', [App\Http\Controllers\TaxConfigController::class, 'bulkDeleteTaxConfig'])->name('bulk-delete-tax-configs');
    Route::post('/bulk-delete-salary-config', [App\Http\Controllers\SalaryConfigController::class, 'bulkDeleteSalaryConfig'])->name('bulk-delete-salary-configs');
    Route::post('/bulk-delete-festival', [App\Http\Controllers\FestivalBonusController::class, 'bulkDeleteFestival'])->name('bulk-delete-festivals');

    Route::post('/bulk-delete-promotion', [App\Http\Controllers\PromotionController::class, 'bulkDeletePromotion'])->name('bulk-delete-promotions');
    Route::post('/bulk-delete-award', [App\Http\Controllers\AwardController::class, 'bulkDeleteAward'])->name('bulk-delete-awards');
    Route::post('/bulk-delete-travel', [App\Http\Controllers\TravelController::class, 'bulkDeleteTravel'])->name('bulk-delete-travels');
    Route::post('/bulk-delete-transfer', [App\Http\Controllers\TransferController::class, 'bulkDeleteTransfer'])->name('bulk-delete-transfers');
    Route::post('/bulk-delete-resignation', [App\Http\Controllers\ResignationController::class, 'bulkDeleteResignation'])->name('bulk-delete-resignations');
    Route::post('/bulk-delete-complaint', [App\Http\Controllers\ComplaintController::class, 'bulkDeleteComplaint'])->name('bulk-delete-complaints');
    Route::post('/bulk-delete-warning', [App\Http\Controllers\WarningController::class, 'bulkDeleteWarning'])->name('bulk-delete-warnings');
    Route::post('/bulk-delete-termination', [App\Http\Controllers\TerminationController::class, 'bulkDeleteTermination'])->name('bulk-delete-terminations');

    Route::post('/bulk-delete-department', [App\Http\Controllers\DepartmentController::class, 'bulkDeleteDepartment'])->name('bulk-delete-departments');
    Route::post('/bulk-delete-allowance-head', [App\Http\Controllers\AllowanceHeadController::class, 'bulkDeleteAllowanceHead'])->name('bulk-delete-allowance-heads');
    Route::post('/bulk-delete-region', [App\Http\Controllers\RegionController::class, 'bulkDeleteRegion'])->name('bulk-delete-regions');
    Route::post('/bulk-delete-area', [App\Http\Controllers\AreaController::class, 'bulkDeleteArea'])->name('bulk-delete-areas');
    Route::post('/bulk-delete-territory', [App\Http\Controllers\TerritoryController::class, 'bulkDeleteTerritory'])->name('bulk-delete-territories');
    Route::post('/bulk-delete-town', [App\Http\Controllers\TownController::class, 'bulkDeleteTown'])->name('bulk-delete-towns');
    Route::post('/bulk-delete-db-house', [App\Http\Controllers\DbHouseController::class, 'bulkDeleteDbHouse'])->name('bulk-delete-db-houses');

    Route::post('/bulk-delete-location-six', [App\Http\Controllers\Locatoion6Controller::class, 'bulkDeleteLocation'])->name('bulk-delete-location-sixes');
    Route::post('/bulk-delete-designation', [App\Http\Controllers\DesignationController::class, 'bulkDeleteDesignation'])->name('bulk-delete-designations');
    Route::post('/bulk-delete-announcement', [App\Http\Controllers\AnnouncementController::class, 'bulkDeleteAnnouncement'])->name('bulk-delete-announcements');

    Route::post('/bulk-delete-leave', [App\Http\Controllers\LeaveController::class, 'bulkDeleteLeave'])->name('bulk-delete-leaves');
    Route::post('/bulk-delete-event', [App\Http\Controllers\EventController::class, 'bulkDeleteEvent'])->name('bulk-delete-events');
    Route::post('/bulk-delete-meeting', [App\Http\Controllers\MeetingController::class, 'bulkDeleteMeeting'])->name('bulk-delete-meetings');

    Route::post('/bulk-delete-project', [App\Http\Controllers\ProjectController::class, 'bulkDeleteProject'])->name('bulk-delete-projects');
    Route::post('/bulk-delete-task', [App\Http\Controllers\TaskController::class, 'bulkDeleteTask'])->name('bulk-delete-tasks');

    Route::post('/bulk-delete-asset-category', [App\Http\Controllers\AssetCategoryController::class, 'bulkDeleteAssetCategory'])->name('bulk-delete-asset-categories');
    Route::post('/bulk-delete-asset', [App\Http\Controllers\AssetController::class, 'bulkDeleteAsset'])->name('bulk-delete-assets');

    Route::post('/bulk-delete-support-ticket', [App\Http\Controllers\SupportTicketController::class, 'bulkDeleteSupportTicket'])->name('bulk-delete-support-tickets');
    Route::post('/bulk-delete-file-manager', [App\Http\Controllers\FileManagerController::class, 'bulkDeleteFileManager'])->name('bulk-delete-file-managers');
    Route::post('/bulk-delete-office-document', [App\Http\Controllers\DocumentController::class, 'bulkDeleteOfficeDocument'])->name('bulk-delete-office-documents');
    //bulkdelete routes routes end here

    Route::get('/payslip-detail', [App\Http\Controllers\EmployeeSetupController::class, 'employeePaySlipRedirectIndex'])->name('payslip-details');
    Route::get('/award-detail', [App\Http\Controllers\EmployeeSetupController::class, 'employeeAwardRedirectIndex'])->name('award-details');
    Route::get('/announcement-detail', [App\Http\Controllers\EmployeeSetupController::class, 'employeeAnnouncementRedirectIndex'])->name('announcement-details');
    Route::get('/leave-detail', [App\Http\Controllers\EmployeeSetupController::class, 'employeeLeaveRedirectIndex'])->name('leave-details');
    Route::get('/travel-detail', [App\Http\Controllers\EmployeeSetupController::class, 'employeeTravelRedirectIndex'])->name('travel-details');
    Route::get('/ticket-detail', [App\Http\Controllers\EmployeeSetupController::class, 'employeeTicketRedirectIndex'])->name('ticket-details');
    Route::get('/upcoming-holidays-detail', [App\Http\Controllers\EmployeeSetupController::class, 'employeeUpcomingRedirectIndex'])->name('upcoming-holidays-details');
    Route::post('/upcoming-holiday-details-by-id',  [App\Http\Controllers\EmployeeSetupController::class, 'upcomingHolidayDetailsById'])->name('upcoming-holiday-details-by-ids');
    Route::get('/transfer-detail', [App\Http\Controllers\EmployeeSetupController::class, 'employeeTransferRedirectIndex'])->name('transfer-details');
    Route::get('/profile-detail', [App\Http\Controllers\EmployeeSetupController::class, 'employeeProfileRedirectIndex'])->name('profile-details');
    //Route::get('/approve-travel/{id}', [App\Http\Controllers\TravelController::class, 'approveTravel'])->name('approve-travels');
    Route::post('file-import-details', [App\Http\Controllers\EmployeeController::class, 'fileImportDetail'])->name('import-details');
    Route::get('/see/all/{id}', [App\Http\Controllers\NotificationController::class, 'seeAll'])->name('see-all');
    Route::get('/clear/all/{id}', [App\Http\Controllers\NotificationController::class, 'clearAll'])->name('clear-all');
    Route::get('/get-seen/{id}', [App\Http\Controllers\NotificationController::class, 'seenByPage'])->name('seen-by-page');
    Route::get('/bulk-download-id-card', [App\Http\Controllers\IdCardController::class, 'bulkIdCardDownload'])->name('bulk-download-id-cards');

    Route::get('/bulk-id-cards', [App\Http\Controllers\IdCardController::class, 'bulkIdCardIndex'])->name('bulk-id-cards');
    Route::post('/bulk-id-cards', [App\Http\Controllers\IdCardController::class, 'searchWiseBulkIdCardDownload'])->name('employee-id-card-bulk-downloads');
    Route::get('/employee-all-id-and-letter', [App\Http\Controllers\GeneralController::class, 'employeeIdsAndLettersIndex'])->name('employee-all-ids-and-letters');


    Route::get('/push', [App\Http\Controllers\NotificationController::class, 'push']);
    Route::post('/save-token', [App\Http\Controllers\NotificationController::class, 'saveToken'])->name('save-token');
    Route::post('/send-notification', [App\Http\Controllers\NotificationController::class, 'sendNotification'])->name('send.notification');

    Route::get('/employee-attendance-form/{id}', [App\Http\Controllers\AttendanceController::class, 'bulkAttendanceForm'])->name('employee-attendance-forms');
    Route::post('/employee-individual-bulk-attendance', [App\Http\Controllers\AttendanceController::class, 'individualBulkAttendance'])->name('employee-individual-bulk-attendances');

    Route::post('/unset-attendance-location', [App\Http\Controllers\AttendanceLocationController::class, 'unsetAttendanceLocation'])->name('unset-attendance-locations');
    Route::post('/set-attendance-location', [App\Http\Controllers\AttendanceLocationController::class, 'setAttendanceLocation'])->name('set-attendance-locations');
    Route::post('/unset-check-out-attendance-location', [App\Http\Controllers\AttendanceLocationController::class, 'unsetCheckOutAttendanceLocation'])->name('unset-check-out-attendance-locations');
    Route::post('/set-check-out-attendance-location', [App\Http\Controllers\AttendanceLocationController::class, 'setCheckOutAttendanceLocation'])->name('set-check-out-attendance-locations');
    //Recruitment Module routes start from here
    Route::get('/job-post', [App\Http\Controllers\RecruitmentController::class, 'jobPostIndex'])->name('job-posts')->middleware(jobpost::class, 'jobpost');
    Route::post('/add-job-post', [App\Http\Controllers\JobPostController::class, 'jobPostAdd'])->name('add-job-posts')->middleware(jobpost::class, 'jobpost');
    Route::post('/job-post-by-id', [App\Http\Controllers\JobPostController::class, 'jobPostById'])->name('job-post-by-ids');
    Route::post('/update-job-post', [App\Http\Controllers\JobPostController::class, 'jobPostUpdate'])->name('update-job-posts')->middleware(jobpost::class, 'jobpost');
    Route::get('/delete-job-post/{id}',  [App\Http\Controllers\JobPostController::class, 'jobPostDelete'])->name('delete-job-posts')->middleware(jobpost::class, 'jobpost');
    Route::get('/job-candidates', [App\Http\Controllers\RecruitmentController::class, 'jobCandidateIndex'])->name('job-candidate')->middleware(jobcandidates::class, 'jobcandidates');
    Route::get('/job-interview', [App\Http\Controllers\RecruitmentController::class, 'jobInterviewIndex'])->name('job-interviews')->middleware(jobinterview::class, 'jobinterview');
    Route::post('/select-candidate', [App\Http\Controllers\JobCandidateController::class, 'selectCandidate'])->name('select-candidates')->middleware(jobcandidates::class, 'jobcandidates');
    //Recruitment Module routes end here
});
//Recruitment Module routes start from here

Route::post('/job-candidate-by-id', [App\Http\Controllers\JobCandidateController::class, 'jobCandidateById'])->name('job-candidate-by-ids');
Route::post('/add-job-apply', [App\Http\Controllers\JobCandidateController::class, 'jobApply'])->name('add-job-applies');
Route::post('/job-apply-by-id', [App\Http\Controllers\JobCandidateController::class, 'jobApplyById'])->name('job-apply-by-ids');
Route::post('/update-job-apply', [App\Http\Controllers\JobCandidateController::class, 'jobApplyUpdate'])->name('update-job-applies');
Route::get('/delete-job-apply/{id}',  [App\Http\Controllers\JobCandidateController::class, 'jobApplyDelete'])->name('delete-job-applies');


Route::get('/job-portal', [App\Http\Controllers\RecruitmentController::class, 'jobPortalIndex'])->name('job-portals');
Route::get('/single-job-detail/{slug}',  [App\Http\Controllers\RecruitmentController::class, 'singleJobDetails'])->name('single-job-details');
Route::get('/job-detail', [App\Http\Controllers\RecruitmentController::class, 'jobDetails'])->name('job-details');
Route::get('/online-job-apply', [App\Http\Controllers\RecruitmentController::class, 'jobApplyIndex'])->name('after-submission-online-job-applies');
Route::post('/online-job-apply', [App\Http\Controllers\RecruitmentController::class, 'jobApplyForm'])->name('online-job-applies');

Route::get('/job-portal-about-us', [App\Http\Controllers\RecruitmentController::class, 'jobPortalAboutUsIndex'])->name('job-portal-abouts');
Route::get('/job-portal-contact-us', [App\Http\Controllers\RecruitmentController::class, 'jobPortalContactUsIndex'])->name('job-portal-contacts');
Route::post('/contact-from-job-portal', [App\Http\Controllers\RecruitmentController::class, 'jobPortalContactUsAdd'])->name('contact-from-job-portals');

Route::get('/job-portal/category/{categories}', [App\Http\Controllers\RecruitmentController::class, 'jobcategory'])->name('job-categories');

Route::get('/job-portal/city/{cities}', [App\Http\Controllers\RecruitmentController::class, 'jobCity'])->name('job-cities');

Route::get('/finger', [App\Http\Controllers\ZKController::class, 'getDeviceInfo'])->name('finger');

//Recruitment Module routes end here


Route::post('/add-attandace', [App\Http\Controllers\ZKController::class, 'addAttandance'])->name('add-attandace');

    //Recruitment Module routes end here
