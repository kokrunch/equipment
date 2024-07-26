<?php include("component/checkSession.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("component/header.php"); ?>
</head>

<body>

  <?php include("component/navbar.php"); ?>

  <?php include("component/sidebar.php"); ?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1 class="my-4">หน้าหลัก</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item active">หน้าหลัก</li>
          <li class="breadcrumb-item"></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">รายการการเบิกวัสดุและครุภัณฑ์<h5>

                      <div class="d-flex align-items-center">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                          <i class="bi bi-cart"></i>
                        </div>
                        <div class="ps-3">
                          <h6 id="For_count_disburse"></h6>
                        </div>
                      </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">รายการแจ้งซ่อมทั้งหมด</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-tools"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="For_count_repair"></h6>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">จำนวนครุภัณฑ์ทั้งหมด</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-mac-fill"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="For_count_equipment"></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">จำนวนวัสดุทั้งหมด</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="ri-ball-pen-line"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="For_count_material"></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">จำนวนครุภัณฑ์ที่ใช้งานได้</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-check-lg"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="For_GoodEqu"></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">จำนวนครุภัณฑ์ที่ใช้งานไม่ได้</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-x-lg"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="For_BadEqu"></h6>
                    </div>
                  </div>

                </div>
              </div>

            </div>

            <div class="col-xxl-4 col-xl-12">

              <!-- <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">จำนวนผู้ใช้งานทั้งหมด</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6 id="For_Emp"></h6>
                    </div>
                  </div>

                </div>
              </div> -->

            </div>

          </div>
        </div><!-- End Left side columns -->

      </div>
    </section>

  </main><!-- End #main -->


  <!-- Vendor JS Files -->
  <?php include("component/script.php"); ?>

</body>

<script>
  $(document).ready(async function() {
    $('.example-for-Nice').select2();
    $('.example-multiple-for-Nice').select2();

    await CountDisburse();
    await CountRepair();
    await CountEquipment();
    await CountMaterial();
    await CountGoodEqu();
    await CountฺBadEqu();

  });

  async function CountDisburse() {
    const url = "./controller/AdminDashboardController.php?countDisburse=1";
    let CountData;
    await axios.get(url).then(function(res) {
      CountData = res.data;
    }).catch((err) => console.log(err))

    const Count_Disburse = document.getElementById("For_count_disburse");

    if (CountData[0].Count <= 0) {
      Count_Disburse.innerHTML = 'ไม่มีรายการ'
    } else {
      Count_Disburse.innerHTML = CountData[0].Count + ' รายการ';
    }
  }

  async function CountRepair() {
    const url = "./controller/AdminDashboardController.php?countRepair=1";
    let CountRepairData;
    await axios.get(url).then(function(res) {
      CountRepairData = res.data;
    }).catch((err) => console.log(err))

    const Count_Repair = document.getElementById("For_count_repair");

    if (CountRepairData[0].Count <= 0) {
      Count_Repair.innerHTML = 'ไม่มีรายการ'
    } else {
      Count_Repair.innerHTML = CountRepairData[0].Count + ' รายการ';
    }
  }

  async function CountEquipment() {
    const url = "./controller/AdminDashboardController.php?countEquipment=1";
    let CountEquipmentData;
    await axios.get(url).then(function(res) {
      CountEquipmentData = res.data;
    }).catch((err) => console.log(err))

    const Count_Equipment = document.getElementById("For_count_equipment");

    if (CountEquipmentData[0].Count <= 0) {
      Count_Equipment.innerHTML = 'ไม่มีรายการ'
    } else {
      Count_Equipment.innerHTML = CountEquipmentData[0].Count + ' รายการ';
    }

  }

  async function CountMaterial() {
    const url = "./controller/AdminDashboardController.php?countMaterial=1";
    let CountMaterialData;
    await axios.get(url).then(function(res) {
      CountMaterialData = res.data;
    }).catch((err) => console.log(err))

    const Count_Material = document.getElementById("For_count_material");

    if (CountMaterialData[0].Count <= 0) {
      Count_Material.innerHTML = 'ไม่มีรายการ'
    } else {
      Count_Material.innerHTML = CountMaterialData[0].Count + ' รายการ';
    }

  }

  async function CountGoodEqu() {
    const url = "./controller/AdminDashboardController.php?countGoodEqu=1";
    let CountGoodEqu;
    await axios.get(url).then(function(res) {
      CountGoodEqu = res.data;
    }).catch((err) => console.log(err))

    const Count_GoodEqu = document.getElementById("For_GoodEqu");

    if (CountGoodEqu[0].Count <= 0) {
      Count_GoodEqu.innerHTML = 'ไม่มีรายการ'
    } else {
      Count_GoodEqu.innerHTML = CountGoodEqu[0].Count + ' รายการ';
    }

  }

  async function CountฺBadEqu() {
    const url = "./controller/AdminDashboardController.php?countBadEqu=1";
    let CountBadEqu;
    await axios.get(url).then(function(res) {
      CountBadEqu = res.data;
    }).catch((err) => console.log(err))

    const Count_BadEqu = document.getElementById("For_BadEqu");

    if (CountBadEqu[0].Count <= 0) {
      Count_BadEqu.innerHTML = 'ไม่มีรายการ'
    } else {
      Count_BadEqu.innerHTML = CountBadEqu[0].Count + ' รายการ';
    }

  }

  // async function CountฺEmp() {
  //   const url = "./controller/AdminDashboardController.php?countEmp=1";
  //   let CountEmp;
  //   await axios.get(url).then(function(res) {
  //     CountEmp = res.data;
  //   }).catch((err) => console.log(err))

  //   const Count_Emp = document.getElementById("For_Emp");

  //   if (CountEmp[0].Count <= 0) {
  //     Count_Emp.innerHTML = 'ไม่มีรายการ'
  //   } else {
  //     Count_Emp.innerHTML = CountEmp[0].Count + ' คน';
  //   }

  // }
</script>

</html>