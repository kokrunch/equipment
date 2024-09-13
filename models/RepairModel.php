<?php
class RepairModel 
{

    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function DataRepairEqu($emp_id)
    {
        try {
            $sql = "SELECT\n".
                   "	* , CONCAT( IF(e.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , e.emp_firstname , \" \" , e.emp_lastname ) emp_name \n".
                   "	, CONCAT( IF(em_appv.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , em_appv.emp_firstname , \" \" , em_appv.emp_lastname ) emp_name_appv\n".
                   "FROM\n".
                   "	tb_repair r\n".
                   "	LEFT JOIN tb_equipment eq ON r.equ_id = eq.equ_id \n".
                   "	LEFT JOIN tb_employee e ON r.emp_id = e.emp_id\n".
                   "	LEFT JOIN tb_employee em_appv ON em_appv.emp_id = r.emp_approve\n".
                   "	LEFT JOIN tb_role role ON r.faction_id = role.role_id \n".
                   "    LEFT JOIN tb_send_repair sr ON r.repair_id = sr.repair_id \n".
                   "WHERE e.emp_id = :emp_id \n".
                   "ORDER BY r.repair_status = 'รอดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_date DESC ,".
                   "         r.repair_status = 'กำลังดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_status = 'กำลังซ่อม' DESC ,\n".
                   "         r.repair_status = 'กำลังส่งซ่อม' DESC ,\n".
                   "         r.repair_status = 'เสร็จสิ้นการซ่อม' DESC ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['emp_id' => $emp_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function DataRepairEquByStatus($data_array)
    {
        try {
            $sql = "SELECT\n".
                   "	* , CONCAT( IF(e.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , e.emp_firstname , \" \" , e.emp_lastname ) emp_name \n".
                   "	, CONCAT( IF(em_appv.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , em_appv.emp_firstname , \" \" , em_appv.emp_lastname ) emp_name_appv\n".
                   "FROM\n".
                   "	tb_repair r\n".
                   "	LEFT JOIN tb_equipment eq ON r.equ_id = eq.equ_id \n".
                   "	LEFT JOIN tb_employee e ON r.emp_id = e.emp_id\n".
                   "	LEFT JOIN tb_employee em_appv ON em_appv.emp_id = r.emp_approve\n".
                   "	LEFT JOIN tb_role role ON r.faction_id = role.role_id \n".
                   "    LEFT JOIN tb_send_repair sr ON r.repair_id = sr.repair_id \n".
                   "WHERE e.emp_id = :emp_id AND r.repair_status = :status \n".
                   "ORDER BY r.repair_status = 'รอดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_date DESC ,".
                   "         r.repair_status = 'กำลังดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_status = 'กำลังซ่อม' DESC ,\n".
                   "         r.repair_status = 'กำลังส่งซ่อม' DESC ,\n".
                   "         r.repair_status = 'เสร็จสิ้นการซ่อม' DESC ";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function DataRepairEqu_by_techical($role_id)
    {
        try {
            $sql = "SELECT\n".
                   "	* , CONCAT( IF(e.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , e.emp_firstname , \" \" , e.emp_lastname ) emp_name \n".
                   "	, CONCAT( IF(em_appv.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , em_appv.emp_firstname , \" \" , em_appv.emp_lastname ) emp_name_appv\n".
                   "    , r.repair_id AS Repair_id ".
                   "FROM\n".
                   "	tb_repair r\n".
                   "	LEFT JOIN tb_equipment eq ON r.equ_id = eq.equ_id \n".
                   "	LEFT JOIN tb_employee e ON r.emp_id = e.emp_id\n".
                   "	LEFT JOIN tb_employee em_appv ON em_appv.emp_id = r.emp_approve\n".
                   "	LEFT JOIN tb_role role ON r.faction_id = role.role_id\n".
                   "    LEFT JOIN tb_send_repair sr ON r.repair_id = sr.repair_id \n".
                   "WHERE r.faction_id = :role_id ".
                   "GROUP BY r.repair_id ". 
                   "ORDER BY r.repair_status = 'รอดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_status = 'กำลังดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_status = 'กำลังซ่อม' DESC ,\n".
                   "         r.repair_date DESC ,".
                   "         r.repair_status = 'กำลังส่งซ่อม' DESC ,\n".
                   "         r.repair_status = 'เสร็จสิ้นการซ่อม' DESC " ;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['role_id' => $role_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function DataRepairEqu_by_officer()
    {
        try {
            $sql = "SELECT\n".
                   "	* , CONCAT( IF(e.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , e.emp_firstname , \" \" , e.emp_lastname ) emp_name \n".
                   "	, CONCAT( IF(em_appv.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , em_appv.emp_firstname , \" \" , em_appv.emp_lastname ) emp_name_appv\n".
                   "FROM\n".
                   "	tb_repair r\n".
                   "	LEFT JOIN tb_equipment eq ON r.equ_id = eq.equ_id \n".
                   "	LEFT JOIN tb_employee e ON r.emp_id = e.emp_id\n".
                   "	LEFT JOIN tb_employee em_appv ON em_appv.emp_id = r.emp_approve\n".
                   "    LEFT JOIN tb_send_repair sr ON r.repair_id = sr.repair_id \n".
                   "WHERE r.repair_status = 'กำลังส่งซ่อม' \n".
                   "ORDER BY r.repair_status = 'รอดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_date DESC ,".
                   "         r.repair_status = 'กำลังดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_status = 'กำลังซ่อม' DESC ,\n".
                   "         r.repair_status = 'เสร็จสิ้นการซ่อม' DESC " ;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function DataRepairEqu_by_status($data_array)
    {
        try {
            $sql = "SELECT\n".
                   "	* , CONCAT( IF(e.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , e.emp_firstname , \" \" , e.emp_lastname ) emp_name \n".
                   "	, CONCAT( IF(em_appv.emp_gender = 'male' , 'นาย' , 'นางสาว' ), \" \" , em_appv.emp_firstname , \" \" , em_appv.emp_lastname ) emp_name_appv\n".
                   "    , r.repair_id AS Repair_id ".
                   "FROM\n".
                   "	tb_repair r\n".
                   "	LEFT JOIN tb_equipment eq ON r.equ_id = eq.equ_id \n".
                   "	LEFT JOIN tb_employee e ON r.emp_id = e.emp_id\n".
                   "	LEFT JOIN tb_employee em_appv ON em_appv.emp_id = r.emp_approve\n".
                   "	LEFT JOIN tb_role role ON r.faction_id = role.role_id\n".
                   "    LEFT JOIN tb_send_repair sr ON r.repair_id = sr.repair_id \n".
                   "WHERE r.faction_id = :role_id AND r.repair_status = :status ".
                   "GROUP BY r.repair_id ". 
                   "ORDER BY r.repair_status = 'รอดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_status = 'กำลังดำเนินการซ่อม' DESC ,\n".
                   "         r.repair_status = 'กำลังซ่อม' DESC ,\n".
                   "         r.repair_date DESC ,".
                   "         r.repair_status = 'กำลังส่งซ่อม' DESC ,\n".
                   "         r.repair_status = 'เสร็จสิ้นการซ่อม' DESC " ;

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function DataRepairOther()
    {
        try {
            $sql = "SELECT * \n".
                   "FROM tb_repair_other ro , tb_employee e\n".
                   "WHERE ro.emp_id = e.emp_id\n".
                   "ORDER BY\n".
                   "	ro.repair_status = 'รอดำเนินการซ่อม' DESC,\n".
                   "	ro.repair_status = 'กำลังดำเนินการซ่อม' DESC,\n".
                   "	ro.repair_status = 'กำลังซ่อม' DESC,\n".
                   "	ro.repair_status = 'เสร็จสิ้นการซ่อม' DESC;";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function addRepair($type_r,$data_array)
    {
        try {
            $sql = "" ;
            if($type_r == 1){
                $sql = "INSERT INTO tb_repair (equ_id,repair_description,repair_status,repair_date,repair_necessity,repair_reason,emp_id,faction_id) ". 
                "VALUES(:equ_id,:repair_desc,:repair_status,:date_repair,:repair_necessity,:repair_reason,:emp_id,:sec_repair)";
            }else {
                $sql = "INSERT INTO tb_repair (repair_description,repair_status,repair_date,repair_necessity,repair_reason,emp_id,faction_id) ". 
                "VALUES(:repair_desc,:repair_status,:date_repair,:repair_necessity,:repair_reason,:emp_id,:sec_repair)";
            }
           
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function addRepairOther($data_array) {
        try {
            
            $sql = "INSERT INTO tb_repair_other (repair_title , repair_description , repair_status , repair_date ,repair_necessity,repair_reason,emp_id)".
                   "VALUES( :repair_title , :repair_desc , :repair_status , :repair_date , :repair_necessity, :repair_reason, :emp_id)";
                   $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function AcceptRepairEqu($data_array)
    {
        try {

            $sql = "UPDATE tb_repair SET repair_status = 'กำลังดำเนินการซ่อม' , repair_approve_date = NOW() ," .
            "emp_approve = :emp_id WHERE repair_id = :repair_id ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

  /*   public function AcceptRepairEqu($data_array) {
        try {
            
            $sql = "UPDATE tb_repair SET repair_status = 'กำลังดำเนินการ' , repair_approve_date = NOW() ,".
                   "emp_approve = :emp_id WHERE repair_id = :repair_id ";
                   $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    } */

    public function CancelRepairEqu($data_array) {
        try {
            $sql = "UPDATE tb_repair SET repair_status = 'ไม่ผ่านการอนุมัติ' , repair_approve_date = NOW() , repair_note = :repair_note ,".
                   "emp_approve = :emp_id WHERE repair_id = :repair_id ";
                   $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function StartRepairEqu($data_array) {
        try {
            $sql = "UPDATE tb_repair SET repair_status = 'กำลังซ่อม' , repair_fixing_date = :repair_fixing_date , ".
                   "repair_deadline_date = :repair_deadline_date ,".
                   "emp_approve = :emp_id WHERE repair_id = :repair_id ";
                   $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function FinishRepairEqu($data_array) {
        try {
            $sql = "UPDATE tb_repair SET repair_status = 'เสร็จสิ้นการซ่อม' , repair_success_date = NOW() , ".
                   "repair_result = :repair_result ,".
                   "emp_approve = :emp_id WHERE repair_id = :repair_id ";
                   $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }
    public function EmpApproveCount($emp_id){
        try {
            $sql = "SELECT COUNT(repair_id) approve_emp_count FROM tb_repair  WHERE repair_status = 'รอดำเนินการแจ้งซ่อม' AND emp_id = :emp_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['emp_id' => $emp_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error query approve count data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }


    public function EmpRepairCount($emp_id){
        try {
            $sql = "SELECT COUNT(repair_id) repair_emp_count FROM tb_repair  WHERE repair_status = 'กำลังซ่อมแซม' AND emp_id = :emp_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['emp_id' => $emp_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error query count repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }
    
    public function EmpFinishRepairCount($emp_id)
    {
        try {
            $sql = "SELECT COUNT(repair_id) finish_repair_emp_count FROM tb_repair  WHERE repair_status = 'เสร็จสิ้นการซ่อม' AND emp_id = :emp_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['emp_id' => $emp_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error query count finish repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }


    
    public function FinishRepairOther($data_array) {
        try {
            $sql = "UPDATE tb_repair_other SET repair_status = 'เสร็จสิ้นการซ่อม' , repair_other_success_date = NOW() , ".
                   "repair_result = :repair_result ,".
                   "emp_approve_id = :emp_id WHERE repair_other_id = :repair_other_id ";
                   $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error FinishRepairOther()';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function AcceptRepairOther($data_array)
    {
        try {

            $sql = "UPDATE tb_repair_other SET repair_status = 'กำลังดำเนินการซ่อม' , approve_date = NOW() ," .
            "emp_approve_id = :emp_id WHERE repair_other_id = :repair_other_id ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function CancelRepairOther($data_array) {
        try {
            $sql = "UPDATE tb_repair_other SET repair_status = 'ไม่ผ่านการอนุมัติ' , approve_date = NOW() , repair_note = :repair_note ,".
                   "emp_approve_id = :emp_id WHERE repair_other_id = :repair_other_id ";
                   $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function StartRepairOther($data_array) {
        try {
            $sql = "UPDATE tb_repair_other SET repair_status = 'กำลังซ่อม' , repair_other_fixing_date = :repair_other_fixing_date , ".
                   "repair_other_deadline_date = :repair_other_deadline_date ,".
                   "emp_approve_id = :emp_id WHERE repair_other_id = :repair_other_id ";
                   $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error adding repair data.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function getDataRoleTechnical() {
        try {
            $sql = "SELECT * FROM tb_role r , tb_sub_role sr WHERE r.role_id = 4 AND r.role_id = sr.role_id ";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function SendRepair($data_array,$data_array_up) {
        try {
            $sql = "INSERT INTO tb_send_repair (send_repair_company,emp_send_id,send_repair_status,repair_id)".
                   "VALUES (:send_repair_company,:emp_send_id,'กำลังส่งซ่อม',:repair_id)" ;
                   $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                
                $sql_repair = "UPDATE tb_repair SET repair_status = 'กำลังส่งซ่อม' , emp_approve = :emp_approve ".
                              "WHERE repair_id = :repair_id ";
                $stmt = $this->conn->prepare($sql_repair);
                $stmt->execute($data_array_up);
                if ($stmt) {
                    return '1';
                } else {
                    return 'There was an error update repair data.';
                }
            } else {
                return 'There was an error SendRepair.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function RepairCountWating()
    {
        try {
            $sql = "SELECT COUNT(*) AS count_waiting FROM tb_repair WHERE repair_status = 'กำลังส่งซ่อม'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function BorrowCountWating()
    {
        try {
            $sql = "SELECT COUNT(*) AS count_waiting FROM `tb_borrow` WHERE borrow_approve_status = 'รออนุมัติ'";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }
}