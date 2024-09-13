<?php
class DisburseModel
{
    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function AddDisburse($dataArray)
    {
        try {
            $sql = "INSERT INTO tb_disburse(dis_date,dis_note,dis_status,emp_id) " .
                "VALUES(:dis_date,:dis_note,:dis_status,:emp_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dataArray);
            if ($stmt->rowCount() >= 1) {
                $dis_id = $this->conn->lastInsertId();
                return [1, $dis_id];
            } else {
                return ['There was an error Insert Disburse Cart.'];
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getDataDisAppv()
    {
        try {
            $sql = "SELECT * , d.dis_date , CONCAT(e.emp_firstname, ' ' ,e.emp_lastname) emp_name\n" .
                "FROM tb_disburse d , tb_employee e\n" .
                "WHERE d.emp_id = e.emp_id ORDER BY dis_status ASC , dis_date DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getDisAppvByStatus($status)
    {
        try {
            $sql = "SELECT * , d.dis_date , CONCAT(e.emp_firstname, ' ' ,e.emp_lastname) emp_name\n" .
                "FROM tb_disburse d , tb_employee e\n" .
                "WHERE d.emp_id = e.emp_id AND dis_status = :status ORDER BY dis_status ASC , dis_date DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['status' => $status]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function AddDisburseDetail($dataArray)
    {
        try {
            $sql = "INSERT INTO tb_disburse_detail(dis_id,mat_budget_id,quantity,dis_mat_detail)" .
                "VALUES(:dis_id,:mat_bud_id,:quan,:detail)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($dataArray);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error Insert Disburse Detail.';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getDataDisAppvById($dis_id)
    {
        try {
            $sql = "SELECT\n".
            "	d.*,\n".
            "	dt.*,\n".
            "	m.*,\n".
            "	u.*,\n".
            "	bg.budget_year, CONCAT( e.emp_firstname, ' ', e.emp_lastname ) fullname,\n".
            "	DATE_FORMAT( d.dis_date + 543, '%d/%m/%Y' ) dis_date_format \n".
            "FROM\n".
            "	tb_disburse d\n".
            "	LEFT JOIN tb_disburse_detail dt ON d.dis_id = dt.dis_id\n".
            "	LEFT JOIN tb_material_budget_year mb ON dt.mat_budget_id = mb.mat_bud_id\n".
            "	LEFT JOIN tb_material m ON mb.mat_id = m.mat_id\n".
            "	LEFT JOIN tb_unit u ON m.unit_id = u.unit_id\n".
            "	LEFT JOIN tb_budget_year bg ON mb.budget_id = bg.budget_id\n".
            "	LEFT JOIN tb_employee e ON d.emp_id = e.emp_id \n".
            "WHERE\n".
            "	.dt.dis_id = $dis_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function appvDisburse($data_array)
    {
        try {
            $sql = "UPDATE tb_disburse SET dis_approve_date = :appv_date , dis_status = :dis_status , dis_not_approve = :not_appv_why , emp_approve = :emp_id WHERE dis_id = :dis_id ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error update approve Disburse.';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function getDisburseEmp($empId)
    {
        try {
            $sql = "	SELECT\n" .
                "		*,\n" .
                "		DATE_FORMAT( d.dis_date, '%d/%m/%Y') dis_date_formate,\n" .
                "		IFNULL( ( SELECT COUNT(*) FROM tb_disburse_detail dt WHERE dt.dis_id = d.dis_id GROUP BY dt.dis_id ), 0 ) count_mat \n" .
                "	FROM\n" .
                "		tb_disburse d \n  WHERE d.emp_id = :emp_id" .
                "	ORDER BY\n" .
                "		d.dis_status ASC,d.dis_id DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['emp_id' => $empId]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function DisburseCount($emp_id)
    {
        try {

            $sql = "SELECT COUNT(dis_id) disburse_count FROM tb_disburse\n" .
                "WHERE dis_status = 'รออนุมัติ' AND emp_id = :emp_id ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['emp_id' => $emp_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getDataDisAppvByMatID($data)
    {
        try {
            $sql = "SELECT * , DATE_FORMAT( d.dis_date, '%Y-%m-%d' ) dis_date_formate , DATE_FORMAT( d.dis_approve_date , '%Y-%m-%d' ) dis_appv_date_formate\n" .
                "FROM tb_disburse d , tb_disburse_detail dd , tb_material m , tb_unit u , tb_material_budget_year mby\n" .
                "WHERE mby.mat_id = m.mat_id AND dd.mat_budget_id = mby.mat_bud_id AND d.dis_id = dd.dis_id AND m.unit_id = u.unit_id AND mby.mat_id = :mat_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getDataDisStatusWaiting()
    {
        try {
            $sql = "SELECT COUNT(*) count_waiting FROM tb_disburse WHERE dis_status = 'รออนุมัติ' ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getDisburseDetailByDisId($dis_id)
    {
        try {

            $sql = "SELECT\n" .
                "	* \n" .
                "FROM\n" .
                "	tb_disburse_detail dis_d\n" .
                "	LEFT JOIN tb_material_budget_year mb ON dis_d.mat_budget_id = mb.mat_bud_id\n" .
                "WHERE\n" .
                "	dis_id = :dis_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['dis_id' => $dis_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function deleteDisburseDetail($dis_id)
    {
        try {
            $sql = "DELETE FROM tb_disburse_detail WHERE dis_id = :dis_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["dis_id" => $dis_id]);
            if ($stmt) {
                return 1;
            } else {
                return 'There was an error Delete Disburse Detail';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function deleteDisburse($dis_id)
    {
        try {
            $sql = "DELETE FROM tb_disburse WHERE dis_id = :dis_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["dis_id" => $dis_id]);
            if ($stmt) {
                return 1;
            } else {
                return 'There was an error Delete Disburse';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function insertmatDisLog($data_array)
    {
        try {
            $sql = "INSERT INTO tb_material_budget_year_log(mat_quantity,mat_bud_id,dis_id) VALUES(:mat_quantity,:mat_bud_id,:dis_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error Insert table MatDisBudget Log';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function UpdateDusIdmatDisLog($data_array)
    {
        try {
            $sql = "UPDATE tb_material_budget_year_log SET dis_id = :dis_id WHERE ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error Insert table MatDisBudget Log';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function DeleteMatBudgetYearsLog($dis_id)
    {
        try {
            $sql = "DELETE FROM tb_material_budget_year_log WHERE dis_id = :dis_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["dis_id" => $dis_id]);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error DELETE DeleteMatBudgetYearsLog';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function UpdateStockDisbruseMat($data_array)
    {
        try {
            $sql = "UPDATE tb_stock_material SET mat_quantity =  mat_quantity + :mat_quantity WHERE mat_id = :mat_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error UpdateStockDisbruseMat';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function UpdateReportDisburse($data_array)
    {
        try {
            $sql = "UPDATE tb_disburse SET report_note = :report_note WHERE dis_id = :dis_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error UpdateReportDisburse';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
