<?php
session_start();
if (!isset($_SESSION["empData"])) {
    Header("Location: ../login-page");
}
include '../config/connectDatabase.php';
require_once('../assets/vendor/TCPDF/tcpdf.php');

$sum_quantity_mat = 0;
$mat_bud_id = 0;
if (isset($_GET['mat_id'])) {


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
    $pdf->SetMargins(10, 15, 10, true);


    $matId = $_GET['mat_id'];

    $sql = "SELECT\n" .
        "	mb.*,\n" .
        "	DATE_FORMAT( mb.mat_date_income, '%d/%m/%Y' ) date_income,\n" .
        "	DATE( mb.mat_date_income ) mat_date_income_format,\n" .
        "	dis_d.*,\n" .
        "	DATE_FORMAT( dis.dis_date, '%d/%m/%Y' ) dis_date,\n" .
        "	DATE( dis.dis_date ) dis_date_format,\n" .
        "	m.*,-- 	mb.mat_bud_id,\n" .
        "-- 	mb.mat_price,\n" .
        "-- 	mb.mat_stock,\n" .
        "	bg.* ,\n" .
        "   tb_unit.*,\n" .
        "   mt.*" .
        "FROM\n" .
        "	tb_material_budget_year mb\n" .
        "	LEFT JOIN tb_material m ON mb.mat_id = m.mat_id\n" .
        "	LEFT JOIN tb_disburse_detail dis_d ON mb.mat_bud_id = dis_d.mat_budget_id\n" .
        "	LEFT JOIN tb_disburse dis ON dis_d.dis_id = dis.dis_id\n" .
        "	LEFT JOIN tb_budget_year bg ON mb.budget_id = bg.budget_id -- GROUP BY mb.mat_bud_id\n" .
        "   LEFT JOIN tb_unit ON m.unit_id = tb_unit.unit_id\n" .
        "   LEFT JOIN tb_material_type mt ON m.mat_type_id = mt.type_id \n" .
        "WHERE\n" .
        "	mb.mat_id = :mat_id \n" .
        "-- 	AND bg.budget_year_status = 1 -- 	AND dis.dis_status = 'อนุมัติ'";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["mat_id" => $matId]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $pdf->AddPage();
    $pdf->SetFont('thsarabun', '', 12);
    $pdf->Cell(200, 0, "แผ่นที่...." . $pdf->getAliasNumPage() . "....", 0, 1, 'R');
    $pdf->SetFont('thsarabunb', '', 16);
    $pdf->Cell(190, 0, "สมุดคุมบัญชีวัสดุ", 0, 1, 'C');

    $pdf->SetFont('thsarabun', '', 14);
    $pdf->Cell(60, 0, "ชื่อวัสดุ..................." . $results[0]['mat_name'] . "....................", 0, 0, 'L');
    $pdf->Cell(70, 0, "", 0, 0, 'L');
    $pdf->Cell(60, 0, "หน่วยนับ..................." . $results[0]['unit_name'] . "..................", 0, 1, 'R');

    $pdf->Cell(60, 0, "รหัส.........................................................", 0, 0, 'L');
    $pdf->Cell(70, 0, "", 0, 0, 'L');
    $pdf->Cell(60, 0, "จำนวนคงเหลือสูงสุด.......................", 0, 1, 'R');

    $pdf->Cell(60, 0, "ชนิด/ขนาด..........."  . $results[0]['type_name'] . "............", 0, 0, 'L');
    $pdf->Cell(70, 0, "", 0, 0, 'L');
    $pdf->Cell(60, 0, "จำนวนคงเหลือต่ำสุด......................", 0, 1, 'R');

    // $pdf->Cell(40, 10, "หน่วยนับ........" . "ด้าม" . "........", 0, 1, 'R');
    // $pdf->Cell(40, 10, "จำนวนคงเหลือสูงสุด........" . "" . "........", 0, 1, 'R');
    // $pdf->Cell(40, 10, "จำนวนคงเหลือต่ำสุด........" . "" . "........", 0, 1, 'R');

    // $text = '
    //  <div class="text1" style="float:left;width:150px;">
    //    <p>ชื่อวัสดุ........</p>
    //    <p>รหัส........</p>
    //    <p>ชนิด/ขนาด......</p>
    //  </div>
    //    <div class="text2" style="float:right;width:150px;">
    //    <p>หน่วยนับ..........</p>
    //    <p>จำนวนคงเหลือสูงสุด..........</p>
    //    <p>จำนวนคงเหลือต่ำสุด.........</p>
    //  </div>
    // ';
    // $pdf->writeHTML($text, true, false, false, false, '');



    $tbl = "";
    $tbl .= '<table id="table-acc" class="" border="0.5" style="width: 100%;font-size:13px;text-align:center;margin-top:5px;">';
    $tbl .= "<thead>";
    $tbl .= "<tr>";
    $tbl .= '<th rowspan="2">วัน/เดือน/ปี</th>';
    $tbl .= '<th rowspan="2">เลขที่ ใบรับ/ใบเบิก</th>';
    $tbl .= '<th colspan="3" class="text-center">รับ</th>';
    $tbl .= '<th colspan="3" class="text-center">จ่าย</th>';
    $tbl .= '<th colspan="3" class="text-center">คงเหลือ</th>';
    $tbl .= "</tr>";
    $tbl .= "<tr>";
    $tbl .= "<th>จำนวน</th>";
    $tbl .= "<th>ราคาต้นทุน</th>";
    $tbl .= "<th>ราค่าต้นทุนทั้งสิ้น</th>";
    $tbl .= "<th>จำนวน</th>";
    $tbl .= "<th>ราคาต้นทุน</th>";
    $tbl .= "<th>ราค่าต้นทุนทั้งสิ้น</th>";
    $tbl .= "<th>จำนวน</th>";
    $tbl .= "<th>ราคาต้นทุน</th>";
    $tbl .= "<th>ราค่าต้นทุนทั้งสิ้น</th>";
    $tbl .= "</tr>";
    $tbl .= "</thead>";
    $tbl .= "<tbody>";

    // $tbl .= "<tr>";
    // $tbl .= "<td>06/01/2023</td>";
    // $tbl .= "<td>23/2567</td>";
    // $tbl .= "<td></td>";
    // $tbl .= "<td></td>";
    // $tbl .= "<td></td>";
    // $tbl .= "<td>3</td>";
    // $tbl .= "<td>1500</td>";
    // $tbl .= "<td>4500</td>";
    // $tbl .= "<td>7</td>";
    // $tbl .= "<td>1500</td>";
    // $tbl .= "<td>10500</td>";
    // $tbl .= "</tr>";


    $index = 0;
    //print_r($results."<br>");
    $mat_bu_id_arr = [];
    $lastData = [];
    $lastIncomeData = [];

    // $numbers = array(1, 2, 3, 4, 5, 6);
    // $evenNumbers = array_filter($numbers, function ($number) {
    //     echo $number;
    //     return $number % 2 === 0;
    // });
    // print_r($evenNumbers);

    foreach ($results as $row) {

        echo ($index + 1);
        echo "<br>";

        $GLOBALS['mat_bud_id'] = $row['mat_bud_id'];
        echo "mat_bud_id = >" . $GLOBALS['mat_bud_id'] . "\t<br>";
        $check_bud_id = array_filter($mat_bu_id_arr, function ($mat_bu_id) {
            // echo $mat_bu_id;
            return $GLOBALS['mat_bud_id'] ==  $mat_bu_id;
        });

        //print_r($check_bud_id);

        $index++;
        $payData = $row;
        echo "count " . count($check_bud_id);
        echo "<br>";
        if (count($check_bud_id) == 0) {
            if ($payData['dis_date_format'] != null) {
                echo "not Null";
                echo "<br>";
                // echo "write income";
                echo $payData['mat_date_income_format'] . " | " . $payData['dis_date_format'];
                echo "<br>";
                $date1 = $payData['mat_date_income_format'];
                $date2 = $payData['dis_date_format'];
                $date1 = strtotime($date1);
                $date2 = strtotime($date2);

                echo $date1 . '|' . $date2 . "<br>";
                array_push($mat_bu_id_arr, $payData['mat_bud_id']);
                if ($date1 == $date2) {
                    echo "เท่ากัน";
                    writeIncomeData($payData);
                    writePayData($payData);
                }
                if ($date1 > $date2) {
                    echo "date1 มากกว่า";
                    writePayData($payData);
                    writeIncomeData($payData);
                }
                if ($date1 < $date2) {
                    echo "date1 น้อยกว่า";
                    writeIncomeData($payData);
                    array_push($lastData, $payData);
                }
                echo "<br>";
                echo "--------------------------------------------------------";
                echo "<br>";
            } else {
                echo "Null";
                echo "<br>";
                echo $payData['mat_date_income_format'] . " | " . $payData['dis_date_format'];
                echo "<br>";
                writeIncomeData($payData);
                echo "<br>";
                echo "--------------------------------------------------------";
                echo "<br>";
            }
        } else {
            echo "not check";
            echo "<br>";

            echo $payData['mat_date_income_format'] . " | " . $payData['dis_date_format'];
            echo "<br>";
            $date1 = $payData['mat_date_income_format'];
            $date2 = $payData['dis_date_format'];
            $date1 = strtotime($date1);
            $date2 = strtotime($date2);

            echo $date1 . '|' . $date2 . " <br>";
            writePayData($payData);
            //array_push($lastData, $payData);
            echo "<br>";
            echo "--------------------------------------------------------";
            echo "<br>";
        }
    }

    for ($i = 0; $i < count($lastData); $i++) {
        writePayData($lastData[$i]);
    }

    $tbl .= "</tbody>";
    $tbl .= "</table>";
    $pdf->writeHTML($tbl, true, false, false, false, '');
    ob_end_clean();
    $pdf->Output('สมุดคุมบัญชี.pdf', 'I');
    $pdf->Close();
}


function writeIncomeData($row)
{
    $sumPrice = floatval($row['mat_price']) * $row['mat_stock'];
    $GLOBALS['sum_quantity_mat'] = $GLOBALS['sum_quantity_mat'] + $row['mat_stock'];

    $GLOBALS['tbl'] .= "<tr>";
    $GLOBALS['tbl'] .= "<td>" . $row['date_income'] . "</td>";
    $GLOBALS['tbl'] .= "<td>" . $row['mat_bud_id'] . "/" . $row['budget_year'] . "</td>";
    $GLOBALS['tbl'] .= "<td>" . $row['mat_stock'] . "</td>";
    $GLOBALS['tbl'] .= "<td>" . floatval($row['mat_price']) . "</td>";
    $GLOBALS['tbl'] .= "<td>" . $sumPrice . "</td>";
    $GLOBALS['tbl'] .= "<td></td>";
    $GLOBALS['tbl'] .= "<td></td>";
    $GLOBALS['tbl'] .= "<td></td>";
    $GLOBALS['tbl'] .= "<td>" . $GLOBALS['sum_quantity_mat'] . "</td>";
    $GLOBALS['tbl'] .= "<td>" . floatval($row['mat_price']) . "</td>";
    $GLOBALS['tbl'] .= "<td>" . floatval($row['mat_price']) * $GLOBALS['sum_quantity_mat'] . "</td>";
    $GLOBALS['tbl'] .= "</tr>";
}

function writePayData($row)
{
    $sumPrice = floatval($row['mat_price']) * $row['quantity'];
    $GLOBALS['sum_quantity_mat'] = $GLOBALS['sum_quantity_mat'] - $row['quantity'];
    $GLOBALS['tbl'] .= "<tr>";
    $GLOBALS['tbl'] .= "<td>" . $row['dis_date'] . "</td>";
    $GLOBALS['tbl'] .= "<td>" . $row['dis_det_id'] . "/" . $row['budget_year'] . "</td>";
    $GLOBALS['tbl'] .= "<td></td>";
    $GLOBALS['tbl'] .= "<td></td>";
    $GLOBALS['tbl'] .= "<td></td>";
    $GLOBALS['tbl'] .= "<td>" . $row['quantity'] . "</td>";
    $GLOBALS['tbl'] .= "<td>" . floatval($row['mat_price']) . "</td>";
    $GLOBALS['tbl'] .= "<td>" . $sumPrice . "</td>";
    $GLOBALS['tbl'] .= "<td>" . $GLOBALS['sum_quantity_mat'] . "</td>";
    $GLOBALS['tbl'] .= "<td>" . floatval($row['mat_price']) . "</td>";
    $GLOBALS['tbl'] .= "<td>" . floatval($row['mat_price']) * $GLOBALS['sum_quantity_mat'] . "</td>";
    $GLOBALS['tbl'] .= "</tr>";
}
