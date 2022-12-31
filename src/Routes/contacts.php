<?php

use App\Config\ResponseHttp;
use App\Controllers\ContactController;

$method = strtolower($_SERVER['REQUEST_METHOD']);
$route = $_GET['route'];
$params = explode('/', $route);
$data = json_decode(file_get_contents("php://input"), true);
$headers = getallheaders();

// Instancia del controlador de contacto
$app = new ContactController($method, $route, $params, $data, $headers);

// Rutas
$app->getAll('contacts/');
$app->getContact("contacts/{$params[1]}");
$app->post('contacts/');
$app->delete("contacts/{$params[1]}");

// Error 404
echo json_encode(ResponseHttp::status404());
