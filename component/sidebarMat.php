<?php $routeName =  basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'dashboard_mat' ? '' : 'collapsed') ?>" href="dashboard_mat.php">
                <i class="ri-home-3-line"></i>
                <span>หน้าหลัก</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'notification_all' ? '' : 'collapsed') ?>" href="notification_all.php">
            <i class="ri-notification-line"></i>
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
            <a class="nav-link collapsed" data-bs-target="#material-nav" data-bs-toggle="collapse" href="#">
            <i class="ri-gallery-upload-line"></i><span>จัดการวัสดุ</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="material-nav" class="nav-content collapse 
            <?php echo ($routeName == 'manage_material' || $routeName == 'manage_material_type' ||
                $routeName == 'manage_unit' || $routeName == 'stockMat' ? 'show' : '') ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="manage_material.php" class="<?php echo ($routeName == 'manage_material' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>วัสดุ</span>
                    </a>
                </li>
                <!--    <li>
                    <a href="stockMat" class="<?php echo ($routeName == 'stockMat' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>คลังวัสดุ</span>
                    </a>
                </li> -->
                <li>
                    <a href="manage_material_type.php" class="<?php echo ($routeName == 'manage_material_type' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>ประเภทวัสดุ</span>
                    </a>
                </li>
                <li>
                    <a href="manage_unit.php" class="<?php echo ($routeName == 'manage_unit' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>หน่วยนับวัสดุ</span>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#equipment-nav" data-bs-toggle="collapse" href="#">
            <i class="ri-gallery-upload-fill"></i> <span>จัดการครุภัณฑ์</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="equipment-nav" class="nav-content collapse 
            <?php echo ($routeName == 'manage_equipment'
                || $routeName == 'manage_type_equipment' || $routeName == 'stockEqu'
                || $routeName == 'manage_equipment_detail' ? 'show' : '') ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="manage_equipment.php" class="<?php echo ($routeName == 'manage_equipment' || $routeName == 'manage_equipment_detail' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>ครุภัณฑ์</span>
                    </a>
                </li>
                <li>
                    <a href="tracking_equipment.php" class="<?php echo ($routeName == 'tracking_equipment' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>ติดตามครุภัณฑ์</span>
                    </a>
                </li>
                <!--   <li>
                    <a href="stockEqu" class="<?php echo ($routeName == 'stockEqu' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>คลังครุภัณฑ์</span>
                    </a>
                </li> -->
                <li>
                    <a href="manage_type_equipment.php" class="<?php echo ($routeName == 'manage_type_equipment' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>ประเภทครุภัณฑ์</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'disburse_approve' ? '' : 'collapsed') ?>" href="disburse_approve.php">
                <i class="ri-task-line"></i>
                <span>รายการเบิกวัสดุ</span>
            </a>
        </li><!-- End Register Page Nav -->

        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'repair_list' ? '' : 'collapsed') ?>" href="repair_list.php">
            <i class="ri-hammer-fill"></i>
                <span>รายการแจ้งซ่อม</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'manage_budget_year' ? '' : 'collapsed') ?>" href="manage_budget_year.php">
            <i class="ri-pie-chart-fill"></i>
                <span>จัดการปีงบประมาณ</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#borrow-nav" data-bs-toggle="collapse" href="#">
            <i class="ri-todo-line"></i><span>รายการยืม-คืนครุภัณฑ์</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="borrow-nav" class="nav-content collapse <?php echo ($routeName == 'borrowEqu' || $routeName == 'borrowReturnEqu' || $routeName == 'borrowReturnDetail' ? 'show' : '') ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="borrowEqu.php" class="<?php echo ($routeName == 'borrowEqu' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>รายการยืมที่รออนุมัติ</span>
                    </a>
                </li>
                <li>
                    <a href="borrowReturnEqu.php" class="<?php echo ($routeName == 'borrowReturnEqu' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>รายการยืมครุภัณฑ์</span>
                    </a>
                </li>
                <li>
                    <a href="borrowReturnDetail.php" class="<?php echo ($routeName == 'borrowReturnDetail' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>รายการครุภัณฑ์ที่คืนแล้ว</span>
                    </a>
                </li>
            </ul>
        </li>



        <!-- <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'account_mat' ? '' : 'collapsed') ?>" href="account_mat">
                <i class="bi bi-journal-bookmark-fill"></i>
                <span>บัญชีวัสดุ</span>
            </a>
        </li> -->

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#report-nav" data-bs-toggle="collapse" href="#">
            <i class="ri-bar-chart-fill"></i><span>รายงาน</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="report-nav" class="nav-content collapse 
            <?php echo ($routeName == 'equ_budgetyear_report'
                || $routeName == 'material_budgetyear_report'
                || $routeName == 'report_equipment_position'
                || $routeName == 'details_equipment_material' ? 'show' : '') ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="equ_budgetyear_report.php" class="<?php echo ($routeName == 'equ_budgetyear_report' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>รายงานรายการครุภัณฑ์ตามปีงบประมาณ</span>
                    </a>
                </li>
                <li>
                    <a href="material_budgetyear_report.php" class="<?php echo ($routeName == 'material_budgetyear_report' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>รายงานรายการวัสดุตามปีงบประมาณ</span>
                    </a>
                </li>
                <li>
                    <a href="report_equipment_position.php" class="<?php echo ($routeName == 'report_equipment_position'
                                                                    || $routeName == 'details_equipment_material' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>ตำแหน่งครุภัณฑ์</span>
                    </a>
                </li>
            </ul>
        </li>


    </ul>

</aside><!-- End Sidebar-->