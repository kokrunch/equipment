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
      <h1>รายการที่ขอยืมครุภัณฑ์</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="dashboard_emp.php">หน้าหลัก</a></li>
          <li class="breadcrumb-item active">รายการที่ขอยืมครุภัณฑ์</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">ตารางรายการยืมครุภัณฑ์</h5>

              <!--div class="row">
                <div class="col-md-3" style="padding-left: 33px;">
                  <span>เลือกสถานะเพื่อดูรายการ</span><select onchange="Status(value)" id="Status_select" class="form-select">
                    <option selected value="รออนุมัติ">รออนุมัติ</option>
                    <option value="อนุมัติแล้ว">อนุมัติแล้ว</option>
                    <option value="ไม่ผ่านอนุมัติ">ไม่ผ่านอนุมัติ</option>
                  </select>
                </div>
              </div-->
              <div class="row">
                <div class="d-flex justify-content-end">
                  <div class="col-6 col-ml-12">
                    <div class="d-flex justify-content-end">
                      <button type="button" class="btn btn-primary" style="margin: 5px;" onclick="FilterStatus('รออนุมัติ')">รออนุมัติ</button>
                      <button type="button" class="btn btn-success" style="margin: 5px;" onclick="FilterStatus('อนุมัติแล้ว')">อนุมัติแล้ว</button>
                      <button type="button" class="btn btn-danger" style="margin: 5px;" onclick="FilterStatus('ไม่ผ่านอนุมัติ')">ไม่ผ่านอนุมัติ</button>
                    </div>
                  </div>
                </div>
              </div>
              <br>
              <div class="table-responsive">
                <table id="table-borrowlist" class="text-center" style="width: 100%;">
                  <thead>
                    <tr>
                      <th class="text-center">ลำดับ</th>
                      <th class="text-center">ชื่อครุภัณฑ์</th>
                      <th class="text-center">จำนวน</th>
                      <th class="text-center">วันที่ยื่นรายการยืม</th>
                      <th class="text-center">รายละเอียด</th>
                      <th class="text-center">สถานะ</th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>

                  <tbody id="borrow-list">

                  </tbody>
                  <input type="hidden" id="room_desc_equ_id">

                </table>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- modal view detail -->
    <div class="modal fade" id="ModalBorrowEquDetail" tabindex="-1" aria-labelledby="ModalBorrowEquDetailLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">รายละเอียดการยืมครุภัณฑ์</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3 mb-2">
              <input type="hidden" class="form-control" id="mat_id">
              <div class="col-12 col-md-3">
                <label for="" class="form-label">
                  รหัสครุภัณฑ์</label>
                <input type="text" class="form-control" id="equ_id" disabled>
              </div>
              <div class="col-12 col-md-6">
                <label for="" class="form-label">
                  ชื่อครุภัณฑ์</label>
                <input type="text" class="form-control" id="equ_name" disabled>
              </div>
              <div class="col-12 col-md-3">
                <label for="" class="form-label">
                  จำนวน</label>
                <input type="text" class="form-control" id="borrow_quantity" disabled>
              </div>
            </div>
            <div class="row g-3 mb-2">
              <div class="col-12 col-md-6">
                <label for="" class="form-label">
                  วันที่ยืม</label>
                <input type="text" class="form-control" id="date_borrow" disabled>
              </div>
              <div class="col-12 col-md-6">
                <label for="" class="form-label">
                  วันส่งคืน</label>
                <input type="text" class="form-control" id="date_return_borrow" disabled>
              </div>
            </div>
            <div class="row g-3 mb-2">
              <div class="col-12 col-md-12">
                <label for="" class="form-label">
                  สถานที่ที่ใช้งาน</label>
                <input type="text" class="form-control" id="br_use_to" disabled>
              </div>
            </div>
            <div class="row g-3 mb-2">

              <div class="col-12">
                <label for="" class="form-label">
                  รายละเอียดการยืม</label>
                <textarea class="form-control" id="desc_borrow" disabled></textarea>
              </div>

            </div>
          </div>
          <div class=" modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          </div>

        </div>
      </div>
    </div>

    <div class="modal fade" id="ModalNotAppproveDetail" tabindex="-1" aria-labelledby="ModalNotAppproveDetail" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">เหตุผลที่ไม่อนุมัติ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row g-3 mb-2">
              <div class="col-12">
                <textarea class="form-control" id="desc_NotApprove" disabled></textarea>
              </div>

            </div>
          </div>
          <div class=" modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
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

      await getBorrowList(0).then(() => writeTable("#table-borrowlist"));


    }); //end ready function

    async function getBorrowList(reload, status) {
      let url;
      if (status != null) {
        url = "./controller/BorrowEquController.php?getBorrowlist=1&status=" + status;
      } else {
        url = "./controller/BorrowEquController.php?getBorrowlist=1&status=0";
      }
      let ListData;
      await axios.get(url).then(function(response) {
        ListData = response.data;
      }).catch((err) => console.log(err));

      const bodyList = document.getElementById("borrow-list");

      if (reload == 1) {
        $("#table-borrowlist").DataTable().destroy();
      }
      bodyList.innerHTML = "";
      ListData.forEach((element, i) => {
        bodyList.innerHTML += `
                <tr>
                    <td>${i+1}</td>
                    <td>${element.equ_name}</td>
                    <td>${element.borrow_quantity}</td>
                    <td style="width:15%" class="text-center">${FormatToThaiDate(element.create_date)}</td>
                    <td style="width:15%">
                                          <button type="button" class="btn btn-outline-warning"
                                                data-jsonBorrow='${JSON.stringify(element)}'
                                                onClick="viewBorrowEquDetail(this);"><i class="bx bx-detail"></i></button>
                                        </td>
                    <td class=" text-center">
                    ${
                        element.borrow_approve_status == 'รออนุมัติ' ? `<span class="badge bg-info">${element.borrow_approve_status}</span>` :
                        element.borrow_approve_status == 'อนุมัติแล้ว' ? `<span class="badge bg-success">${element.borrow_approve_status}</span>` :
                        `<span class="badge bg-danger">${element.borrow_approve_status}</span>`
                    }</td>
                    <td>
                    ${
                      element.borrow_approve_status == 'รออนุมัติ' ? 
                        `<button type="button" class="btn btn-outline-danger" data-JsonCancle='${JSON.stringify(element)}' onclick="CancleBorrow(this)">
                            ยกเลิก
                        </button>` : 
                        element.borrow_approve_status == 'ไม่ผ่านอนุมัติ' ?
                        `<button type="button" class="btn btn-outline-primary" data-JsonNotApprove='${JSON.stringify(element)}' onclick="NotApproveDetail(this)">
                            เหตุผลที่ไม่อนุมัติ
                        </button>` : 
                      ` `
                    }
                    </td>
                </tr>
                `
      });

    }

     async function FilterStatus(status) {
       await getBorrowList(1, status).then(async () => writeTable("#table-borrowlist"));

     }

   /* async function Status(status) {
	console.log(status);
      await getBorrowList(1, status).then(async () => writeTable("#table-borrowlist"));
    }*/

    async function viewBorrowEquDetail(data) {

      $("#ModalBorrowEquDetail").modal("show");
      const jsonStrData = data.getAttribute("data-jsonBorrow")
      const jsonParseData = JSON.parse(jsonStrData)

      document.getElementById("equ_id").value = jsonParseData.equipment_id;
      document.getElementById("equ_name").value = jsonParseData.equ_name;
      document.getElementById("borrow_quantity").value = jsonParseData.borrow_quantity;
      document.getElementById("date_borrow").value = FormatToThaiDate(jsonParseData.borrow_date);
      document.getElementById("date_return_borrow").value = FormatToThaiDate(jsonParseData.borrow_return_date);
      document.getElementById("desc_borrow").value = jsonParseData.borrow_description;
      document.getElementById("room_desc_equ_id").value = jsonParseData.room_desc_equ_id;

      if (jsonParseData.br_use_to != null) {
        document.getElementById("br_use_to").value = jsonParseData.br_use_to
      } else {
        document.getElementById("br_use_to").value = "IT " + jsonParseData.room_name
      }
    }

    async function NotApproveDetail(data) {

      $("#ModalNotAppproveDetail").modal("show");
      const jsonStrData = data.getAttribute("data-JsonNotApprove")
      const jsonParseData = JSON.parse(jsonStrData)

      document.getElementById("equ_id").value = jsonParseData.equipment_id;
      document.getElementById("desc_NotApprove").value = jsonParseData.borrow_notapprove;

    }

    async function CancleBorrow(btn) {

      const jsonStrData = btn.getAttribute("data-JsonCancle")
      const jsonParseData = JSON.parse(jsonStrData)

      let equ_id = jsonParseData.equ_id
      let borrow_quantity = jsonParseData.borrow_quantity;
      let borrow_id = jsonParseData.borrow_id;
      let room_desc_equ_id = jsonParseData.room_desc_equ_id;

      const url = "./controller/BorrowEquController.php";

      const jsondata = {
        cancelBorrow: 'cancelBorrow',
        borrow_id: borrow_id,
        borrow_quantity: borrow_quantity,
        room_desc_equ_id: room_desc_equ_id,
        equ_id: equ_id
      }

      Swal.fire({
        title: 'ยืนยันการยกเลิกการยืมครุภัณฑ์',
        text: "ต้องการยกเลิกใช่หรือไม่ ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ยืนยันการยกเลิกการยืม',
        cancelButtonText: 'ยกเลิก'
      }).then(async (result) => {
        if (result.isConfirmed) {
          await axios({
            method: 'post',
            url: url,
            data: jsondata,
            headers: {
              'Content-Type': 'application/x-www-form-urlencoded'
            },
          }).then((res) => {
            let response = res.data;
            if (response == 1) {
              Swal.fire({
                icon: 'success',
                title: 'ยกเลิกการยืมครุภัณฑ์สำเร็จ',
                showConfirmButton: false,
                timer: 1500
              }).then(async () => {
                await getBorrowList(1).then(() => writeTable("#table-borrowlist"));
              });
            } else {
              Swal.fire({
                icon: 'warning',
                title: 'ยกเลิกการยืมครุภัณฑ์ไม่สำเร็จ',
                showConfirmButton: false,
                timer: 1500
              });
            }
          })

        } else {

        }

      })


    }
  </script>

</body>

</html>