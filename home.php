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

    .bar-box {
        width: 100%;
        /*border: 1px solid green;*/
        display: flex;
        vertical-align: middle;
        justify-content: space-between;
        position: relative;
    }

    .btn-box {
        /*border: 1px solid green;*/
        width: 400px;
        text-align: center;
    }

    .search-box {
        position: relative;
        width: 30%;
        /*border: 1px solid gray;*/
        vertical-align: middle;
        text-align: center;
        padding: 10px 0px;
        align-items: center;
    }

    .search-box input {
        width: 80%;
        border: none;
        z-index: 1;
        padding: 0px 6px;
        border-radius: 20px;
    }

    .search {
        position: absolute;
        right: 0;
        border: 1px solid gray;
        width: 200px;
        border-radius: 25px;
        padding: 4px 0px;
        z-index: 999;
    }

    input[type="search"]:focus,
        select:focus {
            outline: none;
            background-color: none;
            box-shadow: none;
        }

    input[type="search"] :active{
        border: none;
        background-color: none;
        outline: none;
        box-shadow: none;
    }

    
    .buttonbg {
        background-color: white;
        color: lightgray;
        padding: 0% 2%; /*ระยะห่างของขอบปุ่มและข้อความภายใน*/
        /*padding-bottom: 2%;*/
        display: inline-block; /*การแสดงผลเป็น inline-block*/
        transition-duration: 0.4s; /*ระยะเวลาที่ใช้ในการเปลี่ยนสีเมื่อ hover (0.4 วินาที)*/
        cursor: pointer; /*รูปลูกศรของเมาส์เมื่อชี้ไปยังปุ่ม*/
        border: none;
    }
    .buttonbg:hover{
        color: gray;
        border: none;
    }

    .buttonbg svg{
        margin-top: -3px;
    }

</style>

<div class="container">

    <!--  Heading Status of tools  -->

    <div class="display-5 text-center mb-2">
        <a href="home_page.php" class="custom-link">Status of tools</a>
    </div>
    <!--  End Heading Status of tools  -->

    
    <div class="bar-box">
        <div class=""  style="width: 30%;"></div>

        <div class="btn-box">
            <a href="home_alltool.php" class="btn btn-outline-success mb-2 mt-2">All tools</a>    
            <a href="home_available.php" class="btn btn-outline-success mb-2 mt-2">Available</a>
            <a href="home_unavailable.php" class="btn btn-outline-success mb-2 mt-2">Unavailable</a>
            <a href="home_record.php" class="btn btn-outline-success mb-2 mt-2">Record</a>
        </div>
        
        <form class="search-box" method="GET">
            <div class="search">
                <input type="search" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>" placehoder="search">
                <button class="buttonbg">
                    <i class="bi bi-search"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </div>
        </form>

    </div>

</div>

</body>
</html>