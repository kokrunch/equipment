<?php
session_start();

require_once('../models/employeeModel.php');

if (isset($_POST['loginSection'])) {
    try {
        $username = htmlentities($_POST['username']);
        $password = htmlentities($_POST['password']);

        $dataLogin = array(
            'username' => $username,
            'password' => $password
        );

        $empModel = new EmployeeModel();
        $empDataLogin = $empModel->checkLogin($dataLogin);
        $jsonEmpDecode = json_decode($empDataLogin);

        if (sizeof($jsonEmpDecode) >= 1) {

            $login_array = array(
                'status' => "login success",
                'role_id' => $jsonEmpDecode[0]->role_id
            );

            $_SESSION["empData"] = $jsonEmpDecode[0];
            echo json_encode($login_array);
        } else {
            echo "invalid user";
        }
    } catch (\Throwable $th) {
        //throw $th;
        echo $th;
    }
}


if (isset($_GET['logoutSection'])) {
    try {
        session_destroy();
        echo "logout";
    } catch (\Throwable $th) {
        //throw $th;
        echo $th;
    }
}

if (isset($_GET['getEmpRole'])) {
    $role = new EmployeeModel();
    $result = $role->GetEmpRole();
    echo $result;
}


//session_destroy();
