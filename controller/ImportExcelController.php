<?php
require_once("../models/ImportExcelModel.php");
require_once('../models/EquipmentModel.php');
require_once('../models/BudgetYearModel.php');
require_once('../models/EquipmentBudgetYearModel.php');
require_once('../models/StockModel.php');
require_once('../models/MaterialModel.php');
require_once('../models/MaterialbudgetyearModel.php');
require_once('../models/EquipmentTypeModel.php');

if (isset($_POST["addEquFromImport"])) {

  $file = $_FILES["file"]["tmp_name"];
  $file_open = fopen($file, "r");
  $length = 0;
  $arr_data_all = [];

  if ($file_open) {
    while (!feof($file_open)) {
      $data = fgetcsv($file_open);
      array_push($arr_data_all, $data);
      $length = $length + 1;
    }

    $euipmentModel = new EquipmentModel();
    $budgetYearModel = new BudgetYearModel();
    $EquBudModel = new EquipmentBudgetYearModel();
    $stockModel = new stockModel();

    $resultBudget =  $budgetYearModel->getBudgetYearWhereActive();
    $jsonBudgetYear = json_decode($resultBudget);
    $budget_id = $jsonBudgetYear[0]->budget_id;

    print_r($arr_data_all);

    $arr_data_csv = [];

    $result = 0;
    for ($i = 0; $i < ($length - 1); $i++) {
      array_push($arr_data_csv, $arr_data_all[$i]);

      $array_equipment = array(
        'equ_name' => $arr_data_all[$i][0],
        'equ_brand' => $arr_data_all[$i][2],
        'equ_model' => $arr_data_all[$i][3],
        'equ_detail' => $arr_data_all[$i][4],
        'equ_color' => $arr_data_all[$i][5],
        'equ_serail_no' => $arr_data_all[$i][6],
        'equ_status' => 'ใช้งานได้',
        'equ_type_id' => $arr_data_all[$i][1],
        'equ_owner' => $arr_data_all[$i][7]
      );


      $equ_id = $euipmentModel->insertEquipment($array_equipment);

      $array_equ_budget = [
        'equ_price' => $arr_data_all[$i][7],
        'equ_stock' => $arr_data_all[$i][8],
        'equ_id' => $equ_id,
        'budget_id' => $budget_id,
        'equ_date_income' => $arr_data_all[$i][9],
        'equ_expire_date' => $arr_data_all[$i][10],
      ];

      $insertEqubud = $EquBudModel->insertEquipmentBudgetYear($array_equ_budget);

      $arrStockData = [
        "equ_id" => $equ_id,
        "equ_stock" => $arr_data_all[$i][8]
      ];

      $result = $stockModel->insertStockEqu($arrStockData);
    }

    echo $result;

    //echo json_encode($arr_data_csv);
    fclose($file_open);
  } else {
    echo "File not Found!";
  }
}

if (isset($_POST["addMatFromImport"])) {

  $file = $_FILES["file"]["tmp_name"];
  $file_open = fopen($file, "r");
  $length = 0;
  $arr_data_all = [];

  $result = 0;
  if ($file_open) {
    while (!feof($file_open)) {
      $data = fgetcsv($file_open);
      array_push($arr_data_all, $data);
      $length = $length + 1;
    }

    $MaterialModel = new MaterialModel();
    $budgetYearModel = new BudgetYearModel();
    $MatBudModel = new MaterialBudgetYearModel();
    $stockModel = new stockModel();

    $resultBudget =  $budgetYearModel->getBudgetYearWhereActive();
    $jsonBudgetYear = json_decode($resultBudget);
    $budget_id = $jsonBudgetYear[0]->budget_id;

    $arr_data_csv = [];

    $result = 0;
    for ($i = 0; $i < ($length - 1); $i++) {
      array_push($arr_data_csv, $arr_data_all[$i]);

      $data_array = array(
        'mat_name' => $arr_data_all[$i][0],
        'mat_type_id' => $arr_data_all[$i][1],
        'mat_brand' => $arr_data_all[$i][2],
        'mat_unit_id' => $arr_data_all[$i][3],
      );

      $resul_insert = $MaterialModel->insertMaterial($data_array);
      $result_decode = json_decode($resul_insert);

      $material_id = $result_decode[0]->mat_id;

      if ($material_id) {

        $data_array_budget = array(
          'mat_id' => $material_id,
          'mat_price' => $arr_data_all[$i][5],
          'mat_stock' => $arr_data_all[$i][6],
          'mat_date_income' => $arr_data_all[$i][4],
          'budget_id' => $budget_id,
        );

        $result_budget = $MaterialModel->AddMeterialBudgetYear($data_array_budget);

        if ($result_budget) {

          $data_array_stock = array(
            'mat_id' => $material_id,
            'mat_quantity' => $arr_data_all[$i][6],
          );

          $result = $stockModel->AddStockMaterialBudget($data_array_stock);

          if ($result) {
            // echo $result_stock_add;
          } else {
            echo "error adding material_budget_stock";
          }
        } else {
          echo "error adding material_budget";
        }
      } else {
        echo "error adding material";
      }
    }

    echo $result;

    //echo json_encode($arr_data_csv);
    fclose($file_open);
  } else {
    echo "File not Found!";
  }
}



if (isset($_POST["testCSV"])) {

  $file = $_FILES["file"]["tmp_name"];
  $file_name = $_FILES["file"]["name"];
  $file_type = explode(".", $file_name);
  if ($file_type[1] != "csv" && $file_type[1] != "CSV") {
    echo "invalid file type";
    exit;
  }
  $file_open = fopen($file, "r");
  $length = 0;
  $arr_data_all = [];

  if ($file_open) {
    while (!feof($file_open)) {
      $data = fgetcsv($file_open);
      array_push($arr_data_all, $data);
      $length = $length + 1;
    }

    $euipmentModel = new EquipmentModel();
    $equipmentTypeModel = new EquipmentTypeModel();
    $budgetYearModel = new BudgetYearModel();
    $EquBudModel = new EquipmentBudgetYearModel();
    $stockModel = new stockModel();

    $resultBudget =  $budgetYearModel->getBudgetYearWhereActive();
    $jsonBudgetYear = json_decode($resultBudget);
    $budget_id = $jsonBudgetYear[0]->budget_id;

    $lastTypeId = 0;
    $result_import = 0;
    for ($i = 0; $i < count($arr_data_all) - 1; $i++) {
      if ($i > 4) {

        $checkIsType = (int)$arr_data_all[$i][0];
        if ($checkIsType == 0) {
          $resultType =  $equipmentTypeModel->checkEquTypeInDB($arr_data_all[$i][0]);
          $lastTypeId = checkInsertNewEquType($resultType, $arr_data_all[$i][0], $arr_data_all[$i]);
        }

        if ($checkIsType != 0) {
          $array_equipment = array(
            'equ_code' => $arr_data_all[$i][2],
            'equ_name' => $arr_data_all[$i][1],
            'equ_status' => 'ปกติ',
            'equ_type_id' => $lastTypeId,
            'equ_owner' => $arr_data_all[$i][7]
          );

          $equ_id = $euipmentModel->insertEquipmentForCSV($array_equipment);
          $array_equ_budget = [
            'equ_price' => floatval(str_replace(",", "", $arr_data_all[$i][6])),
            'equ_stock' => 1,
            'equ_id' => $equ_id,
            'budget_id' => $budget_id,
            'equ_date_income' => $arr_data_all[$i][3]
          ];

          $insertEqubud = $EquBudModel->insertEquipmentBudgetYearForCSV($array_equ_budget);

          $arrStockData = [
            "equ_id" => $equ_id,
            "equ_stock" => 1
          ];

          $result = $stockModel->insertStockEqu($arrStockData);
          $result_import = $result;
          if ($result_import == 0) {
            echo "error impoer CSV";
            exit();
          }
        }
      }
    }

    echo $result_import;
    //echo json_encode($arr_data_csv);
    fclose($file_open);
  } else {
    echo "File not Found!";
  }
}

function checkInsertNewEquType($resultType, $type_name)
{
  $equipmentTypeModel = new EquipmentTypeModel();
  $countCheckTypeEqu = count($resultType);
  if ($countCheckTypeEqu == 0) {
    $lastType_id = $equipmentTypeModel->inseretEquType($type_name);
    // $array_equipment = array(
    //   'equ_code' => $arr_data_all[2],
    //   'equ_name' => $arr_data_all[1],
    //   'equ_status' => 'ปกติ',
    //   'equ_type_id' => $lastType_id
    // );

    // print_r($array_equipment);
    return $lastType_id;
  } else {
    // $array_equipment = array(
    //   'equ_code' => $arr_data_all[2],
    //   'equ_name' => $arr_data_all[1],
    //   'equ_status' => 'ปกติ',
    //   'equ_type_id' => $resultType[0]["type_id"]
    // );
    // print_r($array_equipment);
    return $resultType[0]["type_id"];
  }
}
