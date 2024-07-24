<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HolidayLeave extends Model
{
    use HasFactory, SoftDeletes;

    protected $delete = ['deleted_at'];

    protected $fillable = [
        'holiday_date', 
        'holiday_name', 
        'status',
    ];
}
