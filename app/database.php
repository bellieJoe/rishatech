<?php

namespace App;

require '../vendor/autoload.php';

use Medoo\Medoo;

class DB {
    private static $database;

    private function __construct() {
        self::$database = new Medoo([
            'type' => 'mysql',
            'host' => 'localhost',
            'database' => 'rishatech_db',
            'username' => 'root',
            'password' => ''
        ]);
    }

    public static function get(): Medoo {
        if (self::$database === null) {
            new self();
        }
        return self::$database;
    }
}

?>
