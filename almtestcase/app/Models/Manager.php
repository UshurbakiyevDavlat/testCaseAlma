<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    protected $table = 'managers';

    protected $primaryKey = 'id';

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'id_user'=>'int'
    ];

    protected $hidden = [
        'password',
    ];
    protected $fillable = [
        'nickname',
        'password',
        'email',
        'id_user'
    ];

}
