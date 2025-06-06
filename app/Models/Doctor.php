<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use Notifiable;

    // Laravel expects this model to use the 'doctors' table
    protected $table = 'doctors';

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
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Enable timestamps (created_at and updated_at)
    public $timestamps = true;
}
