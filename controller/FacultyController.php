<?php

require_once('../models/FacultyModel.php');

if (isset($_GET['getFac'])) {
    $facModel = new FacultyModel();
    $result = $facModel->getAllFaculty();
    echo $result;
}

if (isset($_POST['updateFac'])) {
    $facid = $_POST['fac_id'];
    $facName = htmlentities($_POST['fac_name']);
    $facModel = new FacultyModel();
    if ($facid == 0) {
        $result = $facModel->addFaculty($facName);
    } else {
        $result = $facModel->updateFaculty($facName, $facid);
    }
    echo $result;
}
