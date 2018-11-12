<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    protected $table = 'user_verifications';
    protected $fillable = ['userverificationid', 'userid', 'token', 'url'];
}
