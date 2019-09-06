<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function branch()
    {

        $this->belongsToMany('App\Center_branch_tb');
    }
    public function centers()
    {

        $this->belongsTo('App\Educational_center_tb','center_user_id');
    }
    public function mainCenters()
    {

        $this->hasOne('App\Educational_center_tb');
    }
}
