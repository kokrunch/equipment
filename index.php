<?php

session_start();

if (isset($_SESSION['empData'])) {
    if ($_SESSION['empData']->role_id == 1 || $_SESSION['empData']->role_id == 2 || $_SESSION['empData']->role_id == 24) {
        Header("Location: dashboard_emp");
    }

    if ($_SESSION['empData']->role_id == 4) {
        Header("Location: dashboard_mat");
    }

    if ($_SESSION['empData']->role_id == 5) {
        Header("Location: admin_dashboard");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system ยินดีต้อนรับ</title>
    <link href="assets/css/welcomeStyle.css" rel="stylesheet">
</head>

<body>

    <?php
    include('config/connectDatabase.php');

    $sql = "SELECT * FROM tb_faculty";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="banner-area">
        <h2>ยินดีต้อนรับเข้าสู่ ระบบจัดการวัสดุและครุภัณฑ์</h2>
        <?php if (count($results) != 0) { ?>
            <h2><?php echo $results[0]['fac_name']; ?></h2>
        <?php  } else { ?>
            <h2>ผู้ดูแลระบบยังไม่ระบุคณะ</h2>
        <?php   } ?>
        <a href="login-page.php" class="btn">เริ่มต้นใช้งาน</a>
    </div>

</body>

</html>