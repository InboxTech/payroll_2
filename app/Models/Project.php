<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable =[
        'project_name',
        'start_date',
        'expected_end_date',
        'project_domain_name',
        'running_status',
        'client_name',
        'email',
        'mobile_no',
        'address',
        'project_team',
    ];
}
