<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'service_id',
        'doctor_id',
        'appointment_type',
        'appointment_date',
        'appointment_time',
        'first_name',
        'last_name',
        'phone',
        'email',
        'details',
        'payment_method',
        'service_fees',
    ];
}

