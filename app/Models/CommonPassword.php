<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommonPassword extends Model
{
    protected $fillable = ['password'];
    protected $hidden = ['created_at', 'updated_at'];
}
