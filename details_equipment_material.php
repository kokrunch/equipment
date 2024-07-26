<?php include("component/checkSession.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system</title>
</head>

<body>

<?php include("component/navbar.php"); ?>

<?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <div id="show_roomId"></div>
            <nav>
                <ol class="breadcrumb my-4">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="report_equipment_position.php">ตำแหน่งครุภัณฑ์</a></li>
                    <li class="breadcrumb-item active">รายละเอียดครุภัณฑ์และวัสดุ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section equipment">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">จำนวนครุภัณฑ์</h5>
                            <div id="show-detail-equ" class="row row-cols-1 row-cols-md-4 row-cols-sm-3 g-4">

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="section material">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">จำนวนวัสดุ</h5>
                            <div id="show-detail-mat" class="row row-cols-1 row-cols-md-4 row-cols-sm-3 g-4">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main><!-- End #main -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

</body>
<script>
    $(document).ready(async function() {

        getDetailEqu();
        getDetailMat();
        getRoomId();

        async function getRoomId() {
            let room_id = '<?php echo $_GET['room_id'] ?>';
            // console.log(room_id);
            const url = "./controller/RoomController.php?getRoomId=" + room_id;
            let equData;
            await axios.get(url).then(function(response) {
                equData = response.data;
            }).catch((err) => console.log(err));

            const show_roomId = document.getElementById('show_roomId');
            show_roomId.innerHTML = "";

            equData.forEach((element, i) => {
                // console.log(element);
                show_roomId.innerHTML += `
                <h1>รายละเอียดห้อง ${element.room_name}</h1>
                `;
            })
        }


        async function getDetailEqu() {
            let room_id = '<?php echo $_GET['room_id'] ?>';
            // console.log(room_id);
            const url = "./controller/RoomController.php?getEquDetail=" + room_id;
            let equData;
            await axios.get(url).then(function(response) {
                equData = response.data;
            }).catch((err) => console.log(err));

            const bodyEqu = document.getElementById("show-detail-equ");
            bodyEqu.innerHTML = "";
            if (equData == '') {
                bodyEqu.innerHTML += `
                <div class="alert alert-warning text-center w-100" role="alert">ไม่มีข้อมูล</div>
            `;
            } else {
                equData.forEach((element, i) => {
                    // console.log(element.room_id);
                    bodyEqu.innerHTML += `
            <div class="col">
                                    <div class="card d-flex justify-content-center h-40 ">
                                    
                                        <div class="card-body text-center d-grid gap-2">
                                            <h5 class="card-title">${element.equ_name}</h5>
                                           <button class="btn btn-outline-dark">จำนวน : ${element.quantity}</button>
                                        </div>
                                    </div>
                                </div>
            `
                });
            }


        }

        async function getDetailMat() {
            let room_id = '<?php echo $_GET['room_id'] ?>';

            const url = "./controller/RoomController.php?getMatDetail=" + room_id;
            let matData;
            await axios.get(url).then(function(response) {
                matData = response.data;
            }).catch((err) => console.log(err));

            const bodyMat = document.getElementById("show-detail-mat");
            bodyMat.innerHTML = "";
            if (matData == '') {
                bodyMat.innerHTML += `
            <div class="alert alert-warning text-center w-100" role="alert">ไม่มีข้อมูล</div>
            `;
            } else {
                matData.forEach((element, i) => {
                    //   console.log(element.mat_img);
                    bodyMat.innerHTML += `
            <div class="col">
                                    <div class="card d-flex justify-content-center h-40 ">
                                    
                                        <div class="card-body text-center d-grid gap-2">
                                            <h5 class="card-title">${element.mat_name}</h5>
                                           <button class="btn btn-outline-dark">จำนวน : ${element.quantity}</button>
                                        </div>
                                    </div>
                                </div>
            `
                });
            }

        }

    })
</script>

</html>