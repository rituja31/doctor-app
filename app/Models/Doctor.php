<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use Notifiable;

    // Specify the table name
    protected $table = 'doctors';

    // Add 'timings' to the fillable array
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
        'working_days',
        'timings', // Added to allow mass assignment
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Enable timestamps
    public $timestamps = true;
}