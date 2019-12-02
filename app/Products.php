<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    public function restaurant()
    {
        return $this->belongsTo('App\Restaurant','product_rest');
    }
    public function restaurant_branch()
    {
        return $this->belongsTo('App\Restaurant','product_rest_branch');
    }
    public function units()
    {
        return $this->belongsTo('App\ProductUnit','unit_id');
    }
}
