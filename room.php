<?php include("component/checkSession.php"); ?>
<?php include("component/roleAdmin.php  "); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("component/header.php"); ?>
    <title>it-equipment-system</title>
</head>

<body>

    <?php include("component/navbar.php"); ?>

    <?php include("component/sidebar.php"); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>จัดการข้อมูลห้องภายในคณะ</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="admin_dashboard.php">หน้าหลัก</a></li>
                    <li class="breadcrumb-item active">ห้องภายในคณะ</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">จัดการข้อมูลห้องภายในคณะ </h5>
                            <div class="d-flex justify-content-start">
                                <button type="button" class="btn btn-outline-primary rounded mb-3" data-bs-toggle="modal" data-bs-target="#addModalRoom">
                                    <i class="bx bx-plus"></i> เพิ่มข้อมูลห้อง
                                </button>
                            </div>
                            <!-- <div class="card w-10 text-center"> -->
                            <div class="card-body">
                                <h5 class="card-title text-center" id="floor">ชั้น G</h5>
                                <div class="row d-flex justify-content-center">
                                    <div class="row col-md-3 col-xs-12">
                                        <select class="form-select" onchange="selectFloor()" id="select_floor">
                                            <option value="G" selected>ชั้น G</option>
                                            <option value="2">ชั้น 2</option>
                                            <option value="3">ชั้น 3</option>
                                            <option value="4">ชั้น 4</option>
                                            <option value="5">ชั้น 5</option>
                                            <option value="99">อื่นๆ</option>
                                        </select>
                                        <hr style="clear: both; visibility: hidden;">
                                    </div>
                                    <div class="row col-md-3 col-xs-12">
                                        <div class="input-group rounded">
                                            <input type="search" class="form-control rounded" placeholder="ค้นหาห้อง" aria-label="Search" aria-describedby="search-addon" onkeyup="searchRoom(this.value)" />
                                            <span class="input-group-text border-0" id="search-addon">
                                                <i class='bx bx-search-alt-2'></i>
                                            </span>
                                        </div>
                                        <hr style="clear: both; visibility: hidden;">
                                    </div>
                                </div>
                                <div class="row col-12" id="div-room"></div>
                            </div>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
        </section>

        <!-- Add data -->
        <div class="modal fade" id="addModalRoom" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">เพิ่มข้อมูลห้อง</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    เลือกชั้น</label>
                                <select class="form-select" id="room_floor" onchange="slect_floor_for_add()">
                                    <option value="0" selected disabled>กรุณาเลือกชั้น</option>
                                    <option value="G">ชั้น G</option>
                                    <option value="2">ชั้น 2</option>
                                    <option value="3">ชั้น 3</option>
                                    <option value="4">ชั้น 4</option>
                                    <option value="5">ชั้น 5</option>
                                    <option value="99">อื่นๆ</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    หมายเลขห้อง</label>
                                <input type="text" class="form-control" id="room_name" placeholder="กรอกหมายเลขห้อง">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    รายละเอียดห้อง</label>
                                <input type="text" class="form-control" id="room_detail" placeholder="กรอกรายละเอียดห้อง">
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="addRoom()" class="btn btn-primary">เพิ่มข้อมูล</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit data -->
        <div class="modal fade" id="editModalRoom" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลห้อง</h5>
                        <input type="hidden" id="room_id_edit">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3 mb-2">
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    เลือกชั้น</label>
                                <select class="form-select" id="room_floor_edit">
                                    <option value="0" selected disabled>กรุณาเลือกชั้น</option>
                                    <option value="G">ชั้น G</option>
                                    <option value="2">ชั้น 2</option>
                                    <option value="3">ชั้น 3</option>
                                    <option value="4">ชั้น 4</option>
                                    <option value="5">ชั้น 5</option>
                                    <option value="99">อื่นๆ</option>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    หมายเลขห้อง</label>
                                <input type="text" class="form-control" id="room_name_edit" placeholder="กรอกหมายเลขห้อง">
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="" class="form-label"><span class="text-danger">*</span>
                                    รายละเอียดห้อง</label>
                                <input type="text" class="form-control" id="room_detail_edit" placeholder="กรอกรายละเอียดห้อง">
                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="button" onclick="UpdateRoom()" class="btn btn-primary">บันทึกข้อมูล</button>
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

</html>
<script>
    $(document).ready(async function() {

        await getRoom()

    });

    async function addRoom() {
        let room_floor = document.getElementById("room_floor").value;
        let room_name = document.getElementById("room_name").value;
        let room_detail = document.getElementById("room_detail").value;

        if (room_floor == 0 || !room_name) {
            Swal.fire({
                position: 'top-center',
                icon: 'warning',
                title: 'กรุณากรอกข้อมูลให้ครบถ้วน',
                showConfirmButton: true
            })
        } else {
            let JsonData = {
                'addRoom': 'addRoom',
                'room_name': room_name,
                'room_floor': room_floor,
                'room_detail': room_detail
            }

            const url = "./controller/RoomController.php";
            await axios({
                method: 'post',
                url: url,
                data: JsonData,
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
            }).then((res) => {
                if (res.data == 1) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'เพิ่มข้อมูลห้องสำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $("#addModalRoom").modal('hide');
                        document.getElementById("room_floor").selectedIndex = 0;
                        document.getElementById("room_detail").value = "";
                        document.getElementById("room_name").value = "";
                        getRoom()
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
    }

    async function getRoom() {
        const url = "./controller/RoomController.php?getRoom=1";
        let roomData;
        await axios.get(url).then(function(response) {
            roomData = response.data;
        }).catch((err) => console.log(err));

        const bodyroom = document.getElementById("div-room");

        bodyroom.innerHTML = "";
        roomData.forEach((element, index) => {
            bodyroom.innerHTML += `
                            <div class="col-lg-3 col-md-3">
                                <div class="card" style="width: 15rem;" >
                                        <div class="card-body">
                                            <h5 class="card-title">ห้อง : ${element.room_name}</h5>
                                            <p class="text-black"><small>${element.room_detail}</small></p>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-outline-success" style="margin:5px"
                                                        onclick="detail(${element.room_id})">
                                                        <i class='bx bx-search'></i></button>
                                                <button type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal" data-bs-target="#editModalRoom" style="margin:5px"
                                                        data-Room='${JSON.stringify(element)}' onclick="EditRoom(this)">
                                                        <i class="bx bxs-edit"></i></button>
                                                <button type="button" class="btn btn-outline-danger" 
                                                        style="margin:5px" onclick="delRoom(${element.room_id})"> 
                                                        <i class="bx bxs-trash"></i></button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
        `
        });


    }

    async function selectFloor(room_floor) {

        $("[data-toggle='tooltip']").tooltip('dispose');

        let floor = document.getElementById("select_floor").value;
        if (floor == 99) {
            document.getElementById("floor").innerHTML = "อื่นๆ";
        } else {
            document.getElementById("floor").innerHTML = "ชั้น " + floor;
        }

        let url = "./controller/RoomController.php?getRoomByFloor=" + floor;

        let roomData;
        let RoomLength;
        await axios.get(url).then(function(response) {
            roomData = response.data;
            RoomLength = response.data.length;

            if (RoomLength < 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'ไม่มีข้อมูลห้องในชั้นนี้ !!',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        }).catch((err) => console.log(err));

        const bodyroom = document.getElementById("div-room");
        bodyroom.innerHTML = "";
        roomData.forEach((element, index) => {
            bodyroom.innerHTML += `
                            <div class="col-lg-3 col-md-3">
                                <div class="card" style="width: 15rem;" >
                                        <div class="card-body">
                                            <h5 class="card-title">ห้อง : ${element.room_name}</h5>
                                            <p class="text-black"><small>${element.room_detail}</small></p>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-outline-success" style="margin:5px"
                                                        onclick="detail(${element.room_id})">
                                                        <i class='bx bx-search'></i></button>
                                                <button type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal" data-bs-target="#editModalRoom" style="margin:5px"
                                                        data-Room='${JSON.stringify(element)}' onclick="EditRoom(this)">
                                                        <i class="bx bxs-edit"></i></button>
                                                <button type="button" class="btn btn-outline-danger" 
                                                        style="margin:5px" onclick="delRoom(${element.room_id})"> 
                                                        <i class="bx bxs-trash"></i></button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
        `
        });

    }

    async function slect_floor_for_add() {
        let floor = document.getElementById("room_floor").value;
        if (floor == 'G') {
            document.getElementById("room_name").value = 1;
        } else if (floor == 99) {
            document.getElementById("room_name").value = "";
        } else {
            document.getElementById("room_name").value = floor;
        }

    }

    async function EditRoom(data) {
        let JsonData = data.getAttribute("data-Room")
        const jsonParseData = JSON.parse(JsonData)

        document.getElementById("room_id_edit").value = jsonParseData.room_id;
        document.getElementById("room_name_edit").value = jsonParseData.room_name;
        document.getElementById("room_detail_edit").value = jsonParseData.room_detail;
        document.getElementById("room_floor_edit").value = jsonParseData.room_floor;

    }

    async function UpdateRoom(data) {

        let room_id = document.getElementById("room_id_edit").value;
        let room_name = document.getElementById("room_name_edit").value;
        let room_detail = document.getElementById("room_detail_edit").value;
        let room_floor = document.getElementById("room_floor_edit").value;

        let JsonData = {
            'updateRoom': 'updateRoom',
            'room_id': room_id,
            'room_floor': room_floor,
            'room_name': room_name,
            'room_detail': room_detail,
        }

        const url = "./controller/RoomController.php";
        await axios({
            method: 'post',
            url: url,
            data: JsonData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        }).then((res) => {
            if (res.data == 1) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: 'แก้ไขข้อมูลห้องสำเร็จ',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    $("#editModalRoom").modal('hide');
                    let floor = document.getElementById("select_floor").value;
                    selectFloor(floor)
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

    async function delRoom(room_id) {
        const url = "./controller/RoomController.php?delRoom=" + room_id;
        Swal.fire({
            title: 'ยืนยันการลบห้อง !!',
            text: "ต้องการลบห้องใช่หรือไม่ ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยันการลบ',
            cancelButtonText: 'ยกเลิก'
        }).then(async (result) => {
            if (result.isConfirmed) {
                await axios.get(url).then(function(res) {
                    let response = res.data;
                    if (response == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ลบข้อมูลห้องฑ์สำเร็จ !!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        document.getElementById("select_floor").selectedIndex = 0;
                        document.getElementById("floor").innerHTML = "ชั้น" + " G";

                        getRoom();
                    } else if (response == 2) {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบข้อมูลห้องไม่สำเร็จ !!',
                            text: 'เนื่องจากมีวัสดุ ครุภัณฑ์ ภายในห้อง',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'ลบข้อมูลห้องไม่สำเร็จ !!',
                            showConfirmButton: false,
                            timer: 3000
                        })
                    }
                }).catch((err) => console.log(err))
            } else {

            }

        })
    }

    async function searchRoom(key) {
        let floor = document.getElementById("select_floor").value;
        let roomData;

        let JsonData = {
            'searchRoom': 'searchRoom',
            'room_floor': floor,
            'room_name': key
        }


        const url = "./controller/RoomController.php";
        await axios({
            method: 'post',
            url: url,
            data: JsonData,
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
        }).then((res) => {
            roomData = res.data;

            console.log(roomData.length);

            const bodyroom = document.getElementById("div-room");
            bodyroom.innerHTML = "";

            if (roomData.length == 0) {
                bodyroom.innerHTML = `
                            <div class="col-lg-3 col-md-3">
                                <div class="card" style="width: 15rem;" >
                                    <div class="card-body">
                                        <h5 class="card-title">ไม่มีข้อมูลห้อง</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                `
            }

            roomData.forEach((element, index) => {
                bodyroom.innerHTML += `
                            <div class="col-lg-3 col-md-3">
                                <div class="card" style="width: 15rem;" >
                                <a href="details_equipment_material?room_id=${element.room_id}" >
                                        <div class="card-body">
                                            <h5 class="card-title">ห้อง : ${element.room_name}</h5>
                                            <p class="text-black"><small>${element.room_detail}</small></p>
                                            <div class="d-flex justify-content-end">
                                                <button type="button" class="btn btn-outline-success" style="margin:5px"
                                                        onclick="detail(${element.room_id})">
                                                        <i class='bx bx-search'></i></button>
                                                <button type="button" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal" data-bs-target="#editModalRoom" style="margin:5px"
                                                        data-Room='${JSON.stringify(element)}' onclick="EditRoom(this)">
                                                        <i class="bx bxs-edit"></i></button>
                                                <button type="button" class="btn btn-outline-danger" 
                                                        style="margin:5px" onclick="delRoom(${element.room_id})"> 
                                                        <i class="bx bxs-trash"></i></button>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                `

            });

        })
    }

    async function detail(room_id) {
        let url = './details_equipment_material.php?room_id=' + room_id;
        location.href = url;
    }
</script>