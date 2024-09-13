<?php include("component/checkSession.php"); ?>
<?php include("component/roleMat.php"); ?>
<?php

$mat_id = $_GET['mat_id'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>สมุดคุมบัญชีวัสดุ</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>สมุดคุมบัญชีวัสดุ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">จัดการวัสดุ</li>
                    <li class="breadcrumb-item"><a href="manage_material">วัสดุ</a></li>
                    <li class="breadcrumb-item active">สมุดคุมบัญชีวัสดุ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mt-4">
                                <h3 id="mat_name" style="color: #012970;"><b>สมุดคุมบัญชี</b></h3>
                            </div>
                            <!-- <diiv class="row mb-4">
                                <div class="col-md-4">
                                    <span>ค้นหาตามปีงบประมาณ</span>
                                    <select id="BudgetYear_select" name="BudgetYear_select" class="form-select BudgetYear_select" onchange="getAccMatByBudgetId()">
                                        <option selected value="0">ปีงบประมาณทั้งหมด</option>
                                    </select>
                                </div>
                            </diiv> -->
                            <div class="table-responsive">
                                <table id="table-acc" class="table table-bordered cell-border stripe text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">วัน/เดือน/ปี</th>
                                            <th rowspan="2">เลขที่ ใบรับ/ใบเบิก</th>
                                            <th colspan="3" class="text-center">รับ</th>
                                            <th colspan="3" class="text-center">จ่าย</th>
                                            <th colspan="3" class="text-center">คงเหลือ</th>
                                        </tr>
                                        <tr>
                                            <th>จำนวน</th>
                                            <th>ราคาต้นทุน</th>
                                            <th>ราค่าต้นทุนทั้งสิ้น</th>
                                            <th>จำนวน</th>
                                            <th>ราคาต้นทุน</th>
                                            <th>ราค่าต้นทุนทั้งสิ้น</th>
                                            <th>จำนวน</th>
                                            <th>ราคาต้นทุน</th>
                                            <th>ราค่าต้นทุนทั้งสิ้น</th>
                                        </tr>
                                    </thead>
                                    <tbody id="body_ac_mat">
                                        <tr>
                                            <td colspan="11">ไม่มีข้อมูล</td>
                                        </tr>
                                    </tbody>
                                </table>
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

    <script>
        $(document).ready(async function() {
            getMaterial().then(() => writeDataTable())

        }); //end ready function

        function writeDataTable() {
            $("#table-acc").DataTable({
                "oLanguage": {
                    "sLengthMenu": "แสดง _MENU_ ต่อหน้า",
                    "sZeroRecords": "ไม่มีข้อมูล",
                    "sInfo": "แสดง _START_ ถึง _END_ ของ _TOTAL_ เร็คคอร์ด",
                    "sInfoEmpty": "แสดง 0 ถึง 0 ของ 0 เร็คคอร์ด",
                    "sInfoFiltered": "(จากเร็คคอร์ดทั้งหมด _MAX_ เร็คคอร์ด)",
                    "sSearch": "ค้นหา :",
                    "oPaginate": {
                        "sFirst": "หน้าแรก",
                        "sPrevious": "ก่อนหน้า",
                        "sNext": "ถัดไป",
                        "sLast": "หน้าสุดท้าย"
                    },
                },
                "bJQueryUI": true,
                "sPaginationType": "full_numbers"
            });
        }

        var sum_quantity_mat;
        var mat_name;
        async function getMaterial() {
            sum_quantity_mat = 0;
            let mat_id = '<?php echo $_GET['mat_id'] ?>';

            const url = "./controller/MaterialController.php?getaccmat=1&mat_id=" + mat_id;
            let PayData;
            await axios.get(url).then(function(res) {
                PayData = res.data;
            }).catch((err) => console.log(err))

            mat_name = PayData[0].mat_name;
            const body_acc_mat = document.getElementById('body_ac_mat')
            body_acc_mat.innerHTML = "";
            document.getElementById("mat_name").innerHTML = "<b>สมุดคุมบัญชี " + mat_name + "</b>";

            let mat_bu_id_arr = []
            let lastData = [];
            for (let i = 0; i < PayData.length; i++) {
                const check_bud_id = mat_bu_id_arr.filter((id) => {
                    return PayData[i].mat_bud_id == id
                })
                if (check_bud_id.length == 0) {
                    if (PayData[i].dis_date_format != null) {
                        let date1 = new Date(PayData[i].mat_date_income_format).getTime();
                        let date2 = new Date(PayData[i].dis_date_format).getTime();
                        mat_bu_id_arr.push(PayData[i].mat_bud_id)
                        if (date1 == date2) {
                            writeIncomeData(PayData[i])
                            writePayData(PayData[i])
                        }
                        if (date1 > date2) {
                            writeIncomeData(PayData[i])
                            writePayData(PayData[i])
                        }
                        if (date1 < date2) {
                            lastData.push(PayData[i])
                            writeIncomeData(PayData[i])
                        }
                    } else {
                        writeIncomeData(PayData[i])
                    }
                } else {
                    writePayData(PayData[i])
                }
            }

            for (let i = 0; i < lastData.length; i++) {
                writePayData(lastData[i])
            }
        }


        async function writeIncomeData(incomeData) {
            sum_quantity_mat = sum_quantity_mat + incomeData.mat_stock
            const body_acc_mat = document.getElementById('body_ac_mat');
            const sumPrice = parseFloat(incomeData.mat_price) * parseInt(incomeData.mat_stock);
            body_acc_mat.innerHTML += `
                <tr>
                    <td>${incomeData.date_income}</td>
                    <td>${incomeData.mat_bud_id}/${incomeData.budget_year}</td>
                    <td>${incomeData.mat_stock}</td>
                    <td>${parseFloat(incomeData.mat_price).toLocaleString()}</td>
                    <td>${sumPrice.toLocaleString()}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>${sum_quantity_mat}</td>
                    <td>${parseFloat(incomeData.mat_price).toLocaleString()}</td>
                    <td>${(parseFloat(incomeData.mat_price) * sum_quantity_mat).toLocaleString()}</td>
                </tr>
            `;
        }



        async function writePayData(payData) {
            sum_quantity_mat = sum_quantity_mat - payData.quantity;
            const body_acc_mat = document.getElementById('body_ac_mat');
            const sumPrice = parseFloat(payData.mat_price) * parseInt(payData.quantity);
            body_acc_mat.innerHTML += `
                <tr>
                    <td>${payData.dis_date}</td>
                    <td>${payData.dis_det_id}/${payData.budget_year}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>${payData.quantity}</td>
                    <td>${parseFloat(payData.mat_price).toLocaleString()}</td>
                    <td>${sumPrice.toLocaleString()}</td>
                    <td>${sum_quantity_mat}</td>
                    <td>${parseFloat(payData.mat_price).toLocaleString()}</td>
                    <td>${(parseFloat(payData.mat_price) * sum_quantity_mat).toLocaleString()}</td>
                </tr>
            `
        }
    </script>
</body>

</html>