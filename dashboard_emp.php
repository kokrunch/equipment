<?php include("component/checkSession.php"); ?>
<?php include("component/roleEmp.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarEmp.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>หน้าแดชบอร์ดของ บุคลากร</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">หน้าหลัก</li>
                    <li class="breadcrumb-item"></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="col-lg-12">

                <div class="row">

                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">รายการเบิกวัสดุที่รออนุมัติ</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class='bx bx-time'></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="For_disburse_count"></h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">รายการยืมครุภัณฑ์ที่รออนุมัติ</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class='bx bx-time'></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="For_approve_count"></h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">รายการครุภัณฑ์ที่ยังไม่ส่งคืน</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="ri-mac-fill"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="For_notReturn_Count"></h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?php include("component/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

    <script>
        $(document).ready(async function() {

            await ApproveCount();
            await DisburseCount();
            await ReturnCount();

        }); //end ready function

        async function ApproveCount() {
            const url = "./controller/EmpDashboardController.php?ApproveCount=1";
            let ApproveData;
            await axios.get(url).then(function(res) {
                ApproveData = res.data;
            }).catch((err) => console.log(err))


            const Approve_Count = document.getElementById("For_approve_count");

            if (ApproveData[0].Count <= 0) {
                Approve_Count.innerHTML = 'ไม่มีรายการ'
            } else {
                Approve_Count.innerHTML = ApproveData[0].approve_count + ' รายการ';
            }
        }

        async function DisburseCount() {
            const url = "./controller/EmpDashboardController.php?DisburseCount=1";
            let DisburstData;
            await axios.get(url).then(function(res) {
                DisburstData = res.data;
            }).catch((err) => console.log(err))


            const Disburse_Count = document.getElementById("For_disburse_count");

            if (DisburstData[0].Count <= 0) {
                Disburse_Count.innerHTML = 'ไม่มีรายการ'
            } else {
                Disburse_Count.innerHTML = DisburstData[0].disburse_count + ' รายการ';
            }
        }

        async function ReturnCount() {
            const url = "./controller/EmpDashboardController.php?NotReturnCount=1";
            let ReturnData;
            await axios.get(url).then(function(res) {
                ReturnData = res.data;
            }).catch((err) => console.log(err))


            const Return_Count = document.getElementById("For_notReturn_Count");

            if (ReturnData[0].Count <= 0) {
                Return_Count.innerHTML = 'ไม่มีรายการ'
            } else {
                Return_Count.innerHTML = ReturnData[0].NotReturnCount + ' รายการ';
            }
        }
    </script>
</body>

</html>