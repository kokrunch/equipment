<?php include("component/checkSession.php"); ?>
<?php include("component/roleMat.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>จัดการครุภัณฑ์ it-equipment-system</title>
    <?php include("component/header.php"); ?>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>จัดการครุภัณฑ์</h1>
            <nav>
                <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">ครุภัณฑ์</li>
                    <li class="breadcrumb-item"><a href="tracking_equipment.php">ติดตามครุภัณฑ์</a></li>
                    <li class="breadcrumb-item"><a href="manage_type_equipment.php">ประเภทครุภัณฑ์</a></li>
                    <li class="breadcrumb-item"><a href="manage_equipment_detail.php">รายละเอียดครุภัณฑ์</a></li>

                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-dark" id="head_budget"></h5>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-success rounded mb-3" id="file-choose" style="margin: 10px;" onclick="ShowChooseFile()">
                                    <i class="bx bxs-file"></i> นำเข้า CSV
                                </button>
                                <button type="button" class="btn btn-outline-primary rounded mb-3" style="margin: 10px;" id="btn-add-equ" data-bs-toggle="modal" data-bs-target="#addModalEqu">
                                    <i class="bx bx-plus"></i> เพิ่มข้อมูล
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="table-equipment" class="text-left" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ลำดับ</th>
                                            <th>หมายเลขครุภัณฑ์</th>
                                            <th>ชื่อครุภัณฑ์</th>
                                            <th>ประเภท</th>
                                            <th>วันที่รับเข้า</th>
                                            <th>สถานะ</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-equ">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Add data -->

        <div class="modal fade" id="addModalEqu" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">เพิ่มครุภัณฑ์ ประจำปีงบประมาณ <span id="budget_show"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="show-preview-img">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="row mb-2">
                                        <div class="col-md-12">
                                            <div class="box-img">
                                                <img class="card-img-top" id="show_equ_image1" src="assets/img/no_image.png" alt="Equipment Image">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <label for="" class="form-label"><span class="text-danger">*</span>
                                                รูปภาพครุภัณฑ์</label>
                                            <input type="file" class="form-control" id="equ_images" accept="image/*" placeholder="เลือกรูปครุภัณฑ์">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row mb-3">
                                        <div class="col-md">
                                            <label for="" class="form-label"><span class="text-danger">*</span> หมายเลขครุภัณฑ์</label>
                                            <div style="width:100%;">
                                                <input type="text" class="form-control" id="equ_code" placeholder="กรอกหมายเลขครุภัณฑ์" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="" class="form-label"><span class="text-danger">*</span> ชื่อครุภัณฑ์</label>
                                            <div class="autocomplete" style="width:100%;">
                                                <input type="hidden" class="form-control" id="equ_id">
                                                <input type="text" class="form-control" id="equ_name" placeholder="กรอกชื่อครุภัณฑ์" autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="" class="form-label"><span class="text-danger">*</span>
                                                ประเภทครุภัณฑ์</label>
                                            <select class="form-select select-type-equ" id="equ_type_id">
                                                <option selected value="0">เลือกประเภทครุภัณฑ์</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="" class="form-label"><span class="text-danger">*</span>
                                                ยี่ห้อครุภัณฑ์</label>
                                            <input type="text" class="form-control" id="equ_brand" placeholder="กรอกยี่ห้อครุภัณฑ์">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label"><span class="text-danger">*</span> รุ่นครุภัณฑ์</label>
                                            <input type="text" class="form-control" id="equ_model" placeholder="กรอกรุ่นครุภัณฑ์">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    รหัสเฉพาะครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_serail_no" placeholder="กรอกรหัสเฉพาะครุภัณฑ์">
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span> สีครุภัณฑ์</label>
                                <input class="form-control" type="text" id="equ_color" placeholder="กรอกสีครุภัณฑ์">
                            </div>

                        </div>



                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    จำนวนครุภัณฑ์</label>
                                <input class="form-control" type="number" id="equ_stock" placeholder="กรอกจำนวนครุภัณฑ์" autocomplete="off">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span> ราคาครุภัณฑ์</label>
                                <input type="number" class="form-control" id="equ_price" placeholder="กรอกราคาครุภัณฑ์">
                            </div>

                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันที่รับเข้า</label>
                                <input type="date" class="form-control" id="equ_date_income">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    วันที่หมดอายุ</label>
                                <input type="date" class="form-control" id="equ_expire_date">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ผู้ครอบครอง</label>
                                <input type="text" class="form-control" id="equ_owner" placeholder="กรอกชื่อผู้ครอบครอง">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    รายละเอียดครุภัณฑ์</label>
                                <textarea class="form-control" id="equ_detail" rows="4" placeholder="กรอกรายละเอียดครุภัณฑ์"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="addEquipment()" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- modalEdit Equipment -->
        <div class="modal fade" id="ModalEditEqu" tabindex="-1" aria-labelledby="ModalEditEquLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalEditEquLabel">แก้ไขข้อมูลครุภัณฑ์</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span> หมายเลขครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_code_edit" placeholder="กรอกหมายเลขครุภัณฑ์">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span> ชื่อครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_name_edit" placeholder="กรอกชื่อครุภัณฑ์">
                                <input type="hidden" id="equ_id_edit">
                            </div>

                        </div>
                        <div class="row g-3 mb-2">
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ยี่ห้อครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_brand_edit" placeholder="กรอกยี่ห้อครุภัณฑ์">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span> รุ่นครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_model_edit" placeholder="กรอกรุ่นครุภัณฑ์">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    รหัสเฉพาะครุภัณฑ์</label>
                                <input type="text" class="form-control" id="equ_serail_no_edit" placeholder="กรอกรหัสเฉพาะครุภัณฑ์">
                            </div>
                            <div class="col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span> สีครุภัณฑ์</label>
                                <input class="form-control" type="text" id="equ_color_edit" placeholder="กรอกสีครุภัณฑ์">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    รายละเอียดครุภัณฑ์</label>
                                <textarea class="form-control" id="equ_detail_edit" rows="3" placeholder="กรอกรายละเอียดครุภัณฑ์"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="updateEquipment()" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>


    </main><!-- End #main -->

    <?php include("component/footer.php"); ?>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

</body>
<script>
    $(document).ready(async function() {

        await getEquipment(0).then(() => writeTable('#table-equipment'))
        addBudgetYear();

        getEquipmentType()
        $(".select-type-equ").select2({
            dropdownParent: $("#addModalEqu"),
            width: "100%",
        });

        $(".select-type-edit-equ").select2({
            dropdownParent: $("#ModalEditEqu"),
            width: "100%",
        });
    }); //end ready function
    var budgetData;
    async function getEquipment(reload) {
        const url = "./controller/EquipmentController.php?getEqu=1";
        let equData;
        await axios.get(url).then(function(response) {
            equData = response.data.Equ;
            budgetData = response.data.BudgetYear;
        }).catch((err) => console.log(err));


        const bodyEqu = document.getElementById("body-equ");
        //const optionSelectEqu = document.getElementById("equ_name_select");


        if (reload == 1) {
           $("#table-equipment").DataTable().destroy();
        }
        bodyEqu.innerHTML = "";
        if (equData.length == 0) {
            return;
        }
        var equDataAuto = [];
        equData.forEach((element, i) => {
            equDataAuto.push({
                id: element.equ_id,
                name: element.equ_name
            })
            bodyEqu.innerHTML += `
            <tr>
                <td style="width:5%" class="text-center">${i+1}</td>
                <td style="width:20%">${element.equ_code}</td>
                <td style="width:20%">${element.equ_name}</td>
                <td style="width:20%">${element.type_name}</td>
                <td>${element.equ_date_income}</td> 
                <td style="width:5%"><span class="badge bg-success">${element.equ_status}</span></td>
                <td class="text-center">
                    <a href="manage_equipment_detail.php?equ_id=${element.equ_id}"><button type="button" class="btn btn-outline-success"><i class="bx bx-detail"></i></button></a>
                    <button type="button" class="btn btn-outline-warning mb-2 mt-2" data-jsonEquipment='${JSON.stringify(element)}'  onclick="openModelEdit(this)"><i class="bx bxs-edit"></i></button>
                    <button type="button" class="btn btn-outline-danger" onclick="deleteEquipment(${element.equ_id})"><i class="bx bxs-trash"></i></button>
                </td>
            </tr>
            `;
        });

        //autocomplete(document.getElementById("equ_name"), document.getElementById("equ_id"), equDataAuto, AutoEqu);

    }

    function addBudgetYear() {
        if (budgetData.length != 0) {
            if (budgetData[0].budget_year == undefined) {
                document.getElementById("budget_show").innerText = "ยังไม่ได้จัดการปีงบประมาณ";
                document.getElementById("head_budget").innerText = "ยังไม่ได้จัดการปีงบประมาณ";
                document.getElementById("btn-add-equ").setAttribute("disabled", "");
                document.getElementById("file-choose").setAttribute("disabled", "");
            } else {
                document.getElementById("budget_show").innerText = budgetData[0].budget_year;
                document.getElementById("head_budget").innerText = "ตารางรายการครุภัณฑ์ ประจำปีงบประมาณ " + budgetData[0]
                    .budget_year;
            }
        } else {
            document.getElementById("budget_show").innerText = "ยังไม่ได้จัดการปีงบประมาณ";
            document.getElementById("head_budget").innerText = "ยังไม่ได้จัดการปีงบประมาณ";
            document.getElementById("btn-add-equ").setAttribute("disabled", "");
            document.getElementById("file-choose").setAttribute("disabled", "");
        }
    }

    const AutoEqu = async () => {
        const equ_id = document.getElementById("equ_id").value;
        const url = location.origin +
            "/it-equipment-system/controller/EquipmentController.php?getEquWhereId=1&equ_id=" + equ_id;
        let equ_select_data;
        let equimage;
        await axios.get(url).then(function(response) {
            equ_select_data = response.data.equData;
            equimage = response.data.equImages;
        }).catch((err) => console.log(err));
        document.getElementById("equ_name").value = equ_select_data[0].equ_name;
        //document.getElementById("equ_type_id").value = equ_select_data[0].equ_type_id;
        document.getElementById("equ_brand").value = equ_select_data[0].equ_brand;
        document.getElementById("equ_model").value = equ_select_data[0].equ_model;
        document.getElementById("equ_serail_no").value = equ_select_data[0].equ_serail_no;
        document.getElementById("equ_color").value = equ_select_data[0].equ_color;
        document.getElementById("equ_detail").value = equ_select_data[0].equ_detail;
        $("#equ_type_id").val(equ_select_data[0].equ_type_id).change();
        document.getElementById("show_equ_image1").src = "assets/equipment_img/" + equimage[0].equ_img_name;
        // document.getElementById("show_equ_image2").src = "assets/equipment_img/" + equimage[1].equ_img_name;
        // document.getElementById("show_equ_image3").src = "assets/equipment_img/" + equimage[2].equ_img_name;
    }

    async function getEquipmentType() {
        const url = "./controller/EquipmentController.php?getEquType=1";
        let equTypeData;
        await axios.get(url).then(function(response) {
            equTypeData = response.data;
        }).catch((err) => console.log(err));

        const selectOptionEquTypeAdd = document.getElementById("equ_type_id");
        equTypeData.forEach((val, i) => {
            selectOptionEquTypeAdd.innerHTML += `
            <option value="${val.type_id}">${val.type_name}</option>
            `
        })
    }




    function openModelEdit(btn) {
        $("#ModalEditEqu").modal("show");
        const jsonStrData = btn.getAttribute("data-jsonEquipment")
        const jsonParseData = JSON.parse(jsonStrData)
        // const dateIncomeSplit = jsonParseData.equ_date_income.split(" ");
        // const DateIncomeFormat = dateIncomeSplit[0]
        // const dateExpireSplit = jsonParseData.equ_expire_date.split(" ");
        // const DateExpireFormat = dateExpireSplit[0]

        document.getElementById("equ_id_edit").value = jsonParseData.equ_id;
        document.getElementById("equ_code_edit").value = jsonParseData.equ_code;
        document.getElementById("equ_name_edit").value = jsonParseData.equ_name;
        // document.getElementById("equ_type_id_edit").value = jsonParseData.equ_type_id;  
        document.getElementById("equ_brand_edit").value = jsonParseData.equ_brand;
        document.getElementById("equ_model_edit").value = jsonParseData.equ_model;
        document.getElementById("equ_detail_edit").value = jsonParseData.equ_detail;
        document.getElementById("equ_serail_no_edit").value = jsonParseData.equ_serail_no;
        document.getElementById("equ_color_edit").value = jsonParseData.equ_color;
    }

    async function addEquipment() {
        let equ_id = document.getElementById("equ_id").value;
        let equ_code = document.getElementById("equ_code").value;
        let equ_name = document.getElementById("equ_name").value;
        let equ_type_id = document.getElementById("equ_type_id").value;
        let equ_brand = document.getElementById("equ_brand").value;
        let equ_model = document.getElementById("equ_model").value;
        let equ_detail = document.getElementById("equ_detail").value;
        let equ_serail_no = document.getElementById("equ_serail_no").value;
        let equ_price = document.getElementById("equ_price").value;
        let equ_date_income = document.getElementById("equ_date_income").value;
        let equ_expire_date = document.getElementById("equ_expire_date").value;
        let equ_color = document.getElementById("equ_color").value;
        let equ_stock = document.getElementById("equ_stock").value;
        let equ_owner = document.getElementById("equ_owner").value;

        var equ_images = document.getElementById('equ_images').files;

        if (equ_id == '') {
            if (equ_images.length < 1 || equ_images.length != 1) {
                document.getElementById("equ_images").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดเลือกรูปภาพครุภัณฑ์',
                    text: "เลือกรูปครุภัณฑ์",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }
        }


        if (equ_code == "") {
            document.getElementById("equ_code").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูลหมายเลขครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_name == "") {
            document.getElementById("equ_name").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ชื่อครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_type_id == "0") {
            document.getElementById("equ_type_id").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ประเภทครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_brand == "") {
            document.getElementById("equ_brand").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ยี่ห้อครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_model == "") {
            document.getElementById("equ_model").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล รุ่นครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_serail_no == "") {
            document.getElementById("equ_serail_no").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล รหัสเฉพาะครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }


        if (equ_color == "") {
            document.getElementById("equ_color").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล สีครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_stock == "") {
            document.getElementById("equ_stock").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล จำนวนครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }


        if (equ_price == "") {
            document.getElementById("equ_price").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ราคาครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_date_income == "") {
            document.getElementById("equ_date_income").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล วันที่นำเข้า',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_expire_date == "") {
            document.getElementById("equ_expire_date").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล วันที่หมดอายุ',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_owner == "") {
            document.getElementById("equ_owner").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ผู้ครอบครองครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_detail == "") {
            document.getElementById("equ_detail").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล รายละเอียดครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }



        var formData = new FormData();
        if (equ_id == '') {
            formData.append("equ_type_id", equ_type_id);
            formData.append("equ_name", equ_name);
            formData.append("equ_brand", equ_brand);
            formData.append("equ_model", equ_model);
            formData.append("equ_detail", equ_detail);
            formData.append("equ_serail_no", equ_serail_no);
            formData.append("equ_price", equ_price);
            formData.append("equ_date_income", equ_date_income);
            formData.append("equ_expire_date", equ_expire_date);
            formData.append("equ_color", equ_color);
            formData.append("addEqu", 1);
            formData.append("equ_stock", equ_stock);
            formData.append("equ_code", equ_code);
            formData.append("equ_owner", equ_owner);
        } else {
            formData.append("equ_type_id", equ_type_id);
            formData.append("equ_id", equ_id);
            formData.append("equ_name", equ_name);
            formData.append("equ_brand", equ_brand);
            formData.append("equ_model", equ_model);
            formData.append("equ_detail", equ_detail);
            formData.append("equ_serail_no", equ_serail_no);
            formData.append("equ_price", equ_price);
            formData.append("equ_date_income", equ_date_income);
            formData.append("equ_expire_date", equ_expire_date);
            formData.append("equ_color", equ_color);
            formData.append("addEqu", 1);
            formData.append("equ_stock", equ_stock);
            formData.append("equ_owner", equ_owner);
        }

        // formData.append("file", equ_name);
        for (var index = 0; index < equ_images.length; index++) {
            formData.append("file[]", equ_images[index]);
        }


        var xhttp = new XMLHttpRequest();

        const url = "./controller/EquipmentController.php";
        // Set POST method and ajax file path
        xhttp.open("POST", url, true);

        // call on request changes state
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                if (response == 1) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'เพิ่มครุภัณฑ์สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        $("#addModalEqu").modal('hide');
                        emptyDataInput()
                        await getEquipment(1).then(() => writeTable('#table-equipment'))
                    })
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'warning',
                        title: 'ประเภทไฟล์ไม่ถูกต้อง',
                        text: 'ตรวจสอบประเภทไฟล์ ( jpg, png, jpeg )',
                        showConfirmButton: true,
                    })
                }
            }
        };

        // Send request with data
        xhttp.send(formData);
    }


    async function updateEquipment() {

        let equ_id = document.getElementById("equ_id_edit").value;
        let equ_code = document.getElementById("equ_code_edit").value;
        let equ_name = document.getElementById("equ_name_edit").value;
        let equ_brand = document.getElementById("equ_brand_edit").value;
        let equ_model = document.getElementById("equ_model_edit").value;
        let equ_detail = document.getElementById("equ_detail_edit").value;
        let equ_serail_no = document.getElementById("equ_serail_no_edit").value;
        let equ_color = document.getElementById("equ_color_edit").value;

        if (equ_code == "") {
            document.getElementById("equ_code_edit").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ชื่อครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_name == "") {
            document.getElementById("equ_name_edit").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ชื่อครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        // if (equ_type_id == "0") {
        //     document.getElementById("equ_type_id").focus();
        //     Swal.fire({
        //         position: 'top-center',
        //         icon: 'info',
        //         title: 'โปรดกรอกข้อมูล ประเภทครุภัณฑ์',
        //         text: "ตรวจสอบความถูกต้อง",
        //         showConfirmButton: false,
        //         timer: 1500
        //     });
        //     return;
        // }

        if (equ_brand == "") {
            document.getElementById("equ_brand_edit").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล ยี่ห้อครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_model == "") {
            document.getElementById("equ_model_edit").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล รุ่นครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        if (equ_serail_no == "") {
            document.getElementById("equ_serail_no_edit").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล รหัสเฉพาะครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }


        if (equ_color == "") {
            document.getElementById("equ_color_edit").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล สีครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        // if (equ_stock == "") {
        //     document.getElementById("equ_stock").focus();
        //     Swal.fire({
        //         position: 'top-center',
        //         icon: 'info',
        //         title: 'โปรดกรอกข้อมูล จำนวนครุภัณฑ์',
        //         text: "ตรวจสอบความถูกต้อง",
        //         showConfirmButton: false,
        //         timer: 1500
        //     });
        //     return;
        // }


        // if (equ_price == "") {
        //     document.getElementById("equ_price").focus();
        //     Swal.fire({
        //         position: 'top-center',
        //         icon: 'info',
        //         title: 'โปรดกรอกข้อมูล ราคาครุภัณฑ์',
        //         text: "ตรวจสอบความถูกต้อง",
        //         showConfirmButton: false,
        //         timer: 1500
        //     });
        //     return;
        // }

        // if (equ_date_income == "") {
        //     document.getElementById("equ_date_income").focus();
        //     Swal.fire({
        //         position: 'top-center',
        //         icon: 'info',
        //         title: 'โปรดกรอกข้อมูล วันที่นำเข้า',
        //         text: "ตรวจสอบความถูกต้อง",
        //         showConfirmButton: false,
        //         timer: 1500
        //     });
        //     return;
        // }

        // if (equ_expire_date == "") {
        //     document.getElementById("equ_expire_date").focus();
        //     Swal.fire({
        //         position: 'top-center',
        //         icon: 'info',
        //         title: 'โปรดกรอกข้อมูล วันที่หมดอายุ',
        //         text: "ตรวจสอบความถูกต้อง",
        //         showConfirmButton: false,
        //         timer: 1500
        //     });
        //     return;
        // }

        if (equ_detail == "") {
            document.getElementById("equ_detail_edit").focus();
            Swal.fire({
                position: 'top-center',
                icon: 'info',
                title: 'โปรดกรอกข้อมูล รายละเอียดครุภัณฑ์',
                text: "ตรวจสอบความถูกต้อง",
                showConfirmButton: false,
                timer: 1500
            });
            return;
        }

        const jsonData = {
            equ_id: equ_id,
            equ_code: equ_code,
            equ_name: equ_name,
            // equ_type_id: equ_type_id,
            equ_brand: equ_brand,
            equ_model: equ_model,
            equ_detail: equ_detail,
            equ_serail_no: equ_serail_no,
            // equ_price: equ_price,
            // equ_date_income: equ_date_income,
            // equ_expire_date: equ_expire_date,
            equ_color: equ_color,
            // equ_stock: equ_stock,
            updateEqu: true
        }

        const url = "./controller/EquipmentController.php";
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
                    title: 'แก้ไขข้อมูลครุภัณฑ์สำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then(async () => {
                    $("#ModalEditEqu").modal('hide');
                    await getEquipment(1).then(() => writeTable('#table-equipment'))
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


    async function deleteEquipment(equ_id) {
        Swal.fire({
            title: 'ต้องการลบครุภัณฑ์หรือไม่ ?',
            text: 'หากลบ ข้อมูลครุภัณฑ์นี้จะหายไป',
            showCancelButton: true,
            confirmButtonText: 'ลบข้อมูล',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            cancelButtonText: 'ยกเลิก',
        }).then(async (result) => {
            if (result.isConfirmed) {
                const url = "./controller/EquipmentController.php";
                await axios({
                    method: 'post',
                    url: url,
                    data: {
                        equ_id: equ_id,
                        deleteEqu: true
                    },
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                }).then((res) => {
                    if (res.data == 1) {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'success',
                            title: 'ลบครุภัณฑ์สำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(async () => {
                            await getEquipment(1).then(() => writeTable('#table-equipment'))
                        })
                    } else if (res.data == 'have related information.') {
                        Swal.fire({
                            position: 'top-center',
                            icon: 'warning',
                            title: 'ลบข้อมูลไม่สำเร็จ',
                            text: 'เนื่องจากข้อมูลครุภัณฑ์นี้มีการเชื่อมโยงกับฟีเจอร์อื่น',
                            showConfirmButton: true
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

    function previewMultiple(event) {
        var Files = document.getElementById("equ_images");
        var length = Files.files.length;
        if (length != 1) {
            for (i = 0; i < 1; i++) {
                document.getElementById("show_equ_image" + (i + 1)).src = "assets/img/no_image.png";
            }
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'เลือกรูปภาพ 1 รูป',
                showConfirmButton: true
            })
            return;
        }
        for (i = 0; i < length; i++) {
            var urls = URL.createObjectURL(event.target.files[i]);
            document.getElementById("show_equ_image" + (i + 1)).src = urls;
        }
    }
    document.querySelector("#equ_images").addEventListener("change", (ev) => previewMultiple(ev));




    function emptyDataInput() {
        document.getElementById("equ_code").value = "";
        document.getElementById("equ_id").value = "";
        document.getElementById('equ_images').value = "";
        document.getElementById("equ_name").value = "";
        document.getElementById("equ_type_id").value = "0";
        document.getElementById("equ_brand").value = "";
        document.getElementById("equ_model").value = "";
        document.getElementById("equ_detail").value = "";
        document.getElementById("equ_serail_no").value = "";
        document.getElementById("equ_price").value = "";
        document.getElementById("equ_date_income").value = "";
        document.getElementById("equ_expire_date").value = "";
        document.getElementById("equ_color").value = "";
        document.getElementById("equ_stock").value = "";
        for (i = 0; i < 1; i++) {
            document.getElementById("show_equ_image" + (i + 1)).src = "assets/img/no_image.png";
        }
    }


    function ShowChooseFile() {
        Swal.fire({
            title: '',
            html: '<i class="bx bxs-file text-success" style="font-size:50px;"></i><br>' +
                '<h3><strong>โปรดเลือกไฟล์ที่เป็น <u>.CSV</u> เท่านั้น</strong></h3>',
            //+'<input class="form-control" type="file" id="fileCSV" accept=".csv">',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: 'ยืนยัน',
            input: 'file',
            onBeforeOpen: () => {
                $(".swal-file").change(function() {
                    console.log(this.files[0])
                    var reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'โปรดรอสักครู่',
                    text: "กำลังนำเข้าครุภัณฑ์",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: async () => {
                        Swal.showLoading();
                        const file = result.value;
                        await sentRequestImportEqu(file)
                    },
                    // willClose: () => {
                    //     Swal.fire(
                    //         'สำเร็จ!',
                    //         'นำเข้าครุภัณฑ์เรียบร้อย',
                    //         'success'
                    //     )
                    // }
                })
            }
        })

        $(".swal2-file").addClass("form-control");
        $(".swal2-file").attr("accept", ".csv");
    }

    async function sentRequestImportEqu(CSVfile) {
        var formData = new FormData();
        formData.append("file", CSVfile);
        formData.append("testCSV", true)

        var xhttp = new XMLHttpRequest();
        const url = "./controller/ImportExcelController.php";
        xhttp.open("POST", url, true);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                console.log(response)

                if (response == 1) {
                    Swal.close();
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'สำเร็จ',
                        showConfirmButton: true
                    }).then(async () => {
                        await getEquipment(1).then(() => writeTable('#table-equipment'))
                    })
                } else if (response == "invalid file type") {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'waring',
                        title: 'โปรดเลือกไฟล์ CSV',
                        showConfirmButton: true
                    })
                } else {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        showConfirmButton: true
                    })
                }
            }
        };
        xhttp.send(formData);
    }
</script>