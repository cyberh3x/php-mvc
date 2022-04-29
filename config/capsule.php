<?php
use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$dbConfig = require_once APP_ROOT . "/config/db.php";
$driver = $dbConfig['default'];
$connection = $dbConfig['connections'][$driver];
$host= $connection['host'];
$database = $connection['database'];
$username = $connection['username'];
$password = $connection['password'];
$capsule->addConnection([
    'driver' => $driver,
    'host' => $host,
    'database' => $database,
    'username' => $username,
    'password' => $password,
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

// Set the event dispatcher used by Eloquent models... (optional)
//use Illuminate\Events\Dispatcher;
//use Illuminate\Container\Container;
//$capsule->setEventDispatcher(new Dispatcher(new Container));

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();