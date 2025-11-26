<?php

use Illuminate\Database\Capsule\Manager as Capsule;

-
$host = "localhost";
$user = "root";
$pass = "";
$db = "datamahasiswa"; 

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $host,
    'database'  => $db,
    'username'  => $user,
    'password'  => $pass,
    'charset'   => 'utf8mb4',
    'collation' => 'utf8mb4_unicode_ci',
    'prefix'    => '',
]);


$capsule->setAsGlobal();


$capsule->bootEloquent();
?>