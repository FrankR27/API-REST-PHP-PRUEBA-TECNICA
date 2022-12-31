<?php

namespace App\Controllers;

use App\Config\ResponseHttp;
use App\Models\ContactModel;

class ContactController
{

    // Expresiones regulares
    private static $validate_text = '/^[a-zA-Z]+$/';
    private static $validate_phone = '/^[0-9]{10}$/';
    private static $validate_number = '/^[0-9]+$/';

    public function __construct(
        private string $method,
        private string $route,
        private array $params,
        private $data,
        private $headers
    ) {
    }

    // Métodos
    final public function post(string $endPoint)
    {
        if ($this->method == 'post' && $endPoint == $this->route) {
            if (empty($this->data['name']) || empty($this->data['lastname']) || empty($this->data['email']) || empty($this->data['phone'])) {
                echo json_encode(ResponseHttp::status400('Todos los campos son requeridos'));
            } else if (!preg_match(self::$validate_text, $this->data['name']) || !preg_match(self::$validate_text, $this->data['lastname'])) {
                echo json_encode(ResponseHttp::status400('El nombre y apellido solo pueden contener letras'));
            } else if (!filter_var($this->data['email'], FILTER_VALIDATE_EMAIL)) {
                echo json_encode(ResponseHttp::status400('El email no es válido'));
            } else if (!preg_match(self::$validate_phone, $this->data['phone'])) {
                echo json_encode(ResponseHttp::status400('El telefono no es válido, Ej: 8092371111'));
            } else {
                // Se crea el modelo y se envia la respuesta
                new ContactModel($this->data);
                echo json_encode(ContactModel::post());
            }
            exit;
        }
    }

    final public function getAll(string $endPoint)
    {
        if ($this->method == 'get' && $endPoint == $this->route) {
            echo json_encode(ContactModel::getAll());
            exit;
        }
    }

    final public function getContact(string $endPoint)
    {
        if ($this->method == 'get' && $endPoint == $this->route) {
            $id = $this->params[1];
            if (!isset($id)) {
                echo json_encode(ResponseHttp::status400('El id es requerido'));
            } else if (!preg_match(self::$validate_number, $id)) {
                echo json_encode(ResponseHttp::status400('El id debe ser un número'));
            } else {
                echo json_encode(ContactModel::getContact($id));
                exit;
            }
            exit;
        }
    }

    final public function delete(string $endPoint)
    {
        if ($this->method == 'delete' && $endPoint == $this->route) {
            $id = $this->params[1];
            if (!isset($id)) {
                echo json_encode(ResponseHttp::status400('El id es requerido'));
            } else if (!preg_match(self::$validate_number, $id)) {
                echo json_encode(ResponseHttp::status400('El id debe ser un número'));
            } else {
                echo json_encode(ContactModel::delete($id));
                exit;
            }
            exit;
        }
    }
}
