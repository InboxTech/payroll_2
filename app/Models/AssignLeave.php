<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignLeave extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'leave_id',
        'number_of_leaves',
    ];

    public function leave()
    {
        return $this->belongsTo(Leave::class);
    }
}
