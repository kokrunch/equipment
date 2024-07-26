<?php
session_start();
if (isset($_SESSION["empData"])) {
    Header("Location: admin_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <?php include('component/header.php') ?>
    <title>it-equipment-system login</title>

    <style>
        .imges {
            background-image: url('assets/img/na_feb_08.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-attachment: fixed;
            background-size: 100% 100%;
        }
    </style>

</head>

<body>
    <div class="imges">
        <main>
            <div class="container">

                <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">



                                <!--login -->
                                <div class="card mb-3" id="admin_form">
                                    <div class="card-body">
                                        <div class="pt-4 pb-2">
                                            <a target="_blank" class="text-dark" href="https://it.msu.ac.th/home/"><img src="assets/img/logo-it.png" alt="" class="wow pulse animated" data-wow-delay="1s" style="width: 200px; height: 70px; visibility: visible; animation-delay: 1s; animation-name: pulse; margin-left: 45px;"></a><br>
                                            <h5 class="card-title text-center pb-0 fs-4">ระบบจัดการวัสดุและครุภัณฑ์</h5>
                                            <h5 class="text-center">เข้าสู่ระบบ</h5>
                                        </div>
                                        <!-- <div class="row justify-content-center">
                                            <p class="text-center">เลือกตำแหน่งการเข้าสู่ระบบ</p>
                                            <select class="form-select" id="EmpRole_select" onchange="Select_Emp_Role()" onclick="clearBorder(this)">
                                                <option selected value="0" disabled>เลือกตำแหน่ง</option>
                                            </select>
                                        </div> -->
                                        <br>
                                        <form action="" id="login_form">
                                            <div class="col-12">
                                                <label for="Username" class="form-label">ชื่อผู้ใช้</label>
                                                <div class="input-group has-validation">
                                                    <input type="text" class="form-control" id="Username" onkeyup="clearBorder(this)" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <label for="Password" class="form-label">รหัสผ่าน</label>
                                                <input type="password" class="form-control" id="Password" onkeyup="clearBorder(this)" required>
                                            </div>
                                            <hr style="clear: both; visibility: hidden;">
                                            <div class="col-12">
                                                <button class="btn btn-primary w-100" name="login" id="login_Btn">เข้าสู่ระบบ</button>
                                            </div>
                                            <hr style="clear: both; visibility: hidden;">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main><!-- End #main -->
    </div>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

    <script>
        var input = document.getElementById("login_form");
        input.addEventListener("submit", async function(event) {

            event.preventDefault();
            document.getElementById("login_Btn").click();

            var username
            var password

            username = document.getElementById('Username').value;
            password = document.getElementById('Password').value;

            username_check = document.querySelector('#Username');
            password_check = document.querySelector('#Password');

            if (username == '') {
                Swal.fire('กรุณากรอกชื่อผู้ใช้', '', 'info')
                username_check.style.border = "1px solid red";
                username_check.placeholder = "กรอกชื่อผู้ใช้";
                return;
            } else if (password == '') {
                Swal.fire('กรุณากรอกรหัสผ่าน', '', 'info')
                password_check.style.border = "1px solid red";
                password_check.placeholder = "กรอกรหัสผ่าน";
                return;
            }

            const jsondata = {
                username: username,
                password: password,
                loginSection: 1
            }
            const url = "./controller/loginController.php";

            await axios({
                method: 'post',
                url: url,
                data: jsondata,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then((res) => {
                if (res.data.status == "login success") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'เข้าสู่ระบบสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        role_id = res.data.role_id;
			
                        if (role_id == 1) {
                            window.location.href = "./admin_dashboard.php";
                        } else if (role_id == 2) {
                            window.location.href = "./dashboard_emp.php";
                        } else if (role_id == 3) {
                            window.location.href = "./dashboard_mat.php";
                        } else if (role_id == 4) {
                            window.location.href = "./dashboard_repair.php";
                        }

                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'ไม่สามารถเข้าสู่ระบบได้',
                        text: 'ไม่พบข้อมูลผู้ใช้งาน',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })
        });

        function clearBorder(e) {
            document.querySelector(`#${e.id}`).style.border = "";
        }
    </script>

</body>

</html>