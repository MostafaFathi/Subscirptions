<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requests extends Model
{
    public function users()
    {
        return $this->belongsTo('App\App_users', 'phone_number','number');
    }
}
