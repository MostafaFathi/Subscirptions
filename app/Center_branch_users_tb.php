<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center_branch_users_tb extends Model
{
    protected $table = 'center_branch_users_tb';

    public function branch()
    {
       return $this->belongsTo('App\Center_branch_tb','branch_id');

    }
}
