<?php

namespace RobotKudos\RKDB;
use Illuminate\Database\Eloquent\Model;

class OptionGroup extends Model
{
    public $timestamps = false;
    public $fillable = [
        'key',
        'title'
    ];
    public function options() {
        return $this->hasMany('App\Option', 'option_group_name', 'key');
    }
}
