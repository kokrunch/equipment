<?php include("component/checkSession.php"); ?>
<?php include("component/roleEmp.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>รายการที่ขอเบิกวัสดุ it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarEmp.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>ตารางรายการขอเบิกวัสดุ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_emp">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">ตารางรายการขอเบิกวัสดุ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางรายการขอเบิกวัสดุ</h5>
                            <div class="table-responsive">
                                <table id="table-emp_disburse_list" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">วัสดุ</th>
                                            <th style="width: 10%;">เลขที่ใบเบิก</th>
                                            <th style="width: 15%;">วันที่ขอเบิก</th>
                                            <th style="width: 12%;">จำนวนรายการ</th>
                                            <th style="width: 15%;">เหตุผล</th>
                                            <th class="text-center">สถานะ</th>
                                            <th class="text-left"></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-emp_disburse_list">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="modal fade" id="detailDiscurseModal" tabindex="-1" aria-labelledby="detailDiscurseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="" id="addUser">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailDiscurseModalLabel">รายละเอียดการเบิกวัสดุ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="table-diburse-detail" class="text-left" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รายการวัสดุ</th>
                                            <th>จำนวน</th>
                                            <th>หน่วยนับ</th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-dis-detail">
                                    </tbody>

                                </table>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-3">
                                    <label for="" class="form-label">
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
                            </div>
                        </div>

                        <div class=" modal-footer">

                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="ReportDiscurseModal" tabindex="-1" aria-labelledby="detailDiscurseModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="" id="">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="detailDiscurseModalLabel">รายงานการเบิกวัสดุ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-12">
                                    <label for="" class="form-label">
                                        รายงานการเบิก</label>
                                    <input type="hidden" id="re_dis_id">
                                    <textarea class="form-control" id="dis_report_note" placeholder="กรอกข้อมูลรายงานการเบิกวัสดุ"></textarea>
                                </div>
                                <div class="col-12 col-md-12" id="div_not_appv">

                                </div>
                            </div>
                        </div>

                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" class="btn btn-primary" onclick="ReportDis()">บันทึก</button>
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
            await getDisburseList().then(() => writeTable("#table-emp_disburse_list"));
        }); //end ready function

        async function getDisburseList() {
            const url = "./controller/DisburseController.php?getDisburseEmp=1";
            let disburseData;
            await axios.get(url).then(function(response) {
                disburseData = response.data;
                console.log(disburseData)
            }).catch((err) => console.log(err));

            $("#table-emp_disburse_list").DataTable().destroy();

            const body_disburse = document.getElementById("body-emp_disburse_list");
            body_disburse.innerHTML = "";
            disburseData.forEach((element, i) => {

                let year_disburse = new Date(element.dis_date).getFullYear();
                year_disburse = year_disburse + 543;

                body_disburse.innerHTML += `
                <tr>
                    <td style="width:5%" class="text-center">${i+1}</td>
                    <td class="text-center">${element.dis_id}/${year_disburse}</td>
                    <td>${element.dis_date_formate}</td>
                    <td class="text-center">${element.count_mat}</td>
                    <td style="width:30%">${element.dis_note}</td>
                    <td class="text-center" style="width:10%">${
                        element.dis_status == 'รออนุมัติ' ? `<span class="badge bg-info">${element.dis_status}</span>` :
                        element.dis_status == 'อนุมัติแล้ว' ? `<span class="badge bg-success">${element.dis_status}</span>` :
                        `<span class="badge bg-danger">${element.dis_status}</span>`
                    }</td>
                    <td style="width:14%">
                    ${
                        element.dis_status == 'รออนุมัติ' ? 
                        `
                        <button type="button" class="btn btn-outline-success" 
                            onclick="PrintPdfDisburse(${element.dis_id})"><i class='bx bxs-file-pdf'></i></button>
                        <button type="button" class="btn btn-outline-danger" onclick="cancelDisburse(${element.dis_id})">
                            ยกเลิก
                        </button>` : 
                        element.dis_status == 'ไม่ผ่านอนุมัติ' ? 
                        `<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" 
                        data-bs-target="#detailDiscurseModal" onclick="viewDetail(${element.dis_id})" style="width:100%">
                            ดูรายละเอียด  
                        </button>`:
                        `
                        <button type="button" class="btn btn-outline-success"
                            onclick="PrintPdfDisburse(${element.dis_id})"><i class='bx bxs-file-pdf'></i></button>
                        <button type="button" class="btn btn-outline-warning"
                            data-bs-toggle="modal" 
                            data-bs-target="#ReportDiscurseModal"
                            onclick="ReportDisburse(${element.dis_id})">รายงานการเบิก</button>
                        `
                    }
                    </td>
                </tr>
                `
            });
        }

        async function PrintPdfDisburse(dis_id) {
            window.open(
                "./pdf_pages/ใบเบิกวัสดุ.php?dis_id=" + dis_id,
                '_blank'
            );
        }


        async function viewDetail(dis_id) {
            const table = $("#table-diburse-detail").DataTable();
            table.destroy();
            const url = "./controller/DisburseController.php?getDisAppvById=" + dis_id;
            let disburseDetailData;
            await axios.get(url).then(function(res) {
                disburseDetailData = res.data;
            }).catch((err) => console.log(err))

            const BodyDissAppv = document.getElementById("body-dis-detail");
            const BodyDivnotAppv = document.getElementById("div_not_appv");
            BodyDissAppv.innerHTML = "";
            BodyDivnotAppv.innerHTML = ""
            disburseDetailData.forEach((element, index) => {
                let date = element.dis_appv_date_formate;
                if (date != null) {
                    const date_sp = date.split("-");
                    let date_day = date_sp[2].split(" ");

                    let date_format = date_sp[0] + "-" + date_sp[1] + "-" + date_day[0];
                    document.getElementById("dis_appv_date").value = date_format;
                }

                document.getElementById("dis_note").value = element.dis_note;

                BodyDissAppv.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${element.mat_name}</td>
                            <td>${element.quantity}</td>
                            <td>${element.unit_name}</td>
                        </tr>
                        `
                BodyDivnotAppv.innerHTML = `
                ${element.dis_status == 'ไม่ผ่านอนุมัติ' ? 
                    `<label for="" class="form-label">เหตุผลที่ไม่อนุมัติ</label>
                     <textarea class="form-control" disabled>${element.dis_not_approve}</textarea>` : `` }
            `
            });

            writeTable("#table-diburse-detail")
        }


        async function cancelDisburse(dis_id) {
            Swal.fire({
                title: 'ยืนยันยกเลิกการเบิกวัสดุ',
                text: "ต้องการยกเลิกใช่หรือไม่ ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const jsonData = {
                        dis_id: dis_id,
                        cancelDisburse: true
                    }

                    const url = "./controller/DisburseController.php";
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
                                position: 'top-center',
                                icon: 'success',
                                title: 'ยกเลิกการเบิกสำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(async () => {
                                await getDisburseList().then(() => writeTable(
                                    "#table-emp_disburse_list"));
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
            })
        }

        async function ReportDisburse(dis_de_id) {
            document.getElementById("re_dis_id").value = dis_de_id;
        }

        async function ReportDis() {
            let dis_id = document.getElementById("re_dis_id").value;
            let report_note = document.getElementById("dis_report_note").value;

            if (!dis_id || !report_note) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'warning',
                    title: 'โปรดกรอกข้อมูลรายงานการเบิก',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
            } else {
                const jsonData = {
                    dis_id: dis_id,
                    report_note: report_note,
                    ReportDisburse: "ReportDisburse"
                }

                const url = "./controller/DisburseController.php";
                await axios({
                    method: 'post',
                    url: url,
                    data: jsonData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                }).then((res) => {
                    // console.log(res.data)
                    if (res.data == 1) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'รายงานข้อมูลหลังการเบิกสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(async () => {
                            await getDisburseList().then(() => writeTable(
                                "#table-emp_disburse_list"));
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
    </script>
</body>

</html>