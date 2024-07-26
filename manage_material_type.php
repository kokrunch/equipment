<?php include('component/checkSession.php') ?>
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
            <h1>จัดการประเภทวัสดุ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">จัดการวัสดุ</li>
                    <li class="breadcrumb-item active">จัดการประเภทวัสดุ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">วัสดุและครุภัณฑ์</h5>
                            <div class="d-flex justify-content-end">

                                <button type="button" class="btn btn-outline-primary rounded mb-3"
                                    data-bs-toggle="modal" data-bs-target="#addModal">
                                    เพิ่มประเภทวัสดุ
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="table-mat_type" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อประเภทวัสดุ</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="mat_type">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- AddMatype Modal -->

        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มประเภทวัสดุ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container fluid">
                            <div class="row g-3 mb-2">
                                <div class="col-12">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ชื่อประเภทวัสดุ</label>
                                    <input type="text" class="form-control" id="type_name"
                                        placeholder="กรอกชื่อประเภทวัสดุ">
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="insertMatType()"
                                class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- updateMatType Model -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขประเภทวัสดุ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container fluid">
                            <div class="row g-3 mb-2">
                                <div class="col-12">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ชื่อประเภทวัสดุ</label>
                                    <input type="text" class="form-control" id="update_type_name"
                                        placeholder="กรอกชื่อประเภทวัสดุ">
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <input type="hidden" id="matType_id" value="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="updateMatType()"
                                class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </main><!-- End #main -->

    <?php include("component/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

    <script>
    $(document).ready(async function() {

        await getTypeMeterial(0).then(async () => writeTable("#table-mat_type"))

    }); //end ready function

    async function getTypeMeterial(reload) {
        const url = "./controller/MaterialController.php?gettypemat=1";
        let typeMatData;
        await axios.get(url).then(function(res) {
            typeMatData = res.data;
        }).catch((err) => console.log(err))

        if (reload == 1) {
            $("#table-mat_type").DataTable().destroy();
        }

        const BodyTypeMeterial = document.getElementById("mat_type");
        BodyTypeMeterial.innerHTML = "";
        typeMatData.forEach((element, index) => {
            BodyTypeMeterial.innerHTML += `
            <tr>
                <td align="left">${index+1}</td>
                <td align="left">${element.type_name}</td>
                <td >
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" 
                            data-bs-target="#updateModal")" onclick = "editTypeMaterial(${element.type_id})"><i class="bx bxs-edit"></i></button>
                    <button type="button" class="btn btn-outline-danger" 
                            onclick = "deleteMatType(${element.type_id})"><i class="bx bxs-trash"></i></button>
                </td>
            </tr>
            `
        });
    }

    async function insertMatType() {
        let type_name = document.getElementById("type_name").value;

        if (type_name == '') {
            Swal.fire('กรุณากรอกชื่อประเภทวัสดุ', '', 'info')
            return;
        }

        const data = {
            insertMatType: "insertMatType",
            type_name: type_name
        }

        const url = "./controller/MaterialController.php";
        await axios({
            method: 'post',
            url: url,
            data: data,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        }).then((res) => {
            if (res.data == 1) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'เพิ่มประเภทวัสดุสำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then(async () => {
                    $("#addModal").modal('hide');
                    document.getElementById("type_name").value = "";
                    await getTypeMeterial(1).then(async () => writeTable("#table-mat_type"))
                })
            }
        })
    }

    async function deleteMatType(MatType_id) {

        const url = "./controller/MaterialController.php?deleteMatType=" +
            MatType_id;

        Swal.fire({
            title: 'ยืนยันการลบวัสดุ',
            text: "ต้องการลบวัสดุใช่หรือไม่ ?",
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
                            title: 'ลบประเภทวัสดุสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(async () => {
                            await getTypeMeterial(1).then(async () => writeTable("#table-mat_type"))
                        });
                    } else if (response == 2) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบประเภทไม่สำเร็จ',
                            text: 'เนื่องจากประเภทวัสดุนี้ถุกใช้งานอยู่',
                            showConfirmButton: true,
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบประเภทไม่สำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }).catch((err) => console.log(err))
            }
        })

    }

    async function editTypeMaterial(type_id) {
        const url = "./controller/MaterialController.php?getTypeMatid=" +
            type_id;
        let typeData;
        await axios.get(url).then(function(res) {
            typeData = res.data;
        }).catch((err) => console.log(err))

        typeData.forEach((element, index) => {
            document.getElementById("matType_id").value = element.type_id;
            document.getElementById("update_type_name").value = element.type_name;
        });

    }

    async function updateMatType() {

        let matType_id = document.getElementById("matType_id").value;
        let update_type_name = document.getElementById("update_type_name").value;

        if (!update_type_name) {
            Swal.fire({
                icon: 'info',
                title: 'กรุณากรอกข้อมูลชื่อประเภทวัสดุ !!',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            const data = {
                updateMatType: "updateMatType",
                update_type_name: update_type_name,
                matType_id: matType_id
            }

            const url = "./controller/MaterialController.php";
            await axios({
                method: 'post',
                url: url,
                data: data,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then((res) => {
                if (res.data == 1) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'แก้ไขประเภทวัสดุสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        $("#updateModal").modal('hide');
                        await getTypeMeterial(1).then(async () => writeTable("#table-mat_type"))
                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'เกิดข้อผิดพลาด !!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
        }

    }
    </script>

</body>

</html>