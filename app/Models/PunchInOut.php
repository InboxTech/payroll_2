<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PunchInOut extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'punch_in',
        'punch_in_lat',
        'punch_in_long',
        'punch_out',
        'punch_out_lat',
        'punch_out_long',
        'punch_in_out_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
