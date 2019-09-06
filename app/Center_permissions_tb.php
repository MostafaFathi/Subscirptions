<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center_permissions_tb extends Model
{
    protected $table = 'center_permissions_tb';
protected $primaryKey = 'permission_no';
    public function parents()
    {
        return $this->belongsToMany('App\Center_permissions_tb','permission_no');
    }
    public function childs()
    {
        return $this->hasOne('App\Center_permissions_tb','permission_parent_no');
    }
}
