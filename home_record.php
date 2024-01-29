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
    }

    th, td {
        /*border: 1px solid black;*/
        padding: 8px; /* เพิ่มขอบรอบของข้อความในเซลล์ */
        text-align: center; /* จัดตำแหน่งข้อความในเซลล์ไว้ตรงกลาง */
        border-bottom: 1px solid #DDD; /*ขอบด้านล่าง*/
        /*border: 1px solid black; /*ขอบสีดำ*/
    }

    tbody tr:hover {
        background-color: #F0F8FF; /* พื้นหลังเปลี่ยนสีเมื่อโฮเวอร์ทุกรายการใน tbody */
    }
    </style>

    <table>
        <thead>
            <tr> <!-- Heading Table -->
                <th rowspan="2" style="width:10%">No.</th>
                <th rowspan="2" style="width:10%">Image</th>
                <th rowspan="2" style="width:10%">ID</th>
                <th rowspan="2" style="width:15%">Name</th>
                <th rowspan="2" style="width:15%">Borrower</th>
                <th rowspan="2" style="width:15%">Construction site</th>
                <th colspan="2"style="width:10%">Date</th>
            </tr>
            <tr style="height:5px"> 
                <th style="width:5%">Borrowing</th>
                <th style="width:5%">Returning</th>
            </tr>
        </thead>
        
        <?php
        $sql = "SELECT borrowing.*, tool_data.ID
        FROM borrowing
        JOIN tool_data ON borrowing.ID_Tool = tool_data.ID";


        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <!-- Body Table -->
            <td><?= $row["ID_Borrowing"] ?></td>
            <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="60px" height="60px"></td>
            <td><?= $row["ID_Employee"] ?></td>
            <td><?= $row["Tool_Name"] ?></td>
            <td><?= $row["Em_FirstName"] ?></td>
            <td><?= $row["Site"] ?></td>
            <td><?= $row["Date_Borrow"] ?></td>
            <td>#</td>
        </tr>
    <?php
    }
    ?>

        </tbody>
    </table>
        
    <!--  End Table  -->

</div>


</body>
</html>
