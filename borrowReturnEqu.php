<?php include("component/checkSession.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>รายการยืมครุภัณฑ์ it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>รายการยืมครุภัณฑ์</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">รายการยืมครุภัณฑ์</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางรายการยืมครุภัณฑ์</h5>
                            <div class="table-responsive">
                                <table id="table-borrow_list" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th>ชื่อผู้ยืม</th>
                                            <th>วันที่ทำการยืม</th>
                                            <th>วันที่กำหนดส่งคืน</th>
                                            <th>สถานะการคืน</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body_return">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="ReturnModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quantityModalLabel">คืนครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-5">
                                <label for="" class="form-label">
                                    ครุภัณฑ์ที่ทำการยืม</label>
                                <input type="text" class="form-control" id="equ_name" disabled>
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label">
                                    สถานที่ที่ใช้งาน</label>
                                <input type="text" class="form-control" id="borrow_use_to" disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="form-label">
                                    จำนวนที่ยืมไป</label>
                                <input type="text" class="form-control" id="borrow_quantity" disabled>
                            </div>
                            <div class="col-md-2">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    จำนวนที่ส่งคืน</label>
                                <input type="number" class="form-control" id="return_quantity">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    วันที่กำหนดส่งคืน</label>
                                <input type="text" class="form-control" id="borrow_return_date" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันที่ส่งคืน</label>
                                <input type="date" class="form-control" id="return_date">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    รายละเอียดการส่งคืน</label>
                                <textarea class="form-control" id="return_detail" placeholder="กรอกรายละเอียดที่นี่!"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="equ_id">
                        <input type="hidden" id="borrow_id">
                        <input type="hidden" id="emp_id">
                        <input type="hidden" id="room_desc_equ_id">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="addReturnEqu()" class="btn btn-primary">บักทึกการส่งคืน</button>
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

            await getAllBorrowlist(0).then(() => writeTable("#table-borrow_list"));

        }); //end ready function

        async function getAllBorrowlist(reload) {
            const url = "./controller/BorrowEquController.php?getAllBorrowed=1";
            let BorowlistData;
            await axios.get(url).then(function(response) {
                BorowlistData = response.data;

            }).catch((err) => console.log(err));

            const Borrow_list = document.getElementById("body_return");

            if (reload == 1) {
                $("#table-borrow_list").DataTable().destroy();
            }
            Borrow_list.innerHTML = "";

            const filterNotReturn = BorowlistData.filter((e) => {
                return e.borrow_status_null != 'คืนครุภัณฑ์แล้ว'
            })
            filterNotReturn.forEach((element, i) => {
                Borrow_list.innerHTML += `
                <tr>
                    <td>${i+1}</td>
                    <td>${element.equ_name}</td>
                    <td style="width:15%">${element.emp_firstname} ${element.emp_lastname}</td>
                    <td style="width:15%">${FormatToThaiDate(element.borrow_date)}</td>
                    <td style="width:15%">${FormatToThaiDate(element.borrow_return_date)}</td>
                    <td>
                    ${
                        element.borrow_status == 'กำลังยืม' ? `<span class="badge bg-info">${element.borrow_status}</span>` :
                        element.borrow_status == 'คืนครุภัณฑ์แล้ว' ? `<span class="badge bg-success">${element.borrow_status}</span>` :
                        element.borrow_approve_status == 'ไม่ผ่านอนุมัติ' ? `<span class="badge bg-danger">${element.borrow_approve_status}</span>`:
                        ``
                    }</td>
                    <td>
                    ${
                      element.borrow_status == 'กำลังยืม' ? 
                        `<button type="button" class="btn btn-outline-primary" data-JsonReturn='${JSON.stringify(element)}' onclick="OpenReturnModal(this)">
                            ทำเรื่องคืนครุภัณฑ์
                        </button>` : 
                        element.borrow_status == 'ไม่ผ่านอนุมัติ' ? "":
                      ` `
                    }
                    </td>
                </tr>
                `
            });
        }

        function OpenReturnModal(btn) {
            $("#ReturnModal").modal("show");
            const jsonStrData = btn.getAttribute("data-JsonReturn")
            const jsonParseData = JSON.parse(jsonStrData)

            document.getElementById("borrow_quantity").value = jsonParseData.borrow_quantity;
            document.getElementById("emp_id").value = jsonParseData.emp_id;
            document.getElementById("borrow_id").value = jsonParseData.borrow_id;
            document.getElementById("equ_id").value = jsonParseData.equ_id;
            document.getElementById("equ_name").value = jsonParseData.equ_name + ' ' + jsonParseData.equ_brand;
            document.getElementById("borrow_return_date").value = FormatToThaiDate(jsonParseData.borrow_return_date);
            document.getElementById("room_desc_equ_id").value = jsonParseData.room_desc_equ_id;
            if (jsonParseData.br_use_to != null) {
                document.getElementById("borrow_use_to").value = jsonParseData.br_use_to;
            } else {
                document.getElementById("borrow_use_to").value = "IT " + jsonParseData.room_name;
            }

        }

        async function addReturnEqu() {

            let return_date = document.getElementById('return_date').value;
            let borrow_id = document.getElementById('borrow_id').value;
            let return_quantity = document.getElementById('return_quantity').value;
            let return_detail = document.getElementById('return_detail').value;
            let equ_id = document.getElementById('equ_id').value;
            let borrow_quantity = document.getElementById('borrow_quantity').value;
            let emp_id = document.getElementById('emp_id').value;
            let room_desc_equ_id = document.getElementById("room_desc_equ_id").value;

            if (return_quantity == '') {
                Swal.fire('กรุณากรอกจำนวนที่ส่งคืน', '', 'info')
                return;
            }
            if (parseInt(return_quantity) > parseInt(borrow_quantity)) {
                document.getElementById("return_quantity").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'จำนวนที่ส่งคืนมากกว่าจำนวนที่ยืม',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            } else if (parseInt(return_quantity) <= 0) {
                document.getElementById("return_quantity").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'จำนวนที่ส่งคืนไม่ถูกต้อง',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            if (return_date == '') {
                Swal.fire('กรุณาเลือกวันที่ส่งคืน', '', 'info')
                return;
            }

            if (return_detail == '') {
                Swal.fire('กรุณากรอกรายละเอียดการคืนครุภัณฑ์', '', 'info')
                return;
            }

            const jsondata = {
                addReturnEqu: 'addReturnEqu',
                return_date: return_date,
                emp_id: emp_id,
                borrow_id: borrow_id,
                return_detail: return_detail,
                return_quantity: return_quantity,
                room_desc_equ_id: room_desc_equ_id,
                equ_id: equ_id
            }

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
                        position: 'top-center',
                        icon: 'success',
                        title: 'ส่งคืนครุภัณฑ์สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        await getAllBorrowlist(1).then(() => writeTable("#table-borrow_list"));
                        $("#ReturnModal").modal('hide');

                    })
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'ส่งคืนครุภัณฑ์สำเร็จไม่สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            })


        }
    </script>
</body>

</html>