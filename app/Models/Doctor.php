<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
    use HasFactory, Notifiable;

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
        'timings',
        'start_time',
        'end_time',
        'break_start_time',
        'break_end_time',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Ensures Laravel handles password hashing
        'working_days' => 'array',
        'timings' => 'array',
        'category_id' => 'array',
        'service_id' => 'array',
        'start_time' => 'array',
        'end_time' => 'array',
        'break_start_time' => 'array',
        'break_end_time' => 'array',
    ];

    public $timestamps = true;

    // Relationships
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'doctor_category');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'doctor_service');
    }
}