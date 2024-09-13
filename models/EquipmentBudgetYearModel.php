<?php

class EquipmentBudgetYearModel
{
    private $conn;
    function __construct()
    {
        include('../config/connectDatabase.php');
        $this->conn = $conn;
    }

    public function insertEquipmentBudgetYear($data_array)
    {
        try {
            $sql = "INSERT INTO tb_equipment_budget_year(equ_price,equ_stock,equ_id,budget_id,equ_date_income,equ_expire_date)" .
                "VALUES(:equ_price,:equ_stock,:equ_id,:budget_id,:equ_date_income,:equ_expire_date)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error Insert Equipment Buget Year.';
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }

    public function insertEquipmentBudgetYearForCSV($data_array)
    {
        try {
            $sql = "INSERT INTO tb_equipment_budget_year(equ_price,equ_stock,equ_id,budget_id,equ_date_income)" .
                "VALUES(:equ_price,:equ_stock,:equ_id,:budget_id,:equ_date_income)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error Insert Equipment Buget Year.';
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }

    public function checkEquipementBeforeDelete($equ_id)
    {
        $sql = "SELECT * FROM tb_equipment_budget_year WHERE equ_id = :equ_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['equ_id' => $equ_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getEquBudget($equ_id)
    {
        $sql = "SELECT\n" .
            "	*, \n" .
            "	( SELECT eimg.equ_img_name FROM tb_equipment_images eimg WHERE eimg.equ_id = e.equ_id LIMIT 0, 1 ) e_img1,\n" .
            "	( SELECT eimg.equ_img_name FROM tb_equipment_images eimg WHERE eimg.equ_id = e.equ_id LIMIT 1, 1 ) e_img2,\n" .
            "	( SELECT eimg.equ_img_name FROM tb_equipment_images eimg WHERE eimg.equ_id = e.equ_id LIMIT 2, 1 ) e_img3 \n" .
            "FROM\n" .
            "	tb_equipment_budget_year eb\n" .
            "	LEFT JOIN tb_equipment e ON eb.equ_id = e.equ_id\n" .
            "	LEFT JOIN tb_equipment_type et ON e.equ_type_id = et.type_id\n" .
            "	LEFT JOIN tb_budget_year bud ON eb.budget_id = bud.budget_id \n" .
            "WHERE\n" .
            "	bud.budget_year_status = 1 AND e.equ_id = :equ_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["equ_id" => $equ_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getEquBudgetyearReport($budget_id)
    {
        try {
            $SQLcondition = "";
            if ($budget_id != 0) {
                $SQLcondition = "WHERE EBY.budget_id =" . $budget_id;
            }
            $sql = "SELECT * FROM tb_equipment_budget_year EBY\n" .
                "INNER JOIN tb_equipment EQU ON EBY.equ_id = EQU.equ_id\n" .
                "INNER JOIN tb_budget_year TBY ON EBY.budget_id = TBY.budget_id\n" .
                $SQLcondition . "\n" .
                "ORDER BY EBY.budget_id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }


}
