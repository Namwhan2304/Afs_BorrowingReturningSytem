<?php
include 'php_session_start.php';

// ตรวจสอบการส่งฟอร์มเปลี่ยนรหัสผ่าน
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = ($_POST['current_password']);
    $newPassword = ($_POST['new_password']);
    $confirmPassword = ($_POST['confirm_password']);

    // ดึงรหัสผ่านปัจจุบันของผู้ใช้จากฐานข้อมูล
    $username = ($_SESSION["username"]);
    
    $sql = "SELECT * FROM `employee_data` WHERE ID_Employee ='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    $currentPassword=hash('sha512',$currentPassword);
    // ตรวจสอบรหัสผ่านปัจจุบัน
    if ($currentPassword == $row['Password']) {
        // ตรวจสอบว่ารหัสผ่านใหม่และยืนยันรหัสผ่านตรงกันหรือไม่
        if ($newPassword == $confirmPassword) {
            // ถ้าตรงกัน, ให้ทำการเปลี่ยนรหัสผ่าน
            
            $newPassword=hash('sha512',$newPassword);
            $updateQuery = "UPDATE employee_data SET Password = ? WHERE ID_Employee = ?";
            $updateStmt = mysqli_prepare($conn, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, "ss", $newPassword, $username);
            
            if (mysqli_stmt_execute($updateStmt)) {
                // เปลี่ยนรหัสผ่านสำเร็จ
                echo "<script>alert('Successfully')</script>";
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }

            mysqli_stmt_close($updateStmt);
        } else {
            echo "<script>alert('New password and confirm password do not match')</script>";
        }
    } else {
        echo "<script>alert('Incorrect current password')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change password</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
    <!---Link to css-->
    <link rel="stylesheet" href="home.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">

</head>


<body>

<?php include 'banner.php';?>

    <!--  Heading Status of tools  -->
    <style>
        .custom-link {
            color: black;
            text-decoration: none; /* เอาเส้นล้างข้อความออก */
        }

        .overlay-message {
            position: absolute;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-size: 16px;
            top: 465px;
        }

    </style>

    
    <div style="margin-top:5px;" class="display-5 text-center">
        <a href="mobile_home.php" class="custom-link">Change password</h1></a>
    </div>
    
    <div class="table-box">

        <style>
            div.table-box {
                margin-bottom: 80px;
                margin-left: auto;
                margin-right: auto;
                padding: 10px;
                width: 25%;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin: 10px auto;
            }

            tbody tr {
                height: 35px;
                /*border: 1px solid green;*/
            }

            .button {
                margin-top: 20px;
                text-align: center;
            }

            .button input{
                padding: 8px 10px;
                text-decoration: none; /* เอาเส้นล้างข้อความออก */
                font-size: 14px;
                border-radius: 10px;
                text-align: center;
                color: black;
                background-color: lightgray;
                border: 1px solid lightgray;
            }

            .button input:hover{
                background-color: #e9e9e9;
                border: 1px solid #e9e9e9;
                
            }
        </style>

        <table>
            <tbody>
                <tr>
                    <td style="width:10%">
                        <label>ID</label>
                    </td>
                        <td style="width:30%">
                        <?php
                            // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
                            if(isset($_SESSION["username"])) {
                            echo "<div style='color:gray'>";
                            echo "AFS".$_SESSION["username"];
                            echo "</div>";
                            }
                        ?>
                    </td>
                    <td style="width:20%">
                        <label>Name</label>
                    </td>
                    <td style="width:40%">
                        <?php
                            // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
                            if(isset($_SESSION["username"])) {
                            echo "<div style='color:gray'>";
                            echo $_SESSION["firstname"]." ".$_SESSION["lastname"];
                            echo "</div>";
                            }
                        ?>
                    </td>
                </tr>

            </tbody>
        </table>    
        
        
        <form method="POST" action="">
            <label for="current_password">Current Password</label>
            <input type="password" name="current_password" required class="form-control">

            <label for="new_password">New Password</label>
            <input type="password" name="new_password" required class="form-control">

            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" required class="form-control">
            
            <p style="color:grey; font-family:Quicksand;"><small><i>Maximum 10 characters</i></small></p>
                
            <div class="button">
                <input type="submit" value="Change Password">
            </div>
                    
        </form>
    </div>



    

</body>
</html>