<?php include("component/checkSession.php"); ?>

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
            <h1>การตรวจรับครุภัณฑ์</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Blank</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">รายการตรวจรับครุภัณฑ์</h5>
                            <div class="d-flex justify-content-end">
                                <div class="row col-md-12 col-sm-12">
                                    <div class="row col-md-8 col-sm-12">
                                        <div class="col-md-4 col-sm-8">
                                            <select class="form-select select-search-equ-type" id="equ_type_id"
                                                onchange="getEquimentByType()">
                                                <option selected disabled>เลือกประเภทครุภัณฑ์</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <select class="form-select select-search-equ" id="equ_id">
                                                <option selected disabled>เลือกครุภัณฑ์</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <button type="button" class="btn btn-outline-success rounded mb-3"
                                                data-bs-toggle="modal" data-bs-target="#ModalRecipEqu" id="bt-recip">
                                                ตรวจรับครุภัณฑ์
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="table-recip-equ" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>หมายเลขตรวจรับ</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th>วันที่ตรวจรับ</th>
                                            <th>จำนวน</th>
                                            <th>สถานะ</th>
                                            <th>*</th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-mat">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- modal recip -->
        <div class="modal fade" id="ModalRecipEqu" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">แบบฟอร์มการตรวจรับครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-4">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    รหัสการตรวจรับครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_code">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ชื่อครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_name" disabled>
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันที่ตรวจรับ</label>
                                <input type="date" class="form-control" id="equ_date">
                            </div>
                            <div class="col-12 col-md-4">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    จำนวน</label>
                                <input type="number" class="form-control" id="equ_qun">
                            </div>
                        </div>
                        <hr>
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ชื่อประธานการตรวจรับครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_pres_name">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ตำแหน่ง</label>
                                <input type="text" class="form-control" id="equ_pos" value="ประธานการตรวจรับ" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    อีเมลล์ (Email)</label>
                                <input type="email" class="form-control" id="equ_pres_email">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    เบอร์โทรศัพท์</label>
                                <input type="tel" class="form-control" id="equ_pres_tel"
                                    pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                            </div>
                        </div>
                        <hr>
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ชื่อกรรมการตรวจรับครุภัณฑ์คนที่ 1 </label>
                                <input type="text" class="form-control" id="equ_name_director1">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ตำแหน่ง</label>
                                <input type="text" class="form-control" id="equ_pos_director1"
                                    value="กรรมการตรวจรับคนที่ 1" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ชื่อกรรมการตรวจรับครุภัณฑ์คนที่ 2</label>
                                <input type="email" class="form-control" id="equ_name_director2">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ตำแหน่ง</label>
                                <input type="text" class="form-control" id="equ_pos_director2"
                                    value="กรรมการตรวจรับคนที่ 2" disabled>
                            </div>
                        </div>
                        <hr style="clear: both; visibility: hidden;">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    สถานะการตรวจรับ</label>
                                <select class="form-select" id="recip_status">
                                    <option selected disabled>เลือกสถานะการตรวจรับ</option>
                                    <option value="ผ่าน">ผ่าน</option>
                                    <option value="ไม่ผ่าน">ไม่ผ่าน</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    หมายเหตุ</label>
                                <textarea type="text-area" class="form-control" id="recip_note"
                                    value="กรรมการตรวจรับคนที่ 1"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="AddRecipEquiment()" class="btn btn-primary">บันทึกข้อมูล</button>
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

</body>

</html>
<script>
$(document).ready(async function() {

    $('.select-search-equ').select2();
    $('.select-search-equ-type').select2();

    await getTypeEquiment();

    $("#table-recip-equ").DataTable({
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

});

async function getTypeEquiment() {

    const url = location.origin + "/it-equipment-system/controller/EquipmentController.php?getEquType=1";
    let equTypeData;
    await axios.get(url).then(function(response) {
        equTypeData = response.data;
    }).catch((err) => console.log(err));

    const selectOptionEquType = document.getElementById("equ_type_id");
    equTypeData.forEach((val, i) => {
        selectOptionEquType.innerHTML += `
            <option value="${val.type_id}">${val.type_name}</option>
            `

    })
}

async function getEquimentByType() {
    let selectOptionEqu = document.getElementById("equ_id").innerHTML = "";
    let equ_type_id = selectOptionEquType = document.getElementById("equ_type_id").value;

    const url = location.origin + "/it-equipment-system/controller/EquipmentController.php?getEquByTypeId=" +
        equ_type_id;
    let equData;
    await axios.get(url).then(function(response) {
        equData = response.data;
    }).catch((err) => console.log(err));


    selectOptionEqu = document.getElementById("equ_id");

    selectOptionEqu.innerHTML = `
            <option selected disabled>เลือกครุภัณฑ์</option>
        `
    equData.forEach((val, i) => {
        selectOptionEqu.innerHTML += `
            <option value="${val.equ_id}">${val.equ_name}</option>
            `
        let equ_id = document.getElementById("equ_id").value = val.equ_id;
        document.getElementById("equ_name").value = val.equ_name;

    })
}

async function AddRecipEquiment() {

    let equ_id = document.getElementById("equ_id").value;
    let equ_code = document.getElementById("equ_code").value;
    let equ_date = document.getElementById("equ_date").value;
    let equ_qun = document.getElementById("equ_qun").value;
    let equ_pres_name = document.getElementById("equ_pres_name").value;
    let equ_pos = document.getElementById("equ_pos").value;
    let equ_pres_email = document.getElementById("equ_pres_email").value;
    let equ_pres_tel = document.getElementById("equ_pres_tel").value;
    let equ_name_director1 = document.getElementById("equ_name_director1").value;
    let equ_pos_director1 = document.getElementById("equ_pos_director1").value;
    let equ_name_director2 = document.getElementById("equ_name_director2").value;
    let equ_pos_director2 = document.getElementById("equ_pos_director2").value;
    let recip_status = document.getElementById("recip_status").value;
    let recip_note = document.getElementById("recip_note").value;

    let JsonData = {
        'addRecipEquipment': 'addRecipEquipment',
        'equ_code': equ_code,
        'equ_date': equ_date,
        'recip_note': recip_note,
        'equ_qun': equ_qun,
        'recip_status': recip_status,
        'equ_id': equ_id,
        'equ_pres_name': equ_pres_name,
        'equ_pos': equ_pos,
        'equ_pres_tel' : equ_pres_tel ,
        'equ_pres_email': equ_pres_email,
        'director': [{
            'equ_name_director' : equ_name_director1,
            'equ_pos_director'  :equ_pos_director1,
        }, {
            'equ_name_director' :  equ_name_director2,
            'equ_pos_director'  : equ_pos_director2,
        }],
    };

    if (!equ_id || !equ_code || !equ_date || !equ_qun || !equ_pres_name || !equ_pos || !equ_pres_email ||
        !equ_pres_tel || !equ_name_director1 || !equ_pos_director1 || !equ_name_director2 || !recip_status || !
        recip_note) {
        Swal.fire({
            position: 'top-center',
            icon: 'warning',
            title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
            showConfirmButton: true
        })
    } else {
        const url = location.origin + "/it-equipment-system/controller/EquipmentController.php";
        await axios({
            method: 'post',
            url: url,
            data: JsonData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        }).then((res) => {
            console.log("res :",res)
            if (res.data == 1) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'เพิ่มข้อมูลการตรวจรับครุภัณฑ์สำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $("#ModalRecipEqu").modal('hide');
                    // getEquipment()
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