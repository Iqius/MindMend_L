<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Authenticatable
{
    use HasFactory;

    protected $table = 'patient';
    protected $primaryKey = 'pid';

    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'pname',
        'pemail',
        'ppassword',
        'paddress',
        'pdob',
        'ptel',
    ];

    protected $hidden = [
        'ppassword',
        'remember_token',
    ];

    protected $casts = [
        'dob' => 'date',
    ];
    public function getAuthPassword()
    {
        return $this->ppassword;
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'patient_id', 'pid');
    }
}