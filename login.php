<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
</head>
<body>

<style>
.box {
    border: 1px solid rgb(180, 180, 180);
    width: 90%;
    margin-left: auto;
    margin-right: auto;
    padding-top: 20px;
    padding-bottom: 20px;
    padding-left: 20px;
    padding-right: 20px;
    position: relative;
}

.center {
    text-align: center;
    
}

table tr td{
    /*border: 1px solid black;*/
    padding: 8PX;
}

.buttonbg-green {
    background-color:#009860;
    color: white;
    padding: 6px 10px; /*ระยะห่างของขอบปุ่มและข้อความภายใน*/
    text-align: center; /*การจัดวางข้อความในปุ่ม (ตรงกลาง)*/
    text-decoration: none; /*การจัดรูปแบบข้อความ (ไม่มีขีดเส้นใต้)*/
    display: inline-block; /*การแสดงผลเป็น inline-block*/
    font-size: 16px; /*ขนาดตัวอักษร*/
    margin: 2px 2px; /*ระยะห่างรอบขอบปุ่ม*/
    border-radius: 6px; /*ขอบมน*/
    border: 0px;
}

.buttonbg-gray {
    background-color:gray;
    color: white;
    padding: 6px 10px; /*ระยะห่างของขอบปุ่มและข้อความภายใน*/
    text-align: center; /*การจัดวางข้อความในปุ่ม (ตรงกลาง)*/
    text-decoration: none; /*การจัดรูปแบบข้อความ (ไม่มีขีดเส้นใต้)*/
    display: inline-block; /*การแสดงผลเป็น inline-block*/
    font-size: 16px; /*ขนาดตัวอักษร*/
    margin: 2px 2px; /*ระยะห่างรอบขอบปุ่ม*/
    border-radius: 6px; /*ขอบมน*/
    border: 0px;
}

th, td {
        /*font-size: 12px;*/
    
    }
</style>

    <!-- Banner Section -->
<section class="banner">
    <div class="banner-logo">
        <img src="image/Logo.png" alt="Logo">
    </div>
</section>

    <br>

    <div class="container">
        <div class="box">
            <h1 class="display-5 text-center">Login</h1>

            <!-- Move form tags to wrap around the entire content -->
            <form method="POST" action="login_check.php">
                <table style="width:100%;margin-top:20px;">
                    <thead></thead>
                    <tbody>
                        <tr>
                            <td style="width:30%;">
                                <label>ID Employee</label>
                            </td>
                            <td style="width:70%">
                                <input type="text" name="username" class="form-control" required>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:30%">
                                <label>Password</label>
                            </td>
                            <td style="width:70%">
                                <input type="password" name="password" class="form-control">
                            </td>
                        </tr>

                    </tbody>
                </table>

                <?php
                    // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
                if(isset($_SESSION["Error"])) {
                    echo $_SESSION["Error"];
                    // หลังจากแสดงข้อความแล้วให้ล้างค่าทิ้ง
                    unset($_SESSION["Error"]);
                }
                ?>

                <div class="center" style="margin-top:10px;">
                    <input type="submit" name="submit" class="buttonbg-green" value="Login">
                    <p class="text-center" style="margin-top:5px;">or <a href="register.php"> Register </a></p>
                </div>
            </form>
        </div>
    </div>


</body>
</html>
