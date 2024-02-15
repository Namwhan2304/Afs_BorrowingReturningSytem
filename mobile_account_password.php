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
                echo '<div class="overlay-message" style="color:green;text-align:center;">Successfully</div>';
            } else {
                echo "Error updating password: " . mysqli_error($conn);
            }

            mysqli_stmt_close($updateStmt);
        } else {
            echo '<div class="overlay-message" style="color:red;text-align:center;line-height: 0.9;">New password and confirm password do not match</div>';
        }
    } else {
        echo '<div class="overlay-message" style="color:red;text-align:center;">Incorrect current password</div>';
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

<?php include 'mobile_banner.php'; ?>

    <!--  Heading Status of tools  -->
    <style>
        .custom-link {
            color: black;
            text-decoration: none; /* เอาเส้นล้างข้อความออก */
        }

        .overlay-message {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            font-size: 16px;
            top: 445px;
        }

    </style>

    <div class="table-box" style="margin-top:65px;">
        <div style="margin-top:5px;" class="display-5 text-center">
            <a href="mobile_home.php" class="custom-link">Change password</h1></a>
    </div>

        <style>
            div.table-box {
                margin-top: 20px;
                margin-bottom: 80px;
                margin-left: auto;
                margin-right: auto;
                padding: 10px;
                width: 85%;
                box-shadow: 0 1px 15px 0 rgba(0, 0, 0, 0.15);
                border-radius: 10px;
            }

            table {
                width: 80%;
                border-collapse: collapse;
                margin-left: auto;
                margin-right: auto;
                margin-top: 10PX;
                /*border: 1px solid green;*/
            }

            tbody tr {
                height: 35px;
                /*border: 1px solid green;*/
            }

            .change {
                text-align: center;
                margin: 15px;
                
            }

            .change a{
                /*border: 1px solid green;*/
                padding: 10px;
                text-decoration: none; /* เอาเส้นล้างข้อความออก */
                font-size: 14px;
                text-align: center;
                color: blue;
                text-decoration: none;
            }

            .logout {
                margin-bottom: 15px;
                text-align: center;
            }   

            .logout a {
                color: red;
                padding: 10px;
                text-decoration: none; /*การจัดรูปแบบข้อความ (ไม่มีขีดเส้นใต้)*/
                font-size: 16px; /*ขนาดตัวอักษร*/
            }

            .box {
                width: 80%;
                border-collapse: collapse;
                margin: 5PX auto;
            }

            .box input {
                margin-bottom: 5PX;
            }

            .button {
                margin-top: 40px;
                /*border: 1px solid black;*/
                text-align: center;
            }

            .button input{
                padding: 8px 8px;
                text-decoration: none; /* เอาเส้นล้างข้อความออก */
                font-size: 14px;
                border-radius: 10px;
                text-align: center;
                color: black;
                background-color: #ececec;
                border: none;
            }
        </style>


    <div class="box">
        <label style="margin-bottom: 5PX;">ID
            <?php
            // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
            if(isset($_SESSION["username"])) {
            echo "<div style='color:gray'>";
            echo "AFS".$_SESSION["username"];
            echo "</div>";
            }
            ?></label> <br>
                        

        <label style="margin-bottom: 5PX;">Name
            <?php
                // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
                if(isset($_SESSION["username"])) {
                echo "<div style='color:gray'>";
                echo $_SESSION["firstname"]." ".$_SESSION["lastname"];
                echo "</div>";
                }
                ?></label>
        
        
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