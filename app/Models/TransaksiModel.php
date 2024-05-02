<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransaksiModel extends Model
{
    use HasFactory;

    protected $table = 't_transaksi';
    protected $primaryKey = 'transaksi_id';

    protected $fillable = [
        'user_id',
        'buku_id',
        'transaksi_kode',
        'tgl_peminjaman',
        'tgl_pengembalian',
        'denda',
    ];

    public function user():BelongsTo{
        return $this -> belongsTo(UserModel::class, 'user_id', 'user_id');
    }

    public function buku():BelongsTo{
        return $this -> belongsTo(BukuModel::class, 'buku_id', 'buku_id');
    }
}
