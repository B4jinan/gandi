<?php
// Mahasiswa.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa'; // Nama tabel

    // Kolom yang aman untuk diisi melalui metode create()
    protected $fillable = [
        'npm', 
        'nama', 
        'jurusan'
    ];
    
    // Menonaktifkan updated_at (karena tabel Anda hanya punya created_at)
    public $timestamps = false;
}
?>