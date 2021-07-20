<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testrecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'OrderNo',
        'user_id',
        'PatientMobile',
        'TestType',
        'TestType',
        'ReportStaus',
        'FinalReport',
        'RegistrationDate',
        'AssignedEmpID',
        'AssignedEmpName',
        'AssignedTime',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function phlebotomist(){
        return $this->belongsTo(Phlebotomist::class, 'AssignedEmpID');
    }

}
