<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="" class="logo d-flex align-items-center">
            <h6 class="text-black">ระบบจัดการวัสดุและครุภัณฑ์</h6>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->
            <li class="nav-item dropdown">
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
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <?php if ($count_noti != 0) { ?>
                        <span class="badge bg-danger badge-number"><?php echo $count_noti; ?></span>
                    <?php } ?>

                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        คุณมี <?php echo $count_noti; ?> การแจ้งเตือนใหม่
                        <a href="notification_all"><span class="badge rounded-pill bg-primary p-2 ms-2">ดูทั้งหมด</span></a>
                    </li>
                    <?php if ($count_noti == 0) { ?>
                        <li class="notification-item d-flex justify-content-center">
                            <div>
                                <h4>ไม่มีการแจ้งเตือน</h4>
                            </div>
                        </li>
                    <?php  } else { ?>
                        <?php for ($i = 0; $i < $count_noti; $i++) {
                            if ($i == 4) {
                                break;
                            }
                        ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li class="notification-item">
                                <i class="bi bi-info-circle text-primary"></i>
                                <div>
                                    <h4><?php echo $results[$i]['noti_title']; ?></h4>
                                    <p><?php echo $results[$i]['noti_detail']; ?></p>
                                    <p><?php echo $results[$i]['noti_date']; ?></p>
                                </div>
                            </li>
                        <?php } ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer">
                            <a href="notification_all">แสดงการแจ้งเตือนทั้งหมด</a>
                        </li>
                    <?php } ?>


                </ul><!-- End Notification Dropdown Items -->

            </li>

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <?php if ($_SESSION['empData']->emp_img == null) { ?>
                        <img src="assets/img/no-profile.png" alt="Profile" class="rounded-circle">
                    <?php } else { ?>
                        <img src="assets/employee_img/<?php echo $_SESSION['empData']->emp_img; ?>" alt="Profile" class="img-profile-rounded">
                    <?php } ?>
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['empData']->emp_firstname . " " . $_SESSION['empData']->emp_lastname; ?></span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?php echo $_SESSION['empData']->emp_firstname . " " . $_SESSION['empData']->emp_lastname; ?></h6>
                        <span>ตำแหน่ง : <?php echo $_SESSION['empData']->sub_role_name; ?></span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="user_profile">
                            <i class="bi bi-person"></i>
                            <span>ข้อมูลผู้ใช้งาน</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#" id="logout-btn">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>ออกจากระบบ</span>
                        </a>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header><!-- End Header -->