<?php include("component/checkSession.php"); ?>
<?php include("component/roleAdmin.php  "); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>จัดการภาควิชา it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebar.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>จัดการภาควิชา</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item">จัดการคณะและภาควิชา</li>
                    <li class="breadcrumb-item active">ภาควิชา</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">รายการภาควิชาภายในคณะ</h5>
                            <div class="d-flex justify-content-end">
                                <button type="button" class="btn btn-outline-primary rounded mb-3" data-bs-toggle="modal" data-bs-target="#ModalAddBranch">
                                    <i class="bx bx-plus"></i> เพิ่มข้อมูล
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table id="table-branch" class="text-left" style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">ลำดับ</th>
                                            <th style="width: 60%;">ชื่อภาควิชา</th>
                                            <th style="width: 15%;" class="text-center">จำนวนอาจารย์</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody id="body-branch">
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <div class="modal fade" id="ModalAddBranch" tabindex="-1" aria-labelledby="ModalAddBranchLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalAddBranchLabel">เพิ่มภาควิชา</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="form-label"><span class="text-danger">*</span> ชื่อภาควิชา</label>
                                <input type="text" class="form-control" id="branch_name" placeholder="กรอกชื่อภาควิชา">
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="addBranch()" class="btn btn-primary">บันทึกข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="ModalEditBranch" tabindex="-1" aria-labelledby="ModalEditBranchLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalEditBranchLabel">แก้ไขข้อมูลภาควิชา</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <label for="" class="form-label"><span class="text-danger">*</span> ชื่อภาควิชา</label>
                                <input type="hidden" class="form-control" id="branch_id_edit">
                                <input type="text" class="form-control" id="branch_name_edit" placeholder="กรอกชื่อภาควิชา">
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="EditBranch()" class="btn btn-primary">แก้ไขข้อมูล</button>
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

            await getAllBranch(0).then(() => writeTable("#table-branch"));

        }); //end ready function


        async function getAllBranch(reload) {
            const url = "./controller/BranchController.php?getAllbranch=1";
            let branchData;
            await axios.get(url).then(function(response) {
                branchData = response.data;
            }).catch((err) => console.log(err));

            if (reload == 1) {
                $("#table-branch").DataTable().destroy();
            }
            const bodyBranch = document.getElementById("body-branch");
            bodyBranch.innerHTML = "";
            branchData.forEach((element, i) => {
                bodyBranch.innerHTML += `
            <tr>
                <td>${i + 1}</td>
                <td>${element.branch_name}</td>
                <td class="text-center">${element.count_lecturer}</td>
                <td>
                    <button type="button" class="btn btn-outline-warning mb-2 mt-2" data-jsonBranch='${JSON.stringify(element)}'  onclick="openModelEdit(this)"><i class="bx bxs-edit"></i></button>
                    <button type="button" class="btn btn-outline-danger" onclick="deleteBranch(${element.branch_id})"><i class="bx bxs-trash"></i></button>
                </td>
            </tr>
            `
            });
        }

        function openModelEdit(btn) {
            $("#ModalEditBranch").modal("show")
            const jsonDataStr = btn.getAttribute("data-jsonBranch")
            const jsonBranch = JSON.parse(jsonDataStr)
            document.getElementById("branch_id_edit").value = jsonBranch.branch_id;
            document.getElementById("branch_name_edit").value = jsonBranch.branch_name;

        }


        async function addBranch() {
            const branch_name = document.getElementById("branch_name").value;
            if (branch_name == "") {
                document.getElementById("branch_name").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกชื่อภาควิชา',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            const jsonData = {
                branch_name: branch_name,
                addBranch: true
            }
            const url = "./controller/BranchController.php";
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
                        title: 'เพิ่มภาควิชาสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        await getAllBranch(1).then(() => writeTable("#table-branch"));
                        $("#ModalAddBranch").modal('hide');
                        document.getElementById("branch_name").value = ""

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

        async function EditBranch() {
            const branch_id = document.getElementById("branch_id_edit").value;
            const branch_name = document.getElementById("branch_name_edit").value;
            if (branch_name == "") {
                document.getElementById("branch_name_edit").focus();
                Swal.fire({
                    position: 'top-center',
                    icon: 'info',
                    title: 'โปรดกรอกชื่อภาควิชา',
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
            }

            const jsonData = {
                branch_id: branch_id,
                branch_name: branch_name,
                EditBranch: true
            }
            const url = "./controller/BranchController.php";
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
                        title: 'แกไขข้อมูลภาควิชาสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(async () => {
                        await getAllBranch(1).then(() => writeTable("#table-branch"));
                        $("#ModalEditBranch").modal('hide');
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

        async function deleteBranch(branch_id) {
            Swal.fire({
                title: 'ต้องการลบภาควิชาหรือไม่ ?',
                text: 'หากลบ ภาควิชานี้จะหายไป',
                showCancelButton: true,
                confirmButtonText: 'ลบข้อมูล',
                confirmButtonColor: '#E91010',
                cancelButtonText: 'ยกเลิก',
                cancelButtonColor: '#B9B9B9'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const jsonData = {
                        branch_id: branch_id,
                        deleteBranch: true
                    }
                    const url = "./controller/BranchController.php";
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
                                title: 'ลบข้อมูลภาควิชาสำเร็จ',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(async () => {
                                await getAllBranch(1).then(() => writeTable("#table-branch"));
                            })
                        } else if (res.data == "can't delete branch") {
                            Swal.fire({
                                position: 'top-center',
                                icon: 'warning',
                                title: 'ไม่สามารถลบถาควิชาได้',
                                text: "เนื่องจากภาควิชานี้เชื่อมโยงกับข้อมูลอื่น",
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
    </script>
</body>

</html>