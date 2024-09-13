<?php

// class LecturerModel {
//     private $conn ;
//     function function __construct()
//     {
//         include('../config/connectDatabase.php');
//         $this->conn = $conn;
//     }

//     function checkLogin($username , $password ) {
//         $sql = "SELECT * FROM tb_lecturer WHERE username = "$username" AND password = "$password" ";
//         $stmt = $this->conn->prepare($sql);
//         $stmt->execute();
//         $rs = $stmt->fetchAll();
//         return $rs
//     }
// }