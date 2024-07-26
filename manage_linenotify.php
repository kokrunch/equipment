<?php include("component/checkSession.php"); ?>
<?php //include("component/roleAdmin.php  "); 
?>

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
            <h1>จัดการ LINE Notify</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="show_user.php">จัดการผู้ใช้งาน</a></li>
                    <li class="breadcrumb-item active">จัดการ LINE Notify</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center" style="align-items: center;">
                                <h5 class="card-title" style="margin-right: 10px;">เพิ่ม LINE Notify สำหรับพนักงาน</h5>
                                <img src="assets/img/lineIcon.png" width="25px" height="25px">
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary rounded mb-3" data-bs-toggle="modal" data-bs-target="#modalAddToken">
                                    <i class="bx bx-plus"></i> เพิ่มข้อมูล
                                </button>
                            </div>
                            <div class="row col-md-12">
                                <div class="table-responsive">
                                    <table id="table-user-token" class="table">
                                        <thead>
                                            <tr>
                                                <th style="width: 8%;">#</th>
                                                <th>กลุ่มไลน์</th>
                                                <th>ตำแหน่ง</th>
                                                <th>Token LINE</th>
                                                <th></th>
                                            </tr>
                                        </thead>

                                        <tbody id="body-user">
                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="modal fade" id="modalAddToken" tabindex="-1" aria-labelledby="modalAddTokenLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่ม LINE Token</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ตำแหน่ง</label>
                                <select class="form-select" aria-label="Default select" id="role_id_add">

                                </select>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ชื่อกลุ่ม</label>
                                <input type="text" class="form-control" id="group_name_add" placeholder="กรอกชื่อกลุ่ม">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    Token</label>
                                <input type="text" class="form-control" id="token_add" placeholder="กรอก Token">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="addToken()" class="btn btn-primary">เพิ่ม</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalAddEmp" tabindex="-1" aria-labelledby="modalAddTokenLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="TitlemodalAddEmp">เพิ่มผู้รับการแจ้งเตือนไปยังกลุ่ม</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" id="token_id">
                            <div class="table-responsive" style="max-height:650px;">
                                <table id="table-emp" class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th style="width: 8%;">รูปภาพ</th>
                                            <th>ชื่อ-สกุล</th>
                                            <th>ตำแหน่ง</th>
                                            <th>กลุ่มแจ้งเตือน</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-emp">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalEditToken" tabindex="-1" aria-labelledby="modalEditTokenLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="group_name_edit">แก้ไข Token</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2 ">

                            <div class="col-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    Token</label>
                                <input type="text" class="form-control" id="token_edit" placeholder="กรอก Token">
                                <input type="hidden" id="token_id_edit">
                            </div>

                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="EditToken()" class="btn btn-warning">แก้ไข</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <?php include("component/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

    <script>
        $(document).ready(async function() {
            await getEmpToken(0).then(() => writeTable("#table-user-token"));
            await getRoleData()
        }); //end ready function

        async function getRoleData() {
            const url = "./controller/UserController.php?getRoleData=1";

            let roleData;
            await axios.get(url).then(function(response) {
                roleData = response.data;
            }).catch((err) => console.log(err));


            const selectbody = document.getElementById("role_id_add");
            selectbody.innerHTML = "";
            selectbody.innerHTML = `<option value="0">เลือกตำแหน่ง</option>`
            roleData.forEach((element) => {
                selectbody.innerHTML += `
                <option value="${element.role_id}">${element.role_name}</option>
                `
            });
        }

        async function getEmpToken(reload) {
            const url = "./controller/UserController.php?getEmpToken=1";
            let TokenData;
            await axios.get(url).then(function(response) {
                TokenData = response.data;
            }).catch((err) => console.log(err));

            if (reload == 1) {
                $("#table-user-token").DataTable().destroy();
            }

            const bodyUser = document.getElementById("body-user");
            bodyUser.innerHTML = "";
            TokenData.forEach((element, i) => {
                bodyUser.innerHTML += `
                        <tr>
                        <td>${i + 1}</td>
                            <td>${element.group_name}</td>
                            <td>${element.role_name}</td>
                            <td>${element.token != null ? element.token : '<span class="badge bg-warning">ยังไม่ได้เพิ่ม Token</span>'}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-success" onclick="showModalAddEmp(${element.token_id},'${element.group_name}',${element.role_id})" data-bs-toggle="modal" data-bs-target="#modalAddEmp">
                                    <i class="bx bxs-user-plus"></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning" onclick="showModalEdit(${element.token_id},'${element.token}','${element.group_name}')" data-bs-toggle="modal" data-bs-target="#modalEditToken">
                                    <i class="bx bxs-edit"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" onclick="deleteToken(${element.token_id})"><i class="bx bxs-trash"></i></button>
                            </td>
                            </td>
                        </tr>`;
            });
        }

        function showModalAddEmp(token_id, group_name, role_id) {
            document.getElementById("token_id").value = token_id;
            document.getElementById("TitlemodalAddEmp").innerText = "เพิ่มผู้รับการแจ้งเตือนไปยังกลุ่ม" + group_name;
            writeTableEmployee(role_id)
        }

        function showModalEdit(token_id, token, group_name) {
            document.getElementById('group_name_edit').innerText = "แก้ไข Token " + group_name;
            document.getElementById("token_edit").value = token;
            document.getElementById("token_id_edit").value = token_id;
        }


        async function writeTableEmployee(role_id) {
            const url = "./controller/UserController.php?getEmpWhereRole=1&role_id=" + role_id;
            let dataEmployee;
            await axios.get(url).then(function(response) {
                dataEmployee = response.data;
            }).catch((err) => console.log(err));

            $("#table-emp").DataTable().destroy();
            // const dataEmp = dataEmployee.filter((data) => {
            //     return data.RoleID == role_id
            // })

            const body_emp = document.getElementById("body-emp")
            body_emp.innerHTML = "";
            dataEmployee.forEach((element, i) => {
                body_emp.innerHTML += `
                <tr>
                    <td>${i+1}</td>
                    <td>
                        <img style="width: 50px; height:50px" src="${element.emp_img == null ? 'assets/img/no-profile.png' : ` assets/employee_img/${element.emp_img}"`}" alt="img">
                    </td>
                    <td>${element.emp_firstname} ${element.emp_lastname}</td>
                    <td>${element.role_name}</td>
                    <td class="text-center">${element.emp_token_id == null ? `<span class="badge bg-warning">ยังไม่มีกลุ่ม</span>` : `กลุ่ม${element.group_name}`}</td>
                    <td class="text-center">
                        ${element.emp_token_id == null ? 
                        `<button type="button" class="btn btn-outline-success" id="btn-addEmpToken-${element.EmpID}" onclick="AddEmpNoti(${element.EmpID},${role_id})">
                            <i class="bx bx-plus"></i>
                        </button>` 
                        : `<button type="button" class="btn btn-outline-danger" id="btn-delEmpToken-${element.EmpID}" onclick="removeEmpNoti(${element.emp_token_id},${element.EmpID},${role_id})">
                            <i class="bx bxs-trash"></i>
                        </button>` }
                    </td>
                </tr>
                `;
            })

            writeTable("#table-emp")
        }

        async function addToken() {
            const token = document.getElementById("token_add").value;
            const group_name = document.getElementById("group_name_add").value;
            const role_id = document.getElementById("role_id_add").value;

            if (role_id == 0) {
                document.getElementById("role_id_add").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกเลือกตำแหน่ง',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            if (group_name == "") {
                document.getElementById("group_name_add").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกข้อมูลชื่อกลุ่ม',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
            if (token == "") {
                document.getElementById("token_add").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกข้อมูล Token',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            const jsonData = {
                group_name: group_name,
                token: token,
                role_id: role_id,
                addToken: true
            }
            const url = "./controller/UserController.php";
            await axios({
                method: 'POST',
                url: url,
                data: jsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then(async (response) => {
                if (response.data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'เพิ่มข้อมูล Token สำเร็จ !!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#modalAddToken").modal('hide');
                    emptyDataInput(0)
                    await getEmpToken(1).then(() => writeTable("#table-user-token"));
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

        async function EditToken() {
            const token = document.getElementById("token_edit").value;
            const token_id = document.getElementById("token_id_edit").value;

            if (token == "") {
                document.getElementById("token_edit").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกข้อมูล Token',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            const jsonData = {
                token: token,
                token_id: token_id,
                editToken: true
            }

            const url = "./controller/UserController.php";
            await axios({
                method: 'POST',
                url: url,
                data: jsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then(async (response) => {
                if (response.data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'แก้ไขข้อมูล Token สำเร็จ !!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#modalEditToken").modal('hide');
                    await getEmpToken(1).then(() => writeTable("#table-user-token"));
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


        async function deleteToken(tokenId) {
            Swal.fire({
                title: 'ต้องการลบ Token หรือไม่ ?',
                text: 'หากลบ ข้อมูล Token นี้จะหายไป',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const jsonData = {
                        tokenId: tokenId,
                        deleteToken: true
                    }
                    const url = "./controller/UserController.php";
                    await axios({
                        method: 'POST',
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
                                title: 'ลบ Token สำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(async () => {
                                await getEmpToken(1).then(() => writeTable("#table-user-token"));
                            })
                        } else if (res.data == "can not delete Token because have data in relationship") {
                            Swal.fire({
                                icon: 'warning',
                                title: 'ไม่สามารถลบ Token ได้ !!',
                                text: "Token นี้มีความสัมพันธ์กับข้อมูลอื่น",
                                showConfirmButton: true
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
            })
        }

        async function AddEmpNoti(emp_id, role_id) {
            const token_id = document.getElementById("token_id").value;
            document.getElementById('btn-addEmpToken-' + emp_id).disabled = true;
            const jsonData = {
                token_id: token_id,
                emp_id: emp_id,
                addEmpToken: true
            }
            const url = "./controller/UserController.php";
            await axios({
                method: 'POST',
                url: url,
                data: jsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then(async (res) => {
                if (res.data == 1) {
                    writeTableEmployee(role_id)
                    document.getElementById('btn-addEmpToken-' + emp_id).disabled = false
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

        async function removeEmpNoti(emp_token_id, emp_id, role_id) {
            document.getElementById('btn-delEmpToken-' + emp_id).disabled = true;
            const jsonData = {
                emp_token_id: emp_token_id,
                deleteEmpToken: true
            }
            const url = "./controller/UserController.php";
            await axios({
                method: 'POST',
                url: url,
                data: jsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then(async (res) => {
                if (res.data == 1) {
                    writeTableEmployee(role_id)
                    document.getElementById('btn-delEmpToken-' + emp_id).disabled = false;
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




        //empty data
        function emptyDataInput(index) {
            const modalBody = document.getElementsByClassName('modal-body')
            const childrenBody = modalBody[index].children[0].children;
            for (let i = 0; i < childrenBody.length; i++) {
                const tagname = childrenBody[i].children[1].localName
                if (tagname == 'input') {
                    childrenBody[i].children[1].value = ""
                }
            }
        }
    </script>
</body>

</html>