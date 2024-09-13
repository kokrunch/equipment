<?php

class borrowEquModel
{
    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function getAllBorrowEqu()
    {
        try {
            $sql = "SELECT * ,IFNULL(tb_equipment.equ_id,tb_borrow.equipment_id) equ_id\n" .
                "            FROM tb_borrow \n" .
                "            LEFT JOIN tb_employee ON tb_employee.emp_id = tb_borrow.emp_id\n" .
                "            LEFT JOIN tb_equipment ON tb_equipment.equ_id = tb_borrow.equipment_id\n" .
                "            LEFT JOIN tb_room_desc_equ ON tb_borrow.room_desc_equ_id = tb_room_desc_equ.room_desc_equ_id\n" .
                "            LEFT JOIN tb_room ON tb_room_desc_equ.room_id = tb_room.room_id\n" .
                "            WHERE borrow_approve_status = 'รออนุมัติ'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function getBorrowId($borrow_id)
    {
        try {
            $sql = "SELECT * FROM tb_borrow WHERE borrow_id = :borrow_id ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['borrow_id' =>  $borrow_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function ApproveBorrow($data_array)
    {
        try {
            $sql_up = "UPDATE tb_borrow SET admin_approve = :emp_id,borrow_approve_date = :borrow_approve_date,borrow_approve_status = :borrow_approve_status,borrow_status = :borrow_status WHERE borrow_id = :borrow_id";
            $stmt = $this->conn->prepare($sql_up);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                echo $sql_up;
                echo "error approve borrow";
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }

    public function DisaApproveBorrow($data_array)
    {
        try {
            $sql_up = "UPDATE tb_borrow SET admin_approve = :emp_id,borrow_approve_date = :borrow_approve_date,borrow_approve_status = :borrow_approve_status,borrow_notapprove = :disa_approve_borrow WHERE borrow_id = :borrow_id";
            $stmt = $this->conn->prepare($sql_up);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                echo $sql_up;
                echo "error approve borrow";
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }

    public function queryEquipmentBorrow($equ_id)
    {
        try {
            $sql = "SELECT * FROM tb_borrow \n" .
                "WHERE equipment_id = :equ_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['equ_id' => $equ_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getDataBorrowWaiting()
    {
        try {
            $sql = "SELECT COUNT(*) count_waiting FROM tb_borrow WHERE borrow_approve_status = 'รออนุมัติ' ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function ReturnEqu($data_array)
    {
        try {
            $sql = "INSERT INTO tb_borrow_return (return_date,return_emp,borrow_id,return_detail,return_quantity)\n" .
                "VALUES(:return_date,:emp_id,:borrow_id,:return_detail,:return_quantity)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding the recipEquipmentDetail data.';
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function UpdateStatusBorrow($borrow_id)
    {
        try {
            $sql = "UPDATE tb_borrow SET borrow_status = 'คืนครุภัณฑ์แล้ว' WHERE borrow_id = :borrow_id ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['borrow_id' => $borrow_id]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding the recipEquipmentDetail data.';
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function addBorrow($data_borrow, $room_select)
    {
        try {
            $sql = "";
            if ($room_select != 0) {
                $sql = "INSERT INTO `tb_borrow`(`borrow_quantity`, `borrow_description`, `borrow_date`, `borrow_return_date`, `borrow_approve_status`,`room_desc_equ_id`, `equipment_id`, `emp_id`) \n" .
                    "VALUES (:borrow_quantity,:borrow_description,:borrow_date,:borrow_return_date,:approve_status,:room_id,:equipment_id,:emp_id)";
            } else {
                $sql = "INSERT INTO `tb_borrow`(`borrow_quantity`, `borrow_description`, `borrow_date`, `borrow_return_date`, `borrow_approve_status`,`br_use_to`, `equipment_id`, `emp_id`) \n" .
                    "VALUES (:borrow_quantity,:borrow_description,:borrow_date,:borrow_return_date,:approve_status,:br_use_to,:equipment_id,:emp_id)";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_borrow);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding the recipEquipmentDetail data.';
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function AddEquToRoom($data_room)
    {
        try {
            $sql = "INSERT INTO tb_room_desc_equ(room_id,equ_id,quantity,use_status) VALUES(:room_id,:equ_id,:quantity,:use_status)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_room);
            if ($stmt->rowCount() >= 1) {
                $room_desc_id = $this->conn->lastInsertId();
                return $room_desc_id;
            } else {
                $errors = $stmt->errorInfo();
                return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateStockAfterBorrow($equ_id, $equ_stock)
    {
        try {
            $sql = "UPDATE tb_stock_equipment SET equ_stock = equ_stock - $equ_stock WHERE equ_id = $equ_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding the recipEquipmentDetail data.';
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateReTurnBorrow($equ_id, $borrow_quantity)
    {
        try {
            $sql = "UPDATE tb_stock_equipment SET equ_stock = equ_stock + $borrow_quantity WHERE equ_id = $equ_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding the recipEquipmentDetail data.';
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateReTurn($data_stock)
    {
        try {
            $sql = "UPDATE tb_stock_equipment SET equ_stock = equ_stock + :return_quantity WHERE equ_id = :equ_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_stock);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding the recipEquipmentDetail data.';
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getBorrowlist($data_array)
    {
        try {
            $status = $data_array['status'];
            $emp_id = $data_array['emp_id'];

            $sql = "";
            if ($status != "0") {
                $sql = "SELECT * ,IFNULL(E.equ_id,B.equipment_id) equ_id\n" .
                    "                    FROM tb_borrow B\n" .
                    "                    INNER JOIN tb_equipment E ON B.equipment_id = E.equ_id\n" .
                    "                    LEFT JOIN tb_room_desc_equ RDE ON B.room_desc_equ_id = RDE.room_desc_equ_id\n" .
                    "                    LEFT JOIN tb_room R ON RDE.room_id = R.room_id\n" .
                    "WHERE B.borrow_approve_status = '$status' AND B.emp_id = $emp_id ORDER BY B.borrow_id DESC";
            } else {
                $sql = "SELECT * ,IFNULL(E.equ_id,B.equipment_id) equ_id\n" .
                    "                    FROM tb_borrow B\n" .
                    "                    INNER JOIN tb_equipment E ON B.equipment_id = E.equ_id\n" .
                    "                    LEFT JOIN tb_room_desc_equ RDE ON B.room_desc_equ_id = RDE.room_desc_equ_id\n" .
                    "                    LEFT JOIN tb_room R ON RDE.room_id = R.room_id\n" .
                    "                    WHERE B.borrow_approve_status = 'รออนุมัติ' AND B.emp_id = $emp_id  ORDER BY B.borrow_id DESC";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function cancleBorrow($borrow_id)
    {
        $sql = "DELETE FROM tb_borrow WHERE borrow_id = :borrow_id AND borrow_approve_status = 'รออนุมัติ'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["borrow_id" => $borrow_id]);
        if ($stmt->rowCount() >= 1) {
            return '1';
        } else {
            $errors = $stmt->errorInfo();
            return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
        }
    }

    public function cancleBorrowToRoom($cancle_room)
    {
        $sql = "DELETE FROM tb_room_desc_equ WHERE room_desc_equ_id = :room_desc_equ_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($cancle_room);
        if ($stmt->rowCount() >= 1) {
            return '1';
        } else {
            $errors = $stmt->errorInfo();
            return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
        }
    }

    public function updateUseStatus($array_update)
    {
        try {

            $sql = "UPDATE tb_room_desc_equ SET use_status = :use_status WHERE room_desc_equ_id = :room_desc_equ_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($array_update);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding the recipEquipmentDetail data.';
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function updateNotUseStatus($array_update)
    {
        try {

            $sql = "UPDATE tb_room_desc_equ SET use_status = :use_status WHERE room_desc_equ_id = :room_desc_equ_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($array_update);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding the recipEquipmentDetail data.';
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getAllBorrowlist()
    {
        $sql = "SELECT * , DATE_FORMAT(B.borrow_date, \"%d/%m/%Y\") Borrowdate_format,\n" .
            "DATE_FORMAT(B.borrow_return_date, \"%d/%m/%Y\") returndate_fromat,\n" .
            "DATE_FORMAT(B.create_date, \"%d/%m/%Y\") createdate_fromat,\n" .
            "IFNULL (B.borrow_status , 'ไม่ได้ยืม' ) AS borrow_status_null , B.borrow_status \n" .
            "FROM tb_borrow B\n" .
            "INNER JOIN tb_equipment E ON B.equipment_id = E.equ_id\n" .
            "INNER JOIN tb_employee EM ON B.emp_id = EM.emp_id\n" .
            "LEFT JOIN tb_room_desc_equ RDE ON B.room_desc_equ_id = RDE.room_desc_equ_id\n" .
            "LEFT JOIN tb_room R ON RDE.room_id = R.room_id\n" .
            "WHERE B.borrow_approve_status != 'รออนุมัติ' \n" .
            "ORDER BY B.borrow_id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getAllBorrowed()
    {
        $sql = "SELECT * , DATE_FORMAT(B.borrow_date, \"%d/%m/%Y\") Borrowdate_format,\n" .
            "DATE_FORMAT(B.borrow_return_date, \"%d/%m/%Y\") returndate_fromat,\n" .
            "DATE_FORMAT(B.create_date, \"%d/%m/%Y\") createdate_fromat,\n" .
            "IFNULL (B.borrow_status , 'ไม่ได้ยืม' ) AS borrow_status_null , B.borrow_status \n" .
            "FROM tb_borrow B\n" .
            "INNER JOIN tb_equipment E ON B.equipment_id = E.equ_id\n" .
            "INNER JOIN tb_employee EM ON B.emp_id = EM.emp_id\n" .
            "LEFT JOIN tb_room_desc_equ RDE ON B.room_desc_equ_id = RDE.room_desc_equ_id\n" .
            "LEFT JOIN tb_room R ON RDE.room_id = R.room_id\n" .
            "WHERE B.borrow_status = 'กำลังยืม' \n" .
            "ORDER BY B.borrow_id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getAllReturnlist()
    {
        $sql = "SELECT * , DATE_FORMAT(B.borrow_date, \"%d/%m/%Y\") Borrowdate_format,\n" .
            "DATE_FORMAT(B.borrow_return_date, \"%d/%m/%Y\") returndate_fromat,\n" .
            "DATE_FORMAT(B.create_date, \"%d/%m/%Y\") createdate_fromat,\n" .
            "DATE_FORMAT(BR.return_date, \"%d/%m/%Y\") br_returndate_fromat\n" .
            "FROM tb_borrow B\n" .
            "INNER JOIN tb_equipment E ON B.equipment_id = E.equ_id\n" .
            "INNER JOIN tb_employee EM ON B.emp_id = EM.emp_id\n" .
            "INNER JOIN tb_borrow_return BR ON B.borrow_id = BR.borrow_id\n" .
            "LEFT JOIN tb_room_desc_equ RDE ON B.room_desc_equ_id = RDE.room_desc_equ_id\n" .
            "LEFT JOIN tb_room TR ON RDE.room_id = TR.room_id\n" .
            "WHERE B.borrow_status = 'คืนครุภัณฑ์แล้ว'\n" .
            "ORDER BY B.borrow_id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getDataEquWaitingReturn()
    {
        $sql = "SELECT COUNT(borrow_id) AS Count FROM `tb_borrow`\n" .
            "WHERE borrow_status = \"กำลังยืม\"";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }
}
