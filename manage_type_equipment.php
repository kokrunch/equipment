<?php include("component/checkSession.php"); ?>
<?php include("component/roleMat.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>it-equipment-system จัดการครุภัณฑ์</title>
    <?php include("component/header.php"); ?>

</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>จัดการประเภทครุภัณฑ์</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="manage_equipment.php">ครุภัณฑ์</a></li>
                    <li class="breadcrumb-item"><a href="tracking_equipment.php">ติดตามครุภัณฑ์</a></li>
                    <li class="breadcrumb-item active">ประเภทครุภัณฑ์</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">รายการประเภทครุภัณฑ์</h5>
                            <div class="d-flex justify-content-end">

                                <button type="button" class="btn btn-outline-primary rounded mb-3" data-bs-toggle="modal" data-bs-target="#addModalEquType">
                                    <i class="bx bx-plus"></i> เพิ่มข้อมูล
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="table-equipmentType" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อประเภทครุภัณฑ์</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-equ">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Add data -->
        <div class="modal fade" id="addModalEquType" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">เพิ่มประเภทครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ชื่อประเภทครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_type_name" placeholder="กรอกชื่อครุภัณฑ์">
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="addTypeEquipment()" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- edit -->
        <div class="modal fade" id="editModalEquType" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">แก้ไขประเภทครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ชื่อประเภทครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_type_name_edit" placeholder="กรอกชื่อครุภัณฑ์">
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <input type="hidden" id="type_mat_id" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="UpdateTypeEquiment()" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                </div>
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

        await getEquipment(0).then(() => writeTable("#table-equipmentType"));

    }); //end ready function

    async function getEquipment(reload) {
        const url = "./controller/EquipmentController.php?getEquType=1";
        let equData;
        await axios.get(url).then(function(response) {
            equData = response.data;
        }).catch((err) => console.log(err));

        const bodyEqu = document.getElementById("body-equ");

        if (reload == 1) {
            $("#table-equipmentType").DataTable().destroy();
        }
        bodyEqu.innerHTML = "";

        equData.forEach((element, index) => {
            bodyEqu.innerHTML += `
            <tr>
                <td align="left">${index+1}</td>
                <td align="left">${element.type_name}</td>
                <td>
                    <button type="button" class="btn btn-outline-warning mb-2 mt-2" data-bs-toggle="modal" data-bs-target="#editModalEquType" onclick="editTypeEquiment(${element.type_id})"><i class="bx bxs-edit"></i></button>
                    <button type="button" class="btn btn-outline-danger" onclick="del_typeEqu(${element.type_id})"><i class="bx bxs-trash"></i></button>
                </td>
            </tr>
            `
        });
    }

    async function addTypeEquipment() {
        let type_equ_name = document.getElementById("equ_type_name").value;

        let JsonData = {
            addTypeEquipment: true,
            type_name: type_equ_name
        }

        if (type_equ_name == 0) {
            Swal.fire('กรุณากรอกชื่อประเภทครุภัณฑ์', '', 'info')
            return;
        }

        const url = "./controller/EquipmentController.php";
        await axios({
            method: 'post',
            url: url,
            data: JsonData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        }).then((res) => {
            if (res.data == 1) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'เพิ่มข้อมูลประเภทครุภัณฑ์สำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then(async () => {
                    await getEquipment(1).then(() => writeTable("#table-equipmentType"))
                    $("#addModalEquType").modal('hide');

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

    async function editTypeEquiment(type_id) {
        const url = "./controller/EquipmentController.php?getTypeEquid=" +
            type_id;
        let typeData;
        await axios.get(url).then(function(res) {
            typeData = res.data;
        }).catch((err) => console.log(err))

        typeData.forEach((element, index) => {
            document.getElementById("type_mat_id").value = element.type_id;
            document.getElementById("equ_type_name_edit").value = element.type_name;
        });

    }

    async function UpdateTypeEquiment() {
        let type_id = document.getElementById("type_mat_id").value;
        let type_name = document.getElementById("equ_type_name_edit").value;

        if (!type_name) {
            Swal.fire({
                icon: 'info',
                title: 'กรุณากรอกข้อมูลประเภทครุภัณฑ์ !!',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            let JsonData = {
                updateTypeEqu: "updateTypeEqu",
                type_id: type_id,
                type_name: type_name
            }
            const url = "./controller/EquipmentController.php";
            await axios({
                method: 'post',
                url: url,
                data: JsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then((res) => {
                if (res.data == 1) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'แก้ไขข้อมูลประเภทครุภัณฑ์สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        $("#editModalEquType").modal('hide');
                        await getEquipment(1).then(() => writeTable("#table-equipmentType"))
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


    }

    async function del_typeEqu(type_equ_id) {
        const url = "./controller/EquipmentController.php?deltypeEqu=" +
            type_equ_id;

        Swal.fire({
            title: 'ยืนยันการลบประเภทครุภัณฑ์ !!',
            text: "ต้องการลบประเภทครุภัณฑ์ใช่หรือไม่ ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันการลบ',
            cancelButtonText: 'ยกเลิก'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await axios.get(url).then(function(res) {
                    let response = res.data;
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลประเภทครุภัณฑ์สำเร็จ !!',
                            showConfirmButton: false,
                            timer: 3000
                        }).then(async () => {
                            await getEquipment(1).then(() => writeTable("#table-equipmentType"))
                        });
                    } else if (response == 2) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบข้อมูลประเภทครุภัณฑ์ไม่สำเร็จ !!',
                            text: 'ประเภทครุภัณฑ์ถูกใช้งานอยู่',
                            showConfirmButton: true,
                            confirmButtonText: 'ตกลง',
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบข้อมูลประเภทครุภัณฑ์ไม่สำเร็จ !!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                }).catch((err) => console.log(err))
            } else {

            }

        })
    }
</script>