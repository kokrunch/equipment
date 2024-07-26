<div class="card-body">
    <div class="row ">
        <div class="col-md-4">
            <span>ค้นหาตามวัน</span><input type="date" class="form-control" id="daySelect">
        </div>
        <div class="col-md-4">
            <span>ค้นหาตามเดือน</span><input type="month" class="form-control" id="monthSelect">
        </div>
        <div class="col-md-4">
            <span>ค้นหาตามปี</span><select id="yearSelect" name="yearSelect" class="form-select">
            <option selected value="" disabled>เลือกปี</option>
            </select>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <span>เริ่ม</span><input type="date" class="form-control" id="Firt_date">
        </div>
        <div class="col-md-4">
            <span>ถึง</span><input type="date" class="form-control" id="End_date">
        </div>
        <div class="col-md-4" style="padding-top: 24px;">
            <button class="btn btn-outline-primary">
                <i class='bx bx-search'></i>
                ค้นหา
            </button>
        </div>
    </div>
</div>

<script>
    var currentYear = new Date().getFullYear();
    var yearSelect = document.getElementById("yearSelect");

    for (var i = currentYear + 543; i >= currentYear + 543 -10; i--) {
        var option = document.createElement("option");
        option.value = i;
        option.text = i;
        yearSelect.add(option);
    }

</script>