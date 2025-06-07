<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailChangeRequest extends Model
{
    use HasFactory;
    protected $table = 'email_change_requests';
    protected $fillable = ['user_id', 'new_email', 'token', 'expires_at'];
     public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
