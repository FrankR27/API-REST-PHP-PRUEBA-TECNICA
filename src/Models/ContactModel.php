<?php

namespace App\Models;

use App\Config\ResponseHttp;
use App\Database\ConnectionDataBase;
use App\Database\Sql;

class ContactModel extends ConnectionDataBase {

    // Atributos
    private static string $name;
    private static string $lastanme;
    private static string $email;
    private static string $phone;
 
    // Constructor
    public function __construct(array $data) {
        self::$name = $data['name'];
        self::$lastanme = $data['lastname'];
        self::$email = $data['email'];
        self::$phone = $data['phone'];
    }

    // Getters
    final public static function getName() {return self::$name;}
    final public static function getLastname() {return self::$lastanme;}
    final public static function getEmail() {return self::$email;}
    final public static function getPhone() {return self::$phone;}

    // Setters
    final public static function setName(string $name) {self::$name = $name;}
    final public static function setLastname(string $lastname) {self::$lastanme = $lastname;}
    final public static function setEmail(string $email) {self::$email = $email;}
    final public static function setPhone(string $phone) {self::$phone = $phone;}
    
    // Método para crear un contacto
    final public static function post() {
        if(Sql::exists('SELECT * FROM contacts WHERE email = :email', 'email', self::getEmail())) {
            return ResponseHttp::status400('El email ya existe');
        } else {

            // Se inserta el contacto en la base de datos
            try {
                $con = self::getConnection();
                $query = $con->prepare('INSERT INTO contacts (name, lastname, email, phone) VALUES (:name, :lastname, :email, :phone)');
                $query->execute([
                    ':name' => self::getName(),
                    ':lastname' => self::getLastname(),
                    ':email' => self::getEmail(),
                    ':phone' => self::getPhone()
                ]);

                // Se verifica si se inserto el contacto
                if($query->rowCount() > 0) {
                    return ResponseHttp::status201('Usuario creado exitosamente');
                } else {
                    return ResponseHttp::status500('No se pudo crear el usuario');
                }
            } catch (\PDOException $e) {
                error_log('ContactModel::post: ' . $e->getMessage());
                die(json_encode(ResponseHttp::status500()));
            }
        }
    }

    // Método para obtener todos los contactos
    public static function getAll() {
        try {
            $con = self::getConnection();
            $query = $con->prepare('SELECT * FROM contacts');
            $query->execute();
            return $query->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            error_log('ContactModel::getAll: ' . $e->getMessage());
            die(json_encode(ResponseHttp::status500()));
        }
    }

    // Método para obtener un usuario por id
    public static function getContact(int $id) {
        try {
            $con = self::getConnection();
            $query = $con->prepare('SELECT * FROM contacts WHERE id_contact = :id_contact');
            $query->execute([':id_contact' => $id]);

            // Se verifica si existe el contacto
            if($query->rowCount() > 0) {
                return $query->fetch(\PDO::FETCH_ASSOC);
            } else {
                return ResponseHttp::status404('El contacto no existe');
            }
        } catch (\PDOException $e) {
            error_log('ContactModel::get: ' . $e->getMessage());
            die(json_encode(ResponseHttp::status500()));
        }
    }

    // Método para eliminar un contacto
    public static function delete(int $id) {
        try {
            $con = self::getConnection();
            $query = $con->prepare('DELETE FROM contacts WHERE id_contact = :id_contact');
            $query->execute([':id_contact' => $id]);

            // Se verifica si se elimino el contacto
            if($query->rowCount() > 0) {
                return ResponseHttp::status200('Contacto eliminado exitosamente');
            } else {
                return ResponseHttp::status404('El contacto no existe');
            }
        } catch (\PDOException $e) {
            error_log('ContactModel::delete: ' . $e->getMessage());
            die(json_encode(ResponseHttp::status500()));
        }
    }

    // Método para actualizar un contacto
    public static function patch(int $id, array $data) {
        try {
            $con = self::getConnection();
            $query = $con->prepare('UPDATE contacts SET name = :name, lastname = :lastname, email = :email, phone = :phone WHERE id_contact = :id_contact');
            $query->execute([
                ':name' => $data['name'],
                ':lastname' => $data['lastname'],
                ':email' => $data['email'],
                ':phone' => $data['phone'],
                ':id_contact' => $id
            ]);

            // Se verifica si se actualizo el contacto
            if($query->rowCount() > 0) {
                return ResponseHttp::status200('Contacto actualizado exitosamente');
            } else {
                return ResponseHttp::status404('El contacto no existe');
            }
        } catch (\PDOException $e) {
            error_log('ContactModel::patch: ' . $e->getMessage());
            die(json_encode(ResponseHttp::status500()));
        }
    }

}