<?php

class ImportExcelModel
{
    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function insertRole($data_array)
    {
        try {

            $sql = "INSERT INTO tb_role(role_name) VALUE (:role_name)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return '1';
            } else {
                $errors = $stmt->errorInfo();
                return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
