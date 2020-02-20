<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{

    public function getIntervalText()
    {
        $interval_text = '';
        if($this->interval == 1)  $interval_text = 'يومي';
        if($this->interval == 2)  $interval_text = 'شهر';
        if($this->interval == 3)  $interval_text = '3 شهور';
        if($this->interval == 4)  $interval_text = '6 شهور';
        if($this->interval == 5)  $interval_text = 'سنوي';
        if($this->interval == 6)  $interval_text = 'VIP';

        return $interval_text;
    }
}
