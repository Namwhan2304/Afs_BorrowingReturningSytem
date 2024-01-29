<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="login.css"> 
</head>
<body>

<!------------------------เชื่อมกับฐานข้อมูล-------------------------->
<?php
include 'condb.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
?>

<?php
// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ตรวจสอบว่ามีค่าที่ส่งมาจริง ๆ หรือไม่
    if(isset($_POST["idem"]) && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["phone"]) && isset($_POST["username"]) && isset($_POST["password"])) {
        
        // นำข้อมูลจากฟอร์ม
        $idem = $_POST["idem"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        //เข้ารหัส password ด้วย sha512
        //$password=hash('sha512',$password);

        // เขียนคำสั่ง SQL เพื่อบันทึกข้อมูล
        $sql = "INSERT INTO employee_data (ID_Employee, Em_FirstName, Em_LastName, Em_Phone, UserName, Password, Status)
        VALUES ('$idem','$fname', '$lname', '$phone', '$username', '$password', '0')";

        // ทำการ query และตรวจสอบการทำงาน
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Successfully');</script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // ปิดการเชื่อมต่อ
        mysqli_close($conn);
    } else {
        echo "All fields are required!";
    }
}
?>

<!------------------------------------------------------------------>

<section class="banner">
    <div class="banner-logo">
        <img src="image/Logo.png">
    </div>
</section>

<br>

<div class="container">
    <div class="box">
    <h1 class="display-5 text-center mb-1 mt-1">Register</h1>
        <form method="POST" action="">
        <div class="col-auto">    
            <label>ID Employee</label>
            <input type="number" name="idem" required class="form-control mb-1">
            </div> 
        <div class="col-auto">    
            <label>Name</label>
            <input type="text" name="fname" required class="form-control mb-1">
            </div> 
        <div class="col-auto">
            <label>Lastname </label>
            <input type="text" name="lname" required class="form-control mb-1">
            </div> 
        <div class="col-auto">
            <label>Phone number </label>
            <input type="text" name="phone" required class="form-control mb-1" maxlength="10"> 
            </div> 
        <div class="col-auto">
            <label>Username</label>
            <input type="text" name="username" required class="form-control mb-2">
            </div> 
        <div class="col-auto">
            <label>Password</label>
            <input type="password" name="password" required class="form-control" maxlength="10"> 
            <p style="color:grey; font-family:Quicksand;"><small><i>Maximum 10 characters</i></small></p>
            </div>
        
        <div class="center">
            <input type="submit" name="submit" class="buttonbg-green" value="Submit">
            <input type="reset" name="cancel" class="buttonbg-gray" value="Cancel">
            <p class="text-center" style="margin-top:5px;">Already have an account? <a href="login.php"> Login </a></p>
        </div> 
        </form>
    </div>
    
</div>




</div>


</body>
</html>