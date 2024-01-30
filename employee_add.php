<?php
include 'php_session_start.php';

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ตรวจสอบว่ามีค่าที่ส่งมาจริง ๆ หรือไม่
    if(isset($_POST["idem"]) && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["phone"]) && isset($_POST["status"]) && isset($_POST["password"])) {
        
        // นำข้อมูลจากฟอร์ม
        $idem = $_POST["idem"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
        $status = $_POST["status"];
        $password = $_POST["password"];
        //เข้ารหัส password ด้วย sha512
        $password=hash('sha512',$password);

        // เขียนคำสั่ง SQL เพื่อบันทึกข้อมูล
        $sql = "INSERT INTO employee_data (ID_Employee, Em_FirstName, Em_LastName, Em_Phone, Status, Password) VALUES ('$idem','$fname', '$lname', '$phone', '$status', '$password')";

        // ทำการ query และตรวจสอบการทำงาน
        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Record added successfully');</script>";
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

<?php include 'banner.php'; ?>

<style>
    table {
        width: 50%;
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

<div class="container">
    <h1 class="display-4 text-center mb-2">Add Employee</h1>
    
    <table>
        <tbody>
            <form method="POST" action="">
                <tr>
                    <td style="width:20%"><label>ID Employee</label></td>
                    <td><input type="number" name="idem" required class="form-control"></td>
                </tr>

                <tr>
                    <td style="width:20%"><label>Name</label></td>
                    <td><input type="text" name="fname" required class="form-control"></td>
                </tr>

                <tr>
                    <td style="width:20%"><label>Lastname</label></td>
                    <td><input type="text" name="lname" required class="form-control"></td>
                </tr>

                <tr>
                    <td style="width:20%"><label>Mobile</label></td>
                    <td><input type="number" name="phone" required class="form-control"></td>
                </tr>

                <tr>
                    <td style="width:20%"><label>Status</label></td>
                    <td>
                        <div class="dropdown" style="width: 250px">
                            <select class="form-select form-select" name="status" id="status" aria-label="Default select example">
                                <option disabled selected>Open this select status</option>
                                <option value="1">Admin</option>
                                <option value="0">Employee</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%"><label>Password</label></td>
                    <td>
                        <input type="password" name="password" required class="form-control" maxlength="10">
                    </td>
                </tr>

                <tr>
                    <td style="width:20%"></td>
                    <td>
                        <p style="color:grey; font-family:Quicksand; margin-top:-10px"><small><i>Maximum 10 characters</i></small></p>
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" class="btn btn-success" value="Submit">
                        <a href="employee_show.php" class="btn btn-secondary">Back</a>
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
</div>

</body>
</html>
