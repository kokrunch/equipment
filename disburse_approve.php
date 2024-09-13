<?php include("component/checkSession.php"); ?>
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
            <h1>รายการการเบิกวัสดุ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">รายการการเบิกวัสดุ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">รายการที่ต้องอนุมัติการเบิก</h5>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-info" style="margin: 5px;color: white;"
                                    onclick="FilterStatusDisb('รออนุมัติ')">รออนุมัติ</button>
                                <button type="button" class="btn btn-success" style="margin: 5px;color: white;"
                                    onclick="FilterStatusDisb('อนุมัติแล้ว')">อนุมัติแล้ว</button>
                                <button type="button" class="btn btn-danger" style="margin: 5px;color: white;"
                                    onclick="FilterStatusDisb('ไม่ผ่านอนุมัติ')">ไม่ผ่านอนุมัติ</button>
                            </div><br>
                            <div class="table-responsive">
                                <table id="table-diburse-appv" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>วันที่ขอเบิก</th>
                                            <th>ผู้ขอเบิก</th>
                                            <th>เหตุผลการเบิก</th>
                                            <th>สถานะ</th>
                                            <th style="width: 200px;">*</th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-dis-appv">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- detalModal -->
        <div class="modal fade" id="detailDiscurseAppvModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="" id="addUser">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">รายละเอียดการเบิกวัสดุ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="table-diburse-appv-detail" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รายการวัสดุ</th>
                                            <th>จำนวน</th>
                                            <th>หน่วยนับ</th>
                                            <th>หมายเหตุ</th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-dis-appv-detail">
                                    </tbody>

                                </table>
                            </div>
                            <hr style="clear: both; visibility: hidden;">
                            <div class="row g-3 my-2" id="div_checK_appv_date">
                                <div class="col-12 col-md-3">
                                    <label for="" class="form-label" id="label_appv_date">
                                        วันที่อนุมัติการเบิก</label>
                                    <input type="date" class="form-control" id="dis_appv_date" disabled>
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-12">
                                    <label for="" class="form-label">
                                        เหตุผลการขอเบิกวัสดุ</label>
                                    <textarea class="form-control" id="dis_note" disabled></textarea>
                                </div>
                                <div class="col-12 col-md-12" id="div_not_appv">
                                </div>
                                <div class="col-12 col-md-12" id="div_report_dis">
                                </div>
                            </div>
                        </div>

                        <div class=" modal-footer" id="div_bt_cf_cc">

                        </div>

                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="notDiscurseAppvModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="" id="addUser">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">เหตุผลที่ไม่อนุมัติการเบิกวัสดุ</h5>
                            <input type="hidden" id="dis_id_for_not_apprv">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-12">
                                    <input type="text" class="form-control" id="dis_not_approve"
                                        placeholder="เหตุผลที่ไม่อนุมัติการขอเบิกวัสดุ">
                                </div>
                            </div>
                        </div>

                        <div class=" modal-footer">
                            <button type="button" class="btn btn-success" data-bs-dismiss="modal"
                                onclick="cancel_dis()">บันทึก</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
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
</body>

</html>
<script>
$(document).ready(async function() {

    await getDataDiscurseAppv(0).then(async () => writeTable("#table-diburse-appv"))

    $("#table-diburse-appv-detail").DataTable({
        "oLanguage": {
            "sLengthMenu": "แสดง _MENU_ ต่อหน้า",
            "sZeroRecords": "ไม่มีข้อมูล",
            "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
            "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
            "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
            "sSearch": "ค้นหา :",
            "aaSorting": [
                [0, 'desc']
            ],
            "oPaginate": {
                "sFirst": "หน้าแรก",
                "sPrevious": "ก่อนหน้า",
                "sNext": "ถัดไป",
                "sLast": "หน้าสุดท้าย"
            },
        }
    });

}); //end ready function

async function getDataDiscurseAppv(reload, status) {
    BodyDissAppv = document.getElementById("body-dis-appv").innerHTML = "";
    let url;
    let DisAppvData;

    if (status != null) {
        url = "./controller/DisburseController.php?getDisAppvByStatus=" + status;
    } else {
        url = "./controller/DisburseController.php?getDisAppv=1";
    }

    await axios.get(url).then(function(res) {
        DisAppvData = res.data;
    }).catch((err) => console.log(err))

    if (reload == 1) {
        $("#table-diburse-appv").DataTable().destroy();
    }

    BodyDissAppv = document.getElementById("body-dis-appv");

    BodyDissAppv.innerHTML = "";
    DisAppvData.forEach((element, index) => {
        BodyDissAppv.innerHTML += `
            <tr >
                <td align="left">${index + 1}</td>
                <td align="left">${FormatToThaiDate(element.dis_date)}</td>
                <td align="left">${element.emp_name}</td>
                <td align="left">${element.dis_note == "" ? "-" : element.dis_note}</td>
                <td align="left">${element.dis_status == 'รออนุมัติ' ? `<span class="badge bg-info">${element.dis_status}</span>` 
                    : element.dis_status == 'อนุมัติแล้ว' ? `<span class="badge bg-success">${element.dis_status}</span>`
                    :`<span class="badge bg-danger">${element.dis_status}</span>`}</td>
                <td style="float: right;">
                    ${element.dis_status == 'อนุมัติแล้ว' ? 
                        `
                        <button type="button" class="btn btn-outline-success" title="ปริ้น pdf"
                                onclick="pdf_dis_appv(${element.dis_id})"><i class='bx bxs-file-pdf'></i></button>
                        <button type="button" class="btn btn-outline-success" title="รายละเอียดการเบิก"
                                data-bs-toggle="modal" data-bs-target="#detailDiscurseAppvModal" 
                                onclick="detail_dis_appv(${element.dis_id})"><i class='bx bx-file'></i></button>` : 
                        element.dis_status == 'รออนุมัติ' ? 
                        `
                        <button type="button" class="btn btn-outline-success" title="ปริ้น pdf"
                                onclick="pdf_dis_appv(${element.dis_id})"><i class='bx bxs-file-pdf'></i></button>
                        <button type="button" class="btn btn-outline-success" title="รายละเอียดการเบิก"
                                data-bs-toggle="modal" data-bs-target="#detailDiscurseAppvModal" 
                                onclick="detail_dis_appv(${element.dis_id})"><i class='bx bx-file'></i></button>
                        ` : 
                        `
                        <button type="button" class="btn btn-outline-success" title="ปริ้น pdf"
                                onclick="pdf_dis_appv(${element.dis_id})"><i class='bx bxs-file-pdf'></i></button>
                        <button type="button" class="btn btn-outline-success" title="รายละเอียดการเบิก"
                                data-bs-toggle="modal" data-bs-target="#detailDiscurseAppvModal" 
                                onclick="detail_dis_appv(${element.dis_id})"><i class='bx bx-file'></i></button>` }
                </td>
                
            </tr>
            `
    });
}

async function detail_dis_appv(dis_id) {
    document.getElementById("div_not_appv").innerHTML = "";
    document.getElementById("dis_appv_date").value = "";
    document.getElementById("div_report_dis").value = "";


    BodyDissAppv = document.getElementById("body-dis-appv-detail").innerHTML = "";
    const url = "./controller/DisburseController.php?getDisAppvById=" +
        dis_id;
    let DisAppvData;
    await axios.get(url).then(function(res) {
        DisAppvData = res.data;
    }).catch((err) => console.log(err))

    DivButton = document.getElementById("div_bt_cf_cc").innerHTML = `
     ${DisAppvData[0].dis_status == 'อนุมัติแล้ว' 
        ? `<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>` 
        : DisAppvData[0].dis_status == 'ไม่ผ่านอนุมัติ' 
        ? `<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>` 
        : `<button type="button" class="btn btn-outline-success" data-bs-toggle="modal"
                data-bs-target="#editMaterialModal"onclick="appv_dis(${DisAppvData[0].dis_id})">อนุมัติ</button>
           <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                data-bs-target="#notDiscurseAppvModal"onclick="cancel_dis_bt(${DisAppvData[0].dis_id})">ไม่อนุมัติ</button>
           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          `}
                
    `
    BodyDissAppv = document.getElementById("body-dis-appv-detail");
    BodyDivnotAppv = document.getElementById("div_not_appv");
    BodyReportDis = document.getElementById("div_report_dis");

    DisAppvData.forEach((element, index) => {

        let date = element.dis_appv_date_formate;

        if (date != null) {
            const date_sp = date.split("-");
            let date_day = date_sp[2].split(" ");

            let date_format = date_sp[0] + "-" + date_sp[1] + "-" + date_day[0];
            document.getElementById("dis_appv_date").value = date_format;
        } else {
            document.getElementById("div_checK_appv_date").style.display = "none";
        }

        document.getElementById("dis_note").value = element.dis_note;

        BodyDissAppv.innerHTML += `
            <tr>
                <td align="left">${index + 1}</td>
                <td align="left">${element.mat_name}</td>
                <td align="left">${element.quantity}</td>
                <td align="left">${element.unit_name}</td>
                <td align="left">${element.dis_mat_detail == "" ? "-" : element.dis_mat_detail}</td>
            </tr>
            `
        BodyDivnotAppv.innerHTML = `
                ${element.dis_status == 'ไม่ผ่านอนุมัติ' ? 
                    `<label for="" class="form-label">เหตุผลที่ไม่อนุมัติ</label>
                     <textarea class="form-control" disabled>${element.dis_not_approve}</textarea>` : `` }
            `

        BodyReportDis.innerHTML = `
                ${element.dis_status == 'อนุมัติแล้ว' ? 
                    `<label for="" class="form-label">รายงานการขอเบิก</label>
                     <textarea class="form-control" disabled>${element.report_note}</textarea>` : `` }
            `
    });
}

async function appv_dis(dis_id) {
    // current date
    const currentDate = new Date();
    let date = document.getElementById("dis_appv_date");
    date.value = currentDate.toISOString().substr(0, 10);
    let current_date = date.value;
    //

    const url = "./controller/DisburseController.php";

    let JsonData = {
        'appv_disburse': "appv_disburse",
        'type': '1', // 1 mean appv
        'date': current_date,
        'dis_id': dis_id
    }

    Swal.fire({
        title: 'ยืนยันการอนุมัติการเบิกวัสดุ !!',
        text: "ต้องการอนุมัติการเบิกวัสดุหรือไม่ ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก'
    }).then(async (result) => {
        if (result.isConfirmed) {
            await axios({
                method: 'post',
                url: url,
                data: JsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then(async (res) => {
                let response = res.data;
                if (response == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'อนุมัติสำเร็จ !!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    await getDataDiscurseAppv(1).then(async () => writeTable(
                        "#table-diburse-appv"))
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'อนุมัติไม่สำเร็จ !!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            })


        } else {

        }

    })

}

async function cancel_dis_bt(dis_id) {
    document.getElementById("dis_id_for_not_apprv").value = dis_id
    document.getElementById("dis_not_approve").value = "";
}

async function cancel_dis() {
    let dis_id = document.getElementById("dis_id_for_not_apprv").value;
    let dis_not_approve = document.getElementById("dis_not_approve").value;

    // current date
    const currentDate = new Date();
    let date = document.getElementById("dis_appv_date");
    date.value = currentDate.toISOString().substr(0, 10);
    let current_date = date.value;
    //

    const url = "./controller/DisburseController.php";

    if (!dis_not_approve) {
        Swal.fire({
            icon: 'info',
            title: 'กรุณากรอกข้อมูลให้ครบถ้วน!!',
            showConfirmButton: false,
            timer: 1500
        })
    } else {

        let JsonData = {
            'appv_disburse': "appv_disburse",
            'type': '2', // 1 mean appv
            'date': current_date,
            'dis_id': dis_id,
            'dis_not_approve': dis_not_approve
        }

        Swal.fire({
            title: 'ยืนยันการไม่อนุมัติการเบิกวัสดุ !!',
            text: "ต้องการไม่อนุมัติการเบิกวัสดุใช่หรือไม่ ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await axios({
                    method: 'post',
                    url: url,
                    data: JsonData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                }).then((res) => {
                    let response = res.data;
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'สำเร็จ !!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function() {
                            getDataDiscurseAppv()
                        }, 3000);
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ไม่สำเร็จ !!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(function() {
                            getDataDiscurseAppv()
                        }, 2000);
                    }
                })


            } else {

            }

        })

    }

}

async function pdf_dis_appv(dis_id) {
    window.open(
        location.origin + "/it-equipment-system/pdf_pages/ใบเบิกวัสดุ.php?dis_id=" + dis_id,
        '_blank'
    );
}

async function FilterStatusDisb(status) {
    await getDataDiscurseAppv(1, status).then(async () => writeTable("#table-diburse-appv"))
}
</script>