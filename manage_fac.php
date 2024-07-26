<?php include("component/checkSession.php"); ?>
<?php include("component/roleAdmin.php  "); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>จัดการคณะ it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebar.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>จัดการภาคคณะ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">จัดการคณะและภาควิชา</li>
                    <li class="breadcrumb-item active">คณะ</li>
                </ol>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mt-3">
                                <h1 id="fac_name" style="display: block;"></h1>
                                <input type="text" class="form-control text-center" id="input_facname" style="display: none;font-size: 25px;width: 50%;">
                                <input type="hidden" class="form-control" id="input_fac_id" style="display: none;width: 50%;">
                            </div>
                            <div class="d-flex justify-content-center mt-3">
                                <button class="btn btn-outline-primary" id="btn-show-edit" type="button" style="width: 50%;" onclick="switchBtnEdit()">แก้ไขชื่อคณะ</button>
                                <button class="btn btn-primary" id="btn-edit" type="button" style="width: 44%;margin-right: 10px;" onclick="EditFaculty()">บันทึกการแก้ไขชื่อคณะ</button>
                                <button class="btn btn-outline-danger" id="btn-cencel" type="button" style="width: 5%;" onclick="switchBtnEdit()"><i class="bi bi-x-lg"></i></button>
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
        var check_switchBtn = 0;
        $(document).ready(async function() {
            $("#btn-edit").hide()
            $("#btn-cencel").hide()
            await getFaculty();
        }); //end ready function


        async function getFaculty() {
            const url = "./controller/FacultyController.php?getFac=1";
            let facData;
            await axios.get(url).then(function(response) {
                facData = response.data;
            }).catch((err) => console.log(err));

            const facName = document.getElementById("fac_name");
            if (facData.length == 0) {
                facName.innerHTML = "ยังไม่ได้ระบุคณะ";
                document.getElementById("input_fac_id").value = 0;
                return;
            }

            facName.innerHTML = facData[0].fac_name;
            document.getElementById("input_facname").value = facData[0].fac_name
            document.getElementById("input_fac_id").value = facData[0].fac_id
        }

        function switchBtnEdit() {
            if (check_switchBtn == 0) {
                document.getElementById("fac_name").style.display = "none";
                document.getElementById("input_facname").style.display = "block";
                $("#btn-show-edit").hide()
                $("#btn-edit").show()
                $("#btn-cencel").show()
                document.getElementById("input_facname").focus();
                check_switchBtn = 1;
            } else {
                document.getElementById("fac_name").style.display = "block";
                document.getElementById("input_facname").style.display = "none";
                $("#btn-show-edit").show()
                $("#btn-edit").hide()
                $("#btn-cencel").hide()
                check_switchBtn = 0;
            }

        }


        async function EditFaculty() {
            let fac_id = document.getElementById("input_fac_id").value
            let fac_name = document.getElementById("input_facname").value
            if (fac_name == "") {
                document.getElementById("input_facname").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกข้อมูลชื่อคณะ',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
            const jsonData = {
                fac_name: fac_name,
                fac_id: fac_id,
                updateFac: true
            }
            const url = "./controller/FacultyController.php";
            await axios({
                method: 'post',
                url: url,
                data: jsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then((res) => {
                if (res.data == 1) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'แก้ไขคณะสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        getFaculty()
                        switchBtnEdit()
                    })
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: "โปรดลองใหม่อีกครั้ง",
                        showConfirmButton: true
                    })
                }
            })
        }
    </script>
</body>

</html>