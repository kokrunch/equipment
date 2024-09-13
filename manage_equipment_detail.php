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
            <h1>รายละเอียดครุภัณฑ์</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">จัดการครุภัณฑ์</li>
                    <li class="breadcrumb-item"><a href="manage_equipment.php">ครุภัณฑ์</a></li>
                    <li class="breadcrumb-item active">รายละเอียดครุภัณฑ์</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <?php if (isset($_GET['equ_id'])) { ?>

                            <div class="card-body">
                                <div class="d-flex justify-content-start mt-3 mb-2">
                                    <h3 id="title-equ" style="color: #012970;">รายละเอียดครุภัณฑ์</h3>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="box-img">
                                            <p>รูปภาพ</p>
                                            <img class="card-img-top" id="show_equ_image1" src="assets/img/no_image.png" alt="Equipment Image">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box-img">
                                            <p>ซ้าย</p>
                                            <img class="card-img-top" id="show_equ_image2" src="assets/img/no_image.png" alt="Equipment Image">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="box-img">
                                            <p>ขวา</p>
                                            <img class="card-img-top" id="show_equ_image3" src="assets/img/no_image.png" alt="Equipment Image">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <h5><b>ชื่อครุภัณฑ์ </b>: <span id="equ_name"></span></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><b>ประเภท </b>: <span id="equ_type"></span></h5>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <h5><b>ยี่ห้อ </b>: <span id="equ_brand"></span></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><b>หมายเลขเฉพาะ </b>: <span id="equ_serial_no"></span></h5>
                                    </div>
                                </div>

                                <div class="row mb2">
                                    <div class="col-md-6">
                                        <h5><b>รุ่น </b>: <span id="equ_model"></span></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5><b>สี </b>: <span id="equ_color"></span></h5>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5><b>รายละเอียด </b>: <span id="equ_detail"></span></h5>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-12">
                                        <h5><b>ผู้ครอบครอง </b>: <span id="equ_owner"></span></h5>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-start mt-3 mb-4">
                                    <h3 id="title-equ" style="color: #012970;">ประวัติการนำเข้า</h3>
                                </div>

                                <div class="table-responsive">
                                    <table id="table-equipment-detail" class="table table-striped text-center" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">ลำดับ</th>
                                                <th class="text-center">เลขที่ใบรับ</th>
                                                <th class="text-center">จำนวน</th>
                                                <th class="text-center">ราคาต้นทุน</th>
                                                <th class="text-center">ราคาต้นทุนทั้งสิ้น</th>
                                            </tr>
                                        </thead>
                                        <tbody id="body-equipment-detail">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        <?php } ?>
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
            await getEquipmentBudget();
            $("#table-equipment-detail").DataTable({
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


        async function getEquipmentBudget() {
            const equ_id = '<?php echo $_GET['equ_id']; ?>'
            const url = "./controller/EquipmentController.php?getEquBudgetWhereEquId=1&equ_id=" + equ_id;
            let equBudgetData;
            await axios.get(url).then(function(response) {
                equBudgetData = response.data;
            }).catch((err) => console.log(err));
            const bodyEquDetail = document.getElementById("body-equipment-detail");
            // const optionSelectEqu = document.getElementById("equ_name_select");
            console.log("ddddd",equBudgetData)

            document.getElementById("equ_name").innerHTML = equBudgetData[0].equ_name;
            document.getElementById("equ_type").innerHTML = equBudgetData[0].type_name
            document.getElementById("equ_brand").innerHTML = equBudgetData[0].equ_brand
            document.getElementById("equ_model").innerHTML = equBudgetData[0].equ_model
            document.getElementById("equ_color").innerHTML = equBudgetData[0].equ_color
            document.getElementById("equ_serial_no").innerHTML = equBudgetData[0].equ_serail_no
            document.getElementById("equ_detail").innerHTML = equBudgetData[0].equ_detail;
            document.getElementById("equ_owner").innerHTML = equBudgetData[0].equ_owner;
            equBudgetData[0].e_img1 == null ? document.getElementById("show_equ_image1").src = "assets/img/no_image.png" : document.getElementById("show_equ_image1").src = "assets/equipment_img/" + equBudgetData[0].e_img1;
            equBudgetData[0].e_img2 == null ? document.getElementById("show_equ_image2").src = "assets/img/no_image.png" : document.getElementById("show_equ_image1").src = "assets/equipment_img/" + equBudgetData[0].e_img2;
            equBudgetData[0].e_img3 == null ? document.getElementById("show_equ_image3").src = "assets/img/no_image.png" : document.getElementById("show_equ_image1").src = "assets/equipment_img/" + equBudgetData[0].e_img3;

            bodyEquDetail.innerHTML = "";
            if (equBudgetData.length == 0) {
                return;
            }
            let allSumprice = 0;
            equBudgetData.forEach((element, i) => {
                const sumPrice = parseInt(element.equ_stock) * parseFloat(element.equ_price)
                allSumprice += sumPrice;
                bodyEquDetail.innerHTML += `
                    <tr>
                        <td>${i+1}</td>
                        <td>${element.equ_bud_id}/${parseInt(element.budget_start_date.split("-")[0]) + 43}</td>
                        <td>${element.equ_stock}</td>
                        <td>${element.equ_price.toLocaleString()}</td>
                        <td>${sumPrice.toLocaleString()}</td>
                    </tr>
                    `;
            });
        }
    </script>
</body>

</html>