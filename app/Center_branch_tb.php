<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center_branch_tb extends Model
{

    protected $table = 'center_branch_tb';
    protected $primaryKey = 'branch_id';

    public function user()
    {

        $this->belongsToMany('App\User');
    }

    public function branch()
    {
        return $this->hasMany('App\Center_branch_users_tb');
    }
    //
}
