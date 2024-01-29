<?php
include 'php_session_start.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accout</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
    <!---Link to css-->
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">

</head>


<body>

<?php include 'mobile_banner.php'; ?>


    <!--  Borrowing List  -->
    <style>
        body {
            scrollbar-width: none; /* ซ่อน scrollbar ใน Firefox */
        }
        
        body::-webkit-scrollbar {
            display: none; /* ซ่อน scrollbar ใน Chrome, Safari, และ Edge */
        }

        div.table-box {
            margin-top: 20px;
            margin-bottom: 80px;
            margin-left: auto;
            margin-right: auto;
            padding: 10px;
            width: 85%;
            box-shadow: 0 1px 15px 0 rgba(0, 0, 0, 0.15);
            border-radius: 10px;
        }

        .custom-link {
            color: black;
            text-decoration: none; /* เอาเส้นล้างข้อความออก */
        }

        .button {
            margin-top: 15px;
            /*border: 1px solid black;*/
            text-align: center;

        }

        .button a{
            
            padding: 8px 8px;
            text-decoration: none; /* เอาเส้นล้างข้อความออก */
            font-size: 14px;
            border-radius: 10px;
            text-align: center;
            color: black;
            background-color: #ececec;
            
        }
    </style>

<div class="table-box" style="margin-top:65px;">
    <div style="margin-top:10px;" class="display-5 text-center">
        <a href="mobile_tool.php" class="custom-link">Status of tools</a>  
    </div>
    <!--  End Heading Status of tools  -->

    <div class="button">
        <a href="mobile_tool_available.php" class="">Available</a>    
        <a href="mobile_tool_unavailable.php" class="">Unavailable</a>
    </div>

    <!--    Table     -->
    <style>
        table {
            width: 85%;
            border-collapse: collapse;
            margin-left: 7.5%;
            margin-right: 7.5%;
            margin-top: 15PX;
            /*border: 1px solid black*/
        }
    
        thead th, tbody td {
            /*border: 1px solid black;*/
            padding: 5px; /* เพิ่มขอบรอบของข้อความในเซลล์ */
            border-bottom: 1px solid #DDD; /* ขอบด้านล่างสำหรับแถว */
        }


        tbody tr {
            border-bottom: 1px solid #DDD; /* ขอบด้านล่างสำหรับแถวใน tbody */
        }

    
        tbody tr:hover {
            background-color: #F0F8FF; /* พื้นหลังเปลี่ยนสีเมื่อโฮเวอร์ทุกรายการใน tbody */
        }
    

        tbody td {
            line-height: 1.5;
            font-size: 12px;
        }

        tbody tr .canter {
            text-align: center; 
        }

        tbody.left {
            text-align: left;
        }

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
        <!-- Heading Table -->
        <thead>
            <tr>
            </tr>
        </thead>
        
        <!-- Body Table -->
        <tbody>
    <?php
        $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory, tool_subcategory.Name_SubCategory
        FROM tool_data
        JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
        JOIN tool_subcategory ON tool_data.ID_SubCategoryTool = tool_subcategory.ID_SubCategory
        WHERE tool_data.Status = 0";

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td style="width:20%">
                <img src="tool_image/<?= $row["Tool_Image"] ?>" width="80px" height="80px" class="center"></td>
            <td style="width:60%">ID <?= $row["ID"] ?> 
                <br><?= $row["Tool_Name"] ?>
                (No.<?= $row["Equipment_Sequence"] ?>)</td>
            <td style="width:20%">
                <?php
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
    <?php
        }
    ?>
        </tbody>
    </table>
</div>
</body>
</html>
