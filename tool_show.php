<?php
include 'php_session_start.php'; // เรียกใช้ condb.php เพื่อเชื่อมต่อฐานข้อมูล
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool</title>

    <!-- Boostrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css"> 

</head>
<body>
<style>
    .custom-link {
        color: black;
        text-decoration: none; /* เอาเส้นล้างข้อความออก */
    }

    .bar-box {
        width: 100%;
        /*border: 1px solid green;*/
        vertical-align: middle;
        position: relative;
        height: 45px;
        display: flex;
        justify-content: space-between;
    }

    .search-box {
        /*border: 1px solid red;*/
        width: 230px;
        padding: 4px;
        align-items: center;
    }

    .search {
        width: 230px;
        border: 1px solid gray;
        border-radius: 25px;
        padding: 4px 0px;
    }

    .search input {
        width: 80%;
        border: none;
        padding: 0px 6px;
        border-radius: 20px;
        margin-left: 5px;
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

    .bt-box {
        /*border: 1px solid red;*/
        width: 300px;
    }

    .buttonbg {
        background-color: white;
        color: lightgray;
        display: inline-block; /*การแสดงผลเป็น inline-block*/
        transition-duration: 0.4s; /*ระยะเวลาที่ใช้ในการเปลี่ยนสีเมื่อ hover (0.4 วินาที)*/
        cursor: pointer; /*รูปลูกศรของเมาส์เมื่อชี้ไปยังปุ่ม*/
        border: none;
        /*border: 1px solid yellow;*/
    }
    .buttonbg:hover{
        color: gray;
        border: none;
    }

    .buttonbg svg{
        margin-top: -3px;
    }

</style>

<?php include 'banner.php'; ?>

<div class="container"> 

    <div class="display-5 text-center mb-2">
        <a href="tool_show.php" class="custom-link">Tool</a>
    </div>

    <div class="bar-box">

        <div class="" style="width: 300px;"></div>

            <form class="search-box" method="POST">
                <div class="search">
                    <input type="search" name="keyword" placehoder="search">
                    <button class="buttonbg">
                        <i class="bi bi-search"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </div>
            </form>

        <div class="bt-box">
            <a href="tool_all.php" class="button buttongreen">All tools</a>
            <a href="tool_barcode.php" class="button buttongreen">Barcode</a>
            <a href="tool_add.php" class="button buttongreen">Add New Tool</a>
        </div>
            
    </div>
    
    <!--  Start Table  -->
    
    <table style="width:80%;margin-left: auto;margin-right: auto">
        <!-- Heading Table -->
        <thead>
            <tr> 
                <th style="width:10%">Image</th>
                <th style="width:10%">Name</th>
                <th style="width:10%">Category</th>
                <th style="width:10%">Amount</th>
                <th style="width:10%"></th>
                
                <!--<th style="width:5%"></th>-->
            </tr>
        </thead>
        
        <!-- Body Table -->
        <tbody>
        
        <?php

        $key_word = @$_POST['keyword'];
            if($key_word !="") {
                $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory, COUNT(*) as EquipmentCount
                FROM tool_data
                JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                WHERE Tool_Name like '$key_word' 
                GROUP BY tool_data.Tool_Name
                HAVING COUNT(*) > 0";

            }else{
                $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory, COUNT(*) as EquipmentCount
                FROM tool_data
                JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                GROUP BY tool_data.Tool_Name";
            }
            
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                }
                
                while ($row = mysqli_fetch_array($result)) {
        ?>

        <tr>
            <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="60px" height="60px"></td>
            <td><?= $row["Tool_Name"] ?></td>
            <td><?= $row["Name_MainCategory"] ?></td>
            <td><?= $row["EquipmentCount"] ?></td>
            <td> <a href="tool_view.php?id=<?= $row["Tool_Name"] ?>" class="btn btn-secondary ">View</a> </td>
            <!--td> <a href="tool_add_sequence.php?id=<?= $row["Tool_Name"] ?>" class="btn btn-success" >Add</a></td-->

        </tr>
    <?php
        }
    ?>
    </table>


</div>
</body>
</html>
        