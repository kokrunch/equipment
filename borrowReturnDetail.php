<?php include("component/checkSession.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>รายการครุภัณฑ์ที่คืนแล้ว it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>รายการครุภัณฑ์ที่คืนแล้ว</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">รายการครุภัณฑ์ที่คืนแล้ว</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางรายการครุภัณฑ์ที่คืนแล้ว</h5>
                            <div class="table-responsive">
                                <table id="table-return-detail-list" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อผู้ยืม</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th>วันที่ส่งคืน</th>
                                            <th>จำนวนที่ยืมไป</th>
                                            <th>จำนวนที่ส่งคืน</th>
                                            <th>สถานะการคืน</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody class="text-left" id="body_return">
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
                        <h5 class="modal-title" id="quantityModalLabel">รายละเอียดเพิ่มเติมเกี่ยวกับการคืนครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label">
                                    ชื่อครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_name" disabled>
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
                                <label for="" class="form-label">
                                    วันที่ส่งคืน</label>
                                <input type="text" class="form-control" id="return_date" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    จำนวนที่ยืมไป</label>
                                <input type="text" class="form-control" id="borrow_quantity" disabled>
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    จำนวนที่ส่งคืน</label>
                                <input type="text" class="form-control" id="return_quantity" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label">
                                    สถานที่ที่ใช้งาน</label>
                                <input type="text" class="form-control" id="br_use_to" disabled>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label">
                                    รายละเอียดการส่งคืน</label>
                                <textarea class="form-control" id="return_detail" disabled></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
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

            await getAllReturnlist();

            $("#table-return-detail-list").DataTable({
                dom: 'Bfrtip',
                buttons: {
                    buttons: [{
                        extend: 'excel',
                        className: 'btn btn-success',
                        text: 'ExportExcel'
                    }]
                },
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


        async function getAllReturnlist() {
            const url = "./controller/BorrowEquController.php?getAllReturnlist=1";
            let ReturnlistData;
            await axios.get(url).then(function(response) {
                ReturnlistData = response.data;

            }).catch((err) => console.log(err));

            const Return_list = document.getElementById("body_return");
            Return_list.innerHTML = "";
            ReturnlistData.forEach((element, i) => {
                Return_list.innerHTML += `
                <tr>
                    <td align="left">${i+1}</td>
                    <td align="left" >${element.emp_firstname} ${element.emp_lastname}</td>
                    <td align="left">${element.equ_name}</td>
                    <td align="left">${FormatToThaiDate(element.borrow_return_date)}</td>
                    <td align="left">${element.borrow_quantity}</td>
                    <td align="left" style="width:15%">
                    ${element.return_quantity < element.borrow_quantity ? `${element.return_quantity} <span style="color:red;">(คืนไม่ครบ)</span>` :
                    `${element.return_quantity}`
                    }
                    </td>
                    <td class="text-center">
                    ${
                        element.br_returndate_fromat > element.returndate_fromat ? `<span class="badge bg-warning">คืนครุภัณฑ์ล่าช้า</span>` :
                        `<span class="badge bg-success">${element.borrow_status}</span>`
                    }</td>
                    <td>
                    ${
                        `<button title="รายละเอียดเพิ่มเติมเกี่ยวกับการคืนครุภัณฑ์" type="button" class="btn btn-outline-success" data-JsonReturnList='${JSON.stringify(element)}' onclick="OpenReturnModal(this)"><i class="bx bx-detail"></i></button>`
                    }
                    </td>
                </tr>
                `
            });
        }

        function OpenReturnModal(btn) {
            $("#ReturnModal").modal("show");
            const jsonStrData = btn.getAttribute("data-JsonReturnList")
            const jsonParseData = JSON.parse(jsonStrData)

            document.getElementById('equ_name').value = jsonParseData.equ_name;
            document.getElementById('borrow_return_date').value = FormatToThaiDate(jsonParseData.borrow_return_date);
            document.getElementById('return_date').value = FormatToThaiDate(jsonParseData.return_date);
            let borrow_quantity = document.getElementById('borrow_quantity').value = jsonParseData.borrow_quantity;
            let return_quantity = document.getElementById('return_quantity').value = jsonParseData.return_quantity;
            let return_quantity_alert = document.querySelector('#return_quantity')
            document.getElementById('return_detail').value = jsonParseData.return_detail;

            if (return_quantity < borrow_quantity) {
                document.getElementById('return_quantity').value = jsonParseData.return_quantity + ' ' + '(คืนไม่ครบ)';
                return_quantity_alert.style.color = "red";
                return;
            } else {
                document.getElementById('return_quantity').value = jsonParseData.return_quantity;
                return_quantity_alert.style.color = "black";
            }

            if (jsonParseData.br_use_to != null) {
                document.getElementById("br_use_to").value = jsonParseData.br_use_to
            } else {
                document.getElementById("br_use_to").value = "IT " + jsonParseData.room_name
            }

        }
    </script>
</body>

</html>