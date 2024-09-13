<?php include("component/checkSession.php"); ?>
<?php include("component/roleEmp.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarEmp.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>จัดการแจ้งซ่อม</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_emp.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">หน้าจัดการแจ้งซ่อม</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">จัดการการแจ้งซ่อม</h5>
                            <div class="d-flex justify-content-end">
                                <div class="col-6 col-ml-12">
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-outline-primary rounded mb-3"
                                            style="margin:5px;" data-bs-toggle="modal" data-bs-target="#repairModal">
                                            แจ้งซ่อม
                                        </button>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary" style="margin: 5px;"
                                            onclick="FilterStatusRepair('กำลังดำเนินการซ่อม')">กำลังดำเนินการซ่อม</button>
                                        <button type="button" class="btn btn-info" style="margin: 5px;color: white;"
                                            onclick="FilterStatusRepair('กำลังซ่อม')">กำลังซ่อม</button>
                                        <button type="button" class="btn btn-warning" style="margin: 5px;color: white;"
                                            onclick="FilterStatusRepair('กำลังส่งซ่อม')">กำลังส่งซ่อม</button>
                                        <button type="button" class="btn btn-success" style="margin: 5px;"
                                            onclick="FilterStatusRepair('เสร็จสิ้นการซ่อม')">เสร็จสิ้นการซ่อม</button>
                                    </div>
                                </div>
                            </div>
                            <hr>
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

        <div class="modal fade" id="repairModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="" id="addUser">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">แจ้งซ่อม</h5>
                            <input type="hidden" id="mat_id_for_add">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3 mb-2">
                                <div class="row col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        เลือกการแจ้งซ่อม</label>
                                    <div class="form-check" onchange="select_type_repair()">
                                        <input type="radio" id="select_type_repair" name="type_repair" value="1"
                                            checked />
                                        <label>แจ้งซ่อมครุภัณฑ์</label>

                                        <input type="radio" id="select_type_repair" name="type_repair" value="2" />
                                        <label>แจ้งซ่อมอื่นๆ</label>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row g-3 mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        วันที่แจ้งซ่อม</label>
                                    <input type="date" class="form-control" id="date_repair">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        เลือกฝ่ายการแจ้งซ่อม</label>
                                    <select class="form-select" id="repair_sec">
                                        <option selected value="0" disabled>เลือกฝ่ายซ่อม</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-2">
                                <div class="col-12 col-md-6" id="div_select_equ">
                                    <label for="" class="form-label">
                                        ครุภัณฑ์ที่จะซ่อม</label>
                                    <select class="form-select form-equ" id="repair_equData">
                                        <option selected value="" disabled>เลือกครุภัณฑ์</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label">
                                        รายละเอียดการแจ้งซ่อม</label>
                                    <textarea class="form-control" id="repair_detail" rows="3"
                                        placeholder="กรอกรายละเอียดการแจ้งซ่อม"></textarea>
                                </div>
                                <div class="row g-3 mb-2">
                                    <div class="row col-12 col-md-6">
                                        <label for="" class="form-label"><span class="text-danger">*</span>
                                            ความเร่งด่วนในการแจ้งซ่อม</label><br>
                                        <div class="form-check" onchange="repair_nes()">
                                            <input type="radio" id="v_repair_nes" name="repair_nes" value="1" />
                                            <label>ปกติ</label>

                                            <input type="radio" id="v_repair_nes" name="repair_nes" value="2" />
                                            <label>ด่วน</label>

                                            <input type="radio" id="v_repair_nes" name="repair_nes" value="3" />
                                            <label>ด่วนมาก</label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6" id="div_repair_note">
                                        <label for="" class="form-label"><span class="text-danger">*</span>
                                            เหตุผลที่เร่งด่วน</label>
                                        <textarea class="form-control" id="repair_note" rows="3"
                                            placeholder="กรอกรายละเอียดเหตุผลที่เร่งด่วน"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="btn_confirm_repair()"
                                class="btn btn-primary">แจ้งซ่อม</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="modal fade" id="DetailRepairEqulModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="">รายละเอียดการแจ้งซ่อม</h5>
                        <input type="hidden" id="">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="timeline-steps aos-init aos-animate" data-aos="fade-up"
                                        id="div_timeline_repair">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row g-3 mb-2">
                            <div class="row g-3 mb-2" id="repair_fixing_deadline">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label">
                                        วันที่เริ่มซ่อม</label>
                                    <input type="date" class="form-control" id="de_repair_start_date" disabled>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label">
                                        วันที่สิ้นสุดซ่อม</label>
                                    <input type="date" class="form-control" id="de_repair_end_date" disabled>
                                </div>
                                <hr>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    วันที่แจ้งซ่อม</label>
                                <input type="date" class="form-control" id="de_repair_date" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    คนที่แจ้งซ่อม</label>
                                <input type="text" class="form-control" id="de_repair_emp"
                                    placeholder="เหตุผลการแจ้งซ่อมด่วน" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    เหตุผลการแจ้งซ่อมด่วน</label>
                                <input type="text" class="form-control" id="de_repair_reason"
                                    placeholder="เหตุผลการแจ้งซ่อมด่วน" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label" id="role_tech"></label>
                                <input type="text" class="form-control" id="de_repair_emp_approve"
                                    placeholder="คนรับเรื่องการแจ้งซ่อม" disabled>
                            </div>
                            <hr>
                            <div class="col-12 col-md-6" id="div_send_repair_bussiness">
                                <label for="" class="form-label">
                                    บริษัทที่ส่งซ่อม</label>
                                <input type="text" class="form-control" id="send_repair_bussiness" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    ผลการซ่อม</label>
                                <input type="text" class="form-control" id="de_repair_result" disabled>
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

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

    <script>
    $(document).ready(async function() {

        await getEquipment();
        await getDataRepairEqu(0).then(async () => writeTable("#table-repair"))
        await getSecTechnical();

        $select = $('.form-equ').select2({
            dropdownParent: $("#repairModal"),
            width: "100%",
        });

        document.getElementById("div_repair_note").style.display = "none";

    }); //end ready function

    async function select_type_repair() {
        document.getElementById("select_type_repair").value = "1";
        let radios = document.getElementsByName("type_repair");
        for (var i = 0; i < radios.length; i++) {
            if (radios[i].checked) {
                let value = radios[i].defaultValue;
                if (value == 1) {
                    document.getElementById("div_select_equ").style.display = "block";
                    document.getElementById("select_type_repair").value = 1;
                } else if (value == 2) {
                    document.getElementById("repair_equData").value = "";
                    document.getElementById("div_select_equ").style.display = "none";
                    document.getElementById("select_type_repair").value = 2;
                }
                return value;
            }
        }
        return null;
    }

    async function getDataRepairEqu(reload,status) {
        let url ;
        let equData;

        if (status != null ) {
            url = "./controller/RepairController.php?getdatarepairequ_by_status=" + status;
        } else {
            url = "./controller/RepairController.php?getdatarepairequ=1";
        }

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
                <td align="left">${element.equ_name == null ? 'แจ้งซ่อมอื่นๆ' : 'แจ้งซ่อมครุภัณฑ์' }</td>
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
                <td title="รายละเอียดการแจ้งซ่อม">
                    <button type="button" class="btn btn-outline-success mb-2 mt-2" 
                            data-jsonEquipment='${JSON.stringify(element)}'
                            onclick="DetailEquRepairModal(this)"><i class="bx bx-detail"></i></button>
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
                if (value != 2 && value != 3) {
                    document.getElementById("div_repair_note").style.display = "none";
                    document.getElementById("v_repair_nes").value = "ปกติ";
                } else if (value == 2) {
                    document.getElementById("div_repair_note").style.display = "block";
                    document.getElementById("v_repair_nes").value = "ด่วน";
                } else if (value == 3) {
                    document.getElementById("div_repair_note").style.display = "block";
                    document.getElementById("v_repair_nes").value = "ด่วนมาก";
                }
                return value;
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

    async function getSecTechnical() {
        const url = "./controller/RepairController.php?getDataRoleTechnical=1";
        let SecData;

        await axios.get(url).then(function(response) {
            SecData = response.data;
        }).catch((err) => console.log(err));

        const bodySec = document.getElementById("repair_sec");
        SecData.forEach((element, i) => {
            bodySec.innerHTML += `
                <option value="${element.sub_role_id}">${element.sub_role_name}</option>
            `
        });
    }

    async function btn_confirm_repair() {
        let sec_repair = document.getElementById("repair_sec").value;

        let date_repair = document.getElementById("date_repair").value;

        let equ_id = document.getElementById("repair_equData").value;
        let repair_detail = document.getElementById("repair_detail").value;

        let repair_nes = document.getElementById("v_repair_nes").value;
        let repair_reason = document.getElementById("repair_note").value;

        let type_r = document.getElementById("select_type_repair").value;

        let JsonData = {
            type_r: type_r,
            equ_id: equ_id,
            repair_detail: repair_detail,
            date_repair: date_repair,
            repair_nes: repair_nes,
            repair_reason: repair_reason,
            sec_repair: sec_repair,
            addRepair: 'addRepair'
        }

        if (sec_repair == 0 || !date_repair || !repair_detail || !repair_nes) {
            Swal.fire({
                icon: 'info',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน !!',
                showConfirmButton: false,
                timer: 1500
            })
        } else {

            if (repair_nes != "ปกติ" && repair_reason == "") {
                Swal.fire({
                    icon: 'info',
                    title: 'กรุณากรอกเหตุผลความเร่งด่วน !!',
                    showConfirmButton: false,
                    timer: 1500
                })
            } else {
                const url = "./controller/RepairController.php";
                await axios({
                    method: 'post',
                    url: url,
                    data: JsonData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                }).then(async (res) => {
                    if (res.data == 1) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'แจ้งซ่อมสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        $("#repairModal").modal('hide');
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
    }

    async function List_repair_equ() {
        $("#table-repair").DataTable();
        document.getElementById("div_repair_other").style.display = "none";
        document.getElementById("div_repair_equ").style.display = "block";

        getDataRepairEqu();

    }

    async function DetailEquRepairModal(btn) {
        $("#DetailRepairEqulModal").modal("show");
        const jsonStrData = btn.getAttribute("data-jsonEquipment")
        const jsonParseData = JSON.parse(jsonStrData)

        document.getElementById("div_timeline_repair").innerHTML =
            `
            <div class="timeline-step">
                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                    <div class="inner-circle">
                        <img src="assets/img/timeline1.png" width="50px" class="${jsonParseData.repair_status == 'กำลังดำเนินการซ่อม' ? '' : 'img-gray'}">
                    </div>
                    <p class="h6 text-muted mb-0 mb-lg-0"><strong class="text-${jsonParseData.repair_status == 'กำลังดำเนินการซ่อม' ? 'primary' : 'secondary'}">กำลังดำเนินการซ่อม</strong></p>
                </div>
            </div>
            <div class="timeline-step">
                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                    <div class="inner-circle">
                        <img src="assets/img/timeline2.png" width="50px" class="${jsonParseData.repair_status == 'กำลังซ่อม' ? '' : 'img-gray'}">
                    </div>
                    <p class="h6 text-muted mb-0 mb-lg-0"><strong class="text-${jsonParseData.repair_status == 'กำลังซ่อม' ? 'primary' : 'secondary'}">กำลังซ่อม</strong></p>
                </div>
            </div>
            <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                    <div class="inner-circle">
                        <img src="assets/img/timeline3.png" width="53px" class="${jsonParseData.repair_status == 'กำลังส่งซ่อม' ? '' : 'img-gray'}">
                    </div>
                    <p class="h6 text-muted mb-0 mb-lg-0"><strong class="text-${jsonParseData.repair_status == 'กำลังส่งซ่อม' ? 'primary' : 'secondary'}">กำลังส่งซ่อม</strong></p>
                </div>
            </div>
            <div class="timeline-step">
                <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                    <div class="inner-circle">
                        <img src="assets/img/timeline4.png" width="50px" class="${jsonParseData.repair_status == 'เสร็จสิ้นการซ่อม' ? '' : 'img-gray'}">
                    </div>
                        <p class="h6 text-muted mb-0 mb-lg-0"><strong class="text-${jsonParseData.repair_status == 'เสร็จสิ้นการซ่อม' ? 'primary' : 'secondary'}">เสร็จสิ้นการซ่อม</strong></p>
                </div>
            </div>
        `;



        let repair_date = jsonParseData.repair_date;

        if (repair_date != null) {
            const date_sp = repair_date.split("-");
            let date_day = date_sp[2].split(" ");

            let year = parseInt(date_sp[0]) + 543;
            let date_format = year + "-" + date_sp[1] + "-" + date_day[0];
            document.getElementById("de_repair_date").value = date_format;
        } else {
            document.getElementById("repair_fixing_deadline").style.display = "none";
        }

        let date_start = jsonParseData.repair_fixing_date;

        if (date_start != null) {
            const date_sp = date_start.split("-");
            let date_day = date_sp[2].split(" ");

            let year = parseInt(date_sp[0]) + 543;
            let date_start_format = year + "-" + date_sp[1] + "-" + date_day[0];
            document.getElementById("de_repair_start_date").value = date_start_format;
        } else {
            document.getElementById("repair_fixing_deadline").style.display = "none";
        }

        let date_end = jsonParseData.repair_deadline_date;
        if (date_end != null) {
            const date_sp = date_end.split("-");
            let date_day = date_sp[2].split(" ");

            let year = parseInt(date_sp[0]) + 543;
            let date_end_format = year + "-" + date_sp[1] + "-" + date_day[0];
            document.getElementById("de_repair_end_date").value = date_end_format;
        }

        if (jsonParseData.send_repair_company != null) {
            document.getElementById("send_repair_bussiness").value = jsonParseData.send_repair_company;
        } else {
            document.getElementById("div_send_repair_bussiness").style.display = "none";
        }

        document.getElementById("role_tech").innerHTML = jsonParseData.role_name == null ?
            'คนรับเรื่องการแจ้งซ่อม' : 'คนรับเรื่องการแจ้งซ่อม ( ' + jsonParseData.role_name + ' )';
        document.getElementById("de_repair_emp").value = jsonParseData.emp_name;
        document.getElementById("de_repair_result").value = jsonParseData.repair_result == null ? '-' :
            jsonParseData.repair_result;
        document.getElementById("de_repair_reason").value = jsonParseData.repair_reason;
        document.getElementById("de_repair_emp_approve").value = jsonParseData.emp_name_appv == null ?
            'ยังไม่มีช่างรับเรื่องซ่อม' : jsonParseData.emp_name_appv;
    }

    async function FilterStatusRepair(status) {
        await getDataRepairEqu(1,status).then(async () => writeTable("#table-repair"))
    }
    </script>
</body>

</html>