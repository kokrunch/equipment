<?php include("component/checkSession.php"); ?>
<?php include("component/roleRepair.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarRepair.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>หน้าแดชบอร์ดของ ช่างซ่อมบำรุง</h1>
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
                                <h5 class="card-title">รายการแจ้งซ่อมที่รออนุมัติ</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class='bx bx-time'></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="For_emp_approve_count"></h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">รายการที่ต้องซ่อม</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class='bx bx-time'></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="For_emp_repair_count"></h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card sales-card">

                            <div class="card-body">
                                <h5 class="card-title">รายการซ่อมที่เสร็จสิ้น</h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class='bx bx-time'></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6 id="For_emp_finish_repair_count"></h6>
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
            await ApproveEmpCount();
            await RepairEmpCount();
            await FinishRepairEmpCount();
        });

        async function ApproveEmpCount() {
            const url = "./controller/RepairController.php?EmpApproveCount=1";
            let ArroveEmpData;
            await axios.get(url).then(function(res) {
                ArroveEmpData = res.data;
            }).catch((err) => console.log(err))


            const Approve_Emp_Count = document.getElementById("For_emp_approve_count");

            if (ArroveEmpData[0].Count <= 0) {
                Approve_Emp_Count.innerHTML = 'ไม่มีรายการ'
            } else {
                Approve_Emp_Count.innerHTML = ArroveEmpData[0].approve_emp_count + ' รายการ';
            }
        }

        async function RepairEmpCount() {
            const url = "./controller/RepairController.php?EmpRepairCount=1";
            let RepairEmpData;
            await axios.get(url).then(function(res) {
                RepairEmpData = res.data;
            }).catch((err) => console.log(err))


            const Repair_Emp_Count = document.getElementById("For_emp_repair_count");

            if (RepairEmpData[0].Count <= 0) {
                Repair_Emp_Count.innerHTML = 'ไม่มีรายการ'
            } else {
                Repair_Emp_Count.innerHTML = RepairEmpData[0].repair_emp_count + ' รายการ';
            }
        }

        async function FinishRepairEmpCount() {
            const url = "./controller/RepairController.php?EmpFinishRepairCount=1";
            let FinishRepairEmpData;
            await axios.get(url).then(function(res) {
                FinishRepairEmpData = res.data;
            }).catch((err) => console.log(err))


            const Finish_Repair_Emp_Count = document.getElementById("For_emp_finish_repair_count");

            if (FinishRepairEmpData[0].Count <= 0) {
                Finish_Repair_Emp_Count.innerHTML = 'ไม่มีรายการ'
            } else {
                Finish_Repair_Emp_Count.innerHTML = FinishRepairEmpData[0].finish_repair_emp_count + ' รายการ';
            }
        }
    </script>
</body>

</html>