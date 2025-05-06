<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNoValidate extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'users';
}
