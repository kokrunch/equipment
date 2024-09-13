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
            <h1>ขอเบิกวัสดุ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_emp.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">ขอเบิกวัสดุ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางรายการวัสดุทั้งหมด</h5>
                            <div class="d-flex justify-content-end">
                                <a type="button" id="link_disburse_cart" class="btn btn-primary rounded mb-3" href="disburse_cart.php">
                                    รายการที่ขอเบิก <span class="badge bg-danger badge-number" id="count_cart">0</span>
                                </a>
                            </div>
                            <div class="table-responsive">
                                <table id="table-material" class="text-left" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>เลขใบรับ</th>
                                            <th>ชื่อวัสดุ</th>
                                            <th>ยี่ห้อ</th>
                                            <th>ประเภท</th>
                                            <th class="text-center">จำนวนคงเหลือ</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-material">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- edit_modal -->
        <div class="modal fade" id="quantityModal" tabindex="-1" aria-labelledby="quantityModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quantityModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-10">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    จำนวนที่ต้องการเบิก</label>
                                <input type="number" class="form-control" id="mat_quantity" placeholder="กรอกจำนวนที่ต้องการเบิก">
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" style="margin-top: 35px;" id="unit"></label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="mat_id">
                        <input type="hidden" id="mat_bud_id">
                        <input type="hidden" id="max_quantity">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="addDisburse()" class="btn btn-primary">ขอเบิก</button>
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
            await getAllMat().then(() => writeTable("#table-material"))
            getCountCart();

        });

        async function getAllMat() {
            const url = "./controller/MaterialController.php?getMatBudget=1";
            let matData;
            await axios.get(url).then(function(response) {
                matData = response.data;
            }).catch((err) => console.log(err));

            $("#table-material").DataTable().destroy();

            const bodyMat = document.getElementById("body-material");
            bodyMat.innerHTML = "";
            matData.forEach((element, i) => {
                bodyMat.innerHTML += `
                <tr>
                    <td style="width:10%">${element.mat_bud_id}/${element.budget_year}</td>
                    <td>${element.mat_name}</td>
                    <td>${element.mat_brand}</td>
                    <td>${element.type_name}</td>
                    <td style="width:15%" class="text-center">${parseInt(element.mat_stock) - parseInt(element.dis_bud_log_quantity)}</td>
                    <td style="width:20%" class="text-center">
                        <button type="button" class="btn btn-outline-${element.mat_stock <= 0 ? "danger" : "primary"}"  data-bs-toggle="modal" data-bs-target="#quantityModal"
                        onclick="openQuantityModel(${element.mat_id},${element.mat_bud_id},'${element.unit_name}',${parseInt(element.mat_stock) - parseInt(element.dis_bud_log_quantity)},'${element.mat_name}',${element.mat_stock})" ${element.mat_stock <= 0 ? "disabled" : ""}>
                        เพิ่มเข้ารายการขอเบิก
                        </button>
                    </td>
                </tr>
                `
            });
        }


        async function getCountCart() {
            const url = "./controller/DisburseController.php?getCountCart=1";
            let countCart;
            await axios.get(url).then(function(response) {
                countCart = response.data;
            }).catch((err) => console.log(err));
            document.getElementById('count_cart').innerText = countCart
        }

        function openQuantityModel(mat_id, mat_bud_id, unit_name, max_quantity, mat_name, mat_stock) {
            document.getElementById("mat_id").value = mat_id;
            document.getElementById("mat_bud_id").value = mat_bud_id;
            document.getElementById("max_quantity").value = max_quantity;
            document.getElementById("unit").innerText = unit_name;
            document.getElementById("quantityModalLabel").innerHTML = `ขอเบิก <b>${mat_name}</b>`

        }


        async function addDisburse() {

            let mat_id = document.getElementById("mat_id").value;
            let mat_bud_id = document.getElementById("mat_bud_id").value;
            let mat_quantity = document.getElementById("mat_quantity").value;
            let max_quantity = document.getElementById("max_quantity").value;

            if (mat_quantity == "") {
                document.getElementById("mat_quantity").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกข้อมูลจำนวนที่เบิก',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            if (parseInt(mat_quantity) > parseInt(max_quantity)) {
                document.getElementById("mat_quantity").focus();
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

            if (parseInt(mat_quantity) < 1) {
                document.getElementById("mat_quantity").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกข้อมูลให้ถูกต้อง',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            if (parseInt(max_quantity) <= 0) {
                document.getElementById("mat_quantity").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกข้อมูลให้ถูกต้อง',
                    text: "ตรวจสอบความถูกต้อง",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            const jsonData = {
                mat_bud_id: mat_bud_id,
                mat_quantity: parseInt(mat_quantity),
                mat_id: mat_id,
                addToCart: true
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
                        title: 'เพิ่มรายการเบิกสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        $("#quantityModal").modal("hide")
                        await getAllMat().then(() => writeTable("#table-material"))
                        getCountCart();
                        document.getElementById("mat_quantity").value = ""
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
    </script>
</body>

</html>