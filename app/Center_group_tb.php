<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center_group_tb extends Model
{

    protected $table = 'center_group_tb';
    protected $primaryKey = 'group_id';

    public function students()
    {
        return $this->hasMany('App\Center_group_students_tb','group_id');
    }

    public function appointments()
    {
        return $this->hasMany('App\Center_appointment_tb','group_id');
    }
    public function teachers()
    {
        return $this->belongsTo('App\Center_employee_tb','emp_id');
    }
}

