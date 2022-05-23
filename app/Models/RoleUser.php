<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory; 

    public $timestamps = false; 

    protected $fillable = [
        'user_type', 
        'role_number',
    ];
}
