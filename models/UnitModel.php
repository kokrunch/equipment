<?php

class UnitModel
{
    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function getAllUnit()
    {
        $sql = "select * from tb_unit order by unit_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function insertUnit($data_array = array(), $unit_name)
    {
        try{
           $sql_num = "SELECT * FROM tb_unit u WHERE u.unit_name = :unit_name";
        $stmt_num = $this->conn->prepare($sql_num);
        $stmt_num->execute(['unit_name' => $unit_name]);
        $numUser = $stmt_num->rowCount();

        if ($numUser >= 1) {
            return '55';
        } else {
            $sql = "INSERT INTO tb_unit(unit_name)" .
                "values(:unit_name)";
            $data = array(
                'unit_name' => $data_array['unit_name']
            );
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            if ($stmt->rowCount() >= 1) {
                return '1';
            } else {
                $errors = $stmt->errorInfo();
                echo $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        }  
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
       
    }

    public function editUnit($data_array, $unit_name)
    {
        try {
            $sql_num = "SELECT * FROM tb_unit u WHERE u.unit_name = :unit_name";
            $stmt_num = $this->conn->prepare($sql_num);
            $stmt_num->execute(['unit_name' => $unit_name]);
            $numUser = $stmt_num->rowCount();

            if ($numUser >= 1) {
                return '55';
            } else {
            $sql_up = "UPDATE tb_unit SET unit_name = :unit_name_up WHERE unit_id = :unit_id_up";
            $stmt = $this->conn->prepare($sql_up);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                echo $sql_up;
                echo "error edit unit";
            }
        }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }

    public function deleteUnit($unit_id)
    {

        try {
            $sql = "DELETE FROM tb_unit WHERE unit_id = :unit_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["unit_id" => $unit_id]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Delete Unit.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function CheckUnitNum($unit_name)
    {
        try {
            $sql = "SELECT * FROM tb_unit u WHERE u.unit_name = :unit_name";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['unit_name' => $unit_name]);
            $results = $stmt->rowCount();
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function CheckUniteMat($unit_id)
    {
        try {
            $sql = "SELECT * FROM tb_material m , tb_unit u WHERE m.unit_id = u.unit_id AND u.unit_id = :unit_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['unit_id' => $unit_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }
}
