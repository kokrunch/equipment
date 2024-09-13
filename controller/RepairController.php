<?php
session_start();
require_once("../utils/LineNotifyClass.php");
require_once("../models/RepairModel.php");
require_once("../models/EmployeeModel.php");


if (isset($_GET['getdatarepairequ'])) {
    $Repair = new RepairModel();
    $emp_id = $_SESSION['empData']->emp_id ;
    $result = $Repair->DataRepairEqu($emp_id);
    echo $result;
}

if (isset($_GET['getdatarepairequ_by_status'])) {
    $Repair = new RepairModel();
    $emp_id = $_SESSION['empData']->emp_id ;
    $status = $_GET['getdatarepairequ_by_status'];
    $data_array = [
        'emp_id' => $emp_id,
        'status' => $status ,
    ];
    $result = $Repair->DataRepairEquByStatus($data_array);
    echo $result;
}

if (isset($_GET['DataRepairEqu_by_techical'])) {
    $Repair = new RepairModel();
    $role_id = $_SESSION['empData']->sub_role_id ;
    $result = $Repair->DataRepairEqu_by_techical($role_id);
    echo $result;
}

if (isset($_GET['DataRepairEqu_by_officer'])) {
    $Repair = new RepairModel();
    $role_id = $_SESSION['empData']->sub_role_id ;
    $result = $Repair->DataRepairEqu_by_officer($role_id);
    echo $result;
}

if (isset($_GET['DataRepairEqu_by_status'])) {
    $Repair = new RepairModel();
    $role_id = $_SESSION['empData']->sub_role_id ;
    $status = $_GET['DataRepairEqu_by_status'];

    $data_array = [
        'role_id' => $role_id,
        'status' => $status ,
    ];

    $result = $Repair->DataRepairEqu_by_status($data_array);
    echo $result;
}

if (isset($_GET['getdatarepairother'])) {
    $Repair = new RepairModel();
    $result = $Repair->DataRepairOther();
    echo $result;
}


if (isset($_POST['addRepair'])) {
    
    $date_repair = htmlentities($_POST['date_repair']);
    $sec_repair =  htmlentities($_POST['sec_repair']);

    $equ_id = htmlentities($_POST['equ_id']);
    $repair_detail = htmlentities($_POST['repair_detail']);

    $repair_nes = htmlentities($_POST['repair_nes']);
    $repair_reason = htmlentities($_POST['repair_reason']);
    
    $emp_id = $_SESSION['empData']->emp_id ;

    $type_r = htmlentities($_POST['type_r']);

    if($repair_reason == "") {
        $repair_reason = "-" ;
    }

    $empModel = new EmployeeModel();
    $linenotify = new LineNotifyClass();
    $Repair = new RepairModel();

    $token_data = $empModel->getTokenByRoleId($sec_repair); //ข้อมูล Token ตามตำแหน่ง
    $decodeToken = json_decode($token_data);

    if ( $type_r  == 1) {
        $data_array = [
            'equ_id' => $equ_id,
            'repair_desc' => $repair_detail ,
            'repair_status' => "กำลังดำเนินการซ่อม" ,
            'date_repair' =>  $date_repair ,
            'repair_necessity' =>  $repair_nes ,
            'repair_reason' => $repair_reason,
            'emp_id' => $emp_id  ,
            'sec_repair' =>  $sec_repair
        ];

        $result = $Repair->addRepair($type_r,$data_array);

        if($result == 1) {
            if(count($decodeToken) > 0 ){
                $token = $decodeToken[0]->token;
                $emp_data = $empModel->getUserProfile($emp_id);
                $emp_decode = json_decode($emp_data);
                $emp_name = $emp_decode[0]->emp_firstname . " " . $emp_decode[0]->emp_lastname;
                if (count($emp_decode) != 0) {
                    $linenotify->writeMessageLineNotifyRepair($token,  $emp_name);
                    $arr_data_noti = [
                        "noti_title" => "แจ้งเตือนการแจ้งซ่อม",
                        "noti_detail" => "มีรายการแจ้งซ่อมครุภัณฑ์ 1 รายการ \nจากคุณ " .  $emp_name,
                        "token_id" => $decodeToken[0]->token_id
                    ];
                    $result = $empModel->insertNotification($arr_data_noti);

                    echo $result ;
                }
            } else {
                echo $result ;
            }
        };
    } else {
        $data_array = [
            'repair_desc' => $repair_detail ,
            'repair_status' => "กำลังดำเนินการซ่อม" ,
            'date_repair' =>  $date_repair ,
            'repair_necessity' =>  $repair_nes ,
            'repair_reason' => $repair_reason,
            'emp_id' => $emp_id  ,
            'sec_repair' =>  $sec_repair
        ];

        $result = $Repair->addRepair($type_r,$data_array);

        if($result == 1) {
            if(count($decodeToken) > 0 ){
                $token = $decodeToken[0]->token;
                $emp_data = $empModel->getUserProfile($emp_id);
                $emp_decode = json_decode($emp_data);
                $emp_name = $emp_decode[0]->emp_firstname . " " . $emp_decode[0]->emp_lastname;
                if (count($emp_decode) != 0) {
                    $linenotify->writeMessageLineNotifyRepair($token,  $emp_name);
                    $arr_data_noti = [
                        "noti_title" => "แจ้งเตือนการแจ้งซ่อม",
                        "noti_detail" => "มีรายการแจ้งซ่อมครุภัณฑ์ 1 รายการ \nจากคุณ " .  $emp_name,
                        "token_id" => $decodeToken[0]->token_id
                    ];
                    $result = $empModel->insertNotification($arr_data_noti);

                    echo $result ;
                }
            } else {
                echo $result ;
            }
        };
    }
    

}

if (isset($_POST['addRepairother'])) {
    
    $repair_date = htmlentities($_POST['repair_date']);
    $repair_title = htmlentities($_POST['repair_title']);
    $repair_desc = htmlentities($_POST['repair_desc']);
    $repair_nes = htmlentities($_POST['repair_nes']);
    $repair_reason = htmlentities($_POST['repair_reason']);
    $emp_id = $_SESSION['empData']->emp_id ;
    
    $data_array = [
        'repair_title' => $repair_title ,
        'repair_desc' => $repair_desc ,
        'repair_status' => "รอดำเนินการซ่อม" ,
        'repair_date' =>  $repair_date ,
        'repair_necessity' =>  $repair_nes ,
        'repair_reason' => $repair_reason,
        'emp_id' => $emp_id 
    ];

    $Repair = new RepairModel();
    $result = $Repair->addRepairOther($data_array);

    echo $result ;
}

if (isset($_GET['accept_repair_equ'])) {

    $repair_id = $_GET['accept_repair_equ'];
    $emp_id = $_SESSION['empData']->emp_id ;

    $data_array = array(
        'emp_id' => $emp_id , 
        'repair_id' => $repair_id , 
    );

    $Repair = new RepairModel();
    $result = $Repair->AcceptRepairEqu($data_array);

    echo $result ;
}

if (isset($_POST['cancelRepairEqu'])) {

    $repair_id = htmlentities($_POST['repair_id']);
    $repair_note = htmlentities($_POST['repair_note']);
    $emp_id = $_SESSION['empData']->emp_id ;

    $data_array = array(
        'repair_note' => $repair_note ,
        'emp_id' => $emp_id , 
        'repair_id' => $repair_id , 
    );
    
    $Repair = new RepairModel();
    $result = $Repair->CancelRepairEqu($data_array);

    echo $result ;
}

if (isset($_POST['StartRepairEqu'])) {

    $star_date = htmlentities($_POST['star_date']);
    $deadline_date = htmlentities($_POST['deadline_date']);
    $repair_id = htmlentities($_POST['repair_id']);
    $emp_id = $_SESSION['empData']->emp_id ;

    $data_array = array(
        'repair_fixing_date' => $star_date ,
        'repair_deadline_date' => $deadline_date ,
        'emp_id' => $emp_id , 
        'repair_id' => $repair_id , 
    );
    
    $Repair = new RepairModel();
    $result = $Repair->StartRepairEqu($data_array);

    echo $result ;
}

if (isset($_POST['FinishRepairEqu'])) {

    $repair_result = htmlentities($_POST['repair_result']);
    $repair_id = htmlentities($_POST['repair_id']);
    $emp_id = $_SESSION['empData']->emp_id ;

    $data_array = array(
        'repair_result' => $repair_result ,
        'emp_id' => $emp_id , 
        'repair_id' => $repair_id , 
    );
    
    $Repair = new RepairModel();
    $result = $Repair->FinishRepairEqu($data_array);

    echo $result ;
}

if (isset($_GET['EmpApproveCount'])) {
    $Repair = new RepairModel();
    $emp_id = $_SESSION['empData']->emp_id;
    $result = $Repair->EmpApproveCount($emp_id);
    echo $result;
}


if (isset($_GET['EmpRepairCount'])) {
    $Repair = new RepairModel();
    $emp_id = $_SESSION['empData']->emp_id;
    $result = $Repair->EmpRepairCount($emp_id);
    echo $result;
}

if (isset($_GET['EmpFinishRepairCount'])) {
    $Repair = new RepairModel();
    $emp_id = $_SESSION['empData']->emp_id;
    $result = $Repair->EmpFinishRepairCount($emp_id);
    echo $result;
}


if (isset($_GET['accept_repair_other'])) {

    $repair_id = $_GET['accept_repair_other'];
    $emp_id = $_SESSION['empData']->emp_id ;

    $data_array = array(
        'emp_id' => $emp_id , 
        'repair_other_id' => $repair_id , 
    );

    $Repair = new RepairModel();
    $result = $Repair->AcceptRepairOther($data_array);

    echo $result ;
}

if (isset($_POST['cancelRepairOther'])) {

    $repair_id = htmlentities($_POST['repair_other_id']);
    $repair_note = htmlentities($_POST['repair_note']);
    $emp_id = $_SESSION['empData']->emp_id ;

    $data_array = array(
        'repair_note' => $repair_note ,
        'emp_id' => $emp_id , 
        'repair_other_id' => $repair_id , 
    );
    
    $Repair = new RepairModel();
    $result = $Repair->CancelRepairOther($data_array);

    echo $result ;
}

if (isset($_POST['StartRepairOther'])) {

    $star_date = htmlentities($_POST['fixing_date']);
    $deadline_date = htmlentities($_POST['deadline_date']);
    $repair_other_id = htmlentities($_POST['repair_other_id']);
    $emp_id = $_SESSION['empData']->emp_id ;

    $data_array = array(
        'repair_other_fixing_date' => $star_date ,
        'repair_other_deadline_date' => $deadline_date ,
        'emp_id' => $emp_id , 
        'repair_other_id' => $repair_other_id , 
    );
    
    $Repair = new RepairModel();
    $result = $Repair->StartRepairOther($data_array);

    echo $result ;
}

if (isset($_POST['FinishRepairOther'])) {

    $repair_result = htmlentities($_POST['repair_result']);
    $repair_other_id = htmlentities($_POST['repair_other_id']);
    $emp_id = $_SESSION['empData']->emp_id ;

    $data_array = array(
        'repair_result' => $repair_result ,
        'emp_id' => $emp_id , 
        'repair_other_id' => $repair_other_id , 
    );
    
    $Repair = new RepairModel();
    $result = $Repair->FinishRepairOther($data_array);

    echo $result ;
}

if (isset($_GET['getDataRoleTechnical'])) {
    $Repair = new RepairModel();
    $result = $Repair->getDataRoleTechnical();
    echo $result;
}

if (isset($_POST['sendRepair'])) {

    $repair_id = htmlentities($_POST['repair_id']);
    $send_repair_company = htmlentities($_POST['send_repair_company']);
    $emp_id = $_SESSION['empData']->emp_id ;

    $data_array = array(
        'send_repair_company' => $send_repair_company ,
        'emp_send_id' => $emp_id , 
        'repair_id' => $repair_id , 
    );

    $data_array_up = array(
        'emp_approve' => $emp_id , 
        'repair_id' => $repair_id , 
    );
    
    $Repair = new RepairModel();
    $result = $Repair->SendRepair($data_array,$data_array_up);

    echo $result ;
}

if (isset($_GET['getdatarepairCountWating'])) {
    $Repair = new RepairModel();
    $result = $Repair->RepairCountWating();
    echo $result;
}

if (isset($_GET['getdataborrowCountWating'])) {
    $Repair = new RepairModel();
    $result = $Repair->BorrowCountWating();
    echo $result;
}
?>