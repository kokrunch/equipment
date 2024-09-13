<?php $routeName =  basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'dashboard_repair' ? '' : 'collapsed') ?>" href="dashboard_repair.php">
                <i class="ri-home-3-line"></i>
                <span>หน้าหลัก</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'notification_all' ? '' : 'collapsed') ?>" href="notification_all.php">
                <i class="ri-home-3-line"></i>
                <?php
                include('config/connectDatabase.php');

                $sql = "SELECT\n" .
                    "	*,\n" .
                    "	DATE_FORMAT( n.create_date, '%d/%m/%Y %H:%i' ) noti_date \n" .
                    "FROM\n" .
                    "	tb_token_employee te\n" .
                    "	LEFT JOIN tb_notification n ON te.token_id = n.token_id \n" .
                    "WHERE\n" .
                    "	te.emp_id = :emp_id AND status = 0 \n" .
                    "ORDER BY\n" .
                    "	noti_id DESC";

                $stmt = $conn->prepare($sql);
                $stmt->execute(['emp_id' => $_SESSION['empData']->emp_id]);
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $count_noti = count($results);
                ?>
                <span>การแจ้งเตือน
                    <?php if ($count_noti != 0) { ?>
                        <span class="badge bg-danger"><?php echo $count_noti; ?></span>
                    <?php } ?>
                </span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'manage_repair' ? '' : 'collapsed') ?>" href="manage_repair.php">
                <i class="ri-door-open-line"></i>
                <span>จัดการการแจ้งซ่อม</span>
            </a>
        </li><!-- End Register Page Nav -->
    </ul>

</aside><!-- End Sidebar-->