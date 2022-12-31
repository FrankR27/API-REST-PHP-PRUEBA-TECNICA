<?php

namespace App\Config;

// Establecer zona horaria
date_default_timezone_set('America/Santo_Domingo');

// Configurar el manejo de errores
class ErrorLog
{
    public static function errorLog()
    {
        error_reporting(E_ALL);
        ini_set('ignore_repeated_errors', TRUE);
        ini_set('display_errors', FALSE);
        ini_set('log_errors', TRUE);
        ini_set('error_log', dirname(__DIR__) . '/utils/logs/php-error.log');
    }
}
