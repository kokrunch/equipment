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
            <h1>รายการวัสดุที่ขอเบิก</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="disburse">หน้าหลัก</a></li>
                    <li class="breadcrumb-item"><a href="disburse">ขอเบิกวัสดุ</a></li>
                    <li class="breadcrumb-item active">รายการวัสดุที่ขอเบิก</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางรายการวัสดุที่ขอเบิก</h5>
                            <div class="table-responsive">
                                <table id="table-cart" class="text-left" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อวัสดุ</th>
                                            <th>ยี่ห้อ</th>
                                            <th class="text-center">จำนวนที่เบิก</th>
                                            <th class="text-center">* หมายเหตุ</th>
                                            <th class="text-center"></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-cart">
                                    </tbody>

                                </table>
                            </div>
                            <div id="show-confirm-disburse" style="display: none;">
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="inputNanme4" class="form-label"><span class="text-danger">*</span> วันที่ขอเบิก</label>
                                        <input type="date" class="form-control" id="disburse_date" disabled>
                                    </div>
                                    <div class="col-5">
                                        <label for="inputNanme4" class="form-label">เหตุผลที่ขอเบิก</label>
                                        <textarea class="form-control" style="height: 100px" id="disburse_note"></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="btn-add-disburse">
                                            <button type="button" class="btn btn-primary" id="btn-confirm-disburse">ยืนยันขอเบิก</button>
                                        </div>
                                    </div>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <?php include("component/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

</body>
<script>
    $(document).ready(async function() {
        await getDisburseCart(1).then(() => writeTable());
        getDate();
    }); //end ready function

    function getDate() {
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("disburse_date").value = today;
    }

    function writeTable() {
        const table = $("#table-cart").DataTable();
        table.destroy();

        $("#table-cart").DataTable({
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
    }

    document.getElementById("btn-confirm-disburse").addEventListener("click", () => AddDisburse())

    async function getDisburseCart(reload) {
        const url = "./controller/DisburseController.php?getDisburseCart=1";
        let cartData;
        await axios.get(url).then(function(response) {
            cartData = response.data;
        }).catch((err) => console.log(err));

        if (reload == 0) {
            if (cartData.length == 0) {
                const table = $("#table-cart").DataTable();
                table.destroy();
            }
        }

        if (cartData.length != 0) {
            document.getElementById("show-confirm-disburse").style.display = "block"
        } else {
            document.getElementById("show-confirm-disburse").style.display = "none"
        }

        const bodyCart = document.getElementById("body-cart");
        bodyCart.innerHTML = "";

        cartData.forEach((element, i) => {
            const check_stock = parseInt(element.mat_stock) - parseInt(element.dis_bud_log_quantity)
            bodyCart.innerHTML += `
                <tr>
                    <td style="width:5%">${i + 1}</td>
                    <td>${element.mat_name}</td>
                    <td>${element.mat_brand}</td>
                    <td style="width:18%" class="text-center">
                        <div class="input-group">
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" ${element.quantity == 1 ? 'disabled' : ''} 
                                    id="btn-lower-quan${element.mat_cart_id}" type="button" onclick="updateQuantityLower(${element.mat_cart_id},${element.mat_bud_id})">
                                    <i class="bi bi-dash-lg"></i>
                                </button>
                            </div>
                            <input type="number" class="form-control text-center" id="quantity${element.mat_cart_id}" aria-describedby="basic-addon2" value="${element.quantity}" disabled>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" ${check_stock == 0 ? 'disabled' : ''} 
                                    id="btn-more-quan${element.mat_cart_id}" type="button" onclick="updateQuantityMore(${element.mat_cart_id},${element.mat_bud_id})">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                    <td style="width:20%"><input type="text" class="form-control text-center" id="detail${element.mat_cart_id}"></td>
                    <td style="width:10%" class="text-center">
                        <button type="button" class="btn btn-danger" onclick="deleteFromCart(${element.mat_cart_id},${element.mat_bud_id})">
                        <i class="bx bxs-trash"></i>
                        </button>
                    </td>
                </tr>
                `
        });

        if (reload == 0) {
            if (cartData.length == 0) {
                writeTable();
            }
        }
    }

    async function updateQuantityMore(mat_cart_id, mat_bud_id) {
        document.getElementById("btn-more-quan" + mat_cart_id).disabled = true;

        const url = "./controller/DisburseController.php";
        const jsonData = {
            mat_cart_id: mat_cart_id,
            mat_bud_id: mat_bud_id,
            updateQuantityMore: true
        }
        await axios({
            method: 'post',
            url: url,
            data: jsonData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        }).then((res) => {
            if (res.data == 1) {
                document.getElementById("btn-more-quan" + mat_cart_id).disabled = false;
                getDisburseCart(0)
            } else if (res.data == 0) {
                document.getElementById("btn-more-quan" + mat_cart_id).disabled = true;
            }
        })
    }

    async function updateQuantityLower(mat_cart_id, mat_bud_id) {
        document.getElementById("btn-lower-quan" + mat_cart_id).disabled = true;
        const valueQuantity = document.getElementById("quantity" + mat_cart_id);

        const url = "./controller/DisburseController.php";
        const jsonData = {
            mat_cart_id: mat_cart_id,
            mat_bud_id: mat_bud_id,
            updateQuantityLower: true
        }
        await axios({
            method: 'post',
            url: url,
            data: jsonData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        }).then((res) => {
            if (res.data == 1) {
                document.getElementById("btn-lower-quan" + mat_cart_id).disabled = false;
                getDisburseCart(0)
            }
        })
    }

    async function deleteFromCart(mat_cart_id, mat_bud_id) {
        const quantity = document.getElementById("quantity" + mat_cart_id).value;
        const url = "./controller/DisburseController.php";
        const jsonData = {
            mat_cart_id: mat_cart_id,
            quantity: quantity,
            mat_bud_id: mat_bud_id,
            deleteCart: true
        }
        Swal.fire({
            title: 'ต้องการลบรายการเบิกนี้หรือไม่ ?',
            text: 'หากลบระบบจะคืนค่าจำนวนวัสดุไปยังคลัง',
            showCancelButton: true,
            confirmButtonText: 'ลบข้อมูล',
            confirmButtonColor: '#E91010',
            cancelButtonText: 'ยกเลิก',
            cancelButtonColor: '#B9B9B9'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await axios({
                    method: 'post',
                    url: url,
                    data: jsonData,
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                }).then(async (res) => {
                    if (res.data == 1) {
                        await getDisburseCart(0)
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
        })
    }


    async function AddDisburse() {
        const dis_date = document.getElementById("disburse_date").value;
        const dis_note = document.getElementById("disburse_note").value;


        const table = document.getElementById("table-cart")
        const tbody = table.children[1];
        const tRow = tbody.children;
        var arr_detail_mat = [];
        for (let i = 0; i < tRow.length; i++) {
            const input_vallue = tRow[i].children[4].children[0].value
            arr_detail_mat.push(input_vallue)
        }

        const jsonData = {
            "disburse_date": dis_date,
            "disburse_note": dis_note,
            "adddisburse": true,
            "data_detail": arr_detail_mat
        }

        Swal.fire({
            title: 'ยืนยันการขอเบิก ?',
            text: 'กดยืนยันเพื่อเบิกวัสดุ',
            showCancelButton: true,
            confirmButtonText: 'ยืนยัน',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            cancelButtonText: 'ยกเลิก',
        }).then(async (result) => {
            if (result.isConfirmed) {
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
                            title: 'ยืนยันการเบิกสำเร็จ',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(async () => {
                            location.href = "./emp_disburse_list.php"
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
        })
    }
</script>

</html>