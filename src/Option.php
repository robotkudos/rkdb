<?php

namespace RobotKudos\RKDB;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $fillable = [
        'key',
        'title',
        'value',
        'type',
        'option_group_key'
    ];

    public function optionGroup() {
        return $this->belongsTo('App\OptionGroup');
    }
}
