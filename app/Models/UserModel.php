<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class UserModel extends Authenticatable
{
    use HasFactory;
    protected $table = "m_user";
    protected $primaryKey = "user_id";
    protected $fillable = [
        'nim',
        'nama',
        'password',
        'tgl_lahir',
        'level_id',
    ];
    
    protected $hidden = [
        'password',
    ];
    
    protected $casts = [
        'password' => 'hashed',
    ];

    public function level():BelongsTo{
        return $this -> belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}
