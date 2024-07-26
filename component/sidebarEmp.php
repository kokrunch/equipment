<?php $routeName =  basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'dashboard_emp' ? '' : 'collapsed') ?>" href="dashboard_emp.php">
                <i class="ri-home-3-line"></i>
                <span>หน้าหลัก</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'disburse' || $routeName == 'disburse_cart' ? '' : 'collapsed') ?>" href="disburse.php">
            <i class="ri-fridge-line"></i>
                <span>ขอเบิกวัสดุ</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'emp_borrow' ? '' : 'collapsed') ?>" href="emp_borrow.php">
            <i class="ri-fridge-fill"></i>
                <span>ขอยืมครุภัณฑ์</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'repair' ? '' : 'collapsed') ?>" href="repair.php">
            <i class="ri-hammer-fill"></i>
                <span>แจ้งซ่อม</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'emp_disburse_list' ? '' : 'collapsed') ?>" href="emp_disburse_list.php">
            <i class="ri-gallery-upload-line"></i>
                <span>รายการที่ขอเบิกวัสดุ</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'emp_borrow_list' ? '' : 'collapsed') ?>" href="emp_borrow_list.php">
            <i class="ri-checkbox-multiple-line"></i>
                <span>รายการที่ขอยืมครุภัณฑ์</span>
            </a>
        </li>


    </ul>

</aside><!-- End Sidebar-->