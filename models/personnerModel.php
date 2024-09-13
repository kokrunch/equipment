<?php

class PersonerModel
{
    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function getAllPersonel($emp_id)
    {
        $sql = "select * from tb_employee 
        LEFT JOIN tb_role ON tb_employee.sub_role_id = tb_role.role_id
        LEFT JOIN tb_branch ON tb_employee.branch_id = tb_branch.branch_id WHERE tb_employee.emp_id != $emp_id";
        //echo $sql;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getCheckNumUser($emp_username)
    {
        $sql = "select * from tb_employee 
        LEFT JOIN tb_role ON tb_employee.role_id = tb_role.role_id
        LEFT JOIN tb_branch ON tb_employee.branch_id = tb_branch.branch_id WHERE tb_employee.emp_username = $emp_username";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->rowCount();
        $json = json_encode($results);
        return $json;
    }

    public function getTypeRole()
    {
        $sql = "SELECT * FROM tb_role";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getBranch()
    {
        $sql = "SELECT * FROM tb_branch";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function insertUser($data_array, $username)
    {
        try {
            $sql_num = "select * from tb_employee 
        LEFT JOIN tb_role ON tb_employee.sub_role_id = tb_role.role_id
        LEFT JOIN tb_branch ON tb_employee.branch_id = tb_branch.branch_id WHERE tb_employee.emp_username = :username";
        $stmt_num = $this->conn->prepare($sql_num);
        $stmt_num->execute(['username' => $username]);
        $numUser = $stmt_num->rowCount();

        if ($numUser >= 1) {
            return '55';
        } else {
            $sql = "INSERT INTO tb_employee(emp_username,emp_password,emp_firstname,emp_lastname,emp_gender,emp_email,emp_tel,sub_role_id,emp_img,branch_id)" .
                "values(:username,:password,:firstname,:lastname,:gender,:email,:tel,:role,:emp_img,:branch)";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($data_array);
            if ($stmt->rowCount() >= 1) {
                return '1';
            } else {
                $errors = $stmt->errorInfo();
                echo $errors[2] . ", " . $errors[1] . " ," . $errors[0];
            }
        }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function editUser($data_array)
    {
        $sql_up = "update tb_employee SET emp_firstname = :fname_up,emp_lastname = :lname_up,emp_email = :email_up,emp_tel = :tel_up,sub_role_id = :role_id_up,branch_id = :branch_id_up
         WHERE emp_id = :id_up";

        $stmt = $this->conn->prepare($sql_up);
        $stmt->execute($data_array);
        if ($stmt) {
            return '1';
        } else {

            echo "error edit user";
        }
    }

    public function deleteUser($data)
    {

        $sql_d = "DELETE FROM tb_employee WHERE emp_id = :emp_id";
        $stmt = $this->conn->prepare($sql_d);
        $stmt->execute($data);
        if ($stmt->rowCount() >= 1) {
            return '1';
        } else {
            $errors = $stmt->errorInfo();
            return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
        }
    }

    public function getEmpRole()
    {
        $sql = "SELECT * FROM tb_sub_role ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function insertEmpRole($data)
    {
        try {

            $sql = "INSERT INTO tb_sub_role(sub_role_name,role_id) VALUE (:role_name,:role_id)";
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

    public function deleteEmpRole($data)
    {

        $sql = "DELETE FROM tb_sub_role WHERE sub_role_id = :role_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
        if ($stmt->rowCount() >= 1) {
            return '1';
        } else {
            $errors = $stmt->errorInfo();
            return $errors[2] . ", " . $errors[1] . " ," . $errors[0];
        }
    }

    public function getRoleId($role_id)
    {
        $sql = "SELECT * FROM tb_sub_role WHERE sub_role_id = $role_id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function updateEmpRole($data)
    {
        try {
            $sql = "UPDATE tb_sub_role SET sub_role_name = :update_role_name,role_id = :role_id WHERE sub_role_id = :sub_role_id";
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
}
