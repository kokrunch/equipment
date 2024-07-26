<?php

session_start();

require_once('../models/EquipmentModel.php');
require_once('../models/BorrowEquModel.php');
require_once('../models/BudgetYearModel.php');
require_once('../utils/utils.php');
require_once('../models/EquipmentBudgetYearModel.php');
require_once('../models/StockModel.php');

if (isset($_GET['getEqu'])) {
    $euipment = new EquipmentModel();
    $budgetYearModel = new BudgetYearModel();

    $resultBudget =  $budgetYearModel->getBudgetYearWhereActive();
    $jsonBudgetYear = json_decode($resultBudget);

    $resultEqu = $euipment->getAllEquipment();
    $jsonEqu = json_decode($resultEqu);
    $arrResult = [
        "BudgetYear" => $jsonBudgetYear,
        "Equ" => $jsonEqu
    ];

    echo json_encode($arrResult);
}

if (isset($_GET['getEquType'])) {
    $euipment = new EquipmentModel();
    $result = $euipment->getEquipmentType();
    echo $result;
}

if (isset($_POST['addEqu'])) {
    try {

        $uploadResult = "";
        $euipmentModel = new EquipmentModel();
        $budgetYearModel = new BudgetYearModel();
        $EquBudModel = new EquipmentBudgetYearModel();
        $stockModel = new stockModel();

        $resultBudget =  $budgetYearModel->getBudgetYearWhereActive();
        $jsonBudgetYear = json_decode($resultBudget);
        $budget_id = $jsonBudgetYear[0]->budget_id;

        $equ_code = htmlentities($_POST['equ_code']);
        $equ_name = htmlentities($_POST['equ_name']);
        $equ_type_id = htmlentities($_POST['equ_type_id']);
        $equ_brand = htmlentities($_POST['equ_brand']);
        $equ_model = htmlentities($_POST['equ_model']);
        $equ_detail = htmlentities($_POST['equ_detail']);
        $equ_serail_no = htmlentities($_POST['equ_serail_no']);
        $equ_price = htmlentities($_POST['equ_price']);
        $equ_date_income = htmlentities($_POST['equ_date_income']);
        $equ_expire_date = htmlentities($_POST['equ_expire_date']);
        $equ_color = htmlentities($_POST['equ_color']);
        $equ_stock = htmlentities($_POST['equ_stock']);
        $equ_date_income = ConvertDate($equ_date_income);
        $equ_owner = htmlentities($_POST['equ_owner']);

        if (isset($_POST['equ_id'])) {
            $equ_id = $_POST['equ_id'];
            $array_equ_budget = [
                'equ_price' => $equ_price,
                'equ_stock' => $equ_stock,
                'equ_id' => $equ_id,
                'budget_id' => $budget_id,
                'equ_date_income' => $equ_date_income,
                'equ_expire_date' => $equ_expire_date,
            ];

            $insertEqubud = $EquBudModel->insertEquipmentBudgetYear($array_equ_budget);

            $arrStockData = [
                "equ_quantity" => $equ_stock,
                "equ_id" => $equ_id
            ];

            $updateStock = $stockModel->updateStockEqu($arrStockData);
            echo $updateStock;
        } else {
            $countfiles = count($_FILES['file']['name']);

            $array_equipment = array(
                'equ_code' => $equ_code,
                'equ_name' => $equ_name,
                'equ_brand' => $equ_brand,
                'equ_model' => $equ_model,
                'equ_detail' => $equ_detail,
                'equ_color' => $equ_color,
                'equ_serail_no' => $equ_serail_no,
                'equ_status' => 'ปกติ',
                'equ_type_id' => $equ_type_id,
                'equ_owner' => $equ_owner
            );

            $equ_id = $euipmentModel->insertEquipment($array_equipment);

            $array_equ_budget = [
                'equ_price' => $equ_price,
                'equ_stock' => $equ_stock,
                'equ_id' => $equ_id,
                'budget_id' => $budget_id,
                'equ_date_income' => $equ_date_income,
                'equ_expire_date' => $equ_expire_date,
            ];

            $insertEqubud = $EquBudModel->insertEquipmentBudgetYear($array_equ_budget);

            $arrStockData = [
                "equ_id" => $equ_id,
                "equ_stock" => $equ_stock
            ];
            $insertStock = $stockModel->insertStockEqu($arrStockData);
            if ($insertStock == 1) {
                $utils = new Utils();
                $directory = 'equipment_img'; // path upload image.

                for ($i = 0; $i < $countfiles; $i++) {
                    $file_name = $_FILES['file']['name'][$i];
                    $file_size = $_FILES['file']['size'][$i];
                    $uploadResult = $utils->uploadImageMultiple($file_name, $file_size,  $directory, $i);

                    if ($uploadResult[0] == 'upload success') {
                        $data_image = [
                            "equ_id" => $equ_id,
                            "image_name" => $uploadResult[1]
                        ];
                        $uploadResult = $euipmentModel->InsertEquipmentImage($data_image);
                    } else {
                        echo $uploadResult[0];
                    }
                }
            } else {
                echo $insertStock;
            }
        }
        echo $uploadResult;
    } catch (Exception $th) {
        echo $th;
    }
}


function ConvertDate($date)
{
    list($year, $mounth, $day) = explode("-", $date);
    $year = (int)$year + 543;
    $year = substr($year, 2);
    $mounthConvert = "";
    if ($mounth == "01") {
        $mounthConvert = "ม.ค.";
    } else if ($mounth == "02") {
        $mounthConvert = "ก.พ.";
    } else if ($mounth == "03") {
        $mounthConvert = "มี.ค.";
    } else if ($mounth == "04") {
        $mounthConvert = "เม.ย.";
    } else if ($mounth == "05") {
        $mounthConvert = "พ.ค.";
    } else if ($mounth == "06") {
        $mounthConvert = "มิ.ย.";
    } else if ($mounth == "07") {
        $mounthConvert = "ก.ค.";
    } else if ($mounth == "08") {
        $mounthConvert = "ส.ค.";
    } else if ($mounth == "09") {
        $mounthConvert = "ก.ย.";
    } else if ($mounth == "10") {
        $mounthConvert = "ต.ค.";
    } else if ($mounth == "11") {
        $mounthConvert = "พ.ย.";
    } else if ($mounth == "12") {
        $mounthConvert = "ธ.ค.";
    }

    return $day . "-" . $mounthConvert . "-" . $year;
}

if (isset($_POST['updateEqu'])) {
    try {
        $equ_id = htmlentities($_POST['equ_id']);
        $equ_code = htmlentities($_POST['equ_code']);
        $equ_name = htmlentities($_POST['equ_name']);
        // $equ_type_id = htmlentities($_POST['equ_type_id']);
        $equ_brand = htmlentities($_POST['equ_brand']);
        $equ_model = htmlentities($_POST['equ_model']);
        $equ_detail = htmlentities($_POST['equ_detail']);
        $equ_serail_no = htmlentities($_POST['equ_serail_no']);
        // $equ_price = htmlentities($_POST['equ_price']);
        // $equ_date_income = htmlentities($_POST['equ_date_income']);
        // $equ_expire_date = htmlentities($_POST['equ_expire_date']);
        $equ_color = htmlentities($_POST['equ_color']);
        // $equ_stock = htmlentities($_POST['equ_stock']);

        $array_equipment = [
            'equ_code' => $equ_code,
            'equ_name' => $equ_name,
            'equ_brand' => $equ_brand,
            'equ_model' => $equ_model,
            'equ_detail' => $equ_detail,
            'equ_color' => $equ_color,
            'equ_serail_no' => $equ_serail_no,
            // 'equ_price' => $equ_price,
            // 'equ_date_income' => $equ_date_income,
            // 'equ_expire_date' => $equ_expire_date,
            // 'equ_type_id' => $equ_type_id,
            // 'equ_stock' => $equ_stock,
            'equ_id' => $equ_id
        ];

        $euipmentModel = new EquipmentModel();
        $result = $euipmentModel->updateEquipment($array_equipment);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_POST['deleteEqu'])) {
    try {
        $equ_id = $_POST['equ_id'];
        $euipmentModel = new EquipmentModel();
        $borowModel = new borrowEquModel();
        $EquBudModel = new EquipmentBudgetYearModel();

        $dataBorrow = $borowModel->queryEquipmentBorrow($equ_id);
        $dataEquBud = $EquBudModel->checkEquipementBeforeDelete($equ_id);

        $ArrBorrow = json_decode($dataBorrow);
        $ArrEquBud = json_decode($dataEquBud);
        $length = count($ArrBorrow);
        if ($length > 0) {
            echo "have related information.";
            exit();
        }

        $lengthEqu = count($ArrEquBud);
        if ($lengthEqu > 0) {
            echo "have related information.";
            exit();
        }
        $result = $euipmentModel->deleteEquipment($equ_id);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_POST['addTypeEquipment'])) {
    try {
        $equ_type_name = htmlentities($_POST['type_name']);
        $data = array('equ_type_name' => $equ_type_name);

        $euipmentModel = new EquipmentModel();
        $result = $euipmentModel->AddTypeEquiment($data);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_GET['getTypeEquid'])) {
    $Equipment = new EquipmentModel();
    $type_id = $_GET['getTypeEquid'];
    $result = $Equipment->getEquipmentTypeId($type_id);
    echo $result;
}

if (isset($_POST['updateTypeEqu'])) {

    try {
        $typ_equ_id = htmlentities($_POST['type_id']);
        $type_equ_name = htmlentities($_POST['type_name']);

        $data_array = array(
            'type_name' => $type_equ_name,
            'type_id' => $typ_equ_id,
        );
        $Equipment = new EquipmentModel();
        $result = $Equipment->updateTypeEquipment($data_array);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}


if (isset($_GET['deltypeEqu'])) {
    try {
        $typ_equ_id = $_GET['deltypeEqu'];
        $data_array = array(
            'type_id' => $typ_equ_id,
        );
        $Equipment = new EquipmentModel();

        $check_equType = $Equipment->CheckEquTypeByEqu($typ_equ_id);
        $decode_check_equType = json_decode($check_equType);

        if (count($decode_check_equType) > 0) {
            echo "2";
        } else {
            $result = $Equipment->deleteTypeEquipment($data_array);
            echo $result;
        }
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_GET['getEquByTypeId'])) {
    try {
        $typ_equ_id = $_GET['getEquByTypeId'];

        $data_array = array(
            'type_id' => $typ_equ_id
        );

        $Equipment = new EquipmentModel();
        $result = $Equipment->getEquipmentByTypeId($typ_equ_id);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_POST['addRecipEquipment'])) {
    try {

        $equ_code = htmlentities($_POST['equ_code']);
        $equ_date = htmlentities($_POST['equ_date']);
        $recip_note = htmlentities($_POST['recip_note']);
        $equ_qun = htmlentities($_POST['equ_qun']);
        $recip_status = htmlentities($_POST['recip_status']);
        $equ_id = htmlentities($_POST['equ_id']);



        $director = $_POST['director'];
        // echo "==>>".$director[0]['equ_name_director'];

        $data_array = array(
            'check_code' => $equ_code,
            'check_date' => $equ_date,
            'check_note' => $recip_note,
            'check_quantity' => $equ_qun,
            'check_status' => $recip_status,
            'equ_id' => $equ_id,
        );

        $Equipment = new EquipmentModel();
        $result = $Equipment->addRecipEquipment($data_array);

        $res_check_id =  json_decode($result);

        $check_id = $res_check_id->check_id;

        //president
        $equ_pres_name = htmlentities($_POST['equ_pres_name']);
        $equ_pos = htmlentities($_POST['equ_pos']);
        $equ_pres_email = htmlentities($_POST['equ_pres_email']);
        $equ_pres_tel = htmlentities($_POST['equ_pres_tel']);

        $data_recip_arry = array(
            'fullname' => $equ_pres_name,
            'position' => $equ_pos,
            'email' => $equ_pres_email,
            'phone' => $equ_pres_tel,
            'check_id' => $check_id,
        );

        $result_detail = $Equipment->addRecipEquipmentDetail($data_recip_arry);

        if ($result_detail) {
            for ($i = 0; $i <  count($director); $i++) {

                $data_recip_arry = array(
                    'fullname' => $director[$i]['equ_name_director'],
                    'position' => $director[$i]['equ_pos_director'],
                    'email' => "",
                    'phone' => "-",
                    'check_id' => $check_id,
                );

                $result_detail = $Equipment->addRecipEquipmentDetail($data_recip_arry);
            }

            echo $result_detail;
        }
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_GET['getEquId'])) {
    $euipment = new EquipmentModel();
    $equ_id = $_GET['getEquId'];
    $result = $euipment->getEquId($equ_id);
    echo $result;
}

if (isset($_GET['getEquWhereId'])) {
    try {
        $euipmentModel = new EquipmentModel();
        $equ_id = $_GET['equ_id'];
        $result = $euipmentModel->getEquId($equ_id);
        $jsonEqu = json_decode($result);

        $imagesEqu = $euipmentModel->getEquImageWhereEquId($equ_id);
        $jsonEquImg = json_decode($imagesEqu);
        $arrayDataEquWhereId = [
            "equData" => $jsonEqu,
            "equImages" => $jsonEquImg
        ];

        echo json_encode($arrayDataEquWhereId);
    } catch (Exception $e) {
        echo $e;
    }
}


if (isset($_GET['getEquBudgetWhereEquId'])) {
    try {
        $equ_id = $_GET['equ_id'];
        $budgetYearModel = new EquipmentBudgetYearModel();
        $result = $budgetYearModel->getEquBudget($equ_id);
        echo $result;
    } catch (\Throwable $th) {
        //throw $th;
    }
}

if (isset($_GET['getDataReportEquipmentPosition'])) {
    try {
        $equmodel = new EquipmentModel();
        $result = $equmodel->queryDataReportEquipmentPosition();
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}

if (isset($_GET['gettracEquId'])) {
    try {
        $equmodel = new EquipmentModel();
        $equ_code = $_GET['equ_code'];
        $result = $equmodel->getSearchTracEqu($equ_code);
        echo $result;
    } catch (Exception $e) {
        echo $e;
    }
}
