<?php
include 'php_session_start.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accout</title>

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

    </style>

    <div class="table-box" style="margin-top:65px;">
        <div style="margin-top:5px;" class="display-5 text-center">
            <a href="mobile_home.php" class="custom-link">Account</h1></a>
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
                width: 70%;
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
        </style>

        <table>
            <thead></thead>
            <tbody>
                <tr>
                    <td style="width:25%">
                        <label>ID</label>
                    </td>
                        <td style="width:75%">
                        <?php
                            // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
                            if(isset($_SESSION["username"])) {
                            echo "<div style='color:gray'>";
                            echo "AFS".$_SESSION["username"];
                            echo "</div>";
                            }
                        ?>
                    </td>
                </tr>
                        
                <tr>
                    <td style="width:25%">
                        <label>Name</label>
                    </td>
                    <td style="width:75%">
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

        <div class="change">
            <a href="mobile_account_password.php" class="">Change password</a>  
        </div>

        <div class="logout">
            <a href="logout.php" class="logout">Logout</a>
        </div>

    

</body>
</html>