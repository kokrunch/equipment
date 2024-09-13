<?php include("component/checkSession.php"); ?>
<?php include("component/roleMat.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system จัดการหน่วยนับ</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">


        <div class="pagetitle">
            <h1>ข้อมูลหน่วยนับ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">จัดการวัสดุ</li>
                    <li class="breadcrumb-item active">ข้อมูลหน่วยนับ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">แสดงหน่วยนับ</h5>
                            <div class="d-flex justify-content-end">

                                <button type="button" class="btn btn-outline-primary rounded mb-3" data-bs-toggle="modal" data-bs-target="#addModalUnit">
                                    เพิ่มข้อมูล
                                </button>

                            </div>
                            <div class="table-responsive">
                                <table id="table-unit" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 80px;">ลำดับ</th>
                                            <th style="width: 80px;">ชื่อหน่วยนับ</th>
                                            <th style="width: 80px;"></th>

                                        </tr>
                                    </thead>

                                    <tbody id="body-unit">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="addModalUnit" tabindex="-1" aria-labelledby="addModalUnitLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form action="" id="addUnit">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มหน่วยนับ</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3 mb-2 ">

                                    <div class="col-12">
                                        <label for="" class="form-label"><span class="text-danger">*</span>
                                            ชื่อหน่วยนับ</label>
                                        <input type="text" class="form-control" id="unit_name" placeholder="กรอกชื่อหน่วยนับ">
                                    </div>

                                </div>
                                <div class=" modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                    <button type="button" onclick="addUnit()" class="btn btn-primary">เพิ่มข้อมูล</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Add data -->

        <div class="modal fade" id="EditModalUnit" tabindex="-1" aria-labelledby="EditModalUnitLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" id="editUnit">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขหน่วยนับ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 mb-2 ">
                                <input type="hidden" class="form-control" id="unit_id_up" placeholder="กรอกชื่อหน่วยนับ">
                                <div class="col-12">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ชื่อหน่วยนับ</label>
                                    <input type="text" class="form-control" id="unit_name_up" placeholder="กรอกชื่อหน่วยนับ">
                                </div>

                            </div>
                            <div class=" modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <button type="button" onclick="updateUnit()" class="btn btn-primary">แก้ไขข้อมูล</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
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

        await getUnit(0).then(() => writeTable("#table-unit"));

    }); //end ready function



    async function getUnit(reload) {
        const url = "./controller/UnitController.php?getUnit=1";
        let UnitData;
        await axios.get(url).then(function(res) {
            UnitData = res.data;
        }).catch((err) => console.log(err))

        if (reload == 1) {
            $("#table-unit").DataTable().destroy();
        }

        BodyUnit = document.getElementById("body-unit");
        BodyUnit.innerHTML = "";
        UnitData.forEach((element, i) => {
            BodyUnit.innerHTML += `
            <tr>
                <td align="left">${i+1}</td>
                <td align="left">${element.unit_name}</td>
                <td>
                 <button type="button" class="btn btn-outline-warning mt-1" onClick="openModalEdit('${element.unit_id}','${element.unit_name}')"><i class="bx bxs-edit"></i></button>
                 <button type="button" class="btn btn-outline-danger mt-1" onclick="deleteUnit(${element.unit_id})"><i class="bx bxs-trash"></i></button>
                </td>
            </tr>
            `
        });
    }

    async function addUnit() {

        let unit_name = document.getElementById("unit_name").value;

        if (unit_name == "") {
            document.getElementById("unit_name").focus();
            Swal.fire({
                icon: 'info',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน !!',
                showConfirmButton: false,
                timer: 1500
            })
        } else {

            var formData = new FormData();
            formData.append("unit_name", unit_name);
            formData.append("addUnit", 1);

            var xhttp = new XMLHttpRequest();
            const url = "./controller/UnitController.php";
            xhttp.open("POST", url, true);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลหน่วยนับสำเร็จ !!',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(async () => {
                            $("#addModalUnit").modal('hide');
                            $('#addModalUnit input').val('');
                            await getUnit(1).then(() => writeTable("#table-unit"));
                        })

                    } else if (response == 55) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'รายการซ้ำ !!',
                            showConfirmButton: false,
                            timer: 1500
                        })

                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'เกิดข้อผิดพลาด !!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            };

            xhttp.send(formData);

        }
    }

    function openModalEdit(unit_id, unit_name) {
        $("#EditModalUnit").modal('show');

        document.getElementById("unit_id_up").value = unit_id;
        document.getElementById("unit_name_up").value = unit_name;
    }

    async function updateUnit() {

        let unit_id_up = document.getElementById("unit_id_up").value;
        let unit_name_up = document.getElementById("unit_name_up").value;

        if (unit_name_up == "") {
            document.getElementById("unit_name_up").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล หน่วยนับ',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        const jsonData = {
            unit_id_up: unit_id_up,
            unit_name_up: unit_name_up,
            updateunit: true
        }

        const url = "./controller/UnitController.php";
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
                    icon: 'success',
                    title: 'แก้ไขข้อมูลหน่วยนับสำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then(async () => {
                    $("#EditModalUnit").modal('hide');
                    await getUnit(1).then(() => writeTable("#table-unit"));
                })
            } else if (res.data == 55) {
                Swal.fire({
                    icon: 'warning',
                    title: 'รายการซ้ำ !!',
                    showConfirmButton: false,
                    timer: 1500
                })

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: "โปรดลองใหม่อีกครั้ง",
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })
    }

    async function deleteUnit(unit_id) {

        Swal.fire({
            title: 'ต้องการลบหน่วยนับหรือไม่ ?',
            text: 'หากลบ ข้อมูลหน่วยนับนี้จะหายไป',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then(async (result) => {
            if (result.isConfirmed) {
                const url = "./controller/UnitController.php";
                await axios({
                    method: 'post',
                    url: url,
                    data: {
                        unit_id: unit_id,
                        deleteUnit: true
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                }).then((res) => {
                    let response = res.data;
                    if (response == 1) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'ลบหน่วยนับสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(async () => {
                            await getUnit(1).then(() => writeTable("#table-unit"));
                        })
                    } else if (response == 2) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบหน่วยนับไม่สำเร็จ !!',
                            text: 'เนื่องจากหน่วยนับถูกใช้งานอยู่ !!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(async () => {
                            await getUnit(1).then(() => writeTable("#table-unit"));
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบหน่วยนับไม่สำเร็จ !!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(async () => {
                            await getUnit(1).then(() => writeTable("#table-unit"));
                        })
                    }
                })
            }
        })
    }
</script>