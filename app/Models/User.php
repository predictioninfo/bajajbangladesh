<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use Tymon\JWTAuth\Contracts\JWTSubject;




class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, Loggable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */

    protected $guarded = [];

    public function userdepartment()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }
    public function departmetuser()
    {
        return $this->hasMany(Department::class, 'department_id');
    }

    public function educationdetail(){
      return $this->belongsTo(Qualification::class,'id','qualification_employee_id');
    }
    public function emergencyContact()
    {
        return $this->hasOne(EmergencyContact::class,  'emergency_contact_employee_id', 'id');
    }
    public function userdesignation()
    {
        return $this->belongsTo(Designation::class, 'designation_id');
    }
    public function userofficeshift()
    {
        return $this->belongsTo(OfficeShift::class, 'office_shift_id');
    }
    public function userregion()
    {
        return $this->belongsTo(Region::class, 'region_id');
    }
    public function userarea()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function userterritory()
    {
        return $this->belongsTo(Territory::class, 'territory_id');
    }
    public function usertown()
    {
        return $this->belongsTo(Town::class, 'town_id');
    }
    public function userdbhouse()
    {
        return $this->belongsTo(DbHouse::class, 'db_house_id');
    }
    public function userlocationsix()
    {
        return $this->belongsTo(Locationsix::class, 'location_six_id');
    }
    public function userlocationseven()
    {
        return $this->belongsTo(Locatoionseven::class, 'location_seven_id');
    }
    public function userlocationeight()
    {
        return $this->belongsTo(Locationeight::class, 'location_eight_id');
    }
    public function userlocationnine()
    {
        return $this->belongsTo(Locationnine::class, 'location_nine_id');
    }
    public function userlocationten()
    {
        return $this->belongsTo(Locationten::class, 'location_ten_id');
    }
    public function userlocationeleven()
    {
        return $this->belongsTo(Locationeleven::class, 'location_eleven_id');
    }
    public function userrole()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function salaryconfig()
    {
        return $this->belongsTo(SalaryConfig::class, 'com_id', 'salary_config_com_id');
    }

    public function hourlySalaryConfig()
    {
        return $this->belongsTo(HourlySalaryConfig::class, 'com_id', 'hourly_salary_config_com_id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'com_id', 'id');
    }
    public function salaryIncrement()
    {
        return $this->hasOne(SalaryHistory::class, 'salary_history_emp_id', 'id');
    }
    public function promotion()
    {
        return $this->hasOne(Promotion::class, 'promotion_employee_id', 'id');
    }
    // public function nominee(){
    //     return $this->belongsTo(Nominee::class,'nominee_employee_id');
    //   }
    // public function employeedetail(){
    //     return $this->belongsTo(EmployeeDetail::class,'id','empdetails_employee_id');
    //   }
    public function bankaccount()
    {
        return $this->belongsTo(BankAccount::class, 'id', 'bank_account_employee_id');
    }

    public function emoloyeedetail()
    {
        return $this->belongsTo(EmployeeDetail::class, 'id', 'empdetails_employee_id');
    }

    public function userDivision()
    {
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }

    public function userDistrict()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function userUpazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id');
    }
    public function userUnion()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }
    public function userValueTypeConfigdetail()
    {
        return $this->belongsTo(valueTypeConfigDetail::class, 'id', 'value_type_config_detail_emp_id');
    }
    public function userObjectiveDetail()
    {
        return $this->belongsTo(Objective::class, 'id', 'objective_emp_id');
    }
    public function qualification()
    {
        return $this->hasOne(Qualification::class, 'qualification_employee_id', 'id');
    }
    public function termination()
    {
        return $this->belongsTo(Termination::class, 'termination_employee_id', 'id');
    }
    public function appointmentLetter()
    {
        return $this->belongsTo(AppointmentTemplate::class, 'appointment_letter_format_id','id');
    }

    public function transfer()
    {
        return $this->belongsTo(Transfer::class, 'transfer_employee_id ', 'id');
    }

    public function warningLetter()
    {
        return $this->belongsTo(WarningLetterFormat::class, 'warning_letter_format_id','id');
    }
    public function salaryIncrementLetter()
    {
        return $this->belongsTo(SalaryIncrementLetter::class, 'salary_increment_letter_id','id');
    }
    public function probationLetter()
    {
        return $this->belongsTo(ProbitionLetterFormats::class, 'probation_letter_format_id','id');
    }

    public function Payslip()
    {
        return $this->belongsTo(PaySlip::class, 'pay_slip_employee_id','id');
    }
    public function experienceLetter()
    {
        return $this->belongsTo(ExperienceTemplate::class, 'experience_letter_id','id');
    }

    public function salaryCertificate()
    {
        return $this->belongsTo(SalaryCirtificate::class, 'salary_certificate_format_id','id');
    }

    public function contactRenwalletter()
    {
        return $this->belongsTo(SalaryCirtificate::class, 'salary_certificate_format_id','id');
    }

    public function resignationAcceptanceletter()
    {
        return $this->belongsTo(ResignationLetter::class, 'resignation_letter_acceptance_id','id');
    }

    public function resignationEmployee()
    {
        return $this->belongsTo(Resignation::class, 'resignation_employee_id','id');
    }

    // public function userObjective()
    // {
    //     return $this->hasOne(Objective::class,  'objective_emp_id', 'id');
    // }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
