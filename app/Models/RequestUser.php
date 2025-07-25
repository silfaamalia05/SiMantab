<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestUser extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'request_users';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
