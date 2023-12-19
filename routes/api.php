<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::group([
    'middleware' => 'api',
    //'prefix' => 'auth'
], function ($router) {
    // Route::post('/login', [AuthController::class, 'login']);
    // Route::post('/register', [AuthController::class, 'register']);
    // Route::post('/logout', [AuthController::class, 'logout']);
    // Route::post('/refresh', [AuthController::class, 'refresh']);
    // Route::get('/user-profile', [AuthController::class, 'userProfile']);
    //});


    //Route::group(['namespace'=>'Api'],function(){

    //Route::post('user/login', [App\Http\Controllers\Api\ApiController::class, 'userLogin']);
    Route::post('user/login', [App\Http\Controllers\AuthController::class, 'login']);
    Route::post('user/logout', [App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('user/profile-pic-fetch', [App\Http\Controllers\Api\ApiController::class, 'userProfilePicFetch']);
    Route::post('user/profile-pic-change', [App\Http\Controllers\Api\ApiController::class, 'userProfilePicChange']);
    Route::post('user/basic-information', [App\Http\Controllers\Api\ApiController::class, 'userBasicInformation']);
    Route::post('user/basic-information-update', [App\Http\Controllers\Api\ApiController::class, 'userBasicInformationUpdate']);

    Route::post('user/immigration', [App\Http\Controllers\Api\ApiController::class, 'userImmigration']);
    Route::post('user/immigration-add', [App\Http\Controllers\Api\ApiController::class, 'userImmigrationAdd']);
    Route::post('user/immigration-by-id', [App\Http\Controllers\Api\ApiController::class, 'userImmigrationById']);
    Route::post('user/immigration-update', [App\Http\Controllers\Api\ApiController::class, 'userImmigrationUpdate']);
    Route::post('user/immigration-delete', [App\Http\Controllers\Api\ApiController::class, 'deleteImmigrantion']);

    Route::post('user/emergency-contact', [App\Http\Controllers\Api\ApiController::class, 'userEmergencyContact']);
    Route::post('user/emergency-contact-add', [App\Http\Controllers\Api\ApiController::class, 'userEmergencyContactAdd']);
    Route::post('user/emergency-contact-by-id', [App\Http\Controllers\Api\ApiController::class, 'userEmergencyContactById']);
    Route::post('user/emergency-contact-update', [App\Http\Controllers\Api\ApiController::class, 'userEmergencyContactUpdate']);
    Route::post('user/emergency-contact-delete', [App\Http\Controllers\Api\ApiController::class, 'deleteEmergencyContact']);

    Route::post('user/social-profile', [App\Http\Controllers\Api\ApiController::class, 'userSocialProfile']);
    Route::post('user/social-profile-add', [App\Http\Controllers\Api\ApiController::class, 'userSocialProfileAdd']);
    Route::post('user/social-profile-by-id', [App\Http\Controllers\Api\ApiController::class, 'userSocialProfileById']);
    Route::post('user/social-profile-update', [App\Http\Controllers\Api\ApiController::class, 'userSocialProfileUpdate']);
    Route::post('user/social-profile-delete', [App\Http\Controllers\Api\ApiController::class, 'deleteSocialProfile']);

    Route::post('user/document', [App\Http\Controllers\Api\ApiController::class, 'userDocument']);
    Route::post('user/document-add', [App\Http\Controllers\Api\ApiController::class, 'userDocumentAdd']);
    Route::post('user/document-by-id', [App\Http\Controllers\Api\ApiController::class, 'userDocumentById']);
    Route::post('user/document-update', [App\Http\Controllers\Api\ApiController::class, 'userDocumentUpdate']);
    Route::post('user/document-delete', [App\Http\Controllers\Api\ApiController::class, 'deleteDocument']);

    Route::post('user/qualification', [App\Http\Controllers\Api\ApiController::class, 'userQualification']);
    Route::post('user/qualification-add', [App\Http\Controllers\Api\ApiController::class, 'userQualificationAdd']);
    Route::post('user/qualification-by-id', [App\Http\Controllers\Api\ApiController::class, 'userQualificationById']);
    Route::post('user/qualification-update', [App\Http\Controllers\Api\ApiController::class, 'userQualificationUpdate']);
    Route::post('user/qualification-delete', [App\Http\Controllers\Api\ApiController::class, 'deleteQualification']);

    Route::post('user/work-experience', [App\Http\Controllers\Api\ApiController::class, 'userWorkExperience']);
    Route::post('user/work-experience-add', [App\Http\Controllers\Api\ApiController::class, 'userWorkExperienceAdd']);
    Route::post('user/work-experience-by-id', [App\Http\Controllers\Api\ApiController::class, 'userWorkExperienceById']);
    Route::post('user/work-experience-update', [App\Http\Controllers\Api\ApiController::class, 'userWorkExperienceUpdate']);
    Route::post('user/work-experience-delete', [App\Http\Controllers\Api\ApiController::class, 'deleteWorkExperience']);

    Route::post('user/salary-bank-account', [App\Http\Controllers\Api\ApiController::class, 'userSalaryBankAccount']);
    Route::post('user/salary-bank-account-add', [App\Http\Controllers\Api\ApiController::class, 'userSalaryBankAccountAdd']);
    Route::post('user/salary-bank-account-by-id', [App\Http\Controllers\Api\ApiController::class, 'userSalaryBankAccountById']);
    Route::post('user/salary-bank-account-update', [App\Http\Controllers\Api\ApiController::class, 'userSalaryBankAccountUpdate']);
    //Route::post('user/salary-bank-account-delete', [App\Http\Controllers\Api\ApiController::class, 'deleteSalaryBankAccount']);

    Route::post('user/password-change', [App\Http\Controllers\Api\ApiController::class, 'userPasswordChange']);
    Route::get('user/appointment-letter/{id}', [App\Http\Controllers\Api\ApiController::class, 'userAppointmentLetter']);
    Route::get('user/id-card/{id}', [App\Http\Controllers\Api\ApiController::class, 'userIdCard']);
    Route::post('user/total-salary', [App\Http\Controllers\Api\ApiController::class, 'userTotalSalary']);
    Route::post('user/component', [App\Http\Controllers\Api\ApiController::class, 'userComponent']);
    Route::post('user/commission', [App\Http\Controllers\Api\ApiController::class, 'userCommission']);
    Route::post('user/loan', [App\Http\Controllers\Api\ApiController::class, 'userLoan']);
    Route::post('user/statutory-deduction', [App\Http\Controllers\Api\ApiController::class, 'userStatutoryDeduction']);
    Route::post('user/other-allowance', [App\Http\Controllers\Api\ApiController::class, 'userAllowance']);
    Route::post('user/over-time', [App\Http\Controllers\Api\ApiController::class, 'userOverTime']);
    Route::post('user/salary-pension', [App\Http\Controllers\Api\ApiController::class, 'userSalaryPension']);
    Route::post('user/location-wise-attendance', [App\Http\Controllers\Api\ApiController::class, 'userLocationWiseAttendance']);
    Route::post('user/award', [App\Http\Controllers\Api\ApiController::class, 'userAward']);
    Route::post('user/travel', [App\Http\Controllers\Api\ApiController::class, 'userTravel']);
    Route::post('user/transfer', [App\Http\Controllers\Api\ApiController::class, 'userTransfer']);
    Route::post('user/resignation', [App\Http\Controllers\Api\ApiController::class, 'userResignation']);
    Route::post('user/resignation-add', [App\Http\Controllers\Api\ApiController::class, 'userResignationAdd']);
    Route::post('user/termination', [App\Http\Controllers\Api\ApiController::class, 'userTermination']);
    Route::post('user/promotion', [App\Http\Controllers\Api\ApiController::class, 'userPromotion']);
    Route::post('user/complaint', [App\Http\Controllers\Api\ApiController::class, 'userComplaint']);
    Route::post('user/warning', [App\Http\Controllers\Api\ApiController::class, 'userWarning']);
    Route::post('user/leave', [App\Http\Controllers\Api\ApiController::class, 'userLeave']);
    Route::post('user/support-ticket-own-details', [App\Http\Controllers\Api\ApiController::class, 'userSupportTicketOwnDetails']);
    Route::post('user/project', [App\Http\Controllers\Api\ApiController::class, 'userProject']);
    Route::post('user/task', [App\Http\Controllers\Api\ApiController::class, 'userTask']);
    Route::post('user/pay-slip', [App\Http\Controllers\Api\ApiController::class, 'userPaySlip']);
    Route::post('user/ids-or-appointment-letters', [App\Http\Controllers\Api\ApiController::class, 'userIdsAndAppointmentLetters']);
    Route::post('user/announcement', [App\Http\Controllers\Api\ApiController::class, 'userAnnouncement']);
    Route::post('user/company-policy', [App\Http\Controllers\Api\ApiController::class, 'userCompanyPolicy']);
    Route::post('user/daily-attendance', [App\Http\Controllers\Api\ApiController::class, 'userAttendance']);
    Route::post('user/date-wise-attendance', [App\Http\Controllers\Api\ApiController::class, 'userDateWiseAttendance']);

    Route::post('user/supervisor-employee-attendance-list', [App\Http\Controllers\Api\ApiController::class, 'supervisorEmployeeAttendanceList']);
    Route::post('user/supervisor-employee-attendance-show', [App\Http\Controllers\Api\ApiController::class, 'supervisorEmployeeDateWiseAttendance']);
    Route::post('user/supervisor-employee-show', [App\Http\Controllers\Api\ApiController::class, 'supervisorEmployee']);

    Route::post('user/month-wise-attendance', [App\Http\Controllers\Api\ApiControllerTwo::class, 'userMonthWiseAttendance']);
    Route::post('user/approve-leave-details', [App\Http\Controllers\Api\ApiController::class, 'userLeaveApprove']);
    Route::post('user/approving-leave', [App\Http\Controllers\Api\ApiController::class, 'userApprovingLeave']);

    Route::post('user/approve-travel-details', [App\Http\Controllers\Api\ApiController::class, 'userTravelApprove']);
    Route::post('user/approving-travel', [App\Http\Controllers\Api\ApiController::class, 'userApprovingTravel']);

    Route::post('user/working-on-support-ticket', [App\Http\Controllers\Api\ApiController::class, 'userWorkingOnSupportTicket']);
    Route::post('user/support-ticket-update', [App\Http\Controllers\Api\ApiController::class, 'userSupportTicketUpdate']);
    Route::post('user/asset', [App\Http\Controllers\Api\ApiController::class, 'userAsset']);
    Route::post('user/calendar', [App\Http\Controllers\Api\ApiController::class, 'userCalendar']);
    Route::post('user/leave-request-sending', [App\Http\Controllers\Api\ApiControllerThree::class, 'userLeaveRequestSending']);
    Route::post('user/travel-request-sending', [App\Http\Controllers\Api\ApiControllerThree::class, 'userTravelRequestSending']);
    Route::post('user/support-ticket-request-sending', [App\Http\Controllers\Api\ApiControllerThree::class, 'userSupportTicketRequestSending']);
    Route::post('user/leave-type', [App\Http\Controllers\Api\ApiController::class, 'userLeaveType']);
    Route::post('user/arrangement-type', [App\Http\Controllers\Api\ApiController::class, 'userArrangementType']);
    Route::get('user/support-ticket-priority', [App\Http\Controllers\Api\ApiController::class, 'userTicketPriority']);
    Route::get('user/support-ticket-status', [App\Http\Controllers\Api\ApiController::class, 'userSupportTicketStatus']);
    Route::get('user/immigration-document-type', [App\Http\Controllers\Api\ApiController::class, 'userImmigrationDoccumentType']);
    Route::get('user/document-type', [App\Http\Controllers\Api\ApiController::class, 'userDoccumentType']);
    Route::post('user/education-level', [App\Http\Controllers\Api\ApiController::class, 'userEducationLevel']);
    Route::get('user/bank-account-type', [App\Http\Controllers\Api\ApiController::class, 'userBankAccountType']);
    Route::post('user/mobile-bill', [App\Http\Controllers\Api\ApiController::class, 'userMobileBill']);
    Route::post('user/transport-allowance', [App\Http\Controllers\Api\ApiController::class, 'userTransportAllowance']);
    Route::post('user/notification-counts', [App\Http\Controllers\Api\ApiController::class, 'userUnseenNotificationCount']);
    Route::post('user/notifications', [App\Http\Controllers\Api\ApiController::class, 'userNotification']);
    Route::any('user/attendance-check-in', [App\Http\Controllers\Api\ApiControllerFour::class, 'userAttandanceCheckIn']);
    Route::post('user/attendance-check-out', [App\Http\Controllers\Api\ApiControllerFour::class, 'userAttandanceCheckOut']);
    Route::post('user/save-device-token', [App\Http\Controllers\Api\ApiController::class, 'userDeviceTokenSave']);
    Route::post('user/send-notification', [App\Http\Controllers\Api\ApiController::class, 'sendNotification']);
    Route::post('user/attendance-status-for-current-date', [App\Http\Controllers\Api\ApiController::class, 'attendanceStatusForToday']);
    Route::post('user/designation', [App\Http\Controllers\Api\ApiController::class, 'userDesignation']);
    Route::post('user/office-shift', [App\Http\Controllers\Api\ApiController::class, 'userOfficeShift']);
    Route::post('user/office-shift-time', [App\Http\Controllers\Api\ApiController::class, 'userOfficeShiftTime']);
    Route::post('user/payslip-counts', [App\Http\Controllers\Api\ApiController::class, 'userPaySlipCount']);
    Route::post('user/upcoming-holidays-counts', [App\Http\Controllers\Api\ApiController::class, 'userUpcomingHolidayCount']);
    Route::post('user/award-counts', [App\Http\Controllers\Api\ApiController::class, 'userAwardCount']);
    Route::post('user/announcement-counts', [App\Http\Controllers\Api\ApiController::class, 'userAnnouncementCount']);
    Route::post('user/upcoming-holiday-details', [App\Http\Controllers\Api\ApiController::class, 'userUpcomingHoliday']);
    
    Route::post('user/employee-objective', [App\Http\Controllers\Api\ApiController::class, 'employeeObjective']);
    Route::post('user/employee-details-objective-plan', [App\Http\Controllers\Api\ApiController::class, 'employeeDetailsObjective']);
});
