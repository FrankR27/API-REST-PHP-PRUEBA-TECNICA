<?php

namespace App\Config;

class ResponseHttp
{
    public static $message = array(
        'message' => '',
    );

    // Cabeceras HTTP para el modo de desarrollo
    final public static function headerHttp($method) {

        // Si el método es OPTIONS, salimos
        if($method == 'OPTIONS') {
            exit(0);
        }

        // Establecemos las cabeceras
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, DELETE');
        header('Allow: GET, POST, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');
        header('Content-Type: application/json');
    }

    // Métodos para establecer el código de respuesta HTTP
    
    final public static function status200(string $res = 'OK')
    {
        http_response_code(200);
        self::$message['message'] = $res;
        return self::$message;
    }

    final public static function status201(string $res = 'Created')
    {
        http_response_code(201);
        self::$message['message'] = $res;
        return self::$message;
    }

    final public static function status204(string $res = 'No Content')
    {
        http_response_code(204);
        self::$message['message'] = $res;
        return self::$message;
    }

    final public static function status400(string $res = 'Bad Request')
    {
        http_response_code(400);
        self::$message['message'] = $res;
        return self::$message;
    }

    final public static function status401(string $res = 'Unauthorized')
    {
        http_response_code(401);
        self::$message['message'] = $res;
        return self::$message;
    }

    final public static function status404(string $res = 'Not Found')
    {
        http_response_code(404);
        self::$message['message'] = $res;
        return self::$message;
    }

    final public static function status500(string $res = 'Internal Server Error')
    {
        http_response_code(500);
        self::$message['message'] = $res;
        return self::$message;
    }
}
