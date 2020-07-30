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

    /**
     * Get the value from DB
     * 
     * @param string $key The key to get the value of
     * @param string $default (optional) The default value if key not found
     * 
     * @return string The value of the key found
     */
    public function get($key, $default = null) {
        return $this->getValueByKey($this->options, $key, $default);
    }

    /**
     * Reload the data from the database. Good for when the data has been changed
     * since last fetch.
     * 
     */
    public function reload() {
        $this->options = Option::all();
    }

     /**
     * Add or update a value to the Options table.
     * 
     * @param string $key The key to be inserted or updated
     * @param string $value The value for update
     * @param string $group_key The group key name for this option, if doesn't exist, will be created.
     * @param string $title (optional) The title for the option key, if it needs to be created, will be used.
     * @param string $group_title (optional) The title for option group key, if has to be created
     * @param string $type (optional) The type of data for this option
     * 
     */
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