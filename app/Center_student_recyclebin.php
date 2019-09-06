<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center_student_recyclebin extends Model
{
    protected $table = 'Center_student_recyclebin';
    protected $primaryKey = 'student_id';
    public function levels()
    {
        return $this->belongsTo('App\Center_levels_tb','level_id');
    }

    public function branches()
    {
        return $this->belongsTo('App\Center_branch_tb','branch_id');
    }
}
