<?php
session_start();
$con = mysqli_connect('localhost','root','','equipment');
require 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\CSV;

if(isset($_POST['save_excel_data']))
{
        $fileName = $_FILES['import_file']['name'];
        $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $allowed_ext = ['xls','csv','xlsx'];

        if(in_array($file_ext, $allowed_ext))
        {
            $inputFileNamePath = $_FILES['import_file']['tmp_name'];
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
            $data = $spreadsheet->getActiveSheet()->toArray();
            foreach($data as $row)
            {
                $equ_id = $row['0'];
                $equ_code = $row['1'];
                $equ_name = $row['2'];
                $equ_type_id = $row['3'];
                $equ_brand = $row['4'];
                $equ_model = $row['5'];
                $equ_detail = $row['6'];
                $equ_color = $row['7'];
                $equ_serail_no = $row['8'];
                $equ_status = $row['9'];
                $create_date = $row['10'];
                $equ_owner = $row['11'];

                $manage_equipmentQuery = "INSERT INTO tb_equipment (equ_id, equ_code, equ_name, equ_type_id, equ_brand, equ_model, equ_detail, equ_color, equ_serail_no, equ_status, create_date, equ_owner)VALUES ('$equ_id','$equ_code','$equ_name','$equ_type_id','$equ_brand','$equ_model','$equ_detail','$equ_color','$equ_serail_no','$equ_status','$create_date','$equ_owner')";
                $result = mysqli_query($con, $manage_equipmentQuery);
                $msg = true;
            }

            if(isset($msg))
            {
                $_SESSION['message'] = "Successfuly Imported";
            header('Location: manage_equipment.php');
            exit(0);

            }
            else
            {
                $_SESSION['message'] = "Not Imported";
            header('Location: manage_equipment.php');
            exit(0);

            }
        }
    
        else
        {
            $_SESSION['message'] = "Invalid File";
            header('Location: manage_equipment.php');
            exit(0);
        }
}


// if (isset($_POST["submit"])) {
//     $fileName = $_FILES["file"]["tmp_name"];

//     if ($_FILES["file"]["size"] > 0) {
//         $file = fopen($fileName, "r");

//         // ข้ามแถวหัวตาราง
//         fgetcsv($file);

//         while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
//             $equ_code = $column[0];
//             $equ_name = $column[1];
//             $equ_brand = $column[2];
//             $equ_model = $column[3];
//             $equ_detail = $column[4];
//             $equ_serial_no = $column[5];
//             $equ_color = $column[6];

//             // เรียกใช้ฟังก์ชันเพื่อบันทึกข้อมูลลงฐานข้อมูล
//             insertEquipment($equ_code, $equ_name, $equ_brand, $equ_model, $equ_detail, $equ_serial_no, $equ_color);
//         }

//         fclose($file);
//         echo "นำเข้าข้อมูลสำเร็จ";
//     }
// }

// function insertEquipment($equ_code, $equ_name, $equ_brand, $equ_model, $equ_detail, $equ_serial_no, $equ_color) {
//     include 'db_connection.php'; // เรียกใช้การเชื่อมต่อฐานข้อมูล

//     $sql = "INSERT INTO equipment (equ_code, equ_name, equ_brand, equ_model, equ_detail, equ_serial_no, equ_color)
//             VALUES (?, ?, ?, ?, ?, ?, ?)";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("sssssss", $equ_code, $equ_name, $equ_brand, $equ_model, $equ_detail, $equ_serial_no, $equ_color);

//     if ($stmt->execute()) {
//         echo "บันทึกข้อมูลสำเร็จ: $equ_name<br>";
//     } else {
//         echo "เกิดข้อผิดพลาด: " . $stmt->error . "<br>";
//     }

//     $stmt->close();
//     $conn->close();
// }
?>
