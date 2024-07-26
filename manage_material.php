<?php include("component/checkSession.php"); ?>
<?php include("component/roleMat.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>

</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebarMat.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>รายการวัสดุ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard_mat.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">จัดการวัสดุ</li>
                    <li class="breadcrumb-item active">รายการวัสดุ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">รายการวัสดุ</h5>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-success rounded mb-3" style="margin: 10px;" onclick="ShowChooseFile()">
                                    <i class="bx bxs-file"></i> นำเข้า CSV
                                </button>
                                <button type="button" class="btn btn-outline-primary rounded mb-3" style="margin: 10px;" data-bs-toggle="modal" data-bs-target="#addMaterialModal">
                                    เพิ่มข้อมูลวัสดุ
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="table-mat" class="text-center" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>ชื่อวัสดุ</th>
                                            <th>ประเภทวัสดุ</th>
                                            <th>ยี่ห้อ</th>
                                            <th>จำนวนคงเหลือ</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-mat">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Add data -->
        <div class="modal fade" id="addMaterialModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="" id="addUser">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="title_budget"></h5>
                            <input type="hidden" id="mat_id_for_add">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="div_addMat_empty">
                            <div class="row g-3 mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*
                                            กรณีที่มีอยู่แล้ว</span>
                                        เลือกวัสดุเดิม</label>
                                    <select class="form-select select-mat" id="mat_id" onchange="select_material()">
                                        <option selected value="0">เลือกวัสดุ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-2">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ชื่อวัสดุ</label>
                                    <input type="text" class="form-control" id="mat_name" placeholder="กรอกชื่อวัสดุ">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ประเภทวัสดุ</label>
                                    <select class="form-select select-mat-type" id="mat_type_id">
                                        <option selected disabled>เลือกวัสดุ</option>

                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ยี่ห้อวัสดุ</label>
                                    <input type="text" class="form-control" id="mat_brand" placeholder="กรอกยี่ห้อวัสดุ">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        หน่วยวัสดุ</label>
                                    <select class="form-select select-mat-unit" id="mat_unit_id">
                                        <option selected disabled>เลือกหน่วยวัสดุ</option>
                                    </select>
                                </div>

                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        ราคาวัสดุ</label>
                                    <input type="number" class="form-control" id="mat_price" placeholder="กรอกราคาวัสดุ">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        จำนวน</label>
                                    <input type="number" class="form-control" id="mat_quan" placeholder="กรอกจำนวนวัสดุ">
                                </div>
                            </div>
                            <div class="row g-3 my-2">
                                <div class="col-12 col-md-6">
                                    <label for="" class="form-label"><span class="text-danger">*</span>
                                        วันที่รับเข้าวัสดุ</label>
                                    <input type="date" class="form-control" id="mat_date_income">
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                            <button type="button" onclick="addMaterial()" class="btn btn-primary">บันทึกข้อมูล</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- edit_modal -->
        <div class="modal fade" id="editMaterialModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">แก้ไขวัสดุ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ชื่อวัสดุ</label>
                                <input type="text" class="form-control" id="mat_name_edit" placeholder="กรอกชื่อวัสดุ">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ประเภทวัสดุ</label>
                                <select class="form-select" id="mat_type_id_edit">
                                    <option selected disabled>ประเภทวัสดุ</option>

                                </select>
                            </div>
                        </div>
                        <div class="row g-3 my-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    ยี่ห้อวัสดุ</label>
                                <input type="text" class="form-control" id="mat_brand_edit" placeholder="กรอกยี่ห้อวัสดุ">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    หน่วยวัสดุ</label>
                                <select class="form-select" id="mat_unit_id_edit">
                                    <option selected disabled>เลือกหน่วยวัสดุ</option>
                                </select>
                            </div>

                        </div>

                    </div>
                    <div class=" modal-footer">
                        <input type="hidden" id="material_id" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="updateMaterial()" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <?php include("component/script.php"); ?>

</body>
<script>
    $(document).ready(async function() {

        await getMaterial(0).then(async () => writeTable("#table-mat"))
        await getTypeMeterial();
        await getUnitMaterial();
        await getBudgetYear();

        getDataMaterial()

        await ReloadSelectMat();

        $select = $(".select-mat-type").select2({
            dropdownParent: $("#addMaterialModal"),
            width: "100%",
        });

        $select = $(".select-mat-unit").select2({
            dropdownParent: $("#addMaterialModal"),
            width: "100%",
        });
    }); //end ready function

    async function ReloadSelectMat(check) {
        let BodySelectMaterial = document.getElementById("mat_id");

        if (check == 1) {
            BodySelectMaterial.innerHTML = "";
            BodySelectMaterial.innerHTML = `
            <option selected disabled value="0">เลือกวัสดุ</option>
        `
            getDataMaterial()
        }

        $select = $(".select-mat").select2({
            dropdownParent: $("#addMaterialModal"),
            width: "100%",
        });

    }

    async function getDataMaterial() {
        const url = "./controller/MaterialController.php?getmat=2";
        let MatData;
        await axios.get(url).then(function(res) {
            MatData = res.data;
        }).catch((err) => console.log(err))

        BodyMeterial = document.getElementById("mat_id");
        MatData.forEach((element, index) => {
            BodyMeterial.innerHTML += `
            <option value = "${element.mat_id}"> ${element.mat_name} </option>
        `
        });

    }
    async function select_material() {
        let mat_id = document.getElementById("mat_id").value;
        const url = "./controller/MaterialController.php?getunitmatbyid=" +
            mat_id;
        let MatData;
        await axios.get(url).then(function(res) {
            MatData = res.data;
        }).catch((err) => console.log(err))

        MatData.forEach((element, index) => {
            document.getElementById("mat_name").value = element.mat_name;
            document.getElementById("mat_brand").value = element.mat_brand;
            document.getElementById("mat_price").value = element.mat_price;
            //document.getElementById("mat_type_id").value = element.mat_type_id;
            $("#mat_type_id").val(element.mat_type_id).change();
            $("#mat_unit_id").val(element.unit_id).change();
            document.getElementById("mat_id_for_add").value = mat_id;
        });
    }

    async function getBudgetYear() {
        const url = "./controller/BudgetYearController.php?getBudgetYearLimit=1";
        let budgetData;

        await axios.get(url).then(function(res) {
            budgetData = res.data;
            if (budgetData == "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณาเพิ่มปีงบประมาณ !!',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    setTimeout(() => {
                        let url =
                            "./manage_budget_year.php";
                        location.href = url;
                    }, 2000);
                });

            }
        }).catch((err) => console.log(err))

        budgetData.forEach((element, index) => {
            document.getElementById("title_budget").innerHTML = "เพิ่มวัสดุ ประจำปีงบประมาณ " + element
                .budget_year;
            document.getElementById("title_budget").value = element.budget_id;

        });
    }

    async function getTypeMeterial(type_id, type_name) {
        const url = "./controller/MaterialController.php?gettypemat=1";
        let typeMatData;
        await axios.get(url).then(function(res) {
            typeMatData = res.data;
        }).catch((err) => console.log(err))

        if (type_id > 0) {
            BodyTypeMeterial = document.getElementById("mat_type_id_edit");
            BodyTypeMeterial.innerHTML = `
        <option value = "${type_id}" disabled> ${type_name} </option>`

            typeMatData.forEach((element, index) => {
                BodyTypeMeterial.innerHTML += `
            <option value = "${element.type_id}"> ${element.type_name} </option>
        `
            });
        } else {
            BodyTypeMeterial = document.getElementById("mat_type_id");
            BodyTypeMeterial.innerHTML = "";

            BodyTypeMeterial.innerHTML += `
            <option selected disabled>เลือกประเภทวัสดุ</option>
        `

            typeMatData.forEach((element, index) => {
                BodyTypeMeterial.innerHTML += `
            <option value = "${element.type_id}"> ${element.type_name} </option>
        `
            });
        }

    }

    async function getUnitMaterial(unit_id, unit_name) {
        const url = "./controller/MaterialController.php?getunitmat=3";
        let UnitMatData;
        await axios.get(url).then(function(res) {
            UnitMatData = res.data;
        }).catch((err) => console.log(err))
        if (unit_id > 0) {
            BodyUnitMeterial = document.getElementById("mat_unit_id_edit");
            BodyUnitMeterial.innerHTML = `
            <option value = "${unit_id}" disabled> ${unit_name} </option>
        `
            UnitMatData.forEach((element, index) => {
                BodyUnitMeterial.innerHTML += `
            <option value = "${element.unit_id}"> ${element.unit_name} </option>
        `
            });
        } else {
            BodyUnitMeterial = document.getElementById("mat_unit_id");
            BodyUnitMeterial.innerHTML = "";

            BodyUnitMeterial.innerHTML += `
            <option selected disabled>เลือกหน่วยนับ</option>
        `

            UnitMatData.forEach((element, index) => {
                BodyUnitMeterial.innerHTML += `
            <option value = "${element.unit_id}"> ${element.unit_name} </option>
        `
            });
        }

    }

    async function getMaterial(reload) {
        BodyMaterial = document.getElementById("body-mat").innerHTML = "";
        const url = "./controller/MaterialController.php?getmat=2";
        let MatData;
        await axios.get(url).then(function(res) {
            MatData = res.data;
        }).catch((err) => console.log(err))

        if (reload == 1) {
            $("#table-mat").DataTable().destroy();
        }

        BodyMaterial = document.getElementById("body-mat");
        BodyMaterial.innerHTML = "";

        MatData.forEach((element, index) => {

            BodyMaterial.innerHTML += `
            <tr>
                <td align="left">${element.mat_name}</td>
                <td align="left">${element.type_name}</td>
                <td align="left">${element.mat_brand}</td>
                <td align="left">${element.mat_quantity == 0 
                    ? `<span class="badge bg-danger">ไม่มีวัสดุในสต็อก</span>`
                    : element.mat_quantity}</td>
                <td>
                <a href="account_mat.php?mat_id=${element.mat_id}">
                <button type="button" class="btn btn-outline-success"><i class="bx bx-detail"></i></button></a>
                <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" 
                        data-bs-target="#editMaterialModal" onclick="edit_material(${element.mat_id})"><i class="bx bxs-edit"></i></button>
                <button type="button" class="btn btn-outline-danger" 
                        onclick="del_material(${element.mat_id})"><i class="bx bxs-trash"></i></button>
                </td>
            </tr>
            `
        });
    }

    async function addMaterial() {

        let mat_name = document.getElementById("mat_name").value;
        let mat_type_id = document.getElementById("mat_type_id").value;
        let mat_brand = document.getElementById("mat_brand").value;
        let mat_unit_id = document.getElementById("mat_unit_id").value;
        let mat_price = document.getElementById("mat_price").value;
        let budget_year_id = document.getElementById("title_budget").value;

        let mat_date_income = document.getElementById("mat_date_income").value;
        let mat_quan = document.getElementById("mat_quan").value;

        let mat_id = document.getElementById("mat_id").value;
        let mat_id_for_add = document.getElementById("mat_id_for_add").value;

        if (!mat_name || !mat_type_id || !mat_brand || !mat_unit_id || !mat_price || !mat_date_income || !mat_quan) {
            Swal.fire({
                icon: 'info',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน !!',
                showConfirmButton: false,
                timer: 1500
            })
        } else {

            var formData = new FormData();
            formData.append("mat_name", mat_name);
            formData.append("mat_type_id", mat_type_id);
            formData.append("mat_brand", mat_brand);
            formData.append("mat_unit_id", mat_unit_id);

            formData.append("mat_price", mat_price);
            formData.append("mat_budget_year", budget_year_id);
            formData.append("mat_quan", mat_quan);
            formData.append("mat_date_income", mat_date_income);

            formData.append("mat_id_for_add", mat_id);

            formData.append("addMat", 1);

            // for (let key of formData.entries()){
            //     console.log(key[0] + " - " + key[1])
            // }

            var xhttp = new XMLHttpRequest();
            const url = "./controller/MaterialController.php";
            xhttp.open("POST", url, true);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    var response = this.responseText;
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'เพิ่มข้อมูลวัสดุสำเร็จ !!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(async () => {
                            $("#addMaterialModal").modal('hide');
                            $('#addMaterialModal input').val('');
                            ReloadSelectMat(1);
                            getUnitMaterial()
                            getTypeMeterial()
                            await getMaterial(1).then(async () => writeTable("#table-mat"))
                        })

                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'เกิดข้อผิดพลาด !!',
                            showConfirmButton: false,
                        }).then(() => {
                            $("#addMaterialModal").modal('hide');
                        })
                    }
                }
            };

            xhttp.send(formData);

        }


    }

    async function edit_material(material_id) {
        const url = "./controller/MaterialController.php?getunitmatbyid=" +
            material_id;
        let MatData;
        await axios.get(url).then(function(res) {
            MatData = res.data;
        }).catch((err) => console.log(err))

        MatData.forEach((element, index) => {
            document.getElementById("mat_name_edit").value = element.mat_name;
            document.getElementById("mat_brand_edit").value = element.mat_brand;
            document.getElementById("material_id").value = material_id;

            getTypeMeterial(element.mat_type_id, element.type_name)
            getUnitMaterial(element.unit_id, element.unit_name)

        });

    }

    async function updateMaterial() {
        let mat_name = document.getElementById("mat_name_edit").value;
        let mat_brand = document.getElementById("mat_brand_edit").value;
        let material_id = document.getElementById("material_id").value;
        let mat_type_id = document.getElementById("mat_type_id_edit").value;
        let mat_unit_id = document.getElementById("mat_unit_id_edit").value;

        if (!mat_name || !mat_brand || !material_id || !mat_type_id || !mat_unit_id) {
            Swal.fire({
                icon: 'info',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน !!',
                showConfirmButton: false,
                timer: 1500
            })
        } else {

            var formData = new FormData();
            formData.append("mat_name", mat_name);
            formData.append("mat_type_id", mat_type_id);
            formData.append("mat_brand", mat_brand);
            formData.append("mat_unit_id", mat_unit_id);
            formData.append("material_id", material_id)
            formData.append("updateMat", 1);

            var xhttp = new XMLHttpRequest();
            const url = "./controller/MaterialController.php";
            xhttp.open("POST", url, true);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = this.responseText;
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'แก้ไขข้อมูลวัสดุสำเร็จ !!',
                            showConfirmButton: false,
                        }).then(async () => {
                            $("#editMaterialModal").modal('hide');
                            await getMaterial(1).then(async () => writeTable("#table-mat"))
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'เกิดข้อผิดพลาด !!',
                            showConfirmButton: false,
                        }).then(() => {
                            $("#editMaterialModal").modal('hide');
                        })
                    }
                }
            };

            xhttp.send(formData);

        }

    }

    async function del_material(material_id) {
        const url = "./controller/MaterialController.php?delmat=" + material_id;

        Swal.fire({
            title: 'ยืนยันการลบวัสดุ !!',
            text: "ต้องการลบวัสดุใช่หรือไม่ ?",
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
                            title: 'ลบข้อมูลวัสดุสำเร็จ !!',
                            showConfirmButton: false,
                        })
                        await getMaterial(1).then(async () => writeTable("#table-mat"))
                    } else if (response == 2) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบวัสดุไม่สำเร็จ !!',
                            text: "เนื่องจากมีวัสดุคงอยู่สต็อกอยู่",
                            showConfirmButton: true,
                        })
                        await getMaterial(1).then(async () => writeTable("#table-mat"))
                    } else if (response == 3) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบวัสดุไม่สำเร็จ !!',
                            text: "เนื่องจากในวัสดุในบิลการเบิกวัสดุ",
                            showConfirmButton: true,
                        })
                        await getMaterial(1).then(async () => writeTable("#table-mat"))
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบข้อมูลวัสดุไม่สำเร็จ !!',
                            showConfirmButton: true,
                        })
                        await getMaterial(1).then(async () => writeTable("#table-mat"))
                    }
                }).catch((err) => console.log(err))
            }

        })
    }

    function ShowChooseFile() {
        Swal.fire({
            title: '',
            html: '<i class="bx bxs-file text-success" style="font-size:50px;"></i> ' +
                '<h3><strong>Choose File <u>CSV</u></strong></h3>',
            //+'<input class="form-control" type="file" id="fileCSV" accept=".csv">',
            showCloseButton: true,
            showCancelButton: false,
            focusConfirm: false,
            confirmButtonText: 'ยืนยัน',
            input: 'file',
            onBeforeOpen: () => {
                $(".swal-file").change(function() {
                    var reader = new FileReader();
                    reader.readAsDataURL(this.files[0]);
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'โปรดรอสักครู่',
                    text: "กำลังนำเข้าวัสดุ",
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    didOpen: async () => {
                        Swal.showLoading();
                        var file = result.value;
                        await sentRequestImportMat(file)
                        // console.log(file)
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
    }

    async function sentRequestImportMat(CSVfile) {
        var formData = new FormData();
        formData.append("file", CSVfile);
        formData.append("addMatFromImport", true)

        var xhttp = new XMLHttpRequest();
        const url = "./controller/ImportExcelController.php";
        xhttp.open("POST", url, true);
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var response = this.responseText;

                if (response == 1) {
                    Swal.close();
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'สำเร็จ',
                        showConfirmButton: true
                    }).then(async () => {
                        await getMaterial(1).then(async () => writeTable("#table-mat"))
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