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

<style>

.dropdown {
    position: relative;
    display: inline-block;
    border: none;
}

.dropdown-content {
    display: none;
    position: absolute;
    width: 140px;
    z-index: 99;
    /*border: 1px solid #DDD;*/
    border-radius: 10px;
    background-color: #f5f5f5;
}

.dropdown-content a {
    color: gray;
    padding: 5px 5px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    color: black;
    background-color: #e1e1e1;
    border-radius: 10px;
}

.dropdown:hover .dropdown-content {
  display: block;
}

</style>
        
        <ul class="menu">
            <Li><a href="home_page.php">Home</a></Li>
            <Li><a href="tool_show.php">Tool</a></Li>
            <Li><a href="employee_show.php">Employee</a></Li>

            <Li><div class="dropdown">
                    Account
                    <div class="dropdown-content">
                    <a href="home_password.php">Change password</a>
                    <a href="logout.php">Logout</a>
                    </div>
                </div></Li>
        </ul>
    </nav>
</div>
    <!-- Nav End -->