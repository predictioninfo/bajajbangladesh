<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonObjectionCertificate extends Model
{
    use HasFactory;

    public function signatory()
    {
        return $this->belongsTo(User::class, 'non_objection_certificate_signature_emp_id');
    }
}
