<?php

class AdminDashboardModel
{

    private $conn;
    public function __construct()
    {
        include '../config/connectDatabase.php';
        $this->conn = $conn;
    }

    public function getCountDisburse()
    {
        $sql = "SELECT COUNT(dis_id) Count FROM tb_disburse";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getCountRepair(){
        $sql = "SELECT COUNT(repair_id) Count FROM tb_repair";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

    public function getCountMaterial(){
        $sql = "SELECT COUNT(mat_id) Count FROM tb_material";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $json = json_encode($results);
        return $json;
    }

}
