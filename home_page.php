<?php
include 'php_session_start.php'; // เรียกใช้ condb.php เพื่อเชื่อมต่อฐานข้อมูล
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

<?php
include 'home.php';
?>

<div class="container">

    <!--  Start Table  -->
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px; /* เพิ่มระยะห่างด้านบนของตาราง */
    }

    th, td {
        /*border: 1px solid black;*/
        padding: 8px; /* เพิ่มขอบรอบของข้อความในเซลล์ */
        text-align: center; /* จัดตำแหน่งข้อความในเซลล์ไว้ตรงกลาง */
        border-bottom: 1px solid #DDD; /*ขอบด้านล่าง*/
    }

    tbody tr:hover {
        background-color: #F0F8FF; /* พื้นหลังเปลี่ยนสีเมื่อโฮเวอร์ทุกรายการใน tbody */
    }

    </style>

    <table>
        <thead>
            <tr> <!-- Heading Table -->
                <th style="width:10%">Image</th>
                <th style="width:20%">Name</th>
                <th style="width:20%">Category</th>
                <th style="width:20%">Subcategory</th>
                <th style="width:10%">Amount</th>
                <th style="width:10%">Available</th>
                <th style="width:10%">Unavailable</th>
            </tr>
        </thead>
        
        <tbody>
            <tr> <!-- Body Table -->
                <td>#</td>
                <td>Screw driver gun</td>
                <td>Electrical</td>
                <td>Set A</td>
                <td>10</td>
                <td>5</td>
                <td>5</td>
            </tr>
        </tbody>
    </table>
        
    <!--  End Table  -->

</div>

    
</body>
</html>