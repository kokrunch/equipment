<?php
include('../models/MaterialModel.php');
include('../models/Disbursemodel.php');
include('../models/RoomModel.php');
require_once('../models/BudgetYearModel.php');
require_once('../models/StockModel.php');
include('../utils/utils.php');
require_once('../models/MaterialbudgetyearModel.php');

if (isset($_GET['gettypemat'])) {
    $type_material = new MaterialModel();
    $result = $type_material->getTypeMaterial();
    echo $result;
}

if (isset($_GET['getmat'])) {
    $material = new MaterialModel();
    $result = $material->getMaterial();
    echo $result;
}

if (isset($_GET['getunitmat'])) {
    $unit_material = new MaterialModel();
    $result = $unit_material->getUnitMaterial();
    echo $result;
}

if (isset($_GET['getunitmatbyid'])) {
    $material = new MaterialModel();
    $data_mat_id = $_GET['getunitmatbyid'];
    $result = $material->getMaterialById($data_mat_id);
    echo $result;
}

if (isset($_POST['addMat'])) {
    try {
        $budgetYearModel = new BudgetYearModel();
        $MaterialModel = new MaterialModel();
        $StockModel = new StockModel();

        $mat_name = htmlentities($_POST['mat_name']);
        $mat_type_id = htmlentities($_POST['mat_type_id']);
        $mat_brand = htmlentities($_POST['mat_brand']);
        $mat_unit_id = htmlentities($_POST['mat_unit_id']);

        $mat_price = htmlentities($_POST['mat_price']);
        $mat_budget_year = htmlentities($_POST['mat_budget_year']);
        $mat_quan = htmlentities($_POST['mat_quan']);
        $mat_date_income = htmlentities($_POST['mat_date_income']);

        $mat_id = htmlentities($_POST['mat_id_for_add']);

        $resultBudget =  $budgetYearModel->getBudgetYearWhereActive();
        $jsonBudgetYear = json_decode($resultBudget);
        $budget_id = $jsonBudgetYear[0]->budget_id;


        if ($mat_id == 0) {
            $data_array = array(
                'mat_name' => $mat_name,
                'mat_type_id' => $mat_type_id,
                'mat_brand' => $mat_brand,
                'mat_unit_id' => $mat_unit_id,
            );

            $result = $MaterialModel->insertMaterial($data_array);
            $result_decode = json_decode($result);

            $material_id = $result_decode[0]->mat_id;

            if ($material_id) {

                $data_array_budget = array(
                    'mat_id' => $material_id,
                    'mat_price' => $mat_price,
                    'mat_stock' => $mat_quan,
                    'budget_id' => $budget_id,
                    'mat_date_income' => $mat_date_income,
                    'budget_id' => $mat_budget_year,
                );

                $result_budget = $MaterialModel->AddMeterialBudgetYear($data_array_budget);

                if ($result_budget) {

                    $data_array_stock = array(
                        'mat_id' => $material_id,
                        'mat_quantity' => $mat_quan,
                    );

                    $result_stock_add = $StockModel->AddStockMaterialBudget($data_array_stock);

                    if ($result_stock_add) {
                        echo $result_stock_add;
                    } else {
                        echo "error adding material_budget_stock";
                    }
                } else {
                    echo "error adding material_budget";
                }
            } else {
                echo "error adding material";
            }
        } else {

            $data_array_budget = array(
                'mat_id' => $mat_id,
                'mat_price' => $mat_price,
                'mat_stock' => $mat_quan,
                'budget_id' => $budget_id,
                'mat_date_income' => $mat_date_income,
                'budget_id' => $mat_budget_year,
            );

            $result_budget = $MaterialModel->AddMeterialBudgetYear($data_array_budget);

            if ($result_budget) {

                $data_array_stock = array(
                    'mat_id' => $mat_id,
                    'mat_quantity' => $mat_quan,
                );

                $result_stock = $StockModel->updateStockMaterialBudget($data_array_stock);
                echo $result_stock;
            } else {
                echo "error adding material_budget";
            }
        }
    } catch (\Throwable $th) {
        echo $th;
    }
}

if (isset($_POST['updateMat'])) {

    $material_id = htmlentities($_POST['material_id']);
    $mat_name = htmlentities($_POST['mat_name']);
    $mat_type_id = htmlentities($_POST['mat_type_id']);
    $mat_brand = htmlentities($_POST['mat_brand']);
    $mat_unit_id = htmlentities($_POST['mat_unit_id']);


    $data_array = array(
        'mat_name' => $mat_name,
        'mat_type_id' => $mat_type_id,
        'mat_brand' => $mat_brand,
        'mat_unit_id' => $mat_unit_id,
        'material_id' => $material_id,
    );

    $MaterialModel = new MaterialModel();
    $result = $MaterialModel->updateMaterial($data_array);
    echo $result;
}

if (isset($_GET['delmat'])) {
    $material = new MaterialModel();
    $disburse = new DisburseModel();
    $room = new RoomModel();

    $data_mat_id = $_GET['delmat'];
    $data = array('mat_id' => $data_mat_id);

    // เช็คในรายการเบิกวัสดุ
    $result_check_disb = $disburse->getDataDisAppvByMatID($data);
    $res_check_disb = json_decode($result_check_disb);

    if (count($res_check_disb) <= 0) { //ไม่มีในบิล
        $result_check_stock = $material->getMaterialById($data_mat_id);
        $res_check_stock =  json_decode($result_check_stock);

        if ($res_check_stock[0]->mat_stock == 0) { //ไม่มีสต๊อก
            $result_delete_mat = $material->deleteMaterial($data);
            echo $result_delete_mat;
        } else {
            echo "2"; //this materials are already item in stock
        }
    } else {
        echo "3"; //this material have in a disbruse
    }
}

if (isset($_POST['insertMatType'])) {
    try {
        $type_name = htmlentities($_POST['type_name']);
        $MaterialModel = new MaterialModel();

        $data = array('type_name' => $type_name);
        $result = $MaterialModel->insertMaterialType($data);
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}

if (isset($_GET['deleteMatType'])) {
    $material = new MaterialModel();
    $MatType_id = $_GET['deleteMatType'];
    $data = array('type_id' => $MatType_id);

    $check_mat = $material->CheckMatByTypeMat($MatType_id);
    $check_mat_decode = json_decode($check_mat);

    if (count($check_mat_decode) > 0) {
        echo "2"; // ประเภทวัสดุนี้ถูกใช้งานอยู่
    } else {
        $result = $material->deleteMaterialType($data);
        echo $result;
    }
}

if (isset($_POST['updateMatType'])) {
    try {

        $update_type_name = htmlentities($_POST['update_type_name']);
        $matType_id = htmlentities($_POST['matType_id']);
        $MaterialModel = new MaterialModel();

        $data = array(
            'update_type_name' => $update_type_name,
            'matType_id' => $matType_id
        );

        $result = $MaterialModel->updateMaterialType($data);
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}

if (isset($_GET['getTypeMatid'])) {
    $Equipment = new MaterialModel();
    $type_id = $_GET['getTypeMatid'];
    $result = $Equipment->getMatTypeId($type_id);
    echo $result;
}


if (isset($_GET['getMatBudget'])) {
    $materialBudgteModel = new MaterialBudgetYearModel();
    $result = $materialBudgteModel->getMatBudget();
    echo $result;
}


if (isset($_GET['getaccmat'])) {
    try {
        $mat_id = $_GET['mat_id'];
        $acc_dis_mat_Model =  new MaterialModel();

        $PayResult = $acc_dis_mat_Model->getQueryMatDisburseAccount($mat_id);
        $jsonPay = json_decode($PayResult);

        echo $PayResult;
    } catch (Exception $e) {
        echo $e;
    }
}
