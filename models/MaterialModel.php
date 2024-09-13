<?php

class MaterialModel
{

    private $conn;
    function __construct()
    {
        include('../config/connectDatabase.php');
        $this->conn = $conn;
    }

    function getMaterial()
    {
        $sql_getmat = "SELECT * \n" .
            "FROM tb_material m , tb_material_type tm , tb_unit u , tb_material_budget_year my , tb_stock_material sm\n" .
            "WHERE m.mat_type_id = tm.type_id AND m.unit_id = u.unit_id AND m.mat_id = my.mat_id AND m.mat_id = sm.mat_id\n" .
            "AND my.budget_id = (SELECT budget_id FROM tb_budget_year WHERE tb_budget_year.budget_year_status = 1)\n" .
            "GROUP BY m.mat_id";
        $stmt = $this->conn->prepare($sql_getmat);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    function getMaterialById($data_mat_id)
    {
        $sql_getmat = "SELECT * FROM tb_material m , tb_material_type tm , tb_unit u , tb_material_budget_year my \n" .
            "WHERE m.mat_type_id = tm.type_id AND m.unit_id = u.unit_id AND m.mat_id = my.mat_id AND \n" .
            "my.budget_id = (SELECT budget_id FROM tb_budget_year WHERE budget_year_status = 1) " .
            "AND m.mat_id = $data_mat_id";
        $stmt = $this->conn->prepare($sql_getmat);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    function getTypeMaterial()
    {
        $sql = "SELECT * FROM tb_material_type";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    function getUnitMaterial()
    {
        $sql = "SELECT * FROM tb_unit";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function insertMaterial($data_array)
    {
        try {
            $sql = "INSERT INTO tb_material (mat_name,mat_type_id,mat_brand,unit_id) " .
                "values(:mat_name,:mat_type_id,:mat_brand,:mat_unit_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);

            if ($stmt->rowCount() >= 1) {
                $sql_last_id = "SELECT mat_id FROM tb_material ORDER BY mat_id DESC LIMIT 1";
                $stmt = $this->conn->prepare($sql_last_id);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results);
                return $json;
            } else {
                $errors = $stmt->errorInfo();
                return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function updateMaterial($data_array)
    {
        // print_r($data_array);
        try {
            $sql = "UPDATE tb_material SET mat_name = :mat_name , mat_type_id = :mat_type_id , mat_brand = :mat_brand , unit_id = :mat_unit_id WHERE mat_id = :material_id";
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

    public function deleteMaterial($data)
    {
        $sql = "DELETE FROM tb_material WHERE mat_id = :mat_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        if ($stmt->rowCount() >= 1) {
            return '1';
        } else {
            $errors = $stmt->errorInfo();
            return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
        }
    }

    public function insertMaterialType($data)
    {
        try {

            $sql = "INSERT INTO tb_material_type(type_name) VALUE (:type_name)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
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

    public function deleteMaterialType($data)
    {

        $sql = "DELETE FROM tb_material_type WHERE type_id = :type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        if ($stmt->rowCount() >= 1) {
            return '1';
        } else {
            $errors = $stmt->errorInfo();
            return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
        }
    }

    public function updateMaterialType($data)
    {
        try {
            $sql = "UPDATE tb_material_type SET type_name = :update_type_name WHERE type_id = :matType_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            if ($stmt) {
                return '1';
            } else {
                return ' There was an error editing the materiail data.';
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getMatTypeId($type_id)
    {
        $sql = "SELECT * FROM tb_material_type WHERE type_id = $type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }


    //อัปเดทสต๊อกวัสดุ
    public function updateStockMat($mat_id, $mat_quantity)
    {
        try {
            $sql = "UPDATE tb_stock_material SET mat_quantity = mat_quantity - :mat_quantity WHERE mat_id = :mat_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["mat_quantity" => $mat_quantity, "mat_id" => $mat_id]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Update Stock.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    //อัปเดทสต๊อกวัสดุ
    public function updateStockMatMore($mat_id, $mat_quantity)
    {
        try {
            $sql = "UPDATE tb_stock_material SET mat_quantity = mat_quantity + :mat_quantity WHERE mat_id = :mat_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["mat_quantity" => $mat_quantity, "mat_id" => $mat_id]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Update Stock.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function CheckMatByTypeMat($MatType_id)
    {
        try {
            $sql = "SELECT * FROM tb_material m , tb_material_type mt WHERE m.mat_type_id = mt.type_id AND m.mat_type_id = :mat_type_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['mat_type_id' => $MatType_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    // material budget 
    public function AddMeterialBudgetYear($data_array_budget)
    {
        try {
            $sql = "INSERT INTO tb_material_budget_year (mat_id,mat_price,mat_stock,mat_date_income,budget_id)" .
                "VALUES (:mat_id,:mat_price,:mat_stock,:mat_date_income,:budget_id)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array_budget);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding material_budget.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }


    public function getAccount_Dis_Mat($mat_id, $budget_id)
    {
        try {
            $SQLcondition = "";
            if ($budget_id != 0) {
                $SQLcondition = "AND bg.budget_id =" . $budget_id;
            }
            $sql = "SELECT\n" .
                "	* ,\n" .
                "   DATE_FORMAT(mb.mat_date_income,'%d/%m/%Y') mat_date_income,\n" .
                "	DATE(mb.mat_date_income) mat_date_income_format\n" .
                "	\n" .
                "FROM\n" .
                "	tb_material m\n" .
                "	LEFT JOIN tb_material_budget_year mb ON m.mat_id = mb.mat_id\n" .
                "	LEFT JOIN tb_budget_year bg ON mb.budget_id = bg.budget_id\n" .
                "WHERE\n" .
                "	m.mat_id = :mat_id " . $SQLcondition . "\n" .
                "ORDER BY\n" .
                "	mb.create_date ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['mat_id' => $mat_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getQueryMatDisburseAccount($mat_id)
    {
        try {
            $sql = "SELECT\n" .
                "	mb.*,\n" .
                "	DATE_FORMAT( mb.mat_date_income, '%d/%m/%Y' ) date_income,\n" .
                "	DATE( mb.mat_date_income ) mat_date_income_format,\n" .
                "	dis_d.*,\n" .
                "	DATE_FORMAT( dis.dis_date, '%d/%m/%Y' ) dis_date,\n" .
                "	DATE( dis.dis_date ) dis_date_format,\n" .
                "	m.*,-- 	mb.mat_bud_id,\n" .
                "-- 	mb.mat_price,\n" .
                "-- 	mb.mat_stock,\n" .
                "	bg.* \n" .
                "FROM\n" .
                "	tb_material_budget_year mb\n" .
                "	LEFT JOIN tb_material m ON mb.mat_id = m.mat_id\n" .
                "	LEFT JOIN tb_disburse_detail dis_d ON mb.mat_bud_id = dis_d.mat_budget_id\n" .
                "	LEFT JOIN tb_disburse dis ON dis_d.dis_id = dis.dis_id\n" .
                "	LEFT JOIN tb_budget_year bg ON mb.budget_id = bg.budget_id -- GROUP BY mb.mat_bud_idm,\n" .
                "WHERE\n" .
                "	mb.mat_id = :mat_id \n" .
                "-- 	AND bg.budget_year_status = 1 -- 	AND dis.dis_status = 'อนุมัติ'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['mat_id' => $mat_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }
}
