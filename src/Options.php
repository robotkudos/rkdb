<?php

namespace RobotKudos\RKDB;
use RobotKudos\RKDB\Option;
use RobotKudos\RKDB\OptionGroup;
/**
 * 
 */
class Options
{
    private $options;

    function __construct() {

        $this->options = Option::all();
    }

    public function get($key, $default = null) {
        return $this->getValueByKey($this->options, $key, $default);
    }

    public function set($key, $value, $group_key, $title = null, $group_title = null, $type = 'text') {
        if (!OptionGroup::where('key', $group_key)->exists()) {
            if ($group_title === null) $group_title = $group_key;
            OptionGroup::create(['key' => $group_key, 'title' => $group_title]);
        }
        if ($title === null) $title = $key;
        Option::updateOrCreate(
            ['key' => $key], 
            [
                'key' => $key, 
                'value' => $value, 
                'title' => $title, 
                'option_group_key' => $group_key,
                'type' => $type
            ]
        );
    }

    private function getValueByKey($collection, $key, $default = null, $keyColumn = 'key', $valueColumn = 'value') {
        $filteredCollection = $collection->filter(function($item) use ($keyColumn, $key) {
            return $item->$keyColumn == $key;
        });
    
        if ($filteredCollection->isEmpty()) {
            return $default;
        } else {
            return $filteredCollection->first()->$valueColumn;
        }
    }
}