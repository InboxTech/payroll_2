<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'designation_id',
        'department_id',
        'emp_id',
        'job_type',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'mobile_no',
        'personal_email',
        'password',
        'gender',
        'dob',
        'joining_date',
        'releaving_date',
        'probation_end_date',
        'confirmation_date',
        'profile_image',
        'emp_status',
        'temporary_address',
        'permanent_address',
        'project_manager_id',
        'status',
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->middle_name.' '.$this->last_name;
    }

    public function user_detail()
    {
        return $this->hasOne(UserDetail::class);
    }

    public function salary_history()
    {
        return $this->hasMany(SalaryHistory::class);
    }

    public function assign_leave()
    {
        return $this->hasMany(AssignLeave::class);
    }

    public function leave_apply()
    {
        return $this->hasMany(LeaveApply::class);
    }

    public function designation()
    {
        return $this->belongsTo(Designation::class);
    }
    
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user_document()
    {
        return $this->hasMany(UserDocument::class);
    }
}
