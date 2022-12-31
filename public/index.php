<?php

use App\Config\ResponseHttp;
use App\Config\ErrorLog;

// Autoload files using the Composer autoloader.
require dirname(__DIR__) . '/vendor/autoload.php';

// Cabeceras HTTP
ResponseHttp::headerHttp($_SERVER['REQUEST_METHOD']);

// Configurar el manejo de errores
ErrorLog::errorLog();

// Rutas
if (isset($_GET['route'])) {

    $url = explode('/', $_GET['route']);
    $lista = ['auth', 'contacts'];
    $file = dirname(__DIR__) . '/src/Routes/' . $url[0] . '.php';

    if (!in_array($url[0], $lista)) {
        echo json_encode(ResponseHttp::status400());
        exit;
    }

    if (is_readable($file)) {
        require $file;
        exit;
    } else {
        echo json_encode(ResponseHttp::status400());
    }

} else {
    echo json_encode(ResponseHttp::status404());
}
