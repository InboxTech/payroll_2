<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveApply extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'from_date',
        'to_date',
        'leave_id',
        'leave_mode',
        'is_leave_cancle',
        'reason',
        'is_approved',
        'number_of_days',
        'deleted_by'
    ];

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
