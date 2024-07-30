<?php include("component/checkSession.php"); ?>
<?php include("component/roleAdmin.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system จัดการผู้ใช้งาน</title>
</head>


<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebar.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>รายชื่อผู้ใช้</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">รายชื่อผู้ใช้</li>
                    
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">แสดงชื่อผู้ใช้</h5>
                            <div class="d-flex justify-content-end">

                                <button type="button" class="btn btn-outline-primary rounded mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="bx bx-plus"></i> เพิ่มข้อมูล
                                </button>
                            </div>

                            <!-- Add data -->

                            <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="" id="addUser">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-3 mb-3">
                                                    <div class="col">
                                                        <label for="" class="form-label"><span class="text-danger">*</span> ชื่อผู้ใช้</label>
                                                        <input type="text" class="form-control" id="username">
                                                    </div>
                                                    <div class="col">
                                                        <label for="" class="form-label"><span class="text-danger">*</span> รหัสผ่าน</label>
                                                        <input type="password" class="form-control" id="password">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="" class="form-label"> <span class="text-danger">*</span>
                                                        อีเมลล์</label>
                                                    <input type="email" class="form-control" id="email">
                                                </div>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-12 col-md-6">
                                                        <label for="" class="form-label"><span class="text-danger">*</span> ชื่อ</label>
                                                        <input type="text" class="form-control" id="fname">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label for="" class="form-label"><span class="text-danger">*</span> นามสกุล</label>
                                                        <input type="text" class="form-control" id="lname">
                                                    </div>
                                                </div>
                                                <div class="row g-3 my-2">
                                                    <div class="col">
                                                        <label for="" class="form-label"> รูปภาพโปรไฟล์</label>
                                                        <input class="form-control" type="file" id="emp_img" placeholder="อัพโหลดรูปภาพโปรไฟล์">
                                                    </div>

                                                </div>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-12 col-md-6">
                                                        <label for="" class="form-label"><span class="text-danger">*</span> เบอร์โทรศัพท์</label>
                                                        <input type="tel" id="tel" maxlength="10" class="form-control">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label for="" class="form-label"><span class="text-danger">*</span>
                                                            เพศ</label>
                                                        <select class="form-select" aria-label="Default select example" id="gender">
                                                            <option value="" selected disabled>เลือก</option>
                                                            <option value="male">ชาย</option>
                                                            <option value="female">หญิง</option>
                                                            <option value=" other">อื่นๆ</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6">
                                                        <label for="" class="form-label"><span class="text-danger">*</span>
                                                            สิทธิ์ผู้ใช้</label>
                                                        <select class="form-select" id="role_type_id">
                                                            <option selected value="0" disabled>เลือกระดับสิทธิ์</option>
                                                            <option value="1">ผู้ดูแลระบบ</option>
                                                            <option value="2">อาจารย์/บุคลากร</option>
                                                            <option value="3">เจ้าหน้าที่</option>
                                                            <option value="4">ช่าง</option>
                                                            <option value="5">นักศึกษาฝึกงาน</option>
                                                        
                                                            

                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-6" id="branch_check_i">
                                                        <label for="" class="form-label"><span class="text-danger">*</span>
                                                            สาขาภาควิชา</label>
                                                        <select class="form-select" id="branch_id">
                                                            <option selected value="0" disabled>เลือกสาขาภาควิชา</option>
                                                            <option value="1">ภูมิสารสนเทศ</option>
                                                            <option value="2">เทคโนโลยีสารสนเทศ</option>
                                                            <option value="3">สารสนเทศศาตร์</option>
                                                            <option value="4">นิเทศศาสตร์</option>
                                                            <option value="5">วิทยาการคอมพิวเตอร์</option>
                                                            <option value="6">สื่อนฤมิต</option>

                                                        </select>
                                                    </div>
                                                </div>


                                            </div>
                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                <button type="button" onClick="addUser()" class="btn btn-primary">บันทึกข้อมูล</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--End Add data modal -->

                            <!-- Edit data -->

                            <div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <form action="" id="editUser">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">แก้ไขข้อมูล</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" class="form-control" id="id_up">
                                                <div class="mb-3">
                                                    <label for="" class="form-label">
                                                        อีเมลล์</label>
                                                    <input type="email" class="form-control" id="email_up">
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6">
                                                        <label for="" class="form-label"> ชื่อ</label>
                                                        <input type="text" class="form-control" id="fname_up">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label for="" class="form-label"> นามสกุล</label>
                                                        <input type="text" class="form-control" id="lname_up">
                                                    </div>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-12 col-md-6">
                                                        <label for="" class="form-label"> เบอร์โทรศัพท์</label>
                                                        <input type="tel" maxlength="10" class="form-control" id="tel_up">
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <label for="" class="form-label">สิทธิ์ผู้ใช้</label>
                                                        <select class="form-select" id="role_type_id_edit" onchange="check_role()">
                                                            <option selected value="0" disabled> เลือกระดับสิทธิ์
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row g-3">

                                                    <div class="col-12 col-md-6" id="branch_check">
                                                        <label for="" class="form-label"><span class="text-danger">*</span>
                                                            สาขาภาควิชา</label>
                                                        <select class="form-select" id="branch_id_up">
                                                            <option selected value="0" disabled>เลือกสาขาภาควิชา</option>
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class=" modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                                <button type="button" onclick="updateUser()" class="btn btn-warning">แก้ไขข้อมูล</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--End Edit data modal -->

                            <div class="table-responsive">
                                <table id="table-user" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>รูปภาพ</th>
                                            <th>ชื่อ-สกุล</th>
                                            <th>เบอร์โทรศัพท์</th>
                                            <th>อีเมล์</th>
                                            <th>สังกัดภาควิชา</th>
                                            <th>ตำแหน่ง</th>
                                            
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
        </section>

    </main><!-- End #main -->

    <?php include("component/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

</body>
<script>
    $(document).ready(async function() {
        await getUser(0).then(() => writeTable("#table-user"));
        getTypeRole();
        getBranch();

        check_role();
        check_role_i();

    })


    async function getUser(reload) {
        const url = "./controller/UserController.php?getUser=1";

        var userData;
        await axios.get(url).then(function(response) {
            // console.log(response.data)
            userData = response.data;
            bodyUser.innerHTML = response;
        }).catch((err) => console.log(err));

        if (reload == 1) {
            $("#table-user").DataTable().destroy();
        }

        const bodyUser = document.getElementById("body-user");
        bodyUser.innerHTML = "";
        userData.forEach((element, i) => {
            bodyUser.innerHTML += `
            <tr>
                <td>
                    <img style="width: 50px; height:50px" src="${element.emp_img == null ? 'assets/img/no-profile.png' : ` assets/employee_img/${element.emp_img}"`}" alt="img">
                </td>
                <td>${element.emp_firstname} ${element.emp_lastname}</td>
                <td>${element.emp_tel}</td>
                <td>${element.emp_email}</td>
                <td>${element.branch_name == null ? 'สังกัดคณะ' : element.branch_name}</td>
                <td>${element.role_name}</td>
                <td>
                    <button type="button" class="btn btn-outline-warning mt-1" data-jsonEmployee='${JSON.stringify(element)}' onclick="openModalEdit(this); check_role();"><i class="bx bxs-edit"></i></button>
                    <button type="button" onclick="deleteUser('${element.emp_id}')" class="btn btn-outline-danger mt-1"><i class="bx bxs-trash"></i></button>
                </td>
            </tr>
            `
        });
    }


    function viewDetailEmp(btn) {
        check_role_view();

        $("#ModalEmpDetail").modal("show");
        const jsonStrData = btn.getAttribute("data-jsonEmployee")
        const jsonParseData = JSON.parse(jsonStrData)


        document.getElementById("img_view").src = "assets/employee_img/" + jsonParseData.emp_img;
        document.getElementById("fname_view").value = jsonParseData.emp_firstname;
        document.getElementById("lname_view").value = jsonParseData.emp_lastname;
        document.getElementById("email_view").value = jsonParseData.emp_email;

        if (jsonParseData.emp_gender == "male") {
            console.log("Gender:", jsonParseData.emp_gender);
            document.getElementById("gender_view").value = 'ชาย';
        }
        if (jsonParseData.emp_gender == "female") {
            console.log("Gender:", jsonParseData.emp_gender);
            document.getElementById("gender_view").value = 'หญิง';
        }
        if (jsonParseData.emp_gender == "other") {
            console.log("Gender:", jsonParseData.emp_gender);
            document.getElementById("gender_view").value = 'อื่นๆ';
        }
        document.getElementById("tel_view").value = jsonParseData.emp_tel;
        document.getElementById("role_type_view").value = jsonParseData.role_name;
        document.getElementById("branch_view").value = jsonParseData.branch_name;
    }


    async function check_role() {

        let branch = document.getElementById("role_type_id_edit").value;
        if (branch == 1) {
            document.getElementById("branch_check").style.display = "block";

        } else {
            document.getElementById("branch_check").style.display = "none";
            document.getElementById("branch_id_up").value = 0;
        }


    }
    async function check_role_i() {

        let branch = document.getElementById("role_type_id").value;
        //onsole.log("branch >> ", branch);
        alert(branch);
        if (branch != "") {
            document.getElementById("branch_check_i").style.display = "block";

        } else {
            document.getElementById("branch_check_i").style.display = "none";
            //document.getElementById("branch_id").value = 0;
        }


    }

    async function check_role_view() {

        let branch_view = document.getElementById("role_type_view").value;
        // console.log(branch_view);
        if (branch_view == 'อาจารย์') {
            document.getElementById("branch_check_view").style.display = "block";

        } else {
            document.getElementById("branch_check_view").style.display = "none";
        }
    }


    async function getTypeRole() {
        const url = "./controller/UserController.php?gettyperole=1";
        let typeRoleData;
        await axios.get(url).then(function(res) {
            typeRoleData = res.data;
        }).catch((err) => console.log(err))

        const BodyTypeRole = document.getElementById("role_type_id");
        typeRoleData.forEach((val, index) => {
            BodyTypeRole.innerHTML += `<option value = "${val.role_id}">${val.role_name}</option>`
        });

        const BodyTypeRoleEdit = document.getElementById("role_type_id_edit");
        typeRoleData.forEach((val, index) => {
            BodyTypeRoleEdit.innerHTML += `<option value = "${val.role_id}">${val.role_name}</option>`
        });

    }

    async function getBranch() {
        const url = "./controller/UserController.php?getbranch=1";
        let branchData;
        await axios.get(url).then(function(res) {
            branchData = res.data;
        }).catch((err) => console.log(err))

        const BodyBranch = document.getElementById("branch_id");
        branchData.forEach((val, index) => {
            BodyBranch.innerHTML += `<option value = "${val.branch_id}">${val.branch_name}</option>`
        });

        const BodyBranchEdit = document.getElementById("branch_id_up");
        branchData.forEach((val, index) => {
            BodyBranchEdit.innerHTML += `<option value = "${val.branch_id}">${val.branch_name}</option>`
        });


    }

    async function addUser() {
        let username = document.getElementById("username").value;
        let password = document.getElementById("password").value;
        let email = document.getElementById("email").value;
        let firstname = document.getElementById("fname").value;
        let lastname = document.getElementById("lname").value;
        //let emp_img = document.getElementById('emp_img').files;
        // console.log('emp_img',emp_img)
        let gender = document.getElementById("gender").value;
        let tel = document.getElementById("tel").value;
        let role = document.getElementById("role_type_id").value;
        let branch = document.getElementById("branch_id").value;

        if (username == "") {
            document.getElementById("username").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ผู้ใช้',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (password == "") {
            document.getElementById("password").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล รหัสผ่าน',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (email == "") {
            document.getElementById("email").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล อีเมลล์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (firstname == "") {
            document.getElementById("fname").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ชื่อ',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (lastname == "") {
            document.getElementById("lname").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล นามสกุล',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (tel == "") {
            document.getElementById("tel").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล เบอร์ติดต่อ',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (gender == "") {
            document.getElementById("gender").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดเลือกข้อมูล เพศ',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (role == "" || role == 0) {
            document.getElementById("role_type_id").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดเลือกข้อมูล สิทธิผู้ใช้',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (role == 1) {
            if (branch == '' || branch == 0) {
                document.getElementById("branch_id").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดเลือกข้อมูล สาขาภาควิชา',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
        }


        var formData = new FormData();
        //formData.append("file", emp_img[0]);
        formData.append("username", username);
        formData.append("password", password);
        formData.append("email", email);
        formData.append("firstname", firstname);
        formData.append("lastname", lastname);
        formData.append("gender", gender);
        formData.append("tel", tel);
        formData.append("role", role);
        formData.append("branch", branch);
        formData.append("addUser", 1);

        var xhttp = new XMLHttpRequest();
        const url = "./controller/UserController.php";
        xhttp.open("POST", url, true);

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var response = this.responseText;
                alert(response);
                // console.log(this.responseText)

                if (response == 1) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'เพิ่มข้อมูลผู้ใช้สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        $("#addModal").modal('hide');
                        $("#addModal input").val('');
                        $("#addModal select").val(0);
                        await getUser(1).then(() => writeTable("#table-user"));
                    })


                }
                if (response ==55 ) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'ชื่อผู้ใช้ซ้ำ',
                        text: 'ตรวจสอบชื่อผู้ใช้อีกครั้ง',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }/* else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'ประเภทไฟล์ไม่ถูกต้อง',
                        text: 'ตรวจสอบประเภทไฟล์ ( jpg, png, jpeg )',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }*/
            }
        };

        xhttp.send(formData);

    }
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log('Response:', this.responseText); // ดูค่าตอบกลับจากเซิร์ฟเวอร์

        var response = this.responseText;

        if (response == 1) {
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'เพิ่มข้อมูลผู้ใช้สำเร็จ',
                showConfirmButton: false,
                timer: 1500
            }).then(async () => {
                $("#addModal").modal('hide');
                $("#addModal input").val('');
                $("#addModal select").val(0);
                await getUser(1).then(() => writeTable("#table-user"));
            });
        } else if (response == 55) {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'ชื่อผู้ใช้ซ้ำ',
                text: 'ตรวจสอบชื่อผู้ใช้อีกครั้ง',
                showConfirmButton: false,
                timer: 1500
            });
        } else {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'ประเภทไฟล์ไม่ถูกต้อง',
                text: 'ตรวจสอบประเภทไฟล์ ( jpg, png, jpeg )',
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
};


    function openModalEdit(btn) {
        $("#EditModal").modal('show');
        const jsonStrData = btn.getAttribute("data-jsonEmployee")
        const jsonParseData = JSON.parse(jsonStrData)

        document.getElementById("id_up").value = jsonParseData.emp_id;
        document.getElementById("email_up").value = jsonParseData.emp_email;
        document.getElementById("fname_up").value = jsonParseData.emp_firstname;
        document.getElementById("lname_up").value = jsonParseData.emp_lastname;
        document.getElementById("tel_up").value = jsonParseData.emp_tel;
        document.getElementById("role_type_id_edit").value = jsonParseData.role_id;
        document.getElementById("branch_id_up").value = jsonParseData.branch_id;
    }


    async function updateUser() {
        let id_up = document.getElementById("id_up").value;
        let email_up = document.getElementById("email_up").value;
        let fname_up = document.getElementById("fname_up").value;
        let lname_up = document.getElementById("lname_up").value;
        let tel_up = document.getElementById("tel_up").value;
        let role_id_up = document.getElementById("role_type_id_edit").value;
        let branch_id_up = document.getElementById("branch_id_up").value;

        if (email_up == "") {
            document.getElementById("email_up").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล อีเมลล์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (fname_up == "") {
            document.getElementById("fname_up").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ชื่อ',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (lname_up == "") {
            document.getElementById("lname_up").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล นามสกุล',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (tel_up == "") {
            document.getElementById("tel_up").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล เบอร์ติดต่อ',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (role_id_up == "") {
            document.getElementById("role_id_up").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดเลือกข้อมูล สิทธิผู้ใช้',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }
        if (role_id_up == 1) {
            if (branch_id_up == '' || branch_id_up == 0) {
                document.getElementById("branch_id_up").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดเลือกข้อมูล สาขาภาควิชา',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
        }
        const data = {
            id_up: id_up,
            email_up: email_up,
            fname_up: fname_up,
            lname_up: lname_up,
            tel_up: tel_up,
            role_id_up: role_id_up,
            branch_id_up: branch_id_up,
            editUser: true
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
            // console.log(res.data)
            if (res.data == 1) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'แก้ไขข้อมูลผู้ใช้สำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then(async () => {
                    $("#EditModal").modal('hide');
                    $("#EditModal input").val('');
                    $("#addModal select").val(0);
                    await getUser(1).then(() => writeTable("#table-user"));
                })


            } else {
                Swal.fire({
                    position: 'top-center',
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: "โปรดลองใหม่อีกครั้ง",
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        })

    }


    async function deleteUser(id) {

        const url = "./controller/UserController.php?d_User=" + id;

        Swal.fire({
            title: 'ยืนยันการลบข้อมูลผู้ใช้ !!',
            text: "ต้องการลบข้อมูลผู้ใช้ใช่หรือไม่ ?",
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
                    //     console.log(response);
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลผู้ใช้สำเร็จ !!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(async () => {
                            await getUser(1).then(() => writeTable("#table-user"));
                        })

                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบข้อมูลผู้ใช้ไม่สำเร็จ !!',
                            showConfirmButton: true
                        }).then(async () => {
                            await getUser(1).then(() => writeTable("#table-user"));
                        })

                    }
                }).catch((err) => console.log(err))
            } else {

            }

        })
    }
</script>