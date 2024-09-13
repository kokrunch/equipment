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

    <?php
    if ($_SESSION['empData']->role_id == 2) {
        include("component/sidebarEmp.php");
    }
    if (
        $_SESSION['empData']->role_id == 4
    ) {
        include("component/sidebarRepair.php");
    }
    if ($_SESSION['empData']->role_id == 3) {
        include("component/sidebarMat.php");
    }

    if ($_SESSION['empData']->role_id == 1) {
        include("component/sidebar.php");
    }



    ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1 id="count-noti-title">การแจ้งเตือนใหม่ทั้ง 0 รายการ ทั้งหมด 0 รายการ</h1>
            <nav>
                <ol class="breadcrumb">
                    <?php
                    if ($_SESSION['empData']->role_id == 2) { ?>
                        <li class="breadcrumb-item active">การแจ้งเตือน</li>

                    <?php } ?>
                    <?php if (
                        $_SESSION['empData']->role_id == 4
                    ) { ?>
                        <li class="breadcrumb-item active">การแจ้งเตือน</li>

                    <?php } ?>
                    <?php if ($_SESSION['empData']->role_id == 3) { ?>
                        <li class="breadcrumb-item active">การแจ้งเตือน</li>

                    <?php  } ?>

                    <?php if ($_SESSION['empData']->role_id == 1) { ?>
                        <li class="breadcrumb-item active">การแจ้งเตือน</li>

                    <?php } ?>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row mt-4" id="loader">
                <div class="col-md-12 d-flex justify-content-center">
                    <br><br>
                    <div class="spinner-border text-primary" style="width: 50px; height: 50px;" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" id="notification">

                </div>
                <div class="col-lg-12 d-flex justify-content-center">
                    <a class="text-primary" onclick="viewMore()" id="btn-viewmore" style="display: none;cursor: pointer;">ดูเพิ่มเติม</a>
                </div>
            </div>

        </section>

    </main><!-- End #main -->

    <?php include("component/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

    <script>
        var Limit = 0;
        $(document).ready(async function() {
            await getNotification(Limit, 0)
            document.getElementById("loader").innerHTML = "";
        }); //end ready function

        async function getNotification(limit, view) {
            const url = "./controller/UserController.php?getNotiofication=1&limit=" + parseInt(limit);
            let notiData;
            await axios.get(url).then(function(response) {
                notiData = response.data;
            }).catch((err) => console.log(err));

            const newNoti = notiData.filter((noti) => {
                return noti.status == 0;
            })
            const countNoti = document.getElementById("count-noti-title").innerText = `การแจ้งเตือนใหม่ทั้ง ${newNoti.length} รายการ ทั้งหมด ${notiData.length} รายการ`
            //noti_content.innerHTML = "";
            if (notiData.length != 0) {
                const token_id = notiData[0].token_id;
                updateReadNotification(token_id)
            }

            Limit = Limit + 10;
            writeDataNoti(notiData, view);
        }

        async function updateReadNotification(token_id) {
            const url = "./controller/UserController.php?updateNoti=1&token_id=" + token_id;
            await axios.get(url)
        }


        async function viewMore() {
            await getNotification(Limit, 1)
        }


        function writeDataNoti(notiData, view) {
            const noti_content = document.getElementById("notification")
            if (notiData.length == 0) {
                noti_content.innerHTML += `
                <div class="col-md-12 d-flex justify-content-center">
                   <h3>ไม่มีการแจ้งเตือน</h3>
                </div>
                `;
                document.getElementById('btn-viewmore').style.display = "none"
                return;
            }

            if (view == 0) {
                noti_content.innerHTML = "";
            }

            document.getElementById('btn-viewmore').style.display = "flex"
            notiData.forEach((element, i) => {
                if (element.status == 0) {
                    noti_content.innerHTML += `
                    <div class="card" style="margin-bottom: 20px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        <div class="card-header img-read" style="padding: 5px 12px;">
                            <div class="d-flex justify-content-between">
                                <h5><b>${element.noti_title}</b></h5>
                                <img src="assets/img/noti-solid-icon.png" width="20px">
                            </div>

                        </div>
                        <div class="card-body" style="padding: 5px;">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title" style="padding: 5px 10px;margin: 0;" id="count-noti-title">${element.noti_detail}</h5>
                                <h5 class="card-title" style="padding: 5px 10px;margin: 0;font-size: 14px;" id="count-noti-title">${FormatToThaiDate(element.c)}</h5>
                            </div>
                        </div>
                    </div>`;
                } else {
                    noti_content.innerHTML += `
                    <div class="card readed" style="margin-bottom: 20px; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                        <div class="card-header img-read readed" style="padding: 5px 12px;">
                            <div class="d-flex justify-content-between">
                                <h5><b>${element.noti_title}</b></h5>
                                <img src="assets/img/noti-outline-icon.png" width="20px">
                            </div>

                        </div>
                        <hr>
                        <div class="card-body" style="padding: 5px;">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title" style="padding: 5px 10px;margin: 0;" id="count-noti-title">${element.noti_detail}</h5>
                                <h5 class="card-title" style="padding: 5px 10px;margin: 0;font-size: 14px;" id="count-noti-title">${FormatToThaiDate(element.create_date,"time")}</h5>
                            </div>
                        </div>
                    </div>`;
                }

            });


        }
    </script>
</body>

</html>