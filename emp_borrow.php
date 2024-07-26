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
            <h1>ขอยืมครุภัณฑ์</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_emp.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">ขอยืมครุภัณฑ์</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางรายการครุภัณฑ์ทั้งหมด</h5>
                            <div class="d-flex justify-content-end">
                            </div>
                            <div class="table-responsive">
                                <table id="table-equipment" class="text-left" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th class="text-center">หมายเลขครุภัณฑ์</th>
                                            <th class="text-center">จำนวนในสต็อก</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-Equipment">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="BorrowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quantityModalLabel">ยืมครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="" class="form-label">
                                    ครุภัณฑ์ที่ยืม</label>
                                <input type="text" class="form-control" id="equ_name" disabled value="">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันที่ต้องการยืม</label>
                                <input type="date" class="form-control" id="borrow_date">
                            </div>
                            <div class="col-md-3">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันที่ส่งคืน</label>
                                <input type="date" class="form-control" id="borrow_return_date">
                            </div>
                        </div>
                        <br>
                        <div class="row">

                            <div class="col-md-4">
                                <label for="" class="form-label">
                                    จำนวนที่มีอยู่ในคลัง</label>
                                <input type="text" class="form-control" id="stock" disabled>
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    จำนวนที่ต้องการยืม</label>
                                <input type="number" class="form-control" id="borrow_quantity" value="1">
                            </div>
                            <div class="col-md-4">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    เลือกห้องที่จะใช้งานครุภัณฑ์</label>
                                <select id="Room_select" class="form-select Room_select" onchange="borrow_use_to()">
                                    <option selected value="" disabled>เลือกห้อง</option>
                                    <option value="0">ใช้งานภายนอก</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row" id="outdoor_des">
                            <div class="col-md-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    สถานที่ที่จะนำครุภัณฑ์ไปใช้งาน</label>
                                <textarea class="form-control" id="outdoor" placeholder="กรอกสถานที่ที่นี่!"></textarea>
                            </div>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    เหตุผลในการยืมครุภัณฑ์</label>
                                <textarea class="form-control" id="borrow_description" placeholder="กรอกเหตุผลที่นี่!"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="equ_id">
                        <input type="hidden" id="max_quantity">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="addBorrow()" class="btn btn-primary">เพิ่มรายการยืมครุภัณฑ์</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="PicModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quantityModalLabel">รายละเอียดครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="box-img">
                                    <p>หน้าหรือหลัง</p>
                                    <img class="card-img-top" id="show_equ_image1" src="assets/img/no_image.png" alt="Equipment Image">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box-img">
                                    <p>ซ้าย</p>
                                    <img class="card-img-top" id="show_equ_image2" src="assets/img/no_image.png" alt="Equipment Image">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="box-img">
                                    <p>ขวา</p>
                                    <img class="card-img-top" id="show_equ_image3" src="assets/img/no_image.png" alt="Equipment Image">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <h5><b>ชื่อครุภัณฑ์ </b>: <span id="equ_name_modal"></span></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>ประเภท </b>: <span id="equ_type"></span></h5>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <h5><b>ยี่ห้อ </b>: <span id="equ_brand"></span></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>หมายเลขเฉพาะ </b>: <span id="equ_serial_no"></span></h5>
                            </div>
                        </div>

                        <div class="row mb2">
                            <div class="col-md-6">
                                <h5><b>รุ่น </b>: <span id="equ_model"></span></h5>
                            </div>
                            <div class="col-md-6">
                                <h5><b>สี </b>: <span id="equ_color"></span></h5>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <h5><b>รายละเอียด </b>: <span id="equ_detail"></span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="equ_id">
                        <input type="hidden" id="max_quantity">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>

        <?php include("component/footer.php"); ?>

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <?php include("component/script.php"); ?>

        <script>
            $(document).ready(async function() {
                await getAllEqu();
                await getAllRoom();

                $select = $(".Room_select").select2({
                    dropdownParent: $("#BorrowModal"),
                    width: "100%",
                });

                document.getElementById("outdoor_des").style.display = "none";


                $("#table-equipment").DataTable({
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


            let select = document.getElementById("Room_select").value


            async function getAllRoom(room_id, room_name) {

                const url = "./controller/BorrowEquController.php?getAllRoom=1";
                let RoomData;
                await axios.get(url).then(function(res) {
                    RoomData = res.data;

                }).catch((err) => console.log(err))

                Body_Roomdata = document.getElementById("Room_select");
                RoomData.forEach((element, index) => {
                    Body_Roomdata.innerHTML += `
            <option value = "${element.room_id}"> ${element.room_name} </option>
        `
                });

            }

            async function borrow_use_to() {

                let select = document.getElementById("Room_select").value;

                if (select == 0) {
                    document.getElementById("outdoor_des").style.display = "block";

                } else if (select != 0) {
                    document.getElementById("outdoor_des").style.display = "none";
                }
            }

            async function getAllEqu() {
                const url = "./controller/EquipmentController.php?getEqu=1";
                let EquData;
                await axios.get(url).then(function(response) {
                    EquData = response.data.Equ;

                }).catch((err) => console.log(err));

                const bodyEqu = document.getElementById("body-Equipment");
                bodyEqu.innerHTML = "";
                EquData.forEach((element, i) => {
                    bodyEqu.innerHTML += `
                <tr>
                    <td>${i+1}</td>
                    <td>
                    <a title="รายละเอียดครุภัณฑ์" style="color:blue; cursor: pointer; text-decoration: underline;" data-jsonPic='${JSON.stringify(element)}' onclick="OpenPicModal(this)">${element.equ_name}</a>
                    </td>
                    <td class="text-center">${element.equ_serail_no == null ? 
                        ` - ` :
                        element.equ_serail_no }</td>
                    <td style="width:15%" class="text-center">${element.equ_stock}</td>
                    <td style="width:20%" class="text-center">
                    <button type="button" class="btn btn-outline-${element.equ_stock <= 0 ? "danger" : "primary"}" 
                    data-jsonBorrow='${JSON.stringify(element)}' 
                        onclick="OpenBorrowModal(this)" ${element.equ_stock <= 0 ? "disabled" : ""}>
                        ขอยืมครุภัณฑ์
                        </button>
                    </td>
                </tr>
                `
                });
            }

            function OpenBorrowModal(btn) {
                $("#BorrowModal").modal("show");
                const jsonStrData = btn.getAttribute("data-jsonBorrow")
                const jsonParseData = JSON.parse(jsonStrData)

                document.getElementById("equ_id").value = jsonParseData.equ_id;
                document.getElementById("equ_name").value = jsonParseData.equ_name;
                document.getElementById("max_quantity").value = jsonParseData.equ_stock;
                document.getElementById("stock").value = jsonParseData.equ_stock;

            }

            function OpenPicModal(btn) {
                $("#PicModal").modal("show");
                const jsonStrData = btn.getAttribute("data-jsonPic")
                const jsonParseData = JSON.parse(jsonStrData)

                document.getElementById("equ_name_modal").innerHTML = jsonParseData.equ_name;
                document.getElementById("equ_type").innerHTML = jsonParseData.type_name;
                document.getElementById("equ_brand").innerHTML = jsonParseData.equ_brand;
                document.getElementById("equ_model").innerHTML = jsonParseData.equ_model;
                document.getElementById("equ_color").innerHTML = jsonParseData.equ_color;
                document.getElementById("equ_serial_no").innerHTML = jsonParseData.equ_serail_no;
                document.getElementById("equ_detail").innerHTML = jsonParseData.equ_detail;

                document.getElementById("show_equ_image1").src = "assets/equipment_img/" + jsonParseData.e_img1;
                document.getElementById("show_equ_image2").src = "assets/equipment_img/" + jsonParseData.e_img2;
                document.getElementById("show_equ_image3").src = "assets/equipment_img/" + jsonParseData.e_img3;

            }
            async function addBorrow() {
                let equ_id = document.getElementById('equ_id').value;
                let borrow_date = document.getElementById('borrow_date').value;
                let borrow_return_date = document.getElementById('borrow_return_date').value;
                let borrow_quantity = document.getElementById('borrow_quantity').value;
                let borrow_description = document.getElementById('borrow_description').value;
                let max_quantity = document.getElementById('max_quantity').value;
                let room_select = document.getElementById('Room_select').value;
                let outdoor_des = document.getElementById("outdoor").value;



                if (borrow_date == '') {
                    Swal.fire('กรุณาเลือกวันที่ต้องการยืม', '', 'info')
                    return;
                } else if (borrow_return_date == '') {
                    Swal.fire('กรุณาเลือกวันที่ส่งคืน', '', 'info')
                    return;
                } else if (borrow_quantity == '') {
                    Swal.fire('กรุณาเลือกจำนวนที่ต้องการยืม', '', 'info')
                    return;
                } else if (borrow_return_date < borrow_date) {
                    Swal.fire('กรุณาเลือกวันใหม่', '', 'info')
                    return;
                }

                if (parseInt(borrow_quantity) > parseInt(max_quantity)) {
                    document.getElementById("borrow_quantity").focus();
                    Swal.fire({
                        position: 'top-center',
                        icon: 'info',
                        title: 'จำนวนในคลังมีไม่พอ',
                        text: "ตรวจสอบความถูกต้อง",
                        showConfirmButton: false,
                        timer: 1500
                    });
                    return;
                }

                if (room_select == '') {
                    Swal.fire('กรุณาเลือกห้องที่จะใช้งานครุภัณฑ์', '', 'info')
                    return;
                } else if (borrow_description == '') {
                    Swal.fire('กรุณากรอกเหตุผลในการยืมครุภัณฑ์', '', 'info')
                    return;
                }


                const jsondata = {
                    addBorrow: "addBorrow",
                    borrow_quantity: borrow_quantity,
                    borrow_description: borrow_description,
                    borrow_date: borrow_date,
                    borrow_return_date: borrow_return_date,
                    room_select: room_select,
                    outdoor_des: outdoor_des,
                    equ_id: equ_id,
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
                            title: 'เพิ่มรายการยืมสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            location.href = "./emp_borrow_list.php"
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'เพิ่มรายการยืมไม่สำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            getAllEqu()
                        });
                    }
                })

            }
        </script>
</body>

</html>