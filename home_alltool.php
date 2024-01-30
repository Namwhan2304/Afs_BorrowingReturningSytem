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
    body {
        scrollbar-width: none; /* ซ่อน scrollbar ใน Firefox */
    }
        
    body::-webkit-scrollbar {
        display: none; /* ซ่อน scrollbar ใน Chrome, Safari, และ Edge */
    }

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
        <thead>
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
        </thead>
        
        <!-- Body Table -->
        <tbody>
        <?php
        $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory,
                employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone,
                borrowing.ID_Employee, borrowing.Site, borrowing.Date_Borrow
                FROM tool_data
                JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                LEFT JOIN borrowing ON tool_data.ID = borrowing.ID_Tool AND borrowing.Status = 1
                LEFT JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee";

            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            
            while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr> 
                <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="80px" height="80px" class="center"></td>
                <td><?= $row["ID"]?></td>
                <td><?= $row["Tool_Name"]?> (No.<?= $row["Equipment_Sequence"] ?>)</td>
                <td><?= $row["Name_MainCategory"] ?></td>
                <td><?php
                    if ($row["Status"] == 0) {
                        echo "<div style=color:green;>";
                        echo "Available";
                        echo "</div>";
                    } elseif ($row["Status"] == 1) {
                        echo "<div style=color:red;>";
                        echo "Unavailable";
                        echo "</div>";
                    } else {
                        echo "<div style=color:gray;>";
                        echo "Unknown"; // หรือค่าเริ่มต้นอื่น ๆ ที่คุณต้องการแสดง
                        echo "</div>";
                    }
                    ?></td>
                <td><?= $row["Em_FirstName"] ?> <?= $row["Em_LastName"] ?></td>
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
