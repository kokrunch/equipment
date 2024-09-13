<?php

class EquipmentTypeModel
{
    private $conn;
    function __construct()
    {
        include('../config/connectDatabase.php');
        $this->conn = $conn;
    }


    public function checkEquTypeInDB($type_name)
    {
        try {
            $sql = "SELECT * FROM tb_equipment_type WHERE type_name = :type_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["type_name" => $type_name]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function inseretEquType($type_name)
    {
        try {
            $sql = "INSERT INTO tb_equipment_type(type_name)VALUES(:type_name)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["type_name" => $type_name]);
            if ($stmt->rowCount() >= 1) {
                $type_id = $this->conn->lastInsertId();
                return $type_id;
            } else {
                $errors = $stmt->errorInfo();
                return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
