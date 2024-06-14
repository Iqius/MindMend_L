<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai dengan konvensi Laravel (yaitu, bukan 'appointments')
    protected $table = 'appointment';

    // Tentukan primary key jika bukan 'id'
    protected $primaryKey = 'appoid';

    // Disable auto-incrementing for non-integer primary keys
    public $incrementing = true;

    // Tentukan tipe primary key jika bukan 'int'
    protected $keyType = 'int';

    // Tentukan atribut yang dapat diisi (mass assignable)
    protected $fillable = [
        'pid',
        'apponum',
        'scheduleid',
        'appodate',
    ];

    // Atur timestamps jika Anda tidak ingin menggunakan kolom created_at dan updated_at
    public $timestamps = true;

    // Definisikan relasi jika ada
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'pid');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'scheduleid');
    }
}
