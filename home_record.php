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
        padding: 5px 0px; /* เพิ่มขอบรอบของข้อความในเซลล์ */
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
                <th rowspan="2" style="width:10%">Borrow No.</th>
                <th rowspan="2" style="width:10%">Image</th>
                <th rowspan="2" style="width:10%">Tool ID</th>
                <th rowspan="2" style="width:15%">Name</th>
                <th rowspan="2" style="width:15%">Borrower</th>
                <th rowspan="2" style="width:10%">Site</th>
                <th rowspan="2"style="width:10%">Status</th>
                <th colspan="2"style="width:20%">Date</th>
            </tr>
            <tr style="height:5px"> 
                <th style="width:10%">Borrowing</th>
                <th style="width:10%">Returning</th>
            </tr>
        </thead>
        
        <tbody>
        <?php
            $perpage = 5;
            if(isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page = 1;
            }
            $start = ($page - 1) * $perpage;
    
            $key_word = isset($_GET['keyword']) ? $_GET['keyword'] : '';

            if($key_word !="") {
                $sql = "SELECT borrowing.*, tool_data.Tool_Name, tool_data.ID_MainCategoryTool, tool_data.Tool_Image, tool_data.Equipment_Sequence,
                tool_maincategory.Name_MainCategory,
                employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone
                FROM tool_data
                JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                JOIN borrowing ON borrowing.ID_Tool = tool_data.ID
                JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee
                WHERE ID like '%$key_word%' or ID_Borrowing like '%$key_word%' or Tool_Name like '%$key_word%' or Name_MainCategory like '%$key_word%' or
                Em_FirstName like '%$key_word%' or Em_LastName like '%$key_word%' or Site like '%$key_word%'
                ORDER BY borrowing.ID_Borrowing DESC
                limit {$start}, {$perpage}";

            }else{
                $sql = "SELECT borrowing.*, tool_data.Tool_Name, tool_data.ID_MainCategoryTool, tool_data.Tool_Image, tool_data.Equipment_Sequence,
                tool_maincategory.Name_MainCategory,
                employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone
                FROM tool_data
                JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                JOIN borrowing ON borrowing.ID_Tool = tool_data.ID
                JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee
                ORDER BY borrowing.ID_Borrowing DESC
                limit {$start}, {$perpage}";

            }
            
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
            ?>

            <tr>
                <!-- Body Table -->
                <td><?= $row["ID_Borrowing"] ?></td>
                <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="60px" height="60px"></td>
                <td><?= $row["ID_Tool"]?></td>
                <td><?= $row["Tool_Name"]?>  (No.<?= $row["Equipment_Sequence"] ?>)</td>
                <td><?= $row["Em_FirstName"]?>  <?= $row["Em_LastName"]?></td>
                <td><?= $row["Site"] ?></td>
                <td><?php
                        if ($row["Status"] == 1) {
                            echo "<div style=color:blue;>";
                            echo "Borrowing";
                            echo "</div>";
                        } elseif ($row["Status"] == 2) {
                            echo "<div style=color:green;>";
                            echo "Returned";
                            echo "</div>";
                        } else {
                            echo "<div style=color:gray;>";
                            echo "Unknown"; // หรือค่าเริ่มต้นอื่น ๆ ที่คุณต้องการแสดง
                            echo "</div>";
                        }
                        ?></td>
                <td><?= $row["Date_Borrow"]?></td>
                <td><?= $row["Date_Return"]?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
        
        <?php
        if($key_word !="") {
            $sql1 = "SELECT borrowing.*, tool_data.Tool_Name, tool_data.ID_MainCategoryTool, tool_data.Tool_Image, tool_data.Equipment_Sequence,
            tool_maincategory.Name_MainCategory,
            employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone
            FROM tool_data
            JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
            JOIN borrowing ON borrowing.ID_Tool = tool_data.ID
            JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee
            WHERE ID like '%$key_word%' or ID_Borrowing like '%$key_word%' or Tool_Name like '%$key_word%' or Name_MainCategory like '%$key_word%' or
            Em_FirstName like '%$key_word%' or Em_LastName like '%$key_word%' or Site like '%$key_word%'
            ORDER BY borrowing.ID_Borrowing DESC";
    
        } else {
            $sql1 = "SELECT borrowing.*, tool_data.Tool_Name, tool_data.ID_MainCategoryTool, tool_data.Tool_Image, tool_data.Equipment_Sequence,
            tool_maincategory.Name_MainCategory,
            employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone
            FROM tool_data
            JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
            JOIN borrowing ON borrowing.ID_Tool = tool_data.ID
            JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee
            ORDER BY borrowing.ID_Borrowing DESC";
        }
        
        $query1 = mysqli_query($conn, $sql1); 
        $total_record = mysqli_num_rows($query1);
        $total_page = ceil($total_record/$perpage);
    ?>
        
    <nav aria-label="Page navigation example" style="position: fixed; text-align:center; vertical-align: middle; bottom: 0;
                                                     width: 84.5%;height: 60px;">
    <ul class="pagination" style="margin: 0 auto">


        <?php for ($i = 1; $i <= $total_page; $i++) { ?>

            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>" style="color: <?php echo ($i == $page) ? 'gray' : '#555'; ?>">
            <a  class="page-link" 
                style="color: <?php echo ($i == $page) ? 'gray' : '#7777'; ?>; 
                    background-color: <?php echo ($i == $page) ? 'lightgray' : 'parent'; ?>;
                    border: 1px solid <?php echo ($i == $page) ? 'lightgray' : 'parent'; ?>" 
                href="home_record.php?page=<?php echo $i; ?>&keyword=<?php echo $key_word; ?>">
            <?php echo $i; ?>
            </a>
            </li>
            
        <?php } ?>

    </ul>
    </nav>

</div>


</body>
</html>
