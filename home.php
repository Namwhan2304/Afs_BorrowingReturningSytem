<?php
include 'condb.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
    <!---Link to css-->
    <link rel="stylesheet" href="home.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">

</head>


<body>

<?php include 'banner.php'; ?>

<style>
        .custom-link {
            color: black;
            text-decoration: none; /* เอาเส้นล้างข้อความออก */
        }


</style>

<div class="container">

    <!--  Heading Status of tools  -->

    <div class="display-5 text-center mb-2">
        <a href="home_page.php" class="custom-link">Status of tools</a>
    </div>
    <!--  End Heading Status of tools  -->

    
    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
        <a href="home_alltool.php" class="btn btn-outline-success mb-2 mt-2">All tool</a>    
        <a href="home_available.php" class="btn btn-outline-success mb-2 mt-2">Available</a>
        <a href="home_unavailable.php" class="btn btn-outline-success mb-2 mt-2">Unavailable</a>
        <a href="home_record.php" class="btn btn-outline-success mb-2 mt-2">Record</a> 
        
    </div>
</div>

</body>
</html>