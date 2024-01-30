<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
    <!---Link to css-->
    <link rel="stylesheet" href="home.css"> 

</head>
<body>
    <section class="banner">
        <div class="banner-logo">
            <img src="image/Logo.png">
        </div>
    </section>

    <!-- Nav Start -->
<div class="container"> 
    <nav>
        <div class="logo" style="display: flex;">
            <p style="font-size: 18px;">Borrowing-Returning System</p>
            <?php
            // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
             if(isset($_SESSION["firstname"])) {
                echo "<div style='color:gray; margin-left:5px; margin-top:2px;'>";
                echo " : " . $_SESSION["firstname"]." ".$_SESSION["lastname"]."";
                echo "</div>";
                }
            ?>
        </div>

        

        <ul class="menu">
            <Li><a href="home_page.php">Home</a></Li>
            <Li><a href="tool_show.php">Tool</a></Li>
            <Li><a href="employee_show.php">Employee</a></Li>
            <Li><a href="logout.php">Logout</a></Li>
        </ul>
    </nav>
</div>
    <!-- Nav End -->