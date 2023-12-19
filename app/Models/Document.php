<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function documentUploadedByEmployee()
    {
        return $this->belongsTo(User::class, 'document_uploaded_employee_id');
    }
    public function documentEmployee()
    {
        return $this->belongsTo(User::class, 'document_employee_id');
    }
}