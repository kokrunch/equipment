<?php include("component/checkSession.php"); ?>
<?php include("component/roleAdmin.php  "); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebar.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>จัดการตำแหน่ง/หน้าที่ผู้ใช้งาน</h1>

            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">จัดการสิทธิ์ผู้ใช้งาน</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">จัดการตำแหน่ง/หน้าที่ผู้ใช้งาน</h5>
                            <div class="d-flex justify-content-end">

                                <button type="button" class="btn btn-outline-primary rounded mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                                    เพิ่มตำแหน่ง/หน้าที่ผู้ใช้งาน
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="table-role" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อตำแหน่ง/หน้าที่</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="emp_role">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Add_Role Modal -->

        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">เพิ่มตำแหน่ง/หน้าที่ผู้ใช้งาน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container fluid">
                            <div class="row g-3 mb-2">
                                <div class="col-12">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ชื่อตำแหน่ง/หน้าที่</label>
                                    <input type="text" class="form-control" id="role_name" placeholder="กรอกชื่อตำแหน่ง/หน้าที่">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        สิทธิ์ผู้ใช้งาน</label>
                                    <select class="form-select" aria-label="Default select" id="select_role_id">
                                        <option value="0" selected>โปรดเลือกสิทธิ์ผู้ใช้งาน</option>
                                        <option value="1">ผู้ดูแลระบบ</option>
                                        <option value="2">อาจารย์/บุคลากร</option>
                                        <option value="3">เจ้าหน้าที่</option>
                                        <option value="4">ช่าง</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="insertEmpRole()" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- updateRole Model -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">แก้ไขตำแหน่ง/หน้าที่ผู้ใช้งาน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body container fluid">
                            <div class="row g-3 mb-2">
                                <div class="col-12">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ชื่อตำแหน่ง/หน้าที่</label>
                                    <input type="text" class="form-control" id="update_role_name" placeholder="กรอกชื่อตำแหน่ง/หน้าที่">
                                </div>
                                <div class="col-12">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        สิทธิ์ผู้ใช้งาน</label>
                                    <select class="form-select" aria-label="Default select" id="select_role_id_update">
                                        <option value="0" selected>โปรดเลือกสิทธิ์ผู้ใช้งาน</option>
                                        <option value="1">ผู้ดูแลระบบ</option>
                                        <option value="2">อาจารย์/บุคลากร</option>
                                        <option value="3">เจ้าหน้าที่</option>
                                        <option value="4">ช่าง</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <input type="hidden" id="role_id" value="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="updateEmpRole()" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </main><!-- End #main -->

    <?php include("component/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

    <script>
        $(document).ready(async function() {

            await getEmpRoleFunc(0).then(() => writeTable("#table-role"));

        }); //end ready function

        async function getEmpRoleFunc(reload) {
    const url = "./controller/UserController.php?getEmpRole=1";
    let RoleData;

    try {
        const response = await axios.get(url);
        RoleData = response.data;
        console.log("RoleData:", RoleData); // แสดงข้อมูลที่ได้กลับมา
    } catch (err) {
        console.error("Error fetching RoleData:", err);
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'ไม่สามารถดึงข้อมูลสิทธิ์ผู้ใช้งานได้ กรุณาลองใหม่อีกครั้ง',
        });
        return;
    }

    // ตรวจสอบว่า RoleData เป็นอาร์เรย์หรือไม่
    if (!Array.isArray(RoleData)) {
        console.error("RoleData is not an array:", RoleData);
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาด',
            text: 'ข้อมูลสิทธิ์ผู้ใช้งานที่ได้รับมาไม่ถูกต้อง กรุณาติดต่อผู้ดูแลระบบ',
        });
        return;
    }

    // ถ้า reload มีค่าเป็น 1 ให้ทำลาย DataTable เดิมก่อนสร้างใหม่
    if (reload == 1) {
        $("#table-role").DataTable().destroy();
    }

    const BodyTypeEmpRole = document.getElementById("emp_role");
    BodyTypeEmpRole.innerHTML = "";

    RoleData.forEach((element, index) => {
        BodyTypeEmpRole.innerHTML += `
            <tr>
                <td align="left">${index + 1}</td>
                <td align="left">${element.sub_role_name}</td>
                <td>
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="editEmpRole(${element.sub_role_id})">
                        <i class="bx bxs-edit"></i>
                    </button>
                    <button type="button" class="btn btn-outline-danger" onclick="deleteEmpRole(${element.sub_role_id})">
                        <i class="bx bxs-trash"></i>
                    </button>
                </td>
            </tr>
        `;
    });

    // หลังจากอัปเดตข้อมูลในตารางแล้ว ให้เรียกใช้ DataTable ใหม่
    if (reload == 1) {
        $('#table-role').DataTable();
    }
}



        async function insertEmpRole() {
            let role_name = document.getElementById("role_name").value;
            let role_id = document.getElementById("select_role_id").value;
            if (role_name == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'กรุณากรอกชื่อตำแหน่ง/หน้าที่',
                    showConfirmButton: true,
                    confirmButtonText: "ตกลง",
                })
                return;
            }


            if (role_id == 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'กรุณากรอกชื่อตำแหน่ง/หน้าที่',
                    showConfirmButton: true,
                    confirmButtonText: "ตกลง",
                })
                return;
            }

            const data = {
                insertEmpRole: "insertEmpRole",
                role_name: role_name,
                role_id: role_id
            }

            const url = "./controller/UserController.php";
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
                        title: 'เพิ่มสิทธิ์ผู้ใช้งานสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        $("#addModal").modal('hide');
                        document.getElementById("role_name").value = "";
                        document.getElementById("select_role_id").value = "0";
                        await getEmpRoleFunc(1).then(() => writeTable("#table-role"));
                    })
                }
            })
        }

        async function editEmpRole(role_id) {
            const url = "./controller/UserController.php?getRoleid=" + role_id;
            let RoleData;
            await axios.get(url).then(function(res) {
                RoleData = res.data;
            }).catch((err) => console.log(err))

            document.getElementById("role_id").value = RoleData[0].sub_role_id;
            document.getElementById("update_role_name").value = RoleData[0].sub_role_name;
            document.getElementById("select_role_id_update").value = RoleData[0].role_id;
        }

        async function updateEmpRole() {

            let sub_role_id = document.getElementById("role_id").value;
            let update_role_name = document.getElementById("update_role_name").value;
            let role_id = document.getElementById("select_role_id_update").value;
            if (update_role_name == '') {
                Swal.fire({
                    icon: 'info',
                    title: 'กรุณากรอกตำแหน่ง/หน้าที่ผู้ใช้งาน',
                    showConfirmButton: true,
                    confirmButtonText: "ตกลง",
                })
                return;
            }

            if (role_id == 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'กรุณากรอกตำแหน่ง/หน้าที่ผู้ใช้งาน',
                    showConfirmButton: true,
                    confirmButtonText: "ตกลง",
                })
                return;
            }

            const data = {
                updateEmpRole: "updateEmpRole",
                update_role_name: update_role_name,
                role_id: role_id,
                sub_role_id: sub_role_id
            }

            const url = "./controller/UserController.php";
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
                        title: 'แก้ไขสิทธิ์ผู้ใช้งานสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        $("#updateModal").modal('hide');
                        await getEmpRoleFunc(1).then(() => writeTable("#table-role"));
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

        async function deleteEmpRole(role_id) {

            const url = "./controller/UserController.php?deleteEmpRole=" + role_id;

            Swal.fire({
                title: 'ยืนยันการลบสิทธิ์ผู้ใช้งาน',
                text: "ต้องการลบสิทธิ์ผู้ใช้งานนี้ใช่หรือไม่ ?",
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
                                title: 'ลบสิทธิ์ผู้ใช้งานสำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                getEmpRoleFunc()
                            });
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'ไม่สามารถลบลบสิทธิ์ผู้ใช้งานได้',
                                text: "เนื่องจากสิทธิ์นี้เชื่อมโยงกับข้อมูลอื่น",
                                showConfirmButton: true
                            }).then(async () => {
                                await getEmpRoleFunc(1).then(() => writeTable("#table-role"));
                            });
                        }
                    }).catch((err) => console.log(err))
                } else {

                }
            })
        }
    </script>

</body>

</html>