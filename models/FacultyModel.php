<?php

class FacultyModel
{
    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function getAllFaculty()
    {
        try {
            $sql = "SELECT * FROM tb_faculty";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $json = json_encode($results);
            return $json;
        } catch (Exception $th) {
            echo $th;
        }
    }

    public function addFaculty($facName)
    {
        try {
            $sql = "INSERT INTO tb_faculty(fac_name) VALUES(:facName)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["facName" => $facName]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Insert Faculty.';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }


    public function updateFaculty($facName, $facId)
    {
        try {
            $sql = "UPDATE tb_faculty SET fac_name = :facName WHERE fac_id = :facId";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(["facName" => $facName, "facId" => $facId]);
            if ($stmt) {
                return '1';
            } else {
                return 'There was an error Update Faculty.';
            }
        } catch (Exception $th) {
            echo $th;
        }
    }
}
