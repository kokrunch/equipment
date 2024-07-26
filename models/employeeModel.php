<?php

class EmployeeModel
{
    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function checkLogin($data_array)
    {
        $sql = "SELECT * FROM tb_employee \n" .
            "LEFT JOIN tb_sub_role ON tb_employee.sub_role_id = tb_sub_role.sub_role_id \n" .
            " WHERE emp_username = :username AND emp_password = :password";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data_array);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getUserProfile($emp_id)
    {
        $sql = "SELECT * FROM tb_employee LEFT JOIN tb_sub_role ON tb_employee.sub_role_id = tb_sub_role.sub_role_id WHERE emp_id = :emp_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(["emp_id" => $emp_id]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function GetEmpRole()
    {
        $sql = "SELECT * FROM tb_role";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function editProfile($data_array)
    {
        $sql_up = "update tb_employee SET emp_firstname = :fname,emp_lastname = :lname,emp_email = :email,emp_tel = :tel,emp_img = :emp_img_profile
        WHERE emp_id = :emp_id";

        $stmt = $this->conn->prepare($sql_up);
        $stmt->execute($data_array);
        if ($stmt) {
            return '1';
        } else {

            echo "error edit profile";
        }
    }

    public function changePass($data_array)
    {
        $sql = "update tb_employee SET emp_password = :newPass WHERE emp_id = :emp_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data_array);
        if ($stmt) {
            return '1';
        } else {

            echo "error edit profile";
        }
    }

    public function getCountEmp()
    {
        $sql = "SELECT COUNT(emp_id) Count FROM tb_employee WHERE sub_role_id != 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }


    public function getEmpToken()
    {
        try {
            $sql = "SELECT * FROM `tb_line_token` tk\n" .
                "LEFT JOIN tb_role r ON tk.role_id = r.role_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getEmp($role_id)
    {
        try {
            $sql = "SELECT\n" .
                "	*,tb_employee.emp_id EmpID,\n" .
                "   tb_employee.role_id RoleID\n" .
                "FROM\n" .
                "	tb_employee\n" .
                "	LEFT JOIN tb_role ON tb_employee.role_id = tb_role.role_id \n" .
                "	LEFT JOIN tb_token_employee te ON tb_employee.emp_id = te.emp_id\n" .
                "	LEFT JOIN tb_line_token t ON te.token_id = t.token_id\n" .
                "   WHERE tb_employee.role_id = :role_id \n" .
                "ORDER BY\n" .
                "	tb_employee.emp_firstname ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["role_id" => $role_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function InsertToken($data_array)
    {
        try {
            $sql = "INSERT INTO tb_line_token(group_name,token,role_id) VALUES(:group_name,:token,:role_id)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                echo "Error Insert Token";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function updateToken($data_array)
    {
        try {
            $sql = "UPDATE tb_line_token SET token = :token WHERE token_id = :token_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt) {
                return 1;
            } else {
                echo "Error Update Token";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function deleteToken($tokenId)
    {
        try {
            $sql_up = "DELETE FROM tb_line_token WHERE token_id = :tokenId";

            $stmt = $this->conn->prepare($sql_up);
            $stmt->execute(['tokenId' => $tokenId]);
            if ($stmt) {
                return 1;
            } else {
                echo "Error Delete Token";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getTokenByRoleId($role_id)
    {
        try {
            $sql = "SELECT\n" .
                "	* \n" .
                "FROM\n" .
                "	tb_line_token t \n" .
                "WHERE\n" .
                "	t.role_id = :role_id\n" .
                "	LIMIT 1";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["role_id" => $role_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function insertNotification($data_array)
    {
        try {
            $sql = "INSERT INTO tb_notification(noti_title,noti_detail,token_id) VALUES(:noti_title,:noti_detail,:token_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                echo "Error Insert Noti";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getNotification($emp_id, $limit)
    {
        try {
            $sql = "SELECT\n" .
                "	*,\n" .
                " n.create_date,\n" .
                "	DATE_FORMAT( n.create_date, '%d/%m/%Y %H:%i' ) noti_date \n" .
                "FROM\n" .
                "	tb_token_employee te\n" .
                "	RIGHT JOIN tb_notification n ON te.token_id = n.token_id \n" .
                "WHERE\n" .
                "	te.emp_id = :emp_id\n" .
                "ORDER BY\n" .
                "	noti_id DESC\n" .
                "LIMIT " . $limit . ",10";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["emp_id" => $emp_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function UpdateNotification($token_id)
    {
        try {
            $sql = "UPDATE tb_notification SET status = 1 WHERE token_id = :token_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["token_id" => $token_id]);
            if ($stmt) {
                return 1;
            } else {
                echo "Error Insert Noti";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function insertEmpToken($token_id, $emp_id)
    {
        try {
            $sql = "INSERT INTO tb_token_employee(token_id,emp_id) VALUES(:token_id,:emp_id)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["token_id" => $token_id, "emp_id" => $emp_id]);
            if ($stmt->rowCount() >= 1) {
                return 1;
            } else {
                echo "Error Insert insertEmpToken function";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function deleteEmpToken($emptokenId)
    {
        try {
            $sql_up = "DELETE FROM tb_token_employee WHERE emp_token_id = :emp_token_id";

            $stmt = $this->conn->prepare($sql_up);
            $stmt->execute(['emp_token_id' => $emptokenId]);
            if ($stmt) {
                return 1;
            } else {
                echo "Error Delete deleteEmpToken";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function checkDeleteToken($token_id)
    {
        try {
            $sql = "SELECT * FROM tb_notification WHERE token_id = :token_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["token_id" => $token_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $countNotiByTokenId = count($results);

            $sql = "SELECT * FROM tb_token_employee WHERE token_id = :token_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["token_id" => $token_id]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $countTokenEmpByTokenId = count($results);

            if ($countNotiByTokenId == 0 && $countTokenEmpByTokenId == 0) {
                return 1;
            } else {
                return "can not delete Token because have data in relationship";
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
