<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResetPassword extends Model
{
    protected $table = "resetpasswords";
    protected $fillable = ['resetpasswordid', 'userid', 'url'];

    public function __construct($resetpasswordid = null, $userid = null, $url = null, array $attributes = [])
    {
        parent::__construct($attributes);
        $this->resetpasswordid = $resetpasswordid;
        $this->userid = $userid;
        $this->url = $url;
    }
}
