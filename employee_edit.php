
<?php

include 'php_session_start.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
include 'banner.php';

// ตรวจสอบว่ามีการส่ง ID ของพนักงานที่ต้องการแก้ไขมาหรือไม่
if(isset($_GET["id"]) && !empty($_GET["id"])) {
    $employee_id = $_GET["id"];

    // ดึงข้อมูลพนักงานจากฐานข้อมูล
    $sql = "SELECT * FROM employee_data WHERE ID_Employee = $employee_id";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $fname = $row["Em_FirstName"];
        $lname = $row["Em_LastName"];
        $phone = $row["Em_Phone"];
        $status = $row["Status"];
    } else {
        echo "Employee not found";
        exit;
    }
} else {
    echo "Invalid request";
    exit;
}

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["phone"]) && isset($_POST["status"])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
        $status = $_POST["status"]; // เพิ่มการรับค่า Status จากฟอร์ม

        // ทำการอัปเดตข้อมูลในฐานข้อมูล
        $update_sql = "UPDATE employee_data SET Em_FirstName='$fname', Em_LastName='$lname', Em_Phone='$phone', Status=$status WHERE ID_Employee=$employee_id";

        echo $update_sql; // ใส่นี้เพื่อแสดง Query SQL ที่กำลังทำงาน

        if (mysqli_query($conn, $update_sql)) {
            echo"<script>alert('Successfully edited data');</script>";
            echo"<script>window.location='employee_show.php';</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
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
    <title>Edit Employee</title>

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
<div class="container">
    <div class="box-table" style="width:50%;margin-left:auto;margin-right: auto">
        <h1 class="display-5 text-center mb-2">Edit employee</h1>
    <style>
    table {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
        margin-top: 20px; /* เพิ่มระยะห่างด้านบนของตาราง */
        /*border: 1px solid red;*/
    }

    th, td {
        /*border: 1px solid black;*/
        padding: 5px; /* เพิ่มขอบรอบของข้อความในเซลล์ */
    }
    

    </style>

    <table>
            <thead>
            </thead>

        <tbody>
            <form method="POST" action="" class="row g-2 align-items-center">
                <tr>
                    <td style="width:20%"><label>Name</label></td>
                    <td><input type="text" name="fname" value="<?php echo $fname; ?>" required class="form-control" style="width:100%"></td>
                </tr>

               <tr>
                    <td style="width:20%"><label>Lastname</label></td>
                    <td><input type="text" name="lname" value="<?php echo $lname; ?>" required class="form-control"></td>
                </tr>

                <tr>
                    <td style="width:20%"><label>Phone number</label></td>
                    <td><input type="number" name="phone" value="<?php echo $phone; ?>" required class="form-control"></td>
                </tr>

                <tr>
                    <td style="width:20%"><label>Status</label></td>
                    <td>
                        <div class="dropdown" style="width: 250px">
                            <select class="form-select form-select" name="status" id="status" aria-label="Default select example">
                                <option disabled selected>Open this select status</option>
                                <option value="1" <?php if ($status == 1) echo 'selected'; ?>>Admin</option>
                                <option value="0" <?php if ($status == 0) echo 'selected'; ?>>Employee</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <div class="right" style="">
                            <input type="submit" class="btn btn-success mt-2" value="Update">
                            <a href="employee_show.php" class="btn btn-secondary mt-2">Cancel</a>
                        </div>
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
</div>

</body>
</html>