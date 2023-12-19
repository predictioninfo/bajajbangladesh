<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentTemplate extends Model
{
    use HasFactory;

    public function AppointmentSignatory()
    {
        return $this->belongsTo(User::class, 'appointment_template_signature_employee_id');
    }
    public function AppointmentCompany()
    {
        return $this->belongsTo(Company::class, 'appointment_template_com_id');
    }
    public function appointmentHeader()
    {
        return $this->belongsTo(Header::class, 'appointment_template_header');
    }
}
