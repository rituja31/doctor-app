<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'category_id',
        'service_id',
        'specialties',
        'status',
        'password',
        'start_time',
        'finish_time',
        'break_start_time',
        'break_end_time',
        'working_days',
    ];
}