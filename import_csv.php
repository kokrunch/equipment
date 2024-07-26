<?php
if (isset($_POST["submit"])) {
    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($fileName, "r");

        // ข้ามแถวหัวตาราง
        fgetcsv($file);

        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $equ_code = $column[0];
            $equ_name = $column[1];
            $equ_brand = $column[2];
            $equ_model = $column[3];
            $equ_detail = $column[4];
            $equ_serial_no = $column[5];
            $equ_color = $column[6];

            // เรียกใช้ฟังก์ชันเพื่อบันทึกข้อมูลลงฐานข้อมูล
            insertEquipment($equ_code, $equ_name, $equ_brand, $equ_model, $equ_detail, $equ_serial_no, $equ_color);
        }

        fclose($file);
        echo "นำเข้าข้อมูลสำเร็จ";
    }
}

function insertEquipment($equ_code, $equ_name, $equ_brand, $equ_model, $equ_detail, $equ_serial_no, $equ_color) {
    include 'db_connection.php'; // เรียกใช้การเชื่อมต่อฐานข้อมูล

    $sql = "INSERT INTO equipment (equ_code, equ_name, equ_brand, equ_model, equ_detail, equ_serial_no, equ_color)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssss", $equ_code, $equ_name, $equ_brand, $equ_model, $equ_detail, $equ_serial_no, $equ_color);

    if ($stmt->execute()) {
        echo "บันทึกข้อมูลสำเร็จ: $equ_name<br>";
    } else {
        echo "เกิดข้อผิดพลาด: " . $stmt->error . "<br>";
    }

    $stmt->close();
    $conn->close();
}
?>
