<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'psikolog'; // Nama tabel dalam basis data

    protected $primaryKey = 'docid'; // Nama kolom primary key

    protected $fillable = [
        'docname',
        'docemail',
        'docpassword',
        'doctel',
        'specialties',
        // tambahkan kolom lainnya yang ingin Anda gunakan
    ];

    // Tambahkan relasi atau metode lain yang diperlukan di sini
}
