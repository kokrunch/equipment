<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
@import url("https://fonts.googleapis.com/css2?family=Mitr:wght@300&display=swap");

body {
    margin: 0;
    padding: 0;
    font-family: "Mitr", sans-serif;
}

.banner-area h2 {
    font-family: "Mitr", sans-serif;
    font-size: 65px;
    margin: 0 0 25px;
}

.banner-area {
    width: 100%;
    height: 100vh;
    background: url(https://images.pexels.com/photos/358528/pexels-photo-358528.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940);
    background-position: center;
    -webkit-background-size: cover;
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    font-size: 2vw;
    color: #fff;
}

.btn {
    text-decoration: none;
    padding: 10px 50px;
    color: #fff;
    border: 3px solid #fff;
    transition: 0.6s ease;
    animation: animate 2s 1;

    font-size: 15px;
    font-weight: 900;
}

.btn:hover {
    background-color: #fff;
    color: #000;
}

@keyframes animate {
    0% {
        transform: scale(0);
    }

    100% {
        transform: scale(1);
    }
}

h2 {
    animation: animate 2s 1;
}


@media (max-width: 600px) {


    .banner-area h2 {
        font-size: 28px;
    }
}
</style>

<body>
    <div class="banner-area">

        <h2>ยินดีต้อนรับ สู่ระบบจัดการวัสดุและครุภัณฑ์</h2>
        <a href="#" class="btn">เริ่มต้นใช้งาน</a>
    </div>

</body>

</html>