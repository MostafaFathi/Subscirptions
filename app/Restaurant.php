<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $table = 'restaurants';
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant','branch_id');
    }
}
