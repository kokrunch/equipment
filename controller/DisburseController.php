<?php

session_start();
include('../models/DisburseModel.php');
include('../models/DisburseCartModel.php');
include('../models/MaterialModel.php');
include('../models/MaterialbudgetyearModel.php');
include('../utils/LineNotifyClass.php');

if (isset($_POST['addToCart'])) {
    try {
        $emp_id = $_SESSION['empData']->emp_id;
        $mat_id = $_POST['mat_id'];
        $mat_bud_id = $_POST['mat_bud_id'];
        $mat_quantity = $_POST['mat_quantity'];

        $data = [
            "mat_bud_id" => $mat_bud_id,
            "quantity" => $mat_quantity,
            "emp_id" => $emp_id
        ];

        $cartModel = new DisburseCartModel();
        $result = $cartModel->checkMatInCart($mat_bud_id, $emp_id);

        $matIncart = json_decode($result);

        $insertResult = 0;
        if (count($matIncart) > 0) {
            $insertResult = $cartModel->updateQuanttyCart($matIncart[0]->mat_cart_id, $mat_quantity);
        } else {
            $disburseModel = new DisburseCartModel();
            $insertResult = $disburseModel->insertDisburse($data);
        }

        if ($insertResult == 1) {
            $matModel = new MaterialModel();
            $MaterialBudgetYearModel = new MaterialBudgetYearModel();
            $matModel->updateStockMat($mat_id, $mat_quantity);
            $mat_quantity = '-' . $mat_quantity;
            $data_array = [
                "mat_stock" => $mat_quantity,
                "mat_bud_id" => $mat_bud_id
            ];
            $result =  $MaterialBudgetYearModel->updateMatStockWhereMatBudId($data_array);
            echo $result;
        } else {
            echo $insertResult;
        }
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_GET['getDisburseCart'])) {
    try {
        $emp_id = $_SESSION["empData"]->emp_id;
        $disburseCartModel = new DisburseCartModel();
        $result = $disburseCartModel->getDisburseCart($emp_id);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_GET['getCountCart'])) {
    try {
        $emp_id = $_SESSION["empData"]->emp_id;
        $disburseCartModel = new DisburseCartModel();
        $result = $disburseCartModel->countDisburseCart($emp_id);
        $result = json_decode($result);
        echo $result[0]->count;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['updateQuantityMore'])) {
    try {
        $quantity = 1;
        $mat_cart_id = $_POST['mat_cart_id'];
        $mat_bud_id = $_POST['mat_bud_id'];
        $cartModel = new DisburseCartModel();
        $moreResult = $cartModel->updateQuanttyCart($mat_cart_id, $quantity);
        if ($moreResult == 1) {
            $MaterialBudgetYearModel = new MaterialBudgetYearModel();
            $quantity = -1;
            $data_array = [
                "mat_stock" => $quantity,
                "mat_bud_id" => $mat_bud_id
            ];
            $result =  $MaterialBudgetYearModel->updateMatStockWhereMatBudId($data_array);
            echo $result;
        } else {
            echo $moreResult;
        }
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['updateQuantityLower'])) {
    try {
        $quantity = -1;
        $mat_cart_id = $_POST['mat_cart_id'];
        $mat_bud_id = $_POST['mat_bud_id'];
        $cartModel = new DisburseCartModel();
        $lowerResult = $cartModel->updateQuanttyCart($mat_cart_id, $quantity);

        if ($lowerResult == 1) {
            $MaterialBudgetYearModel = new MaterialBudgetYearModel();
            $quantity = 1;
            $data_array = [
                "mat_stock" => $quantity,
                "mat_bud_id" => $mat_bud_id
            ];
            $result =  $MaterialBudgetYearModel->updateMatStockWhereMatBudId($data_array);
            echo $result;
        } else {
            echo $lowerResult;
        }
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['deleteCart'])) {
    try {
        $mat_cart_id = $_POST['mat_cart_id'];
        $quantity = $_POST['quantity'];
        $mat_bud_id = $_POST['mat_bud_id'];

        $MaterialBudgetYearModel = new MaterialBudgetYearModel();
        $mat_bud = $MaterialBudgetYearModel->getMatBudgetById($mat_bud_id);

        $mat_bud_decode = json_decode($mat_bud);
        $mat_id = $mat_bud_decode[0]->mat_id;
        $cartModel = new DisburseCartModel();
        $delResult = $cartModel->deleteCart($mat_cart_id);
        if ($delResult == 1) {
            $data_array = [
                "mat_stock" => $quantity,
                "mat_bud_id" => $mat_bud_id
            ];
            $MaterialBudgetYearModel->updateMatStockWhereMatBudId($data_array);

            $matModel = new MaterialModel();
            $result = $matModel->updateStockMatMore($mat_id, $quantity);
            echo $result;
        } else {
            echo $delResult;
        }
    } catch (Exception $e) {
        echo $e;
    }
}


if (isset($_POST['adddisburse'])) {
    try {
        $disburse_date = htmlentities($_POST['disburse_date']);
        $disburse_note = htmlentities($_POST['disburse_note']);
        $emp_id = $_SESSION['empData']->emp_id;

        $arr_data_detail_mat = $_POST['data_detail'];
        $arr_data = [
            "dis_date" => $disburse_date,
            "dis_note" => $disburse_note,
            "dis_status" => "รออนุมัติ",
            "emp_id" => $emp_id
        ];

        $disModel = new DisburseModel();
        $disCartModel = new DisburseCartModel();
        $MaterialBudgetYearModel = new MaterialBudgetYearModel();

        $result = 0;

        $insertDisburse = $disModel->AddDisburse($arr_data);
        if ($insertDisburse[0] == 1) {
            $jsonCart = $disCartModel->getDisburseCartWhereDisId($emp_id);
            $arr_dataCart = json_decode($jsonCart);
            $lengthCart = count($arr_dataCart);

            for ($i = 0; $i < $lengthCart; $i++) {
                $matBudId = $arr_dataCart[$i]->mat_bud_id;
                $quantity =  $arr_dataCart[$i]->quantity;

                $data_array = [
                    "mat_quantity" => $quantity,
                    "mat_bud_id" => $matBudId,
                    "dis_id" => $insertDisburse[1]
                ];
                $disModel->insertmatDisLog($data_array);

                $data_array = [
                    "mat_stock" => $quantity,
                    "mat_bud_id" => $matBudId
                ];
                $MaterialBudgetYearModel->updateMatStockWhereMatBudId($data_array);
                $disCartModel->deleteCart($arr_dataCart[$i]->mat_cart_id);

                $dataToDetail = [
                    "dis_id" => $insertDisburse[1],
                    "mat_bud_id" => $matBudId,
                    "quan" => $quantity,
                    "detail" => $arr_data_detail_mat[$i]
                ];
                $result = $disModel->AddDisburseDetail($dataToDetail);
            }

            if ($result == 1) {

                //notification line
                $empModel = new EmployeeModel();
                $linenotify = new LineNotifyClass();

                $role_id = 4;
                $token_data = $empModel->getTokenByRoleId($role_id); //ข้อมูล Token ตามตำแหน่ง

                $emp_data = $empModel->getUserProfile($emp_id); // ข้อมูลผู้อเบิก

                $decodeToken = json_decode($token_data);
                $emp_decode = json_decode($emp_data);

                if (count($decodeToken) > 0) {

                    $emp_name = $emp_decode[0]->emp_firstname . " " . $emp_decode[0]->emp_lastname;

                    $token = $decodeToken[0]->token;
                    $linenotify->writeMessageLineNotifyMat($token,  $emp_name);
                    $arr_data_noti = [
                        "noti_title" => "แจ้งเตือนการเบิกวัสดุ",
                        "noti_detail" => "มีรายการเบิกเข้ามา 1 รายการ \nจากคุณ " .  $emp_name,
                        "token_id" => $decodeToken[0]->token_id
                    ];
                    $result = $empModel->insertNotification($arr_data_noti);
                }
            }

            echo $result;
        } else {
            echo $insertDisburse[0];
        }
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_GET['getDisAppv'])) {
    try {
        $disburseModel = new DisburseModel();
        $result = $disburseModel->getDataDisAppv();
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_GET['getDisAppvByStatus'])) {
    try {
        $disburseModel = new DisburseModel();
        $status = $_GET['getDisAppvByStatus'];
        $result = $disburseModel->getDisAppvByStatus($status);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['cancelDisburse'])) {
    $dis_id = $_POST['dis_id'];
    $disburseModel = new DisburseModel();
    $materialModel = new materialModel();
    $MaterialBudgetYearModel = new MaterialBudgetYearModel();

    $result =  $disburseModel->getDisburseDetailByDisId($dis_id);
    $ArrDisburseDetail = json_decode($result);
    $length = count($ArrDisburseDetail);

    for ($i = 0; $i < $length; $i++) {
        $mat_id = $ArrDisburseDetail[$i]->mat_id;
        $mat_quantity = $ArrDisburseDetail[$i]->quantity;
        $materialModel->updateStockMatMore($mat_id, $mat_quantity);
    }

    $result = $disburseModel->deleteDisburseDetail($dis_id);
    $result = $MaterialBudgetYearModel->deleteBudgetYearLogWhereDisId($dis_id);
    if ($result == 1) {
        $deleteDisburseResult = $disburseModel->deleteDisburse($dis_id);
        echo $deleteDisburseResult;
    }
}

if (isset($_GET['getDisAppvById'])) {
    try {
        $dis_id = $_GET['getDisAppvById'];
        $disburseModel = new DisburseModel();
        $result = $disburseModel->getDataDisAppvById($dis_id);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['appv_disburse'])) {
    try {
        $type = htmlentities($_POST['type']);
        $dis_id = htmlentities($_POST['dis_id']);
        $dis_date = htmlentities($_POST['date']);
        $emp_id = $_SESSION['empData']->emp_id;


        $disburseModel = new DisburseModel();
        $materialModel = new materialModel();

        if ($type == '1') {
            $data_array = [
                'appv_date' => $dis_date,
                'dis_status' => 'อนุมัติแล้ว',
                'not_appv_why' => "",
                'emp_id' => $emp_id,
                'dis_id' => $dis_id
            ];

            $result = $disburseModel->appvDisburse($data_array);
            echo $result;
        } else {

            $not_appv_why = htmlentities($_POST['dis_not_approve']);
            $data_array = [
                'appv_date' => $dis_date,
                'dis_status' => 'ไม่ผ่านอนุมัติ',
                'not_appv_why' => $not_appv_why,
                'emp_id' => $emp_id,
                'dis_id' => $dis_id
            ];

            $result = $disburseModel->appvDisburse($data_array);

            if ($result == 1) {

                $Json_dis_detail = $disburseModel->getDataDisAppvById($dis_id);

                $arr_data = json_decode($Json_dis_detail);

                $result_del_log = $disburseModel->DeleteMatBudgetYearsLog($dis_id);

                for ($i = 0; $i < count($arr_data); $i++) {

                    $mat_id = $arr_data[$i]->mat_id;
                    $mat_quantity = $arr_data[$i]->quantity;

                    $data_array = [
                        'mat_quantity' => $mat_quantity,
                        'mat_id' => $mat_id
                    ];

                    $result_stock = $disburseModel->UpdateStockDisbruseMat($data_array);
                }

                echo $result_stock;
            } else {
                echo $result;
            }
        }
    } catch (Exception $e) {
        echo $e;
    }
}


if (isset($_GET['getDisburseEmp'])) {
    try {
        $disburseModel = new DisburseModel();
        $empId = $_SESSION['empData']->emp_id;
        $result = $disburseModel->getDisburseEmp($empId);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_GET['getDataDisburseWaiting'])) {
    try {
        $disburseModel = new DisburseModel();
        $result = $disburseModel->getDataDisStatusWaiting();
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_POST['ReportDisburse'])) {
    $disburseModel = new DisburseModel();

    $dis_id = htmlentities($_POST['dis_id']);
    $report_note = htmlentities($_POST['report_note']);

    $data_array = [
        'dis_id' => $dis_id,
        'report_note' => $report_note
    ];

    $result_report_disburse = $disburseModel->UpdateReportDisburse($data_array);
    echo $result_report_disburse ;
}
