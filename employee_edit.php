<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <mera http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit employee</title>

    <!-- Boostrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 

</head>
<body>

<?php include 'banner.php'; ?>


<?php
include 'php_session_start.php';;


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
    if(isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["phone"])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];

        // ทำการอัปเดตข้อมูลในฐานข้อมูล
        $update_sql = "UPDATE employee_data SET Em_FirstName='$fname', Em_LastName='$lname', Em_Phone='$phone' WHERE ID_Employee=$employee_id";

        if (mysqli_query($conn, $update_sql)) {
            echo"<script>alert('Successfully edited data');</script>";
            echo"<script>window.location='employee_show.php';</script>";
            //echo "Record updated successfully";
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
    <h1 class="display-5 text-center mb-2">Edit employee</h1>
        <form method="POST" action="" class="row g-2 align-items-center">
            <div class="col-sm-12 mb-2">
                <label>Name</label>
                <input type="text" name="fname" value="<?php echo $fname; ?>" required class="form-control">
            </div>
            <div class="col-sm-12 mb-2"> 
                <label>Lastname</label>
                <input type="text" name="lname" value="<?php echo $lname; ?>" required class="form-control">
            </div>
            <div class="col-sm-12 mb-2"> 
                <label>Phone number</label>
                <input type="number" name="phone" value="<?php echo $phone; ?>" required class="form-control">
            </div>
            <div class="col-sm-8 mb-2">
                <input type="submit" a href="employee_show.php" class="btn btn-success mt-2" value="Update">
                <a href="employee_show.php" class="btn btn-secondary mt-2">Cancel</a>
            </div>
        </form>
</div>
</body>
</html>