<?php include("component/checkSession.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>รายการจำนวนวัสดุในคลัง it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>รายการจำนวนวัสดุในคลัง</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">รายการจำนวนวัสดุในคลัง</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางรายการจำนวนวัสดุในคลัง</h5>
                            <div class="table-responsive">
                                <table id="table-disburse_list" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อวัสดุ</th>
                                            <th>จำนวน</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-stock-mat">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- edit_modal -->
        <div class="modal fade" id="editStockMaterialModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มจำนวนวัสดุ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <input type="hidden" class="form-control" id="mat_id">

                            <h3 id="mat_name">mat_name</h3>
                            <div class="col-md-12" style="margin-top: 0;">
                                <label for="" class="form-label"><span class="text-danger">*</span> จำนวน</label>
                                <input type="number" class="form-control" id="mat_quantity"
                                    placeholder="กรอกจำนวนที่จะเพิ่ม">
                                <input type="hidden" class="form-control" id="mat_stock">
                            </div>
                        </div>


                    </div>
                    <div class=" modal-footer">
                        <input type="hidden" id="material_id" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="updateStockMat()" class="btn btn-primary">เพิ่มสต๊อก</button>
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

        await getStockMat();

        $("#table-disburse_list").DataTable({
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



    async function getStockMat() {
        BodyStock = document.getElementById("body-stock-mat").innerHTML = "";
        const url = location.origin + "/it-equipment-system/controller/StockController.php?getStockMat=1";
        let StockData;
        await axios.get(url).then(function(res) {
            StockData = res.data;
            console.log(StockData);
        }).catch((err) => console.log(err))

        BodyStock = document.getElementById("body-stock-mat");
        StockData.forEach((element, index) => {
            BodyStock.innerHTML += `
            <tr>
                <td align="left">${index+1}</td>
                <td align="left">${element.mat_name}</td>
                <td align="left">${element.mat_stock == 0 ? `<span class="badge bg-danger">ของหมด</span>` : element.mat_stock }</td>
                <td>
                <button type="button" class="btn btn-outline-success"
                 data-bs-toggle="modal" 
                 data-bs-target="#editStockMaterialModal" 
                 data-stock='${JSON.stringify(element)}'
                 onclick="openModalStockMat(this)">เพิ่มสต๊อก</button>
            </tr>
            `
        });
    }

    async function openModalStockMat(btn) {
        const dataStockStr = btn.getAttribute("data-stock");
        const stockJson = JSON.parse(dataStockStr);
        document.getElementById("mat_id").value = stockJson.mat_id;
        document.getElementById("mat_name").innerText = stockJson.mat_name;
        document.getElementById("mat_stock").value = stockJson.mat_stock;

    }

    async function updateStockMat() {
        let mat_id = document.getElementById("mat_id").value;
        let mat_quantity = document.getElementById("mat_quantity").value;
        let mat_stock = document.getElementById("mat_stock").value;
        //console.log(mat_id, mat_stock_add);

        if (mat_quantity == "" || mat_quantity <= 0) {
            document.getElementById("mat_quantity").focus();
            Swal.fire({
                icon: 'info',
                title: 'โปรดกรอกจำนวนที่ต้องการเพิ่ม !!',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            })
            return;
        }


        const jsonData = {
            "mat_id": mat_id,
            "mat_stock": mat_stock,
            "mat_quantity": mat_quantity,
            "updateStockMat": true
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
                    title: 'อัปเดทคลังวัสดุสำเร็จ !!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(async () => {
                    await getStockMat();
                    $('#editStockMaterialModal').modal("hide");
                    document.getElementById("mat_quantity").value = "";
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