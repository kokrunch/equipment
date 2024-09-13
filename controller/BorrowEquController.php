<?php
session_start();
require_once("../models/BorrowEquModel.php");
require_once("../models/EquipmentModel.php");
require_once("../models/RoomModel.php");
include('../utils/LineNotifyClass.php');
date_default_timezone_set('Asia/Bangkok');

if (isset($_GET['getBorrowEqu'])) {
    $borrowEquModel = new BorrowEquModel();
    $result = $borrowEquModel->getAllBorrowEqu();
    echo $result;
}

if (isset($_POST['A_borrow'])) {
    try {
        $approveborrow = new BorrowEquModel();

        $borrow_id = $_POST['borrow_id'];
        $emp_id = $_SESSION["empData"]->emp_id;
        $date = date('d-m-y h:i:s');


        $array_approve_borrow = array(
            'emp_id' => $emp_id,
            'borrow_approve_date' => $date,
            'borrow_approve_status' => 'อนุมัติแล้ว',
            'borrow_status' => 'กำลังยืม',
            'borrow_id' => $borrow_id

        );

        $result = $approveborrow->ApproveBorrow($array_approve_borrow);
        if ($result == 1) {
            $getBorrowId = $approveborrow->getBorrowId($borrow_id);
            $result_borrow = json_decode($getBorrowId);

            if (isset($result_borrow[0]->room_desc_equ_id)) {
                $array_update = array(
                    'use_status' => '1',
                    'room_desc_equ_id' => $result_borrow[0]->room_desc_equ_id
                );
                $result = $approveborrow->updateUseStatus($array_update);
            }
            echo $result;
        }
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_POST['Approve_b'])) {
    $borrow_id = $_POST['borrow_id'];
    $disa_approve_borrow = $_POST['desc_a_borrow'];
    $emp_id = $_SESSION["empData"]->emp_id;
    $date = date('d-m-y h:i:s');
    $equ_id = $_POST['equ_id'];
    $borrow_quantity = $_POST['borrow_quantity'];

    $array_approve_borrow = array(
        'emp_id' => $emp_id,
        'borrow_approve_date' => $date,
        'borrow_approve_status' => 'ไม่ผ่านอนุมัติ',
        'disa_approve_borrow' => $disa_approve_borrow,
        'borrow_id' => $borrow_id
    );


    $disaapproveborrow = new BorrowEquModel();
    $result = $disaapproveborrow->DisaApproveBorrow($array_approve_borrow);
    if ($result == 1) {
        $result = $disaapproveborrow->updateReTurnBorrow($equ_id, $borrow_quantity);
        echo $result;
    } else {
        echo "can not ";
    }
}

if (isset($_GET['getDataBorrowWaiting'])) {
    $borrow = new BorrowEquModel();
    $result = $borrow->getDataBorrowWaiting();
    echo $result;
}

if (isset($_POST['addReturnEqu'])) {
    try {

        $Equipment = new borrowEquModel();
        $updatestock = new borrowEquModel();

        $equ_id = htmlentities($_POST['equ_id']);
        $borrow_id = htmlentities($_POST['borrow_id']);
        $return_quantity = htmlentities($_POST['return_quantity']);
        $return_date = htmlentities($_POST['return_date']);
        $return_detail = htmlentities($_POST['return_detail']);
        $emp_id = $_SESSION['empData']->emp_id;

        $data_array = [
            'return_date' => $return_date,
            'emp_id' => $emp_id,
            'borrow_id' => $borrow_id,
            'return_detail' => $return_detail,
            'return_quantity' => $return_quantity
        ];

        $result = $Equipment->ReturnEqu($data_array);

        $data_stock = [
            'return_quantity' => $return_quantity,
            'equ_id' => $equ_id
        ];

        if ($result == 1) {
            $result = $updatestock->updateReTurn($data_stock);
            $result = $Equipment->UpdateStatusBorrow($borrow_id);
            $getBorrowId = $Equipment->getBorrowId($borrow_id);
            $result_borrow = json_decode($getBorrowId);

            if (isset($result_borrow[0]->room_desc_equ_id)) {
                $array_update = array(
                    'use_status' => '0',
                    'room_desc_equ_id' => $result_borrow[0]->room_desc_equ_id
                );
                $result = $Equipment->updateNotUseStatus($array_update);
            }
            echo $result;
        }



        // if ($result == 1) {
        //     $result = $updatestock->updateReTurn($data_stock);
        //     $result = $Equipment->UpdateStatusBorrow($borrow_id);
        //     $result = $Equipment->updateNotUseStatus($array_update, $room_desc_equ_id);
        //     echo $result;
        // }
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_POST['addBorrow'])) {
    try {

        $Borrow = new borrowEquModel();

        $equ_id = htmlentities($_POST['equ_id']);
        $borrow_quantity = htmlentities($_POST['borrow_quantity']);
        $borrow_date = htmlentities($_POST['borrow_date']);
        $return_date = htmlentities($_POST['borrow_return_date']);
        $borrow_description = htmlentities($_POST['borrow_description']);
        $room_select = htmlentities($_POST['room_select']);
        $emp_id = $_SESSION['empData']->emp_id;
        $outdoor_des = htmlentities($_POST['outdoor_des']);


        $data_room = array(
            'room_id' => $room_select,
            'equ_id' => $equ_id,
            'quantity' => $borrow_quantity,
            'use_status' => "0"
        );

        if ($room_select != 0) {
            $room_desc_id = $Borrow->AddEquToRoom($data_room);
            $data_borrow = array(
                'borrow_quantity' => $borrow_quantity,
                'borrow_description' => $borrow_description,
                'borrow_date' => $borrow_date,
                'borrow_return_date' => $return_date,
                'approve_status' => "รออนุมัติ",
                'room_id' => $room_desc_id,
                'equipment_id' => $equ_id,
                'emp_id' => $emp_id,
            );
        } else {
            $data_borrow = array(
                'borrow_quantity' => $borrow_quantity,
                'borrow_description' => $borrow_description,
                'borrow_date' => $borrow_date,
                'borrow_return_date' => $return_date,
                'approve_status' => "รออนุมัติ",
                'br_use_to' => $outdoor_des,
                'equipment_id' => $equ_id,
                'emp_id' => $emp_id,
            );
        }

        $result = $Borrow->addBorrow($data_borrow, $room_select);

        if ($result == 1) {
            $result = $Borrow->updateStockAfterBorrow($equ_id, $borrow_quantity);
            echo $result;

            //notification line
            $empModel = new EmployeeModel();
            $linenotify = new LineNotifyClass();

            $role_id = 4;
            $token_data = $empModel->getTokenByRoleId($role_id); //ข้อมูล Token ตามตำแหน่ง

            $emp_data = $empModel->getUserProfile($emp_id); // ข้อมูลผู้ขอยืม

            $decodeToken = json_decode($token_data);
            $emp_decode = json_decode($emp_data);

            if (count($decodeToken) > 0) {
                $emp_name = $emp_decode[0]->emp_firstname . " " . $emp_decode[0]->emp_lastname;

                $token = $decodeToken[0]->token;
                $linenotify->writeMessageLineNotifyEqu($token,  $emp_name);
                $arr_data_noti = [
                    "noti_title" => "แจ้งเตือนยืมครุภัณฑ์",
                    "noti_detail" => "มีรายการยืมครุภัณฑ์เข้ามา 1 รายการ \nจากคุณ " .  $emp_name,
                    "token_id" => $decodeToken[0]->token_id
                ];
                $result = $empModel->insertNotification($arr_data_noti);
            }
        }
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_GET['getBorrowlist'])) {
    $euipment = new borrowEquModel();
    $status = htmlentities($_GET['status']);
    $emp_id = $_SESSION['empData']->emp_id;
    $data_array = array(
        'status' => $status,
        'emp_id' => $emp_id
    );
    $result = $euipment->getBorrowlist($data_array);
    echo $result;
}


if (isset($_POST['cancelBorrow'])) {
    try {
        $borrow_id = $_POST['borrow_id'];
        $equ_id = htmlentities($_POST['equ_id']);
        $borrow_quantity = htmlentities($_POST['borrow_quantity']);

        $Equipment = new borrowEquModel();
        $result = $Equipment->cancleBorrow($borrow_id);

        if ($result == 1) {
            $getBorrowId = $Equipment->getBorrowId($borrow_id);
            $result_borrow = json_decode($getBorrowId);

            if (isset($result_borrow[0]->room_desc_equ_id)) {
                $cancle_room = array(
                    'room_desc_equ_id' => $result_borrow[0]->room_desc_equ_id
                );
                $result = $Equipment->cancleBorrowToRoom($cancle_room);
            }

            $result = $Equipment->updateReTurnBorrow($equ_id, $borrow_quantity);
            echo $result;
        }
        // print_r($equ_id);
    } catch (Exception $th) {
        echo $th;
    }
}


if (isset($_GET['getAllBorrowlist'])) {
    $euipment = new borrowEquModel();
    $result = $euipment->getAllBorrowlist();
    echo $result;
}

if (isset($_GET['getAllReturnlist'])) {
    $euipment = new borrowEquModel();
    $result = $euipment->getAllReturnlist();
    echo $result;
}

if (isset($_GET['getAllBorrowed'])) {
    $euipment = new borrowEquModel();
    $result = $euipment->getAllBorrowed();
    echo $result;
}

if (isset($_GET['getAllRoom'])) {
    $room = new RoomModel();
    $result = $room->getAllRoom();
    echo $result;
}

if (isset($_GET['getDataEquWaitingReturn'])) {
    $equipment = new borrowEquModel();
    $result = $equipment->getDataEquWaitingReturn();
    echo $result;
}
