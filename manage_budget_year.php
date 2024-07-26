<?php include("component/checkSession.php"); ?>
<?php include("component/roleMat.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>จัดการงบประมาณ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">จัดการงบประมาณ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">งบประมาณปี</h5>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary rounded mb-3"
                                    data-bs-toggle="modal" data-bs-target="#addbudgetModal">
                                    เพื่มงบประมาณประจำปี
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="table-budget" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>งบประมาณปี</th>
                                            <th>วันที่เริ่มต้นงบประมาณ</th>
                                            <th>วันที่สิ้นสุดงบประมาณ</th>
                                            <th>สถานะปีงบประมาณ</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-budget">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="modal fade" id="addbudgetModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มงบประมาณประจำปี</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ปีงบประมาณ</label>
                                <input type="text" class="form-control" id="budget_name"
                                    placeholder="กรอกปีงบประมาณ เช่น 2566 , 2567">
                            </div>
                        </div>
                        <div class="row g-3 my-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันเริ่มต้นงบประมาณ</label>
                                <input type="date" class="form-control" id="budget_start_date" disabled>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันสิ้นสุดงบประมาณ</label>
                                <input type="date" class="form-control" id="budget_end_date" disabled>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="addBudgetYear()"
                            class="btn btn-primary">เพิ่มข้อมูลปีงบประมาณ</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editbudgetModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">เพิ่มงบประมาณประจำปี</h5>
                        <input type="hidden" id="budget_id_ed">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ปีงบประมาณ</label>
                                <input type="text" class="form-control" id="budget_name_ed"
                                    placeholder="กรอกปีงบประมาณ เช่น 2566 , 2567">
                            </div>
                        </div>
                        <div class="row g-3 my-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันเริ่มต้นงบประมาณ</label>
                                <input type="date" class="form-control" id="budget_start_date_ed">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันสิ้นสุดงบประมาณ</label>
                                <input type="date" class="form-control" id="budget_end_date_ed">
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="confirmEditBudgetYear()"
                            class="btn btn-primary">แก้ไขข้อมูลปีงบประมาณ</button>
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

        await getDataBudgetYear(0).then(async () => writeTable("#table-budget"))

        const date_start_budget = document.querySelector('#budget_start_date');
        date_start_budget.value = new Date().getFullYear()+543 + '-01-10';

        const date_end_budget = document.querySelector('#budget_end_date');
        date_end_budget.value = new Date().getFullYear() + 544  + '-09-30';

    }); //end ready function

    async function getDataBudgetYear(reload) {
        Bodybudget = document.getElementById("body-budget").innerHTML = "";
        const url = "./controller/BudgetYearController.php?getBudgetYear=1";
        let BudgetData;
        await axios.get(url).then(function(res) {
            BudgetData = res.data;
        }).catch((err) => console.log(err))

        if (reload == 1) {
            $("#table-budget").DataTable().destroy();
        }

        Bodybudget = document.getElementById("body-budget");

        Bodybudget.innerHTML = "";

        BudgetData.forEach((element, index) => {
            Bodybudget.innerHTML += `
            <tr>
                <td align="left">${index+1}</td>
                <td align="left">${element.budget_year}</td>
                <td align="left">${FormatToThaiDate(element.budget_start_date)}</td>
                <td align="left">${FormatToThaiDate(element.budget_end_date)}</td>
                <td align="left">${element.budget_year_status == 0 ?
                     '<span class="badge bg-danger">สิ้นปีงบประมาณ</span>'
                    :'<span class="badge bg-success">ใช้งานอยู่</span>'}</td>
                <td >
                    <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" 
                            data-bs-target="#editbudgetModal" data-jsonBudget='${JSON.stringify(element)}' 
                            onclick = "editBudgetYear(this)"><i class="bx bxs-edit"></i></button>
                    <button type="button" class="btn btn-outline-danger" 
                            onclick = "deleteBudgetYear(${element.budget_id})"><i class="bx bxs-trash"></i></button>
                </td>
            </tr>
            `
        });
    }

    async function addBudgetYear() {
        let date = new Date();
        let date_format_start = date.getFullYear() + "-" + 10 + "-0" + 1;
        let date_format_end = date.getFullYear() + 1 + "-0" + 9 + "-" + 30;

        let budget_year = document.getElementById("budget_name").value;
        let budget_st_date = document.getElementById("budget_start_date").value = date_format_start;
        let budget_end_date = document.getElementById("budget_end_date").value = date_format_end;

        if (!budget_year || !budget_st_date || !budget_end_date) {
            Swal.fire({
                icon: 'info',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน !!',
                showConfirmButton: false,
                timer: 1500
            })
        } else {

            const url = "./controller/BudgetYearController.php";

            let JsonData = {
                addBudgetYear: "addBudgetYear",
                budget_year: budget_year,
                budget_st_date: budget_st_date,
                budget_end_date: budget_end_date
            }

            await axios({
                method: 'post',
                url: url,
                data: JsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then(async (res) => {
                let response = res.data;
                if (response == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'เพิ่มปีงบประมาณสำเร็จ!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#addbudgetModal").modal('hide');
                    document.getElementById("budget_name").value = "";
                    await getDataBudgetYear(1).then(async () => writeTable("#table-budget"))
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'เพิ่มปีงบประมาณไม่สำเร็จ !!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#addbudgetModal").modal('hide');
                }
            })
        }
    }

    async function editBudgetYear(btn) {
        const jsonStrData = btn.getAttribute("data-jsonBudget")
        const jsonParseData = JSON.parse(jsonStrData)

        let date_st = jsonParseData.budget_start_date;
        let date_en = jsonParseData.budget_end_date;

        const date_sp_st = date_st.split("-");
        let date_day_st = date_sp_st[2].split(" ");

        const date_sp_en = date_en.split("-");
        let date_day_en = date_sp_en[2].split(" ");

        let date_format_st = date_sp_st[0] + "-" + date_sp_st[1] + "-" + date_day_st[0];
        let date_format_en = date_sp_en[0] + "-" + date_sp_en[1] + "-" + date_day_en[0];

        document.getElementById("budget_start_date_ed").value = date_format_st;
        document.getElementById("budget_end_date_ed").value = date_format_en;
        document.getElementById("budget_name_ed").value = jsonParseData.budget_year;
        document.getElementById("budget_id_ed").value = jsonParseData.budget_id;

    }

    async function confirmEditBudgetYear() {
        let budget_id = document.getElementById("budget_id_ed").value;
        let budget_year = document.getElementById("budget_name_ed").value;
        let start_date = document.getElementById("budget_start_date_ed").value;
        let end_date = document.getElementById("budget_end_date_ed").value;

        let JsonData = {
            updateBudget: 'updateBudget',
            budget_id: budget_id,
            budget_year: budget_year,
            start_date: start_date,
            end_date: end_date
        }

        if (!budget_year) {
            Swal.fire({
                icon: 'info',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน !!',
                showConfirmButton: false,
                timer: 1500
            })
        } else {
            const url = "./controller/BudgetYearController.php";

            await axios({
                method: 'post',
                url: url,
                data: JsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then(async (res) => {
                let response = res.data;
                if (response == 1) {
                    Swal.fire({
                        icon: 'success',
                        title: 'แก้ไขข้อมูลปีงบประมาณสำเร็จ!!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#editbudgetModal").modal('hide');
                    await getDataBudgetYear(1).then(() => writeTable("#table-budget"))
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'แก้ไขข้อมูลปีงบประมาณไม่สำเร็จ !!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $("#editbudgetModal").modal('hide');
                }
            })
        }

    }

    async function deleteBudgetYear(budget_id) {

        const url = "./controller/BudgetYearController.php?delBudget=" +
            budget_id;

        Swal.fire({
            title: 'ยืนยันการลบปีงบประมาณ !!',
            text: "ต้องการลบปีงบประมาณใช่หรือไม่ ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันการลบ',
            cancelButtonText: 'ยกเลิก'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await axios.get(url).then(async function(res) {
                    let response = res.data;
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลปีงบประมาณสำเร็จ !!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        await getDataBudgetYear(1).then(() => writeTable("#table-budget"))
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบข้อมูลปีงบประมาณไม่สำเร็จ !!',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        await getDataBudgetYear(1).then(() => writeTable("#table-budget"))
                    }
                }).catch((err) => console.log(err))
            }
        })
    }
    </script>
</body>

</html>