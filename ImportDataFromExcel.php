<html>

<body>
    <div id="wrapper">
        <form method="post" action="../it-equipment-system/controller/ImportExcelController.php?submit_file=1" enctype="multipart/form-data">
            <input type="file" name="file_csv" />
            <input type="submit" name="submit_file" value="Submit" />
            <!-- <button class="btn btn-primary w-100" name="login" onclick="ImportData()">นำเข้าข้อมูล</button> -->
        </form>
    </div>
</body>
<script>
    async function ImportData() {
        let file = document.getElementById("file_csv").files;

        var formData = new FormData();
        formData.append("file", file);
        formData.append("submit_file", 1);

        console.log(formData)
        var xhttp = new XMLHttpRequest();
        const url = "./controller/ImportExcelController.php";
        // Set POST method and ajax file path
        xhttp.open("POST", url, true);

        // call on request changes state
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                var response = this.responseText;
                console.log("=>>", response)
                if (response == 1) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: 'สำเร็จ',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        alert()
                    })
                } else {

                }
            }
        };

        // Send request with data
        xhttp.send(formData);
    }
</script>

</html>