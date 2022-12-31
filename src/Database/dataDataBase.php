<?php

use App\Database\ConnectionDataBase;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv->load();

// Datos de conexión
$data = array(
    'user' => $_ENV['USER'],
    'pass' => $_ENV['PASSWORD'],
    'host' => $_ENV['HOST'],
    'db' => $_ENV['DB_NAME'],
    'port' => $_ENV['PORT']
);

// Conexión a la base de datos
$host = 'mysql:host=' . $data['host'] . ';' . 'port=' . $data['port'] . ';' . 'dbname=' . $data['db'];
ConnectionDataBase::connect($host, $data['user'], $data['pass']);
