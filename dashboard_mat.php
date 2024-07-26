<?php include("component/checkSession.php"); ?>
<?php include("component/roleMat.php"); ?>

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
            <h1>หน้าแดชบอร์ดของ เจ้าหน้าที่</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item active">หน้าหลัก</li>
                    <li class="breadcrumb-item"></li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">รายการการเบิกวัสดุที่ "รออนุมัติ"</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="disapprv_waiting"></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">รายการการยืมครุภัณฑ์ที่ "รออนุมัติ"</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="borrow_waiting"></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">รายการการยืมครุภัณฑ์ที่ "รอส่งคืน"</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="equ_waiting_for_return"></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-md-6">
                            <div class="card info-card sales-card">

                                <div class="card-body">
                                    <h5 class="card-title">รายการการแจ้งซ่อมที่ "รอส่งซ่อม"</h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-tools"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="repair_waiting"></h6>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                    </div>
                </div><!-- End Left side columns -->

            </div>
        </section>

    </main><!-- End #main -->

    <?php include("component/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

    <script>
        $(document).ready(async function() {
            await getDataDisburseWaiting();
            await getDataRepairWaiting();
            await getDataBorrowWaiting();
            await getDataEquWaitingReturn();
        }); //end ready function

        async function getDataDisburseWaiting() {
            const url = "./controller/DisburseController.php?getDataDisburseWaiting=1";
            let DataWaiting;
            await axios.get(url).then(function(res) {
                DataWaiting = res.data[0]['count_waiting'];
            }).catch((err) => console.log(err))

            document.getElementById("disapprv_waiting").innerHTML = DataWaiting + " รายการ";

        }

        async function getDataRepairWaiting() {
            const url = "./controller/RepairController.php?getdatarepairCountWating=1";
            let DataWaiting;
            await axios.get(url).then(function(res) {
                DataWaiting = res.data[0]['count_waiting'];
            }).catch((err) => console.log(err))

            document.getElementById("repair_waiting").innerHTML = DataWaiting + " รายการ";

        }

        async function getDataBorrowWaiting() {
            const url = "./controller/RepairController.php?getdataborrowCountWating=1";
            let DataWaiting;
            await axios.get(url).then(function(res) {
                DataWaiting = res.data[0]['count_waiting'];
            }).catch((err) => console.log(err))

            document.getElementById("borrow_waiting").innerHTML = DataWaiting + " รายการ";

        }

        async function getDataEquWaitingReturn() {
            const url = "./controller/BorrowEquController.php?getDataEquWaitingReturn=1";
            let DataEquWaitingReturn

            await axios.get(url).then(function(res) {
                DataEquWaitingReturn = res.data[0]['Count'];
            }).catch((err) => console.log(err))

            document.getElementById("equ_waiting_for_return").innerHTML = DataEquWaitingReturn + " รายการ";

        }
    </script>
</body>

</html>