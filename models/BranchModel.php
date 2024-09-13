<?php
class BranchModel
{

    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function getAllBranch()
    {
        try {
            $sql = "SELECT *,\n" .
                "( \n" .
                "	SELECT COUNT( emp_id ) FROM tb_employee \n" .
                "	WHERE tb_employee.branch_id = tb_branch.branch_id \n" .
                ") count_lecturer\n" .
                "FROM\n" .
                "	tb_branch";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }


    public function insertBranch($branchName)
    {
        try {
            $sql = "INSERT INTO tb_branch(branch_name) VALUES(:branch_name)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["branch_name" => $branchName]);
            if ($stmt->rowCount() >= 1) {
                return '1';
            } else {
                return 'There was an error Insert Branch.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function updateBranch($branchName, $branchId)
    {
        try {
            $sql = "UPDATE tb_branch SET branch_name = :branch_name WHERE branch_id = :branch_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["branch_name" => $branchName, "branch_id" => $branchId]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Update Branch.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function getEmpWhereBranch($branch_id)
    {
        try {
            $sql = "SELECT * FROM tb_employee emp \n" .
                "WHERE branch_id = :branch_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["branch_id" => $branch_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function deleteBranch($branchId)
    {
        try {
            $sql = "DELETE FROM tb_branch WHERE branch_id = :branch_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["branch_id" => $branchId]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Delete Branch.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }
}
