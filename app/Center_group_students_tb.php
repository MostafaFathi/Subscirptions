<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Center_group_students_tb extends Model
{
    protected $table = 'center_group_students_tb';
    protected $primaryKey = 'tag_no';
    protected $fillable = ['student_id','payment_status','payment_value'];
    public function students()
    {
        return $this->belongsTo('App\Center_students_tb','student_id');
    }
    public function group()
    {
        return $this->belongsTo('App\Center_group_tb','group_id');
    }
}
