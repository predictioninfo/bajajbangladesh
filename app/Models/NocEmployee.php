<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NocEmployee extends Model
{
    use HasFactory;
    public function nocemployee()
    {
        return $this->belongsTo(User::class, 'noc_employee_id');
    }
    public function noctemplate()
    {
        return $this->belongsTo(NonObjectionCertificate::class, 'noc_template_id');
    }
    public function scopeWithNocFilters($query, $noc_employee_id, $start_date_of_issue, $end_date_of_issue)
    {
        // \Log::info($noc_employee_id);
        // \Log::info($start_year);
        // \Log::info($end_year);

        return $query->when($noc_employee_id, function ($query) use ($noc_employee_id) {

            $query->where('noc_employee_id', $noc_employee_id);
        })
           
            ->when($start_date_of_issue, function ($query) use ($start_date_of_issue) {

                $query->where('date_of_issue', '>=', $start_date_of_issue);
            })
            ->when($end_date_of_issue, function ($query) use ($end_date_of_issue) {

                $query->where('date_of_issue', '<=', $end_date_of_issue);
            })
            ;
    }
}
