<?php include("component/checkSession.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system </title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php
    if ($_SESSION['empData']->role_id == 1 || $_SESSION['empData']->role_id == 2) {
        include("component/sidebarEmp.php");
    }
    if ($_SESSION['empData']->role_id == 3) {
        include("component/sidebarRepair.php");
    }
    if ($_SESSION['empData']->role_id == 4) {
        include("component/sidebarMat.php");
    }

    if ($_SESSION['empData']->role_id == 5) {
        include("component/sidebar.php");
    }



    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>โปรไฟล์</h1>
            <nav>
                <ol class="breadcrumb">
                    <?php
                    if ($_SESSION['empData']->role_id == 1 || $_SESSION['empData']->role_id == 2) { ?>

                        <li class="breadcrumb-item"><a href="dashboard_emp.php">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">แก้ไขโปรไฟล์</li>

                    <?php } ?>
                    <?php if ($_SESSION['empData']->role_id == 3) { ?>

                        <li class="breadcrumb-item"><a href="dashboard_repair.php">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">แก้ไขโปรไฟล์</li>

                    <?php } ?>
                    <?php if ($_SESSION['empData']->role_id == 4) { ?>

                        <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">แก้ไขโปรไฟล์</li>

                    <?php  } ?>

                    <?php if ($_SESSION['empData']->role_id == 5) { ?>

                        <li class="breadcrumb-item"><a href="admin_dashboard.php">หน้าหลัก</a></li>
                        <li class="breadcrumb-item active">แก้ไขโปรไฟล์</li>

                    <?php } ?>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" id="profile-show">

                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">ข้อมูล</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">แก้ไขโปรไฟล์</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">เปลี่ยนรหัสผ่าน</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">

                                </div>

                            </div><!-- End Bordered Tabs -->

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

        await getProfileUser();
        getProfileUserEdit();
        getChangePass();

        async function getProfileUser() {
            const url = "./controller/UserController.php?getProfile=1";
            let userData;
            await axios.get(url).then(function(response) {
                //  console.log(response.data)
                userData = response.data;
            }).catch((err) => console.log(err));

            const bodyProfile = document.getElementById("profile-overview");
            bodyProfile.innerHTML = "";
            userData.forEach((element, i) => {
                bodyProfile.innerHTML += `
            <h5 class="card-title">รายละเอียด</h5>
            <div class="row">
                <div class="col-lg-3 col-md-4 label ">ชื่อ-นามสกุล</div>
                <div class="col-lg-9 col-md-8">${element.emp_firstname} ${element.emp_lastname}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">เพศ</div>
                <div class="col-lg-9 col-md-8">
                ${element.emp_gender === 'male' ? 'ชาย' : element.emp_gender === 'female' ? 'หญิง' : 'อื่นๆ'} 
                </div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">อีเมลล์</div>
                <div class="col-lg-9 col-md-8">${element.emp_email}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">เบอร์โทรศัพท์</div>
                <div class="col-lg-9 col-md-8">${element.emp_tel}</div>
            </div>

            <div class="row">
                <div class="col-lg-3 col-md-4 label">ตำแหน่ง</div>
                <div class="col-lg-9 col-md-8">${element.sub_role_name}</div>
            </div>
            `
            });

            const bodyProfileShow = document.getElementById("profile-show");
            bodyProfileShow.innerHTML = "";
            userData.forEach((element, i) => {
                bodyProfileShow.innerHTML += `
            <img src="${element.emp_img == null ? 'assets/img/no-profile.png' : ` assets/employee_img/${element.emp_img}"`}" alt="Profile" class="img-profile-rounded-lg">
                            <h2>${element.emp_firstname} ${element.emp_lastname}</h2>
                            <h3>${element.sub_role_name}</h3>
            `
            });
        }

        async function getProfileUserEdit() {
            const url = "./controller/UserController.php?getProfile=1";
            let userData;
            await axios.get(url).then(function(response) {
                // console.log(response.data)
                userData = response.data;
            }).catch((err) => console.log(err));

            const bodyProfile = document.getElementById("profile-edit");
            bodyProfile.innerHTML = "";
            userData.forEach((element, i) => {
                bodyProfile.innerHTML += `
            <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">รูปโปรไฟล์</label>
                                            <div class="col-md-8 col-lg-9">
                                <img id="showeImg" class="rounded-circle mx-auto d-block" alt="">
                                                <div class="pt-2">
                                                <div class="form-group">
                                    <label for="">รูปโปรไฟล์</label><br>
                                     <input type="hidden" id="img_profile_old" class="form-control" value="${element.emp_img}">
                                    <input type="file" id="img_profile" class="form-control">
                                </div>

                                                </div>
                                            </div>
                                        </div>
                                        <input name="emp_id" type="hidden" class="form-control" id="emp_id" value="${element.emp_id}">
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">ชื่อ</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="fname" type="text" class="form-control" id="fname" value="${element.emp_firstname}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">นามสกุล</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="lname" type="text" class="form-control" id="lname" value="${element.emp_lastname}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="about" class="col-md-4 col-lg-3 col-form-label">อีเมลล์</label>
                                            <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="email" value="${element.emp_email}">
                                        </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="company"
                                                class="col-md-4 col-lg-3 col-form-label">เบอร์ติดต่อ</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="tel" type="tel" class="form-control" id="tel" value="${element.emp_tel}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-warning" id="editProfile">แก้ไขข้อมูล</button>
                                        </div>
            `
            });

            document.getElementById("editProfile").addEventListener("click", editProfile, false);
        }

        async function editProfile() {
            let emp_id = document.getElementById("emp_id").value;
            let fname = document.getElementById("fname").value;
            let lname = document.getElementById("lname").value;
            let email = document.getElementById("email").value;
            let img_profile_old = document.getElementById('img_profile_old').value;
            let img_profile = document.getElementById('img_profile').files;
            let tel = document.getElementById("tel").value;

            // if (img_profile == "") {
            //     document.getElementById("img_profile").focus();
            //     Swal.fire({
            //         position: 'top-center',
            //         icon: 'info',
            //         title: 'โปรดอัพรูปโปรไฟล์',
            //         text: "ตรวจสอบความถูกต้อง",
            //         showConfirmButton: false,
            //         timer: 1500
            //     });
            //     return;
            // }
            if (fname == "") {
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
            if (lname == "") {
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

            var formData = new FormData();
            formData.append("file_old", img_profile_old);
            formData.append("file", img_profile[0]);
            formData.append("emp_id", emp_id);
            formData.append("fname", fname);
            formData.append("lname", lname);
            formData.append("email", email);
            formData.append("tel", tel);
            formData.append("editProfile", 1);

            var xhttp = new XMLHttpRequest();
            const url = "./controller/UserController.php";
            xhttp.open("POST", url, true);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    var response = this.responseText;
                    // console.log(this.responseText)

                    if (response == 1) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'แก้ไขข้อมูลสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            getProfileUser();
                            window.location.reload();
                        })
                    } else {

                        Swal.fire({
                            position: 'top-center',
                            icon: 'warning',
                            title: 'ประเภทไฟล์ไม่ถูกต้อง',
                            text: 'ตรวจสอบประเภทไฟล์ ( jpg, png, jpeg )',
                            showConfirmButton: false,
                            timer: 2000
                        })
                    }
                }
            };

            xhttp.send(formData);


        }

        async function getChangePass() {
            const url = "./controller/UserController.php?getProfile=1";
            let userData;
            await axios.get(url).then(function(response) {
                // console.log(response.data)
                userData = response.data;
            }).catch((err) => console.log(err));

            const bodyProfilePass = document.getElementById("profile-change-password");
            bodyProfilePass.innerHTML = "";
            userData.forEach((element, i) => {
                bodyProfilePass.innerHTML += `

                                        <div class="row mb-3">
                                         <input name="emp_id" type="hidden" class="form-control" id="emp_id" value="${element.emp_id}" disabled>
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">รหัสผ่านปัจจุบัน</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="text" class="form-control" id="currentPassword" value="${element.emp_password}" disabled>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">รหัสผ่านใหม่</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control" id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">ยืนยันรหัสผ่านใหม่อีกครั้ง</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="button" class="btn btn-outline-warning" id="changePass">เปลี่ยนรหัสผ่าน</button>
                                        </div>
            `
            });

            document.getElementById("changePass").addEventListener("click", changePassword, false);
        }

        async function changePassword() {
            let emp_id = document.getElementById("emp_id").value;
            let newPass = document.getElementById("newPassword").value;
            let renewPass = document.getElementById("renewPassword").value;

            if (newPass == "") {
                document.getElementById("newPassword").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกรหัสผ่านใหม่',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
            if (renewPass == "") {
                document.getElementById("renewPassword").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกยืนยันรหัสผ่านใหม่',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
            if (newPass !== renewPass) {
                document.getElementById("renewPassword").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกยืนยันรหัสผ่านใหม่ให้ถูกต้อง',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            const jsonData = {
                emp_id: emp_id,
                newPass: newPass,
                changePass: true
            }

            const url = "./controller/UserController.php";
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
                        title: 'เปลี่ยนรหัสผ่านใหม่สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        getChangePass();
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

    });
</script>

</html>