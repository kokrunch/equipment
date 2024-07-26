<?php include("component/checkSession.php");
?>
<?php include("component/roleMat.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>จัดการครุภัณฑ์ it-equipment-system</title>
    <?php include("component/header.php"); ?>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

    <div class="pagetitle">
            <h1>ติดตามครุภัณฑ์</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="manage_equipment.php">ครุภัณฑ์</a></li>
                    <li class="breadcrumb-item active">ติดตามครุภัณฑ์</li>
                    <li class="breadcrumb-item"><a href="manage_type_equipment.php">ประเภทครุภัณฑ์</a></li>
                    
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-dark" id="head_budget">ค้นหาครุภัณฑ์</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <span>หมายเลขครุภัณฑ์</span><input type="text" class="form-control" id="trac_equ">
                                </div>
                                <div class="col-md-4" style="padding-top: 24px;">
                                    <button class="btn btn-outline-primary" onclick="search_track_equ()">
                                        <i class='bx bx-search'></i>
                                        ค้นหา
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div id="alert_null_code"></div>
                        <div class="card-body" id="equ_details" style="display: none">
                            <h5 class="card-title" id="equ_code"></h5>

                            <div class="row mb-4">
                                <div class="col-md-5">
                                    <div class="box-img">
                                        <p></p>
                                        <img class="card-img-top" id="show_equ_image1" src="assets/img/no_image.png" alt="Equipment Image">
                                    </div>
                                </div>
                                <div class="col-md-7 mt-2">
                                    <div class="row my-2">
                                        <div class="col-12 col-lg-6 col-md-8 col-sm-6 my-1">
                                            <h5><b>ชื่อครุภัณฑ์ </b>: <span id="equ_name"></span></h5>
                                        </div>
                                        <div class="col-12 col-lg-6 col-md-8 col-sm-6 my-1">
                                            <h5><b>ประเภท </b>: <span id="equ_type"></span></h5>
                                        </div>
                                    </div>
                                    <div class="row my-2">
                                        <div class="col-12 col-lg-6 col-md-8 col-sm-6 my-1">
                                            <h5><b>ยี่ห้อ </b>: <span id="equ_brand"></span></h5>
                                        </div>
                                        <div class="col-12 col-lg-6 col-md-8 col-sm-6 my-1">
                                            <h5><b>หมายเลขเฉพาะ </b>: <span id="equ_serial_no"></span></h5>
                                        </div>
                                    </div>

                                    <div class="row my-2">
                                        <div class="col-12 col-lg-6 col-md-8 col-sm-6 my-1">
                                            <h5><b>รุ่น </b>: <span id="equ_model"></span></h5>
                                        </div>
                                        <div class="col-12 col-lg-6 col-md-8 col-sm-6 my-1">
                                            <h5><b>สี </b>: <span id="equ_color"></span></h5>
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-md-12">
                                            <h5><b>รายละเอียด </b>: <span id="equ_detail"></span></h5>
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-md-12">
                                            <h5><b>ห้องที่เก็บ </b>: <span id="room_num" class="btn btn-primary"></span></h5>
                                        </div>
                                    </div>
                                </div>

                                <!-- <div class="col-md-4">
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
                                </div> -->
                            </div>

                            <!-- <div class="row mb-2">
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
                                    <h5><b>ห้องที่เก็บ </b>: <span id="room_num" class="btn btn-primary"></span></h5>
                                </div>
                            </div> -->
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

    }); //end ready function
    async function search_track_equ() {

        const equ_code = document.getElementById("trac_equ").value;


        // console.log(equ_code);
        if (equ_code.length <= 0) {

            // console.log("null equ_code");
            document.getElementById("alert_null_code").innerHTML = `
            <div class="alert alert-warning m-4" role="alert">กรอกหมายเลยครุภัณฑ์</div>
            `;
            document.getElementById("alert_null_code").style.display = "block";
            document.getElementById("equ_details").style.display = 'none';

        } else {

            const url = "./controller/EquipmentController.php?gettracEquId=1&equ_code=" + equ_code;
            let trackequData;
            await axios.get(url).then(function(response) {
                trackequData = response.data;
            }).catch((err) => console.log(err));

            if (trackequData == 55) {

                // console.log("Not equ_code");
                document.getElementById("alert_null_code").innerHTML = `
            <div class="alert alert-danger m-4" role="alert">ไม่พบหมายเลยครุภัณฑ์</div>
            `;
                document.getElementById("alert_null_code").style.display = "block";
                document.getElementById("equ_details").style.display = 'none';

            } else {
                document.getElementById("equ_details").style.display = "block";
                document.getElementById("alert_null_code").style.display = "none";
                document.getElementById("equ_code").innerHTML = `ครุภัณฑ์หมายเลข ${trackequData[0].equ_code ? trackequData[0].equ_code : '-'}`;
                document.getElementById("equ_name").innerHTML = `${trackequData[0].equ_name ? trackequData[0].equ_name : '-'}`;
                document.getElementById("equ_type").innerHTML = `${trackequData[0].type_name ? trackequData[0].type_name : '-'}`;
                document.getElementById("equ_brand").innerHTML = `${trackequData[0].equ_brand ? trackequData[0].equ_brand : '-'}`;
                document.getElementById("equ_model").innerHTML = `${trackequData[0].equ_model ? trackequData[0].equ_model : '-'}`;
                document.getElementById("equ_color").innerHTML = `${trackequData[0].equ_color ? trackequData[0].equ_color : '-'}`;
                document.getElementById("equ_serial_no").innerHTML = `${trackequData[0].equ_serail_no ? trackequData[0].equ_serail_no : '-'}`;
                document.getElementById("equ_detail").innerHTML = `${trackequData[0].equ_detail ? trackequData[0].equ_detail : '-'}`;

                if (trackequData[0].room_name == "" || trackequData[0].room_name == null) {

                    document.getElementById("room_num").innerHTML = "อยู่ที่ไหนสักห้องนี่แหละ ไปหาเอง";

                } else if (trackequData[0].use_status == 0) {
                    document.getElementById("room_num").innerHTML = "อยู่ส่วนกลาง";
                } else if (trackequData[0].use_status == 1) {
                    document.getElementById("room_num").innerHTML = trackequData[0].room_name
                } else if (!trackequData[0].use_status) {
                    document.getElementById("room_num").innerHTML = "อยู่ส่วนกลาง";
                }

                if (trackequData[0].e_img1 == null) {
                    document.getElementById("show_equ_image1").src = "assets/img/no_image.png";
                } else {
                    document.getElementById("show_equ_image1").src = "assets/equipment_img/" + trackequData[0].e_img1;
                }
               
            }

        }

    }
</script>