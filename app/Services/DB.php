<?php
namespace App\Services;

use Cake\Database\Connection;
use Cake\Database\Driver\Mysql;

class DB
{
    /** @var Connection $connection */
    private static $connection;

    /**
     * @return Connection
     */
    public static function instance(): Connection
    {
        if (empty(self::$connection)) {
            $database            = require dirname(__DIR__, 2) . "/config/database.php";
            $default_environment = $database["environments"]["default_environment"];
            $env                 = $database["environments"][$default_environment];

            $driver = new Mysql([
                'host'     => $env['host'],
                'username' => $env['user'],
                'password' => $env['pass'],
                'database' => $env['name'],
                'port'     => $env['port'],
                'encoding' => $env['charset'],
            ]);

            self::$connection = new Connection([
                'driver' => $driver,
            ]);
        }

        return self::$connection;

    }

    private function __construct()
    {}

    private function __clone()
    {}
}
