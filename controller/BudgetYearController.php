<?php
require_once('../models/BudgetYearModel.php');
require_once('../models/EquipmentBudgetYearModel.php');
require_once('../models/MaterialbudgetyearModel.php');


if (isset($_GET['getBudgetYear'])) {
    try {
        $budget = new BudgetYearModel();
        $result = $budget->getBudgetYear();
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_GET['getBudgetYearLimit'])) {
    try {
        $budget = new BudgetYearModel();
        $result = $budget->getBudgetYearLimit();
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_POST['addBudgetYear'])) {
    try {
        $budget_year = htmlentities($_POST['budget_year']);
        $budget_st_date = htmlentities($_POST['budget_st_date']);
        $budget_end_date = htmlentities($_POST['budget_end_date']);

        $data_arry = array(
            'budget_year' => $budget_year,
            'budget_st_date' => $budget_st_date,
            'budget_end_date' => $budget_end_date
        );
        $budget = new BudgetYearModel();
        $result = $budget->addBudgetYear($data_arry);

        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_POST['updateBudget'])) {
    try {
        $budget_id = htmlentities($_POST['budget_id']);
        $budget_year = htmlentities($_POST['budget_year']);
        $budget_st_date = htmlentities($_POST['start_date']);
        $budget_end_date = htmlentities($_POST['end_date']);

        $data_arry = array(
            'budget_year' => $budget_year,
            'budget_start_date' => $budget_st_date,
            'budget_end_date' => $budget_end_date,
            'budget_id' => $budget_id
        );

        $budget = new BudgetYearModel();
        $result = $budget->updateBudgetYear($data_arry);

        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_GET['delBudget'])) {
    try {
        $budget_id = $_GET['delBudget'];
        $budget = new BudgetYearModel();
        $result = $budget->deleteBudgetYear($budget_id);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_GET['getYear_budgetYear'])) {
    $equbudget = new BudgetYearModel();
    $result = $equbudget->getYear_budgetYear();
    echo $result;
}

if (isset($_GET['getEquBudgetyearReport'])) {
    try {
        $budget_id = htmlentities($_GET['budget_id']);
        $equbudget = new EquipmentBudgetYearModel();
        $result = $equbudget->getEquBudgetyearReport($budget_id);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}

if (isset($_GET['getMatBudgetyearReport'])) {
    try {
        $budget_id = htmlentities($_GET['budget_id']);
        $matbudget = new MaterialBudgetYearModel();
        $result = $matbudget->getMatBudgetyearReport($budget_id);
        echo $result;
    } catch (Exception $th) {
        echo $th;
    }
}
