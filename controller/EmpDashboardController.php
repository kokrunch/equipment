<?php 
session_start();

require_once('../models/EquipmentModel.php');
require_once('../models/Disbursemodel.php');
require_once('../utils/utils.php');

if(isset($_GET['ApproveCount'])) {
    $count = new EquipmentModel();
    $emp_id = $_SESSION['empData']->emp_id;
    $result = $count->ApproveCount($emp_id);
    echo $result;
}

if(isset($_GET['DisburseCount'])) {
    $count = new DisburseModel();
    $emp_id = $_SESSION['empData']->emp_id;
    $result = $count->DisburseCount($emp_id);
    echo $result;
}

if(isset($_GET['NotReturnCount'])) {
    $count = new EquipmentModel();
    $emp_id = $_SESSION['empData']->emp_id;
    $result = $count->NotReturnCount($emp_id);
    echo $result;
}

?>