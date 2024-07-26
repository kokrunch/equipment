<?php

class EquipmentModel
{
    private $conn;
    function __construct()
    {
        include('../config/connectDatabase.php');
        $this->conn = $conn;
    }

    function getAllEquipment()
    {
        $sql = "SELECT\n" .
            "	tb_equipment.*,\n" .
            "	tb_equipment_type.type_name,\n" .
            "   edy.equ_date_income, \n" .
            "   edy.equ_expire_date, \n" .
            "	DATE_FORMAT( edy.equ_date_income, '%d/%m/%Y' ) date_income,\n" .
            "   DATE_FORMAT( edy.equ_expire_date, '%d/%m/%Y' ) date_expire,\n" .
            "	tb_budget_year.*,\n" .
            "	( SELECT eimg.equ_img_name FROM tb_equipment_images eimg WHERE eimg.equ_id = tb_equipment.equ_id LIMIT 0, 1 ) e_img1,\n" .
            "	( SELECT eimg.equ_img_name FROM tb_equipment_images eimg WHERE eimg.equ_id = tb_equipment.equ_id LIMIT 1, 1 ) e_img2,\n" .
            "	( SELECT eimg.equ_img_name FROM tb_equipment_images eimg WHERE eimg.equ_id = tb_equipment.equ_id LIMIT 2, 1 ) e_img3, \n" .
            "   se.equ_stock \n" .
            "FROM\n" .
            "	tb_equipment\n" .
            "	LEFT JOIN tb_equipment_type ON tb_equipment.equ_type_id = tb_equipment_type.type_id\n" .
            "	LEFT JOIN tb_equipment_budget_year edy ON tb_equipment.equ_id = edy.equ_id\n" .
            "	LEFT JOIN tb_budget_year ON edy.budget_id = tb_budget_year.budget_id \n" .
            "   LEFT JOIN tb_stock_equipment se ON tb_equipment.equ_id = se.equ_id\n" .
            "WHERE\n" .
            "	tb_budget_year.budget_year_status = 1 \n" .
            "GROUP BY\n" .
            "	tb_equipment.equ_id \n" .
            "ORDER BY tb_equipment.equ_id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }


    public function insertEquipment($data_array)
    {
        try {
            $sql = "INSERT INTO tb_equipment(equ_code,equ_name,equ_brand,equ_model,equ_detail,equ_color,equ_serail_no,"
                . "equ_status,equ_type_id,equ_owner)" .
                "VALUES(:equ_code,:equ_name,:equ_brand,:equ_model,:equ_detail,:equ_color,:equ_serail_no,"
                . ":equ_status,:equ_type_id,:equ_owner)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                $equ_id = $this->conn->lastInsertId();
                return $equ_id;
            } else {
                $errors = $stmt->errorInfo();
                return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }


    public function insertEquipmentForCSV($data_array)
    {
        try {
            $sql = "INSERT INTO tb_equipment(equ_code,equ_name,equ_status,equ_type_id,equ_owner)" .
                "VALUES(:equ_code,:equ_name,:equ_status,:equ_type_id,:equ_owner)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                $equ_id = $this->conn->lastInsertId();
                return $equ_id;
            } else {
                $errors = $stmt->errorInfo();
                return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }


    public function getEquipmentType()
    {
        $sql = "SELECT * FROM tb_equipment_type";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function updateEquipment($data_array)
    {
        try {
            $sql = "UPDATE tb_equipment \n" .
                "SET \n" .
                "equ_code = :equ_code,\n" .
                "equ_name = :equ_name,\n" .
                "equ_brand = :equ_brand,\n" .
                "equ_model = :equ_model,\n" .
                "equ_detail = :equ_detail,\n" .
                "equ_color = :equ_color,\n" .
                "equ_serail_no = :equ_serail_no\n" .
                // "equ_price = :equ_price,\n" .
                // "equ_date_income = :equ_date_income,\n" .
                // "equ_expire_date = :equ_expire_date,\n" .
                // "equ_type_id = :equ_type_id\n" .
                // "equ_stock = :equ_stock\n" .
                "WHERE\n" .
                "	equ_id = :equ_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Editing the equipment data.';
            }
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }
    }

    public function AddTypeEquiment($data)
    {
        try {
            $sql = "INSERT INTO tb_equipment_type (type_name) VALUES (:equ_type_name)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error editing the equipment data.';
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getEquipmentTypeId($type_id)
    {
        $sql = "SELECT * FROM tb_equipment_type WHERE type_id = $type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function updateTypeEquipment($data_array)
    {
        $sql = "UPDATE tb_equipment_type SET type_name = :type_name WHERE type_id = :type_id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data_array);
        if ($stmt) {
            return '1';
        } else {
            return 'There was an error editing the equipment data.';
        }
    }

    public function deleteEquipment($equ_id)
    {
        $sql = "DELETE FROM tb_equipment WHERE equ_id = :equ_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['equ_id' => $equ_id]);
        if ($stmt) {
            return '1';
        } else {
            return 'There was an error Deleting the equipment data.';
        }
    }

    public function deleteTypeEquipment($data_array)
    {
        $sql = "DELETE FROM tb_equipment_type WHERE type_id = :type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data_array);
        if ($stmt) {
            return '1';
        } else {
            return 'There was an error Deleting the equipment type data.';
        }
    }

    public function getEquipmentByTypeId($typ_equ_id)
    {
        $sql = "SELECT * FROM tb_equipment equ , tb_equipment_type equt WHERE equ.equ_type_id = equt.type_id AND equt.type_id = $typ_equ_id ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }


    public function addRecipEquipment($data_array)
    {
        try {
            $sql = "INSERT INTO tb_check_equipment (check_code,check_date,check_note,check_quantity,check_status,equ_id) VALUES (:check_code,:check_date,:check_note,:check_quantity,:check_status,:equ_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);

            if ($stmt) {

                $sql = "SELECT check_id FROM `tb_check_equipment` ORDER BY check_id DESC LIMIT 1 ";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $json = json_encode($results[0]);

                return $json;
            } else {
                return ' There was an error adding the recipEquipment data.';
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    function addRecipEquipmentDetail($data_recip_arry)
    {
        try {
            $sql = "INSERT INTO tb_check_equipment_detail (fullname,position,email,phone,check_id) VALUES (:fullname,:position,:email,:phone,:check_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_recip_arry);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding the recipEquipmentDetail data.';
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function getGoodEqu()
    {
        $sql = "SELECT COUNT(equ_id) Count FROM tb_equipment WHERE equ_status = 'ปกติ' ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getBadEqu()
    {
        $sql = "SELECT COUNT(equ_id) Count FROM tb_equipment WHERE equ_status = 'ใช้งานไม่ได้' ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getCountEquipment()
    {
        $sql = "SELECT COUNT(equ_id) Count FROM tb_equipment";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getEquId($equ_id)
    {
        $sql = "SELECT * FROM tb_equipment WHERE equ_id = $equ_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getEquImageWhereEquId($equ_id)
    {
        $sql = "SELECT * FROM tb_equipment_images WHERE equ_id = $equ_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function ApproveCount($emp_id)
    {
        $sql = "SELECT COUNT(borrow_id) approve_count FROM tb_borrow \n" .
            "WHERE borrow_approve_status = 'รออนุมัติ' AND emp_id = :emp_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['emp_id' => $emp_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function NotReturnCount($emp_id)
    {
        $sql = "SELECT COUNT(borrow_id) AS NotReturnCount FROM tb_borrow\n" .
            "WHERE borrow_status = 'กำลังยืม' AND emp_id = :emp_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['emp_id' => $emp_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    // เช็คการลบประเภทครุภัณฑ์
    public function CheckEquTypeByEqu($typ_equ_id)
    {
        $sql = "SELECT * FROM tb_equipment e ,tb_equipment_type et WHERE e.equ_type_id = et.type_id AND et.type_id = :type_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['type_id' => $typ_equ_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function InsertEquipmentImage($data_image)
    {
        try {
            $sql = "INSERT INTO tb_equipment_images(equ_img_name,equ_id) VALUES(:image_name,:equ_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_image);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                return 'There was an error Insert equipment image';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function queryDataReportEquipmentPosition()
    {
        try {
            $sql = "SELECT\n" .
                "	*,\n" .
                "	SUM( r_equ.quantity ) sum_quantity\n" .
                "FROM\n" .
                "	tb_room_desc_equ r_equ\n" .
                "	LEFT JOIN tb_room r ON r_equ.room_id = r.room_id\n" .
                "	LEFT JOIN tb_equipment equ ON r_equ.equ_id = equ.equ_id\n" .
                "	LEFT JOIN tb_equipment_budget_year eby ON equ.equ_id = eby.equ_id\n" .
                "	LEFT JOIN tb_budget_year bg ON eby.budget_id = bg.budget_id \n" .
                "WHERE\n" .
                "	r_equ.use_status = 1 \n" .
                "GROUP BY\n" .
                "	r_equ.equ_id,r_equ.room_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getSearchTracEqu($equ_code)
    {
        $sql_num = "SELECT * FROM tb_equipment e WHERE e.equ_code = :equ_code";
        $stmt_num = $this->conn->prepare($sql_num);
        $stmt_num->execute(["equ_code" => $equ_code]);
        $numequ = $stmt_num->rowCount();

        if ($numequ <= 0) {
            return 55;
        } else {
            $sql = "SELECT
	*,
	( SELECT eimg.equ_img_name FROM tb_equipment_images eimg WHERE eimg.equ_id = e.equ_id LIMIT 0, 1 ) e_img1
FROM
	tb_equipment e
	LEFT JOIN tb_equipment_type et ON e.equ_type_id = et.type_id
	LEFT JOIN tb_room_desc_equ tre ON e.equ_id = tre.equ_id
	LEFT JOIN tb_room tr ON tre.room_id = tr.room_id 
WHERE
	e.equ_code = :equ_code ORDER BY tre.create_date DESC LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["equ_code" => $equ_code]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        }
    }
}
