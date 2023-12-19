<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'checkStatus' => \App\Http\Middleware\CheckStatus::class,
        'crudCheckStatus' => \App\Http\Middleware\CrudCheckStatus::class,


        'comapnylist' => \App\Http\Middleware\company\comapnylist::class,
        'packagelist' => \App\Http\Middleware\company\packagelist::class,
        'dashboard' => \App\Http\Middleware\dashboard::class,
        'userlist' => \App\Http\Middleware\admin\userlist::class,
        'assigningrole' => \App\Http\Middleware\admin\assigningrole::class,
        'employeelist' => \App\Http\Middleware\admin\employeelist::class,
        'addemployee' => \App\Http\Middleware\admin\addemployee::class,
        'updateemployee' => \App\Http\Middleware\admin\updateemployee::class,
        'role' => \App\Http\Middleware\admin\role::class,
        'variabletype' => \App\Http\Middleware\admin\variabletype::class,
        'variablemethod' => \App\Http\Middleware\admin\variablemethod::class,
        'TaxConfigure' => \App\Http\Middleware\admin\TaxConfigure::class,
        'SalaryConfigure' => \App\Http\Middleware\admin\SalaryConfigure::class,
        'Festival' => \App\Http\Middleware\admin\Festival::class,
        'OverTimeConfig' => \App\Http\Middleware\admin\OverTimeConfig::class,
        'LateTimeConfig' => \App\Http\Middleware\admin\LateTimeConfig::class,
        'companypf' => \App\Http\Middleware\admin\companypf::class,
        'promotion' => \App\Http\Middleware\admin\promotion::class,
        'award' => \App\Http\Middleware\admin\award::class,
        'travel' => \App\Http\Middleware\admin\travel::class,
        'transfer' => \App\Http\Middleware\admin\transfer::class,
        'regignation' => \App\Http\Middleware\admin\regignation::class,
        'complimant' => \App\Http\Middleware\admin\complimant::class,
        'warning' => \App\Http\Middleware\admin\warning::class,
        'termination' => \App\Http\Middleware\admin\termination::class,
        'eligiblepfmember' => \App\Http\Middleware\admin\eligiblepfmember::class,
        'PfMembership' => \App\Http\Middleware\admin\PfMembership::class,
        'PfBankAccount' => \App\Http\Middleware\admin\PfBankAccount::class,
        'Company' => \App\Http\Middleware\admin\Company::class,
        'department' => \App\Http\Middleware\admin\Department::class,
        'allowancehead' => \App\Http\Middleware\admin\AllowanceHead::class,
        'region' => \App\Http\Middleware\admin\Region::class,
        'area' => \App\Http\Middleware\admin\Area::class,
        'territory' => \App\Http\Middleware\admin\Territory::class,
        'Town' => \App\Http\Middleware\admin\Town::class,
        'dbhouse' => \App\Http\Middleware\admin\Dbhouse::class,
        'designation' => \App\Http\Middleware\admin\Designation::class,
        'announcement' => \App\Http\Middleware\admin\Announcements::class,
        'CompanyPolicy' => \App\Http\Middleware\admin\CompanyPolicy::class,
        'Attendance' => \App\Http\Middleware\admin\Attendance::class,
        'DateWiseAttendance' => \App\Http\Middleware\admin\DateWiseAttendance::class,
        'MonthlyAttendance' => \App\Http\Middleware\admin\MonthlyAttendance::class,
        'UpdateAttendance' => \App\Http\Middleware\admin\UpdateAttendance::class,
        'ImportAttendance' => \App\Http\Middleware\admin\ImportAttendance::class,
        'Officeshift' => \App\Http\Middleware\admin\Officeshift::class,
        'weeklyHoliday' => \App\Http\Middleware\admin\weeklyHoliday::class,
        'otherHoliday' => \App\Http\Middleware\admin\otherHoliday::class,
        'manageLeaveType' => \App\Http\Middleware\admin\manageLeaveType::class,
        'manageLeave' => \App\Http\Middleware\admin\manageLeave::class,
        'ApproveLeave' => \App\Http\Middleware\admin\ApproveLeave::class,
        'NewPayment' => \App\Http\Middleware\admin\NewPayment::class,
        'paymentHistory' => \App\Http\Middleware\admin\paymentHistory::class,
        'providentFundHistory' => \App\Http\Middleware\admin\providentFundHistory::class,
        'hrCalendar' => \App\Http\Middleware\admin\hrCalendar::class,
        'attendanceReport' => \App\Http\Middleware\admin\attendanceReport::class,
        'ProjectReport' => \App\Http\Middleware\admin\ProjectReport::class,
        'TaskReport' => \App\Http\Middleware\admin\TaskReport::class,
        'EmployeeReport' => \App\Http\Middleware\admin\EmployeeReport::class,
        'pfreport' => \App\Http\Middleware\admin\pfreport::class,
        'events' => \App\Http\Middleware\admin\events::class,
        'meetings' => \App\Http\Middleware\admin\meetings::class,
        'Project' => \App\Http\Middleware\admin\Project::class,
        'Task' => \App\Http\Middleware\admin\Task::class,
        'SupportTicket' => \App\Http\Middleware\admin\SupportTicket::class,
        'Assest' => \App\Http\Middleware\admin\Assest::class,
        'AssestCategories' => \App\Http\Middleware\admin\AssestCategories::class,
        'FileManager' => \App\Http\Middleware\admin\FileManager::class,
        'OfficialDocuments' => \App\Http\Middleware\admin\OfficialDocuments::class,
        'FileConfigure' => \App\Http\Middleware\admin\FileConfigure::class,

        'goaltype' => \App\Http\Middleware\admin\goaltype::class,
        'goaltracking' => \App\Http\Middleware\admin\goaltracking::class,
        'kpiObjectivetypes' => \App\Http\Middleware\admin\kpiObjectivetypes::class,
        'kpiObjectivetypeconfig' => \App\Http\Middleware\admin\kpiObjectivetypeconfig::class,
        'kpiObjective' => \App\Http\Middleware\admin\kpiObjective::class,
        'yearlyreviewconfig' => \App\Http\Middleware\admin\yearlyreviewconfig::class,
        'PDPointconfig' => \App\Http\Middleware\admin\PDPointconfig::class,
        'SeatsAllocation' => \App\Http\Middleware\admin\SeatsAllocation::class,
        'performanceform' => \App\Http\Middleware\admin\performanceform::class,
        'Supervisormarking' => \App\Http\Middleware\admin\Supervisormarking::class,
        'EligiblePDEmployees' => \App\Http\Middleware\admin\EligiblePDEmployees::class,
        'AnnualIncrement' => \App\Http\Middleware\admin\AnnualIncrement::class,

        'trainingtype' => \App\Http\Middleware\admin\trainingtype::class,
        'trainers' => \App\Http\Middleware\admin\trainers::class,
        'traininglist' => \App\Http\Middleware\admin\traininglist::class,
        'jobpost' => \App\Http\Middleware\admin\jobpost::class,
        'jobcandidates' => \App\Http\Middleware\admin\jobcandidates::class,
        'jobinterview' => \App\Http\Middleware\admin\jobinterview::class,

        'employeeprofile' => \App\Http\Middleware\employee\employeeProfile::class,
    ];
}