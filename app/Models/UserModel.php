<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;
    protected $table = "m_user";
    protected $primaryKey = "user_id";
    protected $fillable = [
        'nama',
        'username',
        'password',
        'activate',
        'foto',
        'level_id',
    ];
    
    protected $hidden = [
        'password',
    ];
    
    protected $casts = [
        'password' => 'hashed',
    ];
}
