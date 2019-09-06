<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center_employee_tb extends Model
{
   protected $table = 'center_employee_tb';
   protected $primaryKey = 'emp_id';

    public function job()
    {
        return $this->belongsTo('App\Center_jobs_table','job_id');
   }
    public function branches()
    {
        return $this->belongsTo('App\Center_branch_tb','branch_id');
    }

    public function groups()
    {
        return $this->hasMany('App\Center_group_tb','emp_id');
    }
}
