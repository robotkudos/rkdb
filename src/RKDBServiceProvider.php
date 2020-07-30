<?php

namespace RobotKudos\RKDB;
use Illuminate\Support\ServiceProvider;

class RKDBServiceProvider extends ServiceProvider {
    public function boot() {
        $this->loadMigrationsFrom([
            __DIR__.'/database/migrations/2020_07_29_183549_create_option_groups_table.php',
            __DIR__.'/database/migrations/2020_07_29_232145_create_options_table.php',
        ]);
    }

    public function register() {

    }
}