<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Educational_center_tb extends Model
{
    protected $table = 'educational_center_tb';
    protected $primaryKey= 'center_id';

    public function users()
    {
        return $this->hasMany('App\User','center_id');
    }
    public function mainUser()
    {
        return $this->belongsTo('App\User','center_user_id');
    }
}
