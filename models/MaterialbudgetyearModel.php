<?php

class MaterialBudgetYearModel
{
    private $conn;
    function __construct()
    {
        include('../config/connectDatabase.php');
        $this->conn = $conn;
    }

    public function getMatBudget()
    {
        $sql = "SELECT\n" .
            "	*,\n" .
            "	IFNULL( ( SELECT SUM( mbl.mat_quantity ) FROM tb_material_budget_year_log mbl WHERE mbl.mat_bud_id = mb.mat_bud_id ), 0 ) dis_bud_log_quantity \n" .
            "FROM\n" .
            "	tb_material_budget_year mb\n" .
            "	LEFT JOIN tb_material m ON mb.mat_id = m.mat_id\n" .
            "	LEFT JOIN tb_material_type mt ON m.mat_type_id = mt.type_id\n" .
            "	LEFT JOIN tb_unit ON m.unit_id = tb_unit.unit_id\n" .
            "	LEFT JOIN tb_budget_year ON mb.budget_id = tb_budget_year.budget_id\n" .
            "	WHERE tb_budget_year.budget_year_status = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function updateMatStockWhereMatBudId($data_array_budget)
    {
        try {
            $sql = "UPDATE tb_material_budget_year SET mat_stock = mat_stock + :mat_stock WHERE mat_bud_id = :mat_bud_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array_budget);
            if ($stmt) {
                return 1;
            } else {
                return 'There was an error Update matStock material_budget_year.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function getMatBudgetyearReport($budget_id)
    {
        try {
            $SQLcondition = "";
            if ($budget_id != 0) {
                $SQLcondition = "WHERE MBY.budget_id =" . $budget_id;
            }
            $sql = "SELECT * FROM tb_material_budget_year MBY\n" .
                "INNER JOIN tb_material TM ON MBY.mat_id = TM.mat_id\n" .
                "INNER JOIN tb_budget_year TBY ON MBY.budget_id = TBY.budget_id\n" .
                $SQLcondition . "\n" .
                "ORDER BY MBY.budget_id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getMatBudgetById($mat_bud_id)
    {
        $sql = "SELECT\n" .
            "	*\n" .
            "FROM\n" .
            "	tb_material_budget_year mb\n" .
            "	WHERE mat_bud_id = :mat_bud_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["mat_bud_id" => $mat_bud_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function deleteBudgetYearLogWhereDisId($dis_id)
    {
        try {
            $sql = "DELETE FROM tb_material_budget_year_log WHERE dis_id = :dis_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["dis_id" => $dis_id]);
            if ($stmt) {
                return 1;
            } else {
                return 'There was an error Delete tb_material_budget_year_log';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
