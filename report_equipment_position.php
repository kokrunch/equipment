<?php include("component/checkSession.php"); ?>
<?php include("component/roleMat.php");
?>

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
            <h1>รายงานข้อมูลตำแหน่งครุภัณฑ์</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">รายงาน</li>
                    <li class="breadcrumb-item active">ตำแหน่งครุภัณฑ์</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตำแหน่งครุภัณฑ์</h5>
                            <div class="table-responsive">
                                <table id="table-report-equ-position" class="text-left" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th>ปีงบประมาณ</th>
                                            <th>ห้อง</th>
                                            <th class="text-center">จำนวน</th>
                                            <th class="text-center">ดูเพิ่มเติม</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body-report-equ-position">
                                    </tbody>
                                </table>
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
</body>

<script>
    $(document).ready(async function() {
        await getDataReportEquipmentPosition();
        $("#table-report-equ-position").DataTable({
            "oLanguage": {
                "sLengthMenu": "แสดง _MENU_ ต่อหน้า",
                "sZeroRecords": "ไม่มีข้อมูล",
                "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                "sSearch": "ค้นหา :",
                "aaSorting": [
                    [0, 'desc']
                ],
                "oPaginate": {
                    "sFirst": "หน้าแรก",
                    "sPrevious": "ก่อนหน้า",
                    "sNext": "ถัดไป",
                    "sLast": "หน้าสุดท้าย"
                },
            }
        });

    }); //end ready function
    async function getDataReportEquipmentPosition() {
        const url = "./controller/EquipmentController.php?getDataReportEquipmentPosition=1";
        let reportData;
        await axios.get(url).then(function(res) {
            reportData = res.data;
        }).catch((err) => console.log(err))

        Bodyreport = document.getElementById("body-report-equ-position");
        Bodyreport.innerHTML = "";
        reportData.forEach((element, i) => {
            Bodyreport.innerHTML += `
            <tr>
                <td class="text-center">${i+1}</td>
                <td>${element.equ_name}</td>
                <td>${element.budget_year}</td>
                <td>${element.room_name}</td>
                <td class="text-center">${element.sum_quantity}</td>
                <td class="text-center"><a href="details_equipment_material.php?room_id=${element.room_id}">ดูเพิ่มเติม</a></td>
            </tr>
            `
        });
    }
</script>

</html>