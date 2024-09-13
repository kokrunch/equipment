<?php include("component/checkSession.php"); ?>
<?php include("component/roleMat.php  "); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>คลังครุภัณฑ์ it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>อัปเดทคลังครุภัณฑ์</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">จัดการครุภัณฑ์</li>
                    <li class="breadcrumb-item active">คลังครุภัณฑ์</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางข้อมูลคลังครุภัณฑ์</h5>
                            <div class="table-responsive">
                                <table id="table-stockEqu" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;" class="text-center">ลำดับ</th>
                                            <th style="width: 30%;">ชื่อครุภัณฑ์</th>
                                            <th style="width: 15%;" class="text-center">จำนวนคงเหลือ</th>
                                            <th style="width: 15%;"></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-stock-equ">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="modal fade" id="ModalUpStockEqu" tabindex="-1" aria-labelledby="ModalUpStockEquLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalUpStockEquLabel">อัปเดทจำนวนครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <input type="hidden" class="form-control" id="equ_id">
                            <h3 id="equ_name">equ_name</h3>
                            <div class="col-md-12" style="margin-top: 0;">
                                <label for="" class="form-label"><span class="text-danger">*</span> จำนวน</label>
                                <input type="number" class="form-control" id="equ_quantity" placeholder="กรอกจำนวนที่จะเพิ่ม">
                                <input type="hidden" class="form-control" id="equ_stock">
                            </div>
                        </div>


                    </div>
                    <div class=" modal-footer">
                        <input type="hidden" id="material_id" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="updateStockEqu()" class="btn btn-primary">อัปเดทคลัง</button>
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
            await getStockEqu();
            $("#table-stockEqu").DataTable({
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


        async function getStockEqu() {
            const url = location.origin + "/it-equipment-system/controller/EquipmentController?getEqu=1";
            let dataStockEqu;
            await axios.get(url).then(function(res) {
                dataStockEqu = res.data;
            }).catch((err) => console.log(err))

            const bodyStock = document.getElementById("body-stock-equ");
            bodyStock.innerHTML = "";
            dataStockEqu.forEach((element, i) => {
                bodyStock.innerHTML += `
                <tr>
                    <td class="text-center">${i + 1}</td>
                    <td>${element.equ_name}</td>
                    <td class="text-center">
                        ${element.equ_stock == 0 ? `<span class="badge bg-danger">ของหมด</span>` : element.equ_stock}
                    </td>
                    <td>
                    <button type="button" class="btn btn-outline-success" 
                        data-bs-toggle="modal" data-bs-target="#ModalUpStockEqu" data-stock='${JSON.stringify(element)}'
                        onclick="openModalStockEqu(this)"> เพิ่มสต๊อก
                    </button>
                    </td>
                </tr>
                `;
            });
        }

        function openModalStockEqu(btn) {
            const dataStockStr = btn.getAttribute("data-stock");
            const stockJson = JSON.parse(dataStockStr);
            document.getElementById("equ_name").innerText = stockJson.equ_name;
            document.getElementById("equ_stock").value = stockJson.equ_stock;
            document.getElementById("equ_id").value = stockJson.equ_id;
        }

        async function updateStockEqu() {
            const equ_id = document.getElementById("equ_id").value;
            const equ_quantity = document.getElementById("equ_quantity").value;
            const equ_stock = document.getElementById("equ_stock").value;
            console.log(equ_stock)
            if (equ_quantity == "") {
                document.getElementById("equ_quantity").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกข้อมูลจำนวนครุภัณฑ์',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: true,
                });
                return;
            }

            if (equ_quantity <= 0) {
                document.getElementById("equ_quantity").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกข้อมูลจำนวนครุภัณฑ์',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: true,
                });
                return;
            }




            const jsonData = {
                "equ_id": equ_id,
                "equ_stock": equ_stock,
                "equ_quantity": equ_quantity,
                "updateStockEqu": true
            }

            console.log(jsonData)

            const url = location.origin + "/it-equipment-system/controller/StockController"
            await axios({
                method: 'post',
                url: url,
                data: jsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then((res) => {
                console.log(res.data)
                if (res.data == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'อัปเดทคลังครุภัณฑ์สำเร็จ !!',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        await getStockEqu();
                        $('#ModalUpStockEqu').modal("hide");
                        document.getElementById("equ_quantity").value = "";
                    })

                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'เกิดข้อผิดพลาด !!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

            })
        }
    </script>
</body>

</html>