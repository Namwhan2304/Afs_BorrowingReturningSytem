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
    }

    tbody tr:hover {background-color: #F0F8FF;} /*พื้นหลังเปลี่ยนสีเมื่อเลือก*/
    
    tbody td .status-available {
        color: green;
        }

    tbody td .status-unavailable {
        color: red;
        }

    tbody td .status-unknown {
        color: gray;
        }
    </style>

    <table>
        <thead>
            <tr> <!-- Heading Table -->
                <th style="width:10%">Image</th>
                <th style="width:5%">Tool ID</th>
                <th style="width:20%">Name</th>
                <th style="width:10%">Category</th>
                <th style="width:10%">Status</th>
                <th style="width:10%">Borrower</th>
                <th style="width:10%">Site</th>
                <th style="width:10%">Borrowing Date</th>
            </tr>
        </thead>
        
        <!-- Body Table -->
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
                $sql = "SELECT borrowing.*, tool_data.*, tool_maincategory.Name_MainCategory,
                employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone
                FROM tool_data
                JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                JOIN borrowing ON borrowing.ID_Tool = tool_data.ID
                JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee
                WHERE (ID like '%$key_word%' or Tool_Name like '%$key_word%' or Name_MainCategory like '%$key_word%' or
                Em_FirstName like '%$key_word%' or Em_LastName like '%$key_word%' or Site like '%$key_word%')
                AND tool_data.Status = 1 AND borrowing.Status = 1
                limit {$start}, {$perpage}";

            }else{
                $sql = "SELECT borrowing.*, tool_data.*, tool_maincategory.Name_MainCategory,
                employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone
                FROM tool_data
                JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                JOIN borrowing ON borrowing.ID_Tool = tool_data.ID
                JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee
                WHERE tool_data.Status = 1 AND borrowing.Status = 1
                limit {$start}, {$perpage}";

            }
            
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result)) {
            ?>

            <tr>
                <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="65px" height="65px" class="center"></td>
                <td><?= $row["ID"] ?></td>
                <td><?= $row["Tool_Name"] ?> (No.<?= $row["Equipment_Sequence"] ?>)</td>
                <td><?= $row["Name_MainCategory"] ?></td>
                <td><?php
                if ($row["Status"] == 0) {
                    echo "<div class='status-available'>";
                    echo "Available";
                    echo "</div>";
                } elseif ($row["Status"] == 1) {
                    echo "<div class='status-unavailable'>";
                    echo "Unavailable";
                    echo "</div>";
                } else {
                    echo "<div class='status-unknown'>";
                    echo "Unknown"; // หรือค่าเริ่มต้นอื่น ๆ ที่คุณต้องการแสดง
                    echo "</div>";
                }
                ?></td>
                <td><?= $row["Em_FirstName"] ?> <?= $row["Em_LastName"]?></td>
                <td><?= $row["Site"] ?></td>
                <td><?= $row["Date_Borrow"] ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
        
    <?php
        if($key_word !="") {
            $sql1 = "SELECT borrowing.*, tool_data.*, tool_maincategory.Name_MainCategory,
            employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone
            FROM tool_data
            JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
            JOIN borrowing ON borrowing.ID_Tool = tool_data.ID
            JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee
            WHERE (ID like '%$key_word%' or Tool_Name like '%$key_word%' or Name_MainCategory like '%$key_word%' or
            Em_FirstName like '%$key_word%' or Em_LastName like '%$key_word%' or Site like '%$key_word%')
            AND tool_data.Status = 1 AND borrowing.Status = 1";
    
        } else {
            $sql1 = "SELECT borrowing.*, tool_data.*, tool_maincategory.Name_MainCategory,
            employee_data.Em_FirstName, employee_data.Em_LastName, employee_data.Em_Phone
            FROM tool_data
            JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
            JOIN borrowing ON borrowing.ID_Tool = tool_data.ID
            JOIN employee_data ON borrowing.ID_Employee = employee_data.ID_Employee
            WHERE tool_data.Status = 1 AND borrowing.Status = 1";
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
                href="home_unavailable.php?page=<?php echo $i; ?>&keyword=<?php echo $key_word; ?>">
            <?php echo $i; ?>
            </a>
            </li>
            
        <?php } ?>

    </ul>
    </nav>

</div>


</body>
</html>
