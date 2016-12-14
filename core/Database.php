<?php
namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;

/**
 * Class Database
 * @package Core
 */
class Database
{

    protected static $conn;

    /**
     * Database constructor.
     */
    public function __construct()
    {

    }

    public static function init()
    {
        if (is_null(self::$conn)) {
            $capsule = new Capsule;
            $capsule->addConnection([
                'driver' => 'mysql',
                'host' => $GLOBALS['config']['host'],
                'database' => $GLOBALS['config']['dbname'],
                'username' => $GLOBALS['config']['user'],
                'password' => $GLOBALS['config']['password'],
                'charset' => 'utf8',
                'collation' => 'utf8_unicode_ci',
                'prefix' => '',
            ]);

            // Make this Capsule instance available globally via static methods... (optional)
            $capsule->setAsGlobal();
            // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
            $capsule->bootEloquent();
        }
    }
}
