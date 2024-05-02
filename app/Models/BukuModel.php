<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    use HasFactory;
    protected $table = 'm_buku';
    protected $primaryKey = 'buku_id';

    protected $fillable = [
        'buku_kode',
        'judul', 
        'pengarang', 
        'penerbit', 
    ];
}
