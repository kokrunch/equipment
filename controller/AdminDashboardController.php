<?php

require_once('../models/AdminDashboardModel.php');
require_once('../models/employeeModel.php');
require_once('../models/EquipmentModel.php');

if (isset($_GET['countDisburse'])) {
    $countdisburse = new AdminDashboardModel();
    $result = $countdisburse->getCountDisburse();
    echo $result;
}

if (isset($_GET['countRepair'])) {
    $countrepair = new AdminDashboardModel();
    $result = $countrepair->getCountRepair();
    echo $result;
}

if (isset($_GET['countEquipment'])) {
    $countequipment = new EquipmentModel();
    $result = $countequipment->getCountEquipment();
    echo $result;
}

if (isset($_GET['countMaterial'])) {
    $countmaterial = new AdminDashboardModel();
    $result = $countmaterial->getCountMaterial();
    echo $result;
}

if (isset($_GET['countGoodEqu'])) {
    $countgoodequ = new EquipmentModel();
    $result = $countgoodequ->getGoodEqu();
    echo $result;
}

if (isset($_GET['countBadEqu'])) {
    $countbadequ = new EquipmentModel();
    $result = $countbadequ->getBadEqu();
    echo $result;
}

if (isset($_GET['countEmp'])) {
    $countEmp = new EmployeeModel();
    $result = $countEmp->getCountEmp();
    echo $result;
}

