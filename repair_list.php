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
            <h1>หน้ารายการแจ้งซ่อม</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">รายการแจ้งซ่อม</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">รายการที่ต้องรอการส่งซ่อม</h5>
                            <div class="table-responsive-equ" id="div_repair_equ">
                                <table id="table-repair" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ประเภทการแจ้งซ่อม</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th>วันที่แจ้งซ่อม</th>
                                            <th>รายละเอียดการแจ้งซ่อม</th>
                                            <th>ความเร่งด่วน</th>
                                            <th>สถานะการซ่อม</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-repair">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- modal repairEqu -->
        <div class="modal fade" id="repairEquModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="" id="addUser">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title_budget"></h5>
                            <input type="hidden" id="mat_id_for_add">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        วันที่แจ้งซ่อม</label>
                                    <input type="date" class="form-control" id="date_repair">
                                </div>
                            </div>
                            <div class="row g-3 mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ครุภัณฑ์ที่จะซ่อม</label>
                                    <select class="form-select form-equ" id="repair_equData">
                                        <option selected disabled>เลือกครุภัณฑ์</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        รายละเอียดการแจ้งซ่อมครุภัณฑ์</label>
                                    <textarea class="form-control" id="repair_equ_detail" rows="3" placeholder="กรอกรายละเอียดการแจ้งซ่อมครุภัณฑ์"></textarea>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="col-12 col-md-6" onchange="repair_nes()">
                                        <label for="" class="form-label"><span class="text-danger">*</span>
                                            ความเร่งด่วนในการแจ้งซ่อม</label><br>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="repair_nes" id="v_repair_nes" value="1">ปกติ
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="repair_nes" id="v_repair_nes" value="2">ด่วน
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="repair_nes" id="v_repair_nes" value="3">ด่วนมาก
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6" id="div_repair_note">
                                        <label for="" class="form-label"><span class="text-danger">*</span>
                                            เหตุผลที่เร่งด่วน</label>
                                        <textarea class="form-control" id="repair_note" rows="3" placeholder="กรอกรายละเอียดเหตุผลที่เร่งด่วน"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="btn_confirm_repairEqu()" class="btn btn-primary">แจ้งซ่อม</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- FinishRepairModal -->
        <div class="modal fade" id="FinishRepairModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="" id="addUser">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="">ผลการส่งซ่อม</h5>
                            <input type="hidden" id="repair_id_finish">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ผลการซ่อม</label>
                                    <textarea type="text" class="form-control" id="repair_result" placeholder="ผลการซ่อม"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="btn_cf_finishrepairEqu()" class="btn btn-success">เสร็จงานซ่อม</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- DetailRepairEqulModal -->
        <div class="modal fade" id="DetailRepairEqulModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">รายละเอียดการแจ้งซ่อม</h5>
                        <input type="hidden" id="">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    วันที่แจ้งซ่อม</label>
                                <input type="date" class="form-control" id="de_repair_date" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    คนที่แจ้งซ่อม</label>
                                <input type="text" class="form-control" id="de_repair_emp" placeholder="เหตุผลการแจ้งซ่อมด่วน" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    เหตุผลการแจ้งซ่อมด่วน</label>
                                <input type="text" class="form-control" id="de_repair_reason" placeholder="เหตุผลการแจ้งซ่อมด่วน" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">บริษัทที่รับงานซ่อม</label>
                                <input type="text" class="form-control" id="de_repair_comp" placeholder="" disabled>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
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

            await getEquipment();
            await getDataRepairEqu(0).then(async () => writeTable("#table-repair"))

            $select = $('.form-equ').select2({
                dropdownParent: $("#repairEquModal"),
                width: "100%",
            });

            document.getElementById("div_repair_note").style.display = "none";

        }); //end ready function

        async function getDataRepairEqu(reload) {
            const url =
                "./controller/RepairController.php?DataRepairEqu_by_officer=1";
            let equData;

            await axios.get(url).then(function(response) {
                equData = response.data;
            }).catch((err) => console.log(err));

            if (reload == 1) {
                $("#table-repair").DataTable().destroy();
            }

            const Bodyrepair = document.getElementById("body-repair");
            Bodyrepair.innerHTML = "";
            equData.forEach((element, index) => {
                Bodyrepair.innerHTML += `
            <tr>
                <td align="left">${index+1}</td>
                <td align="left">${element.equ_name == null ? 'แจ้งซ่อมอื่นๆ' : 'แจ้งซ่อมครุครุภัณฑ์' }</td>
                <td align="left">${element.equ_name == null ? '-' : element.equ_name }</td>
                <td align="left">${FormatToThaiDate(element.repair_date)}</td>
                <td align="left">${element.repair_description}</td>
                <td align="left">${element.repair_necessity}</td>
                <td align="right">
                    ${element.repair_status == 'กำลังดำเนินการซ่อม' ?
                    `<span class="badge bg-primary">กำลังดำเนินการซ่อม</span>` 
                    : element.repair_status == 'กำลังซ่อม' ? 
                    `<span class="badge bg-info">กำลังซ่อม</span>` 
                    : element.repair_status == 'เสร็จสิ้นการซ่อม' ?
                     `<span class="badge bg-success">เสร็จสิ้น</span>`  
                    : element.repair_status == 'รอดำเนินการซ่อม' ?
                     `<span class="badge bg-secondary">รอดำเนินการซ่อม</span>`
                     :element.repair_status == 'กำลังส่งซ่อม' ? 
                     `<span class="badge bg-warning">กำลังส่งซ่อม</span>` : '' }
                </td>
                <td align="right" >
                    ${element.repair_status == 'กำลังส่งซ่อม' ?
                    `
                    <button type="button" class="btn btn-outline-success"
                            title="ปริ้น pdf"
                            onclick="PDF_sendRepair()"><i class='bx bxs-file-pdf'></i></button>
                    <button type="button" class="btn btn-outline-success mb-2 mt-2"
                            title="รายละเอียดการแจ้งซ่อม"
                            data-jsonEquipment='${JSON.stringify(element)}'
                            onclick="DetailEquRepairModal(this)"><i class="bx bx-detail"></i></button>
                    <button type="button" class="btn btn-outline-success mb-1"
                        data-jsonEquipment='${JSON.stringify(element)}'
                        onClick="finishRepair(this)">เสร็จงานซ่อม</button>` 
                    : '-'}
                </td>
            </tr>
            `
            });

        }

        async function repair_nes() {
            let radios = document.getElementsByName("repair_nes");
            for (var i = 0; i < radios.length; i++) {
                if (radios[i].checked) {
                    let value = radios[i].defaultValue;
                    let value_repair_nes;
                    if (value != 2 && value != 3) {
                        document.getElementById("div_repair_note").style.display = "none";
                        document.getElementById("div_repair_other_note").style.display = "none";

                        value_repair_nes = document.getElementById("v_repair_nes").value = "ปกติ"
                    } else if (value == 2) {
                        document.getElementById("div_repair_note").style.display = "block";
                        document.getElementById("div_repair_other_note").style.display = "block";

                        value_repair_nes = document.getElementById("v_repair_nes").value = "ด่วน"
                    } else if (value == 3) {
                        document.getElementById("div_repair_note").style.display = "block";
                        document.getElementById("div_repair_other_note").style.display = "block";

                        value_repair_nes = document.getElementById("v_repair_nes").value = "ด่วนมาก"
                    }
                    return value_repair_nes;
                }
            }
            return null;
        }

        async function getEquipment() {
            const url = "./controller/EquipmentController.php?getEqu=1";
            let equData;

            await axios.get(url).then(function(response) {
                equData = response.data.Equ;
            }).catch((err) => console.log(err));

            const bodyEqu = document.getElementById("repair_equData");
            equData.forEach((element, i) => {
                bodyEqu.innerHTML += `
                <option value="${element.equ_id}">${element.equ_name}</option>
            `
            });
        }

        async function List_repair_equ() {
            $("#table-repair").DataTable();
            document.getElementById("div_repair_other").style.display = "none";
            document.getElementById("div_repair_equ").style.display = "block";

            getDataRepairEqu();

        }

        async function List_repair_other() {
            $("#table-repair_other").DataTable();
            document.getElementById("div_repair_equ").style.display = "none";
            document.getElementById("div_repair_other").style.display = "block";

            getDataRepairOther();
        }

        async function finishRepair(btn) {
            $("#FinishRepairModal").modal("show");
            const jsonStrData = btn.getAttribute("data-jsonEquipment")
            const jsonParseData = JSON.parse(jsonStrData)
            document.getElementById("repair_id_finish").value = jsonParseData.repair_id;
        }

        async function btn_cf_finishrepairEqu() {
            let repair_id = document.getElementById("repair_id_finish").value;
            let repair_result = document.getElementById("repair_result").value;

            if (!repair_id || !repair_result) {
                Swal.fire({
                    icon: 'info',
                    title: 'กรุณากรอกข้อมูลให้ครบถ้วน !!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                let jsonData = {
                    repair_result: repair_result,
                    repair_id: repair_id,
                    FinishRepairEqu: 'FinishRepairEqu'
                }

                const url = "./controller/RepairController.php";
                await axios({
                    method: 'post',
                    url: url,
                    data: jsonData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                }).then(async (res) => {
                    if (res.data == 1) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'สำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#FinishRepairModal").modal('hide');
                        await getDataRepairEqu(1).then(async () => writeTable("#table-repair"))
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

        async function PDF_sendRepair() {
            window.open(
                "./pdf_pages/ใบส่งซ่อมครุภัณฑ์คณะวิทยาการสารสนเทศ.php",
                '_blank'
            );
        }

        async function DetailEquRepairModal(btn) {
            $("#DetailRepairEqulModal").modal("show");
            const jsonStrData = btn.getAttribute("data-jsonEquipment")
            const jsonParseData = JSON.parse(jsonStrData)

            let date = jsonParseData.repair_date;

            if (date != null) {
                const date_sp = date.split("-");
                let date_day = date_sp[2].split(" ");

                let year = parseInt(date_sp[0]) + 543;
                let date_format = year + "-" + date_sp[1] + "-" + date_day[0];
                document.getElementById("de_repair_date").value = date_format;
            }


            document.getElementById("de_repair_comp").value = jsonParseData.send_repair_company;
            document.getElementById("de_repair_emp").value = jsonParseData.emp_name;
            document.getElementById("de_repair_reason").value = jsonParseData.repair_reason;

        }
    </script>
</body>

</html>