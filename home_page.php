<?php
include 'php_session_start.php'; // เรียกใช้ condb.php เพื่อเชื่อมต่อฐานข้อมูล
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

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
        margin-left: auto;
        margin-right: auto;
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
                <th style="width:5%">Image</th>
                <th style="width:10%">Tool ID</th>
                <th style="width:15%">Name</th>
                <th style="width:10%">Category</th>
                <th style="width:5%">Status</th>
                <th style="width:15%">Borrower</th>
                <th style="width:10%">Mobile</th>
                <th style="width:15%">Construction site</th>
                <th style="width:15%">Borrowing Date</th>
            </tr>
        </thead>
        
        <!-- Body Table -->
        <tbody>
    <?php
        $sql = "SELECT borrowing.*, tool_data.*, tool_maincategory.Name_MainCategory,
        employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone
        FROM tool_data
        JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
        JOIN borrowing ON borrowing.ID_Tool = tool_data.ID
        JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee
        WHERE tool_data.Status = 1 AND borrowing.Status = 1";


        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
    ?>
            <tr>
                <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="80px" height="80px" class="center"></td>
                <td><?= $row["ID"] ?></td>
                <td><?= $row["Tool_Name"] ?> (No.<?= $row["Equipment_Sequence"] ?>)</td>
                <td><?= $row["Name_MainCategory"] ?></td>
                <td><?php
                if ($row["Status"] == 0) {
                    echo "<div style=color:green;>";
                    echo "Available";
                    echo "</div>";
                } elseif ($row["Status"] == 1) {
                    echo "<div style=color:blue;>";
                    echo "Borrowing";
                    echo "</div>";
                } else {
                    echo "<div style=color:gray;>";
                    echo "Unknown"; // หรือค่าเริ่มต้นอื่น ๆ ที่คุณต้องการแสดง
                    echo "</div>";
                }
                ?></td>
                <td><?= $row["Em_FirstName"] ?> <?= $row["Em_LastName"]?></td>
                <td><?= $row["Em_Phone"] ?></td>
                <td><?= $row["Site"] ?></td>
                <td><?= $row["Date_Borrow"] ?></td>
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