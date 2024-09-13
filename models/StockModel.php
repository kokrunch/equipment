<?php

class stockModel
{

    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function getStockMat()
    {

        try {
            $sql = "SELECT * FROM tb_material 
            LEFT JOIN tb_material_type ON tb_material_type.type_id = tb_material.mat_type_id
            LEFT JOIN tb_unit ON tb_unit.unit_id = tb_material.unit_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getMat($id)
    {
        try {
            $sql = "SELECT * FROM tb_material WHERE mat_id = '$id'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            echo $th;
        }
    }


    public function updateStockMaterial($data_array)
    {
        // print_r($data_array);
        try {
            $sql = "UPDATE tb_material SET mat_stock = mat_stock+:mat_stock WHERE mat_id = :mat_id";
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


    public function updateStockLogMaterial($data_array)
    {
        // print_r($data_array);
        try {
            $sql = "INSERT INTO tb_stock_material_log(mat_id,mat_quantity_before,mat_quantity,emp_id) VALUES(:mat_id,:mat_stock,:mat_quantity,:emp_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return "There was an error Update Stock Material LOG.";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function updateStockEqu($dataEqu)
    {
        try {
            $sql = "UPDATE tb_stock_equipment SET equ_stock = equ_stock + :equ_quantity WHERE equ_id = :equ_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dataEqu);
            if ($stmt) {
                return 1;
            } else {
                return "There was an error Update Stock Equipment.";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function insertStockEqu($dataEqu)
    {
        try {
            $sql = "INSERT INTO tb_stock_equipment(equ_id,equ_stock) VALUES(:equ_id,:equ_stock)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dataEqu);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return "There was an error Insert Stock Equipment.";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function AddStockMaterialBudget($data_array_stock)
    {
        try {
            $sql = "INSERT INTO tb_stock_material (mat_id,mat_quantity) VALUES (:mat_id,:mat_quantity)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array_stock);
            if ($stmt->rowCount() >= 1) {
                return '1';
            } else {
                $errors = $stmt->errorInfo();
                return $errors ."adding stock_material ( AddStockMaterialBudget() )" ;
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function updateStockMaterialBudget($data_array_stock)
    {
        // print_r($data_array);
        try {
            $sql = "UPDATE tb_stock_material SET mat_quantity = mat_quantity+:mat_quantity WHERE mat_id = :mat_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array_stock);
            if ($stmt->rowCount() >= 1) {
                return '1';
            } else {
                $errors = $stmt->errorInfo();
                return $errors ."updating stock_material ( updateStockMaterialBudget() )" ;
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }
}
