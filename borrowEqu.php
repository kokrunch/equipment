<?php include("component/checkSession.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>รายการยืมที่รออนุมัติ it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>รายการยืมที่รออนุมัติ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">รายการยืมที่รออนุมัติ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางรายการยืมที่รออนุมัติ</h5>
                            <div class="table-responsive">
                                <table id="table-borrow_list" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>รหัสครุภัณฑ์</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th>จำนวน</th>
                                            <th>ชื่อผู้ยืม</th>
                                            <th>วันที่ยื่นยืม</th>
                                            <th>สถานะการยืม</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-borrow-equ">

                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- modal view detail -->
        <div class="modal fade" id="ModalBorrowEquDetail" tabindex="-1" aria-labelledby="ModalBorrowEquDetailLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">รายละเอียดการยืมครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <input type="hidden" class="form-control" id="mat_id">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    รหัสครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_id" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    ชื่อครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_name" disabled>
                            </div>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    จำนวน</label>
                                <input type="text" class="form-control" id="borrow_quantity" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    ชื่อผู้ยืม</label>
                                <input type="text" class="form-control" id="emp_name" disabled>
                            </div>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    วันที่ยืม</label>
                                <input type="text" class="form-control" id="date_borrow" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label">
                                    วันส่งคืน</label>
                                <input type="text" class="form-control" id="date_return_borrow" disabled>
                            </div>
                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-12">
                                <label for="" class="form-label">
                                    สถานที่ที่ใช้งาน</label>
                                <input type="text" class="form-control" id="br_use_to" disabled>
                            </div>
                        </div>
                        <div class="row g-3 mb-2">

                            <div class="col-12">
                                <label for="" class="form-label">
                                    รายละเอียดการยืม</label>
                                <textarea class="form-control" id="desc_borrow" disabled></textarea>
                            </div>

                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>

                </div>
            </div>
        </div>

        <!-- modal disable note -->
        <div class="modal fade" id="ModalDisableNote" tabindex="-1" aria-labelledby="ModalDisableNoteLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body">

                        <div class="row g-3 mb-2">
                            <input type="hidden" class="form-control" id="borrow_id">
                            <input type="hidden" id="equ_id_">
                            <input type="hidden" id="borrow_quantity_">
                            <input type="hidden" id="room_desc_equ_id">
                            <div class="col-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    เหตุผลที่ไม่อนุมัติ</label>
                                <textarea class="form-control" id="desc_a_borrow"></textarea>
                            </div>
                        </div>

                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" class="btn btn-primary" onClick="disableNote();">ยืนยัน</button>
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

            await getBorrowEqu(0).then(() => writeTable("#table-borrow_list"));

        }); //end ready function

        async function getBorrowEqu(reload) {
            BodyBorrowEqu = document.getElementById("body-borrow-equ").innerHTML = "";
            const url = "./controller/BorrowEquController.php?getBorrowEqu=1";
            let BorrowEquData;
            await axios.get(url).then(function(res) {
                BorrowEquData = res.data;
            }).catch((err) => console.log(err))

            if (reload == 1) {
                $("#table-borrow_list").DataTable().destroy();
            }


            BodyBorrowEqu = document.getElementById("body-borrow-equ");

            BodyBorrowEqu.innerHTML = "";

            BorrowEquData.forEach((element, index) => {

                BodyBorrowEqu.innerHTML += `
            <tr>
                                        <td>${index + 1}</td>
                                        <td>${element.equ_code == null ? '-' : element.equ_code}</td>
                                        <td>${element.equ_name}</td>
                                        <td>${element.borrow_quantity}</td>
                                        <td>${element.emp_firstname} ${element.emp_lastname}</td>
                                        <td>${FormatToThaiDate(element.create_date)}</td>
                                        <td style="width:10%">
                                        ${element.borrow_approve_status == 'รออนุมัติ' ? 
                                            `<span class="badge bg-info">${element.borrow_approve_status}</span>`
                                            : 
                                            element.borrow_approve_status == 'อนุมัติแล้ว' ?
                                            `<span class="badge bg-success">${element.borrow_approve_status}</span>` 
                                        :
                                      `<span class="badge bg-danger">${element.borrow_approve_status}</span>`}
                                            
                                        </td>
                                      
                                        <td class="text-center" style="width:22%">
                                          <button title="รายละเอียดการยืมครุภัณฑ์" type="button" class="btn btn-outline-warning"
                                                data-jsonBorrow='${JSON.stringify(element)}'
                                                onClick="viewBorrowEquDetail(this);"><i class="bx bx-detail"></i></button>
                                            <button type="button" class="btn btn-outline-success mb-1" data-JsonApprove='${JSON.stringify(element)}' onClick="ApproveBorrow(this)">อนุมัติ</button>
                                            <button type="button" class="btn btn-outline-danger mb-1"
                                                data-jsonDisableNote='${JSON.stringify(element)}'
                                                onClick="viewDisableNote(this);">ไม่อนุมัติ</button>
                                        </td>
            </tr>
            `
            });
        }

        async function viewBorrowEquDetail(data) {

            $("#ModalBorrowEquDetail").modal("show");
            const jsonStrData = data.getAttribute("data-jsonBorrow")
            const jsonParseData = JSON.parse(jsonStrData)

            document.getElementById("equ_id").value = jsonParseData.equipment_id;
            document.getElementById("equ_name").value = jsonParseData.equ_name;
            document.getElementById("borrow_quantity").value = jsonParseData.borrow_quantity;
            document.getElementById("emp_name").value = jsonParseData.emp_firstname + " " + jsonParseData.emp_lastname;
            document.getElementById("date_borrow").value = FormatToThaiDate(jsonParseData.borrow_date);
            document.getElementById("date_return_borrow").value = FormatToThaiDate(jsonParseData.borrow_return_date);
            document.getElementById("desc_borrow").value = jsonParseData.borrow_description;
            document.getElementById("room_desc_equ_id").value = jsonParseData.room_desc_equ_id;

            if (jsonParseData.br_use_to != null) {
                document.getElementById("br_use_to").value = jsonParseData.br_use_to
            } else {
                document.getElementById("br_use_to").value = "IT " + jsonParseData.room_name
            }


        }

        async function ApproveBorrow(btn) {
            const jsonStrData = btn.getAttribute("data-JsonApprove")
            const jsonParseData = JSON.parse(jsonStrData)

            let borrow_id = jsonParseData.borrow_id
            let room_desc_equ_id = jsonParseData.room_desc_equ_id;

            const jsondata = {
                A_borrow: 'A_borrow',
                borrow_id: borrow_id,
                room_desc_equ_id: room_desc_equ_id,
            }

            Swal.fire({
                title: 'ต้องการอนุมัติการยืมใช่หรือไม่ ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const url = "./controller/BorrowEquController.php";
                    await axios({
                        method: 'post',
                        url: url,
                        data: jsondata,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                    }).then((res) => {
                        if (res.data == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'อนุมัติการยืมสำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(async () => {
                                await getBorrowEqu(1).then(() => writeTable("#table-borrow_list"));
                            })
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'เกิดข้อผิดพลาด',
                                text: "โปรดลองใหม่อีกครั้ง",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    })
                }
            })
        }


        async function viewDisableNote(data) {

            $("#ModalDisableNote").modal("show");
            const jsonStrData = data.getAttribute("data-jsonDisableNote")
            const jsonParseData = JSON.parse(jsonStrData)

            document.getElementById("borrow_id").value = jsonParseData.borrow_id;
            document.getElementById("equ_id_").value = jsonParseData.equ_id;
            document.getElementById("borrow_quantity_").value = jsonParseData.borrow_quantity;
        }

        async function disableNote() {
            let borrow_id = document.getElementById("borrow_id").value;
            let desc_a_borrow = document.getElementById("desc_a_borrow").value;

            let equ_id = document.getElementById("equ_id_").value;
            let borrow_quantity = document.getElementById("borrow_quantity_").value;

            if (desc_a_borrow == "") {
                document.getElementById("desc_a_borrow").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกเหตุผลที่ไม่อนุมัติ',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            const jsonData = {
                borrow_id: borrow_id,
                desc_a_borrow: desc_a_borrow,
                borrow_id: borrow_id,
                equ_id: equ_id,
                borrow_quantity: borrow_quantity,
                Approve_b: true
            }

            const url = "./controller/BorrowEquController.php";
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
                        title: 'ไม่อนุมัติการยืมสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        $("#ModalDisableNote").modal('hide');
                        await getBorrowEqu(1).then(() => writeTable("#table-borrow_list"));
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
    </script>
</body>

</html>