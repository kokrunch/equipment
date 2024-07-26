<?php
session_start();
require_once("../models/StockModel.php");

if (isset($_GET['getStockMat'])) {
    try {
        $stock = new stockModel();
        $result = $stock->getStockMat();
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}


if (isset($_GET['getmat'])) {
    try {
        $mat_id = $_GET['getmat'];
        $stock = new stockModel();
        $result = $stock->getMat($mat_id);
        echo $result;
    } catch (\Throwable $th) {
        echo $th;
    }
}


if (isset($_POST['updateStockMat'])) {
   

        $mat_id = $_POST['mat_id'];
        $mat_stock = $_POST['mat_stock'];
        $emp_id = $_SESSION['empData']->emp_id;
        $mat_quantity =  htmlentities($_POST['mat_quantity']);

        $data_array = array(
            'mat_stock' => $mat_quantity,
            'mat_id' => $mat_id
        );

        $stock = new stockModel();
        $result = $stock->updateStockMaterial($data_array);
        if ($result == 1) {
            $data_array = array(
                 'mat_id' => $mat_id,
                'mat_stock' => $mat_stock,
                'mat_quantity' => $mat_quantity,
                'emp_id' => $emp_id
            );
            $result = $stock->updateStockLogMaterial($data_array);
            echo $result;
        }else{
            echo $result;
        }
}

if (isset($_POST['updateStockEqu'])) {
    $equ_id = $_POST['equ_id'];
    $equ_stock = $_POST['equ_stock'];
    $emp_id = $_SESSION['empData']->emp_id;
    $emp_quantity =  htmlentities($_POST['equ_quantity']);
    $data_array = [
        'equ_stock' => $emp_quantity,
        'equ_id' => $equ_id
    ];

    $stockMd = new stockModel();
    $result = $stockMd->updateStockEqu($data_array);
    if ($result == 1) {
        $data_array = [
            'equ_id' => $equ_id,
            'equ_stock' => $equ_stock,
            'equ_quantity' => $emp_quantity,
            'emp_id' => $emp_id
        ];
        $result = $stockMd->insertStockEqu($data_array);
        echo $result;
    } else {
        echo $result;
    }



    // after disable about stock

    
}
