<?php include("component/checkSession.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title id="PageTitle">รายงานรายการครุภัณฑ์แต่ละชนิด ตามปีงบประมาณ</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>รายงานรายการครุภัณฑ์แต่ละชนิด ตามปีงบประมาณ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">รายงาน</li>
                    <li class="breadcrumb-item active">รายงานรายการครุภัณฑ์แต่ละชนิด ตามปีงบประมาณ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">ตารางรายงานรายการครุภัณฑ์แต่ละชนิด ตามปีงบประมาณ</h5>
                            <div class="row">
                                <div class="col-md-4" style="padding-left: 33px;">
                                    <span>ค้นหาตามปีงบประมาณ</span><select onchange="ChangeYeaer()" id="BudgetYear_select" name="BudgetYear_select" class="form-select BudgetYear_select">
                                        <option selected value="0">ปีงบประมาณทั้งหมด</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table id="table-budgetyear-report" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th>หมายเลขประจำครุภัณฑ์</th>
                                            <th>เลขที่ใบรับ</th>
                                            <th>ปีงบประมาณ</th>
                                            <th>ราคาต่อหน่วย</th>
                                            <th>จำนวนในคลัง</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-left" id="body_budgetyear_report">
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

            await getYear_budgetYear();
            await getEquBudgetyearReport().then(() => writeDataTable());

            $select = $(".table-budgetyear-report").select2({
                width: "100%",
            });

        }); //end ready function

        function writeDataTable() {
            $("#table-budgetyear-report").DataTable({
                dom: "<'row'<'col-sm-5'B><'col-sm-3 text-center'l><'col-sm-4'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-4'i><'col-sm-8'p>>",
                buttons: {
                    buttons: [{
                        extend: 'excelHtml5',
                        className: 'btn btn-success',
                        text: 'Export Excel',

                    }]
                },
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'ทั้งหมด'],
                ],
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

        async function ChangeYeaer() {
            getEquBudgetyearReport().then(() => writeDataTable());

            const title = document.getElementById("PageTitle");

            let BodyBudgetYear = document.getElementById("BudgetYear_select");

            const selectedValue = $("#BudgetYear_select Option:selected").text();

            title.innerText = `รายงานรายการครุภัณฑ์แต่ละชนิด ตามปีงบประมาณ ${selectedValue}`;

        }

        async function getEquBudgetyearReport() {

            let budget_id = document.getElementById("BudgetYear_select").value;

            const url ="./controller/BudgetYearController.php?getEquBudgetyearReport=1&budget_id=" +
                budget_id;
            let BudgetYearRepData;
            await axios.get(url).then(function(response) {
                BudgetYearRepData = response.data;
            }).catch((err) => console.log(err));


            $("#table-budgetyear-report").DataTable().destroy();

            const BudgetYearRep_list = document.getElementById("body_budgetyear_report");

            BudgetYearRep_list.innerHTML = "";

            BudgetYearRepData.forEach((element, i) => {

                BudgetYearRep_list.innerHTML += `
                    <tr>
                        <td align="left">${i+1}</td>
                        <td align="left" >${element.equ_name}</td>
                        <td align="left">${element.equ_serail_no == null ? 
                        ` - ` :
                        element.equ_serail_no }</td>
                        <td align="left">${element.equ_bud_id}</td>
                        <td align="left">${element.budget_year}</td>
                        <td align="left">${parseFloat(element.equ_price).toLocaleString()} บาท</td>
                        <td align="left">${element.equ_stock}</td>
                    </tr>
                    `
            });



        }

        async function getYear_budgetYear(budget_id, budget_year) {
            const url ="./controller/BudgetYearController.php?getYear_budgetYear=1";
            let budgetYearData;
            await axios.get(url).then(function(res) {
                budgetYearData = res.data;

            }).catch((err) => console.log(err))

            BodyBudgetYear = document.getElementById("BudgetYear_select");
            budgetYearData.forEach((element, index) => {
                BodyBudgetYear.innerHTML += `
            <option value = "${element.budget_id}"> ${element.budget_year} </option>
        `
            });

        }
    </script>
</body>

</html>