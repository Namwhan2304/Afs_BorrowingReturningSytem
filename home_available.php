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

    tr:hover {background-color: #F0F8FF;} /*พื้นหลังเปลี่ยนสีเมื่อเลือก*/
    </style>

    <table> 
        <tr> <!-- Heading Table -->
            <th style="width:10%">Image</th>
            <th style="width:10%">ID</th>
            <th style="width:15%">Name</th>
            <th style="width:15%">Category</th>
            <th style="width:10%">Status</th>
            <th style="width:15%">Borrower</th>
            <th style="width:15%">Construction site</th>
            <th style="width:10%">Borrowing Date</th>

        </tr>
        
        <!-- Body Table -->

        <tr> 
            <td>#</td>
            <td>E0101002</td>
            <td>Screw driver gun</td>
            <td>Electrical</td>
            <td style="color:Green;">Available</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>

    </table>
        
    <!--  End Table  -->

</div>


</body>
</html>
