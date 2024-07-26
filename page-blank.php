<?php include("component/checkSession.php"); ?>
<?php //include("component/roleAdmin.php  "); 
?>

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
      <h1>Blank Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Example Card</h5>
              <p>เขียนภายในนี้</p>
              <label for="" class="form-label"><span class="text-danger">*</span> ประเภทครุภัณฑ์</label>
              <select class="form-select" id="equ_type_id_edit">
                <option selected value="0">เลือกครุภัณฑ์</option>
              </select>
              <br>

              <!-- autocomplete -->
              <div class="autocomplete" style="width:300px;">
                <input type="text" id="mat_name" class="form-control">
                <input type="hidden" id="mat_id" class="form-control">
              </div>

              <button onclick="onBtn()">click</button>
              <br><br>
              <div class="test-time">
                <div class="container">
                  <div class="row">
                    <div class="col">
                      <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                        <div class="timeline-step">
                          <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                            <div class="inner-circle">
                              <img src="assets/img/timeline1.png" width="50px">
                            </div>
                            <p class="h6 text-muted mb-0 mb-lg-0"><strong class="text-primary">กำลังดำเนินการซ่อม</strong></p>
                          </div>
                        </div>
                        <div class="timeline-step">
                          <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                            <div class="inner-circle">
                              <img src="assets/img/timeline2.png" width="50px" class="img-gray">
                            </div>
                            <p class="h6 text-muted mb-0 mb-lg-0"><strong class="text-secondary">กำลังซ่อม</strong></p>
                          </div>
                        </div>
                        <div class="timeline-step">
                          <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                            <div class="inner-circle">
                              <img src="assets/img/timeline3.png" width="53px" class="img-gray">
                            </div>
                            <p class="h6 text-muted mb-0 mb-lg-0"><strong class="text-secondary">กำลังส่งซ่อม</strong></p>
                          </div>
                        </div>
                        <div class="timeline-step">
                          <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                            <div class="inner-circle">
                              <img src="assets/img/timeline4.png" width="50px" class="img-gray">
                            </div>
                            <p class="h6 text-muted mb-0 mb-lg-0"><strong class="text-secondary">เสร็จการซ่อม</strong></p>
                          </div>
                        </div>
                      </div>
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

  <script>
    const onBtn = () => {
      console.log(document.getElementById("mat_id").value)
    }
    $(document).ready(async function() {
      $('.example-for-Nice').select2();

      autocomplete(document.getElementById("mat_name"), document.getElementById("mat_id"), nameTh, onBtn);
    }); //end ready function
  </script>

  <script>
    const nameTh = [{
        "id": 1,
        "name": "สมชาย ไชยานนท์"
      },
      {
        "id": 2,
        "name": "สมหญิง ดาวิกาล"
      },
      {
        "id": 3,
        "name": "ภัทรพล จันทร์โอชา"
      },
      {
        "id": 4,
        "name": "สุภาภรณ์ เจริญกิจ"
      },
      {
        "id": 5,
        "name": "ธนพล วิโรจน์ภาคย์"
      },
      {
        "id": 6,
        "name": "สุริยา จันทร์เจริญ"
      },
      {
        "id": 7,
        "name": "สมหญิง มีสุข"
      },
      {
        "id": 8,
        "name": "ปิยะพงษ์ เจริญสุข"
      },
      {
        "id": 9,
        "name": "ธัชพล บุญเรือง"
      },
      {
        "id": 10,
        "name": "สุริยา สุขสวัสดิ์"
      },
      {
        "id": 11,
        "name": "สมชาย จันทร์สุข"
      },
      {
        "id": 12,
        "name": "ปิยะภัทร สุขสวัสดิ์"
      },
      {
        "id": 13,
        "name": "สมหญิง จันทร์เจริญ"
      },
      {
        "id": 14,
        "name": "สุภาพร สุขสวัสดิ์"
      },
      {
        "id": 15,
        "name": "น๊อต โต๊ะคุง"

      }, {
        "id": 16,
        "name": "สุริยา จันทร์สุข"
      },
      {
        "id": 17,
        "name": "ประภา ดวงการ"
      },
      {
        "id": 18,
        "name": "จิตรา สุขภาพ"
      },
      {
        "id": 19,
        "name": "ศิรินทร์ สุขสันต์"
      },
      {
        "id": 20,
        "name": "ธนพล สุขสวัสดิ์"
      },
      {
        "id": 21,
        "name": "ภัทรวรรณ วิเศษภาคย์"
      },
      {
        "id": 22,
        "name": "สมหญิง สุขภาพ"
      },
      {
        "id": 23,
        "name": "สุภาพร จันทร์สุข"
      },
      {
        "id": 24,
        "name": "ธนพล สุขสันต์"
      },
      {
        "id": 25,
        "name": "ภัทรพล สุขภาพ"
      },
      {
        "id": 26,
        "name": "สุภาภรณ์ สุขสันต์"
      },
      {
        "id": 27,
        "name": "สุริยา สุขภาพ"
      },
      {
        "id": 28,
        "name": "ปิยะภัทร สุขสันต์"
      },
      {
        "id": 29,
        "name": "สุภาพร จันทร์เจริญ"
      },
      {
        "id": 30,
        "name": "ธัชพล สุขสวัสด"
      }
    ];
    // const colors = [{
    //   "id": 1,
    //   "name": "John Smith"
    // }, {
    //   "id": 2,
    //   "name": "Jane Doe"
    // }, {
    //   "id": 3,
    //   "name": "Bob Johnson"
    // }, {
    //   "id": 4,
    //   "name": "Emily Davis"
    // }, {
    //   "id": 5,
    //   "name": "Michael Brown"
    // }, {
    //   "id": 6,
    //   "name": "Sarah Miller"
    // }, {
    //   "id": 7,
    //   "name": "David Garcia"
    // }, {
    //   "id": 8,
    //   "name": "Jessica Rodriguez"
    // }, {
    //   "id": 9,
    //   "name": "Richard Wilson"
    // }, {
    //   "id": 10,
    //   "name": "Ashley Martinez"
    // }, {
    //   "id": 11,
    //   "name": "Matthew Anderson"
    // }, {
    //   "id": 12,
    //   "name": "Joshua Thompson"
    // }, {
    //   "id": 13,
    //   "name": "Amanda Gomez"
    // }, {
    //   "id": 14,
    //   "name": "Daniel Martinez"
    // }, {
    //   "id": 15,
    //   "name": "Edward Taylor"
    // }, {
    //   "id": 16,
    //   "name": "Melissa Hernandez"
    // }, {
    //   "id": 17,
    //   "name": "Brian Moore"
    // }, {
    //   "id": 18,
    //   "name": "Kevin Martin"
    // }, {
    //   "id": 19,
    //   "name": "Jason Lee"
    // }, {
    //   "id": 20,
    //   "name": "Laura Perez"
    // }, {
    //   "id": 21,
    //   "name": "William Thompson"
    // }, {
    //   "id": 22,
    //   "name": "Lauren Harris"
    // }, {
    //   "id": 23,
    //   "name": "Matthew Young"
    // }, {
    //   "id": 24,
    //   "name": "Jacob Allen"
    // }, {
    //   "id": 25,
    //   "name": "Nicholas King"
    // }, {
    //   "id": 26,
    //   "name": "Samantha Wright"
    // }, {
    //   "id": 27,
    //   "name": "George Lopez"
    // }, {
    //   "id": 28,
    //   "name": "Ashley Scott"
    // }, {
    //   "id": 29,
    //   "name": "Brandon Green"
    // }, {
    //   "id": 30,
    //   "name": "Frank Lewis"
    // }]
  </script>
</body>

</html>