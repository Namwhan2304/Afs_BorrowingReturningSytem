<?php
include 'php_session_start.php';; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <mera http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add employee</title>

    <!-- Boostrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 

</head>
<body>

<?php include 'banner.php'; ?>

<?php
// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ตรวจสอบว่ามีค่าที่ส่งมาจริง ๆ หรือไม่
    if(isset($_POST["idem"]) && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["phone"])) {
        
        // นำข้อมูลจากฟอร์ม
        $idem = $_POST["idem"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];

        // เขียนคำสั่ง SQL เพื่อบันทึกข้อมูล
        $sql = "INSERT INTO employee_data (ID_Employee, Em_FirstName, Em_LastName, Em_Phone) VALUES ('$idem','$fname', '$lname', '$phone')";

        // ทำการ query และตรวจสอบการทำงาน
        if (mysqli_query($conn, $sql)) {

            echo"<script>alert('Record added successfully');</script>";

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add employee</title>

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
    <div class="container">
    <h1 class="display-4 text-center mb-2">Add Employee</h1>
        <form method="POST" action="">
        <div class="h6 mt-2">    
            <label>ID Employee</label>
            <input type="number" name="idem" required class="form-control">
        <div class="h6 mt-2">    
            <label>Name</label>
            <input type="text" name="fname" required class="form-control">
        <div class="h6 mt-2">
            <label>Lastname </label>
            <input type="text" name="lname" required class="form-control">
        <div class="h6 mt-2">
            <label>Phone number </label>
            <input type="number" name="phone" required class="form-control"> 

            <input type="submit" class="btn btn-success mt-2" value="Submit">
            <a href="employee_show.php" class="btn btn-secondary mt-2">Back</a>
        </form>
    </div>
</body>
</html>

</body>
</html>