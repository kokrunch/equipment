<?php

class BudgetYearModel
{

    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function getBudgetYear()
    {
        $sql = "SELECT * FROM tb_budget_year ORDER BY budget_year DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function addBudgetYear($data_arry)
    {

        $sql_disabel = "UPDATE tb_budget_year SET budget_year_status = 0 ".
                       "WHERE budget_id = (SELECT budget_id FROM tb_budget_year WHERE budget_year_status = 1) ";
        $stmt_dis = $this->conn->prepare($sql_disabel);
        $stmt_dis->execute();

        if ($stmt_dis->rowCount() >= 1) {
            $sql = "INSERT INTO tb_budget_year (budget_year , budget_start_date , budget_end_date , budget_year_status) " .
                "VALUES (:budget_year,:budget_st_date,:budget_end_date,1)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_arry);
            if ($stmt->rowCount() >= 1) {
                return '1';
            } else {
                $errors = $stmt->errorInfo();
                echo $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        } else {
            $sql = "INSERT INTO tb_budget_year (budget_year , budget_start_date , budget_end_date , budget_year_status) " .
                "VALUES (:budget_year,:budget_st_date,:budget_end_date,1)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_arry);
            if ($stmt->rowCount() >= 1) {
                return '1';
            } else {
                $errors = $stmt->errorInfo();
                echo $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        }
    }

    public function updateBudgetYear($data_arry)
    {
        $sql = "UPDATE tb_budget_year SET budget_year = :budget_year , " .
            "budget_start_date = :budget_start_date , budget_end_date = :budget_end_date WHERE budget_id = :budget_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data_arry);
        if ($stmt) {
            return '1';
        } else {
            echo '2';
        }
    }

    public function deleteBudgetYear($budget_id)
    {
        $sql = "DELETE FROM tb_budget_year WHERE budget_id = :budget_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['budget_id' => $budget_id]);
        if ($stmt->rowCount() >= 1) {
            return '1';
        } else {
            $errors = $stmt->errorInfo();
            echo $errors[2] . ", " . $errors[1] . " ," . $errors[0];
        }
    }


    public function getBudgetYearWhereActive()
    {
        try {
            $sql = "SELECT * FROM tb_budget_year WHERE budget_year_status = 1 LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getBudgetYearLimit()
    {
        $sql = "SELECT * , DATE_FORMAT( budget_start_date, '%d/%m/%Y' ) budget_st_date ,\n".
               "DATE_FORMAT( budget_end_date, '%d/%m/%Y' ) budget_en_date \n".
               "FROM tb_budget_year bd\n".
               "WHERE bd.budget_year_status = 1";
               
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getYear_budgetYear()
    {
        $sql = "SELECT * FROM `tb_budget_year` \n" .
            "ORDER BY budget_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }
}
