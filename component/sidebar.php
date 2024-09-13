<?php $routeName =  basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-heading">Pages</li>
        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'admin_dashboard' ? '' : 'collapsed') ?>" href="admin_dashboard.php">
                <i class="ri-home-3-line"></i>
                <span>หน้าหลัก</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#branch-nav" data-bs-toggle="collapse" href="#">
                <i class="ri-building-line"></i></i><span>จัดการคณะและภาควิชา</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="branch-nav" class="nav-content collapse <?php echo ($routeName == 'manage_fac' || $routeName == 'manage_branch' ? 'show' : '') ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="manage_fac.php" class="<?php echo ($routeName == 'manage_fac' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i><span>คณะ</span>
                    </a>
                </li>
                <li>
                    <a href="manage_branch.php" class="<?php echo ($routeName == 'manage_branch' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i><span>ภาควิชา</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#user-nav" data-bs-toggle="collapse" href="#">
                <i class="ri-user-settings-line"></i><span>จัดการผู้ใช้งาน</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="user-nav" class="nav-content collapse <?php echo ($routeName == 'show_user' 
            || $routeName == 'manage_role_emp' || $routeName == 'manage_linenotify' ? 'show' : '') ?>" data-bs-parent="#sidebar-nav">
                <li>
                    <a href="show_user.php" class="<?php echo ($routeName == 'show_user' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>จัดการผู้ใช้งาน</span>
                    </a>
                </li>
                <li>
                    <a href="manage_role_emp.php" class="<?php echo ($routeName == 'manage_role_emp' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>จัดการสิทธิ์ผู้ใช้งาน</span>
                    </a>
                </li>
                <li>
                    <a href="manage_linenotify.php" class="<?php echo ($routeName == 'manage_linenotify' ? 'active' : '') ?>">
                        <i class="bi bi-circle"></i>
                        <span>จัดการ LINE Notify</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- <li class="nav-item">
            <a class="nav-link <?php // echo ($routeName == 'receipt' ? '' : 'collapsed') 
                                ?>" href="receipt">
                <i class="ri-chat-check-line"></i>
                <span>ตรวจรับพัสดุ</span>
            </a>
        </li> -->

        <li class="nav-item">
            <a class="nav-link <?php echo ($routeName == 'room' ? '' : 'collapsed') ?>" href="room.php">
                <i class="ri-door-open-line"></i>
                <span>จัดการห้องภายในคณะ</span>
            </a>
        </li>

    </ul>

</aside><!-- End Sidebar-->