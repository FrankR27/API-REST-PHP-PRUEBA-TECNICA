<?php

namespace App\Database;

use App\Config\ResponseHttp;

class Sql extends ConnectionDataBase
{

    public static function exists(string $request, string $condition, $params)
    {
        try {
            $con = self::getConnection();
            $query = $con->prepare($request);
            $query->execute([
                $condition => $params
            ]);
            $result = ($query->rowCount() == 0) ? false : true;
            return $result;
        } catch (\PDOException $e) {
            error_log('Sql::exists: ' . $e->getMessage());
            die(json_encode(ResponseHttp::status500()));
        }
    }
}
