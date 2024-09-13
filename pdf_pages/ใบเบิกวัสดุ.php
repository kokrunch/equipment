<?php
session_start();
if (!isset($_SESSION["empData"])) {
    Header("Location: ../login-page");
}
include '../config/connectDatabase.php';
require_once('../assets/vendor/TCPDF/tcpdf.php');


if (isset($_GET['dis_id'])) {

    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // define('Sarabun', TCPDF_FONTS::addTTFfont('../assets/fonts/Sarabun-Regular.ttf', 'TrueTypeUnicode'));
    // define('SarabunB', TCPDF_FONTS::addTTFfont('../assets/fonts/Sarabun-Bold.ttf', 'TrueTypeUnicode'));
    // $font = $pdf->addTTFfont("filename.ttf");
    $pdf->SetCreator(PDF_CREATOR);

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    $pdf->SetMargins(25, 15, 30, true);


    $disId = $_GET['dis_id'];

    $sql = "SELECT\n" .
        "-- 	* ,\n" .
        "	d.*,\n" .
        "	dt.*,\n" .
        "	m.*,\n" .
        "	u.*,\n" .
        "	bg.budget_year,\n" .
        "	CONCAT(e.emp_firstname,' ',e.emp_lastname) fullname,\n" .
        "	DATE_FORMAT(d.dis_date+543,'%d/%m/%Y') dis_date_format\n" .
        "FROM\n" .
        "	tb_disburse d\n" .
        "	LEFT JOIN tb_disburse_detail dt ON d.dis_id = dt.dis_id\n" .
        "	LEFT JOIN tb_material_budget_year mb ON dt.mat_budget_id = mb.mat_bud_id\n" .
        "	LEFT JOIN tb_material m ON mb.mat_id = m.mat_id\n" .
        "	LEFT JOIN tb_unit u ON m.unit_id = u.unit_id \n" .
        "	LEFT JOIN tb_budget_year bg ON mb.budget_id = bg.budget_id\n" .
        "	LEFT JOIN tb_employee e ON d.emp_id = e.emp_id\n" .
        "WHERE\n" .
        "	dt.dis_id = :dis_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["dis_id" => $disId]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($results);
    $jsonArr = json_decode($json);
    $countJsonArr = count($jsonArr);

    $cellEmpty = 11 - $countJsonArr;

    $y = 543;
    $date_y = substr($jsonArr[0]->dis_date, 0, 4);
    $date_m = substr($jsonArr[0]->dis_date, 5, 2);
    $date_d = substr($jsonArr[0]->dis_date, 8, 2);
    $date_y = $date_y + $y;
    $date_format_TH = $date_d . "/" . $date_m . "/" . $date_y;
    $pdf->AddPage();

    //$pdf->setHeaderFont(array('freeserif', 'B', 12));
    $pdf->SetFont('thsarabun', '', 18);

    //$pdf->SetFont('freeserif', '', 14);

    $pdf->Cell(160, 8, "", 0, 1, 'C');
    $pdf->Cell(148, 0, "ใบเบิกวัสดุ", 0, 1, 'C');
    $pdf->Cell(160, 0, "", 0, 1, 'C');
    $pdf->SetFont('thsarabun', '', 16);

    $pdf->Cell(148, 8, "ใบเบิกที่....." . $jsonArr[0]->dis_id . "..../......" . $jsonArr[0]->budget_year . ".......", 0, 1, 'L');
    $pdf->Cell(148, 8, "วันที่.........." . $date_format_TH . "..............", 0, 1, 'R');
    $pdf->Cell(15, 8, "เรียน", 0, 0, 'L');
    $pdf->Cell(148, 8, "คณบดีคณะวิทยาการสารสนเทศ", 0, 1, 'L');
    $pdf->Cell(15, 8, "", 0, 0, 'L');
    $pdf->Cell(148, 8, "ข้าพเจ้ามีความประสงค์จะขอเบิกพัสดุ สำหรับใช้ในราชการของคณะวิทยาการสารสนเทศ", 0, 1, 'L');
    $pdf->Cell(15, 8, "ตามรายการดังต่อไปนี้", 0, 1, 'L');


    $pdf->Cell(148, 8, "", 0, 1, 'C');
    $pdf->Cell(15, 8, "ลำดับ", 1, 0, 'C');
    $pdf->Cell(55, 8, "รายการวัสดุ", 1, 0, 'C');
    $pdf->Cell(22.5, 8, "จำนวน", 1, 0, 'C');
    $pdf->Cell(22.5, 8, "หน่วย", 1, 0, 'C');
    $pdf->Cell(45, 8, "* หมายเหตุ", 1, 1, 'C');


    for ($i = 0; $i < $countJsonArr; $i++) {
        $pdf->Cell(15, 8, ($i + 1), 1, 0, 'C');
        $pdf->Cell(55, 8, $jsonArr[$i]->mat_name, 1, 0, 'L');
        $pdf->Cell(22.5, 8, $jsonArr[$i]->quantity, 1, 0, 'C');
        $pdf->Cell(22.5, 8, $jsonArr[$i]->unit_name, 1, 0, 'C');
        $pdf->Cell(45, 8, $jsonArr[$i]->dis_mat_detail, 1, 1, 'C');
        // if ($i == 0) {
        //     $pdf->Cell(45, 8, $jsonArr[$i]->dis_note, 1, 1, 'C');
        // } else {
        //     $pdf->Cell(45, 8, "", 1, 1, 'C');
        // }
    }

    for ($i = 0; $i < $cellEmpty; $i++) {
        $pdf->Cell(15, 8, "", 1, 0, 'C');
        $pdf->Cell(55, 8, "", 1, 0, 'L');
        $pdf->Cell(22.5, 8, "", 1, 0, 'C');
        $pdf->Cell(22.5, 8, "", 1, 0, 'C');
        $pdf->Cell(45, 8, "", 1, 1, 'C');
    }

    $pdf->Cell(40, 8, "", 0, 1, 'C');

    $pdf->Cell(40, 8, "พัสดุจำนวนดังกล่าวมอบให้................................................................................................เป็นผู้รับแทนข้าพเจ้า", 0, 1, 'L');

    $pdf->Cell(45, 16, "อนุญาตให้จ่ายพัสดุได้", 0, 0, 'R');
    $pdf->Cell(51, 16, "", 0, 0, 'C');
    $pdf->Cell(60, 16, ".................................................", 0, 1, 'L');

    $pdf->Cell(60, 4, "...........................................................", 0, 0, 'L');
    $pdf->Cell(34.5, 16, "", 0, 0, 'C');
    $pdf->Cell(60, 4, "(............." . $jsonArr[0]->fullname . "..............) ผู้เบิก", 0, 1, 'C');

    $pdf->Cell(60, 16, "(..........................................................)", 0, 0, 'L');
    $pdf->Cell(37, 16, "", 0, 0, 'C');
    $pdf->Cell(60, 16, ".....................................................ตำแหน่ง", 0, 1, 'C');

    $pdf->Cell(60, 4, "ผู้รับของ..............................................", 0, 0, 'L');
    $pdf->Cell(39, 16, "", 0, 0, 'C');
    $pdf->Cell(60, 4, "ลงบัญชีพัสดุแล้ว", 0, 1, 'C');

    $pdf->Cell(60, 16, "ผู้จ่ายของ............................................", 0, 0, 'L');
    $pdf->Cell(20, 16, "", 0, 0, 'C');
    $pdf->Cell(80, 16, ".....................................................................", 0, 1, 'R');

    $pdf->Cell(108, 8, "", 0, 0, 'R');
    $pdf->Cell(42.5, 8, "เจ้าหน้าที่พัสดุ", 0, 1, 'C');

    $pdf->Output('ใบเบิกวัสดุ.pdf', 'I');
    $pdf->Close();
}
