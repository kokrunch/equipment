<?php

require_once('../models/BranchModel.php');

if (isset($_GET['getAllbranch'])) {
    $branchModel = new BranchModel();
    $result = $branchModel->getAllBranch();
    echo $result;
}


if (isset($_POST['addBranch'])) {
    try {
        $branchName = htmlentities($_POST['branch_name']);
        $branchModel = new BranchModel();
        $result = $branchModel->insertBranch($branchName);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_POST['EditBranch'])) {
    try {
        $branchId = $_POST['branch_id'];
        $branchName = htmlentities($_POST['branch_name']);
        $branchModel = new BranchModel();
        $result = $branchModel->updateBranch($branchName, $branchId);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_POST['deleteBranch'])) {
    try {
        $branchId = $_POST['branch_id'];
        $branchModel = new BranchModel();
        $dataEmp = $branchModel->getEmpWhereBranch($branchId);
        $dataEmpDecode = json_decode($dataEmp);
        if (count($dataEmpDecode) > 0) {
            echo "can't delete branch";
            exit;
        }
        $result = $branchModel->deleteBranch($branchId);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}
