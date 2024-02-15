<?php

include 'php_session_start.php';

require_once 'vendor/autoload.php';
use Picqer\Barcode\BarcodeGeneratorHTML;

// สร้างรหัส Barcode
//$generator = new BarcodeGeneratorHTML();
//$htmlBarcode = $generator->getBarcode('123456', $generator::TYPE_CODE_128);

//echo $htmlBarcode;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barcode</title>
</head>
<body>

<?php include 'banner.php'; ?>

<style>
.button {
        background-color: #009860; 
        padding: 6px 10px; /*ระยะห่างของขอบปุ่มและข้อความภายใน*/
        text-align: center; /*การจัดวางข้อความในปุ่ม (ตรงกลาง)*/
        text-decoration: none; /*การจัดรูปแบบข้อความ (ไม่มีขีดเส้นใต้)*/
        display: inline-block; /*การแสดงผลเป็น inline-block*/
        font-size: 16px; /*ขนาดตัวอักษร*/
        margin: 2px 2px; /*ระยะห่างรอบขอบปุ่ม*/
        transition-duration: 0.4s; /*ระยะเวลาที่ใช้ในการเปลี่ยนสีเมื่อ hover (0.4 วินาที)*/
        cursor: pointer; /*รูปลูกศรของเมาส์เมื่อชี้ไปยังปุ่ม*/
        border-radius: 6px; /*ขอบมน*/
    }

.buttongray {
        background-color: white;
        padding: 6px 10px;
        text-align: center; 
        color: gray; 
        border: 1px solid gray;
        font-size: 16px;
        margin: 2px 2px;
        transition-duration: 0.4s; /*ระยะเวลาที่ใช้ในการเปลี่ยนสีเมื่อ hover (0.4 วินาที)*/
        cursor: pointer; /*รูปลูกศรของเมาส์เมื่อชี้ไปยังปุ่ม*/
        border-radius: 6px; /*ขอบมน*/
    }

.buttongray:hover {
        background-color: gray;
        color: white;
    }
    
    
.buttongreen {
        background-color: white; 
        color: #009860; 
        border: 1px solid #009860;
    }

.buttongreen:hover {
        background-color: #009860;
        color: white;
    }

table {
    border-collapse: collapse;
    margin-top: 10px; /* เพิ่มระยะห่างด้านบนของตาราง */
    margin-bottom: 40px;
}
    
thead th, tbody td {
    /*border: 1px solid black;*/
    padding: 5px 8px; /* เพิ่มขอบรอบของข้อความในเซลล์ */
    text-align: center; /* จัดตำแหน่งข้อความในเซลล์ไว้ตรงกลาง */
    border-bottom: 1px solid #DDD; /* ขอบด้านล่างสำหรับแถว */
}

thead tr {
    border-bottom: 1px solid #DDD; /* ขอบด้านล่างสำหรับแถวใน tbody */
}

tbody tr {
    border-bottom: 1px solid #DDD; /* ขอบด้านล่างสำหรับแถวใน tbody */
}

    
tbody tr:hover {
    background-color: #F0F8FF; /* พื้นหลังเปลี่ยนสีเมื่อโฮเวอร์ทุกรายการใน tbody */
}


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
        width: 200px;
    }

    .btsearch {
        background-color: white;
        color: lightgray;
        display: inline-block; /*การแสดงผลเป็น inline-block*/
        transition-duration: 0.4s; /*ระยะเวลาที่ใช้ในการเปลี่ยนสีเมื่อ hover (0.4 วินาที)*/
        cursor: pointer; /*รูปลูกศรของเมาส์เมื่อชี้ไปยังปุ่ม*/
        border: none;
        /*border: 1px solid yellow;*/
    }
    .btsearch:hover{
        color: gray;
        border: none;
    }

    .btsearch svg{
        margin-top: -3px;
    }


</style>   

<div class="container"> 
    <h1 class="display-5 text-center mb-2">Barcode</h1>

    <div class="bar-box">
        <div class="" style="width: 200px;"></div>

        <form class="search-box" method="POST">
            <div class="search">
                <input type="search" name="keyword" placehoder="search">
                <button class="btsearch">
                    <i class="bi bi-search"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
            </div>
        </form>

        <div class="bt-box">
            <button class="button buttongray" onclick="downloadSelected()">Download</button>
            <a href="tool_show.php" class="button buttongreen">Back</a>
        </div>
            
    </div>

    <table style="width:95%;margin-left: auto;margin-right: auto">
        <!-- Heading Table -->
        <thead>
            <tr> 
                <th style="width:2%"><input type="checkbox" id="selectAll"> </th>
                <th style="width:5%">Image</th>
                <th style="width:10%">Tool ID</th>
                <th style="width:10%">Barcode</th>
                <th style="width:20%">Name</th>
                <th style="width:15%">Category</th> 
            </tr>
        </thead>
        
        <!-- Body Table -->
        <tbody>
        <?php
        $key_word = @$_POST['keyword'];
        if($key_word !="") {
            $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory
                    FROM tool_data
                    JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                    WHERE ID like '%$key_word%' or Tool_Name like '%$key_word%' or Name_MainCategory like '%$key_word%'";

        }else{
            $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory
                    FROM tool_data
                    JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory";
        }
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            
        ?>
        
        <tr>
            <td style="text-align: center; line-height: 0;">   
                <!-- Checkbox input -->
                <input type="checkbox" class="download-checkbox" name="download[]" value="<?= $row["ID"] ?>"></td>

            <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="60px" height="60px"></td>
            <td><?= $row["ID"] ?></td>
            <td style="text-align: center; line-height: 0;">
            <?php

                // สร้างรหัส Barcode
                $generator = new BarcodeGeneratorHTML();
                $barcodeHtml = $generator->getBarcode($row["ID"], $generator::TYPE_CODE_128, 2, 30);
                //echo '<center><a href="data:image/png;base64,' . base64_encode($generator->getBarcode($row["ID"], $generator::TYPE_CODE_128, 2, 30)) . '" download >download</a></center>';

                // แสดงรหัสบาร์โค้ดในแท็บเซลล์
                echo '<div style="display: inline-block;">';
                echo $barcodeHtml;
                echo '</div>';

                // แสดงตัวเลขด้านล่าง
                echo '<div style="margin-top: 10px; font-size: 12px;">';
                echo $row["ID"];
                echo '</div>';
            ?>
            </td>
            <td><?= $row["Tool_Name"] ?> (No.<?= $row["Equipment_Sequence"] ?>)</td>
            <td><?= $row["Name_MainCategory"] ?></td>
        </tr>
    <?php
        }
    ?>
    </table>



<script>
document.getElementById('selectAll').addEventListener('change', function () {
    var checkboxes = document.getElementsByClassName('download-checkbox');
    for (var i = 0; i < checkboxes.length; i++) {
        checkboxes[i].checked = this.checked;
    }
});

function downloadSelected() {
    var checkboxes = document.getElementsByName('download[]');
    var selectedIds = [];

    // วนลูปเพื่อตรวจสอบ Checkbox ที่ถูกเลือก
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            selectedIds.push(checkboxes[i].value);
        }
    }

    // ตรวจสอบว่ามี ID ที่ถูกเลือกหรือไม่
    if (selectedIds.length > 0) {
        // ส่งไปยังสคริปต์หรือหน้าที่จะดาวน์โหลด
        window.location.href = 'tool_download.php?ids=' + selectedIds.join(',');
    } else {
        alert('Please select at least one item to download.');
    }
}
</script>
 

</div>
</body>
</html>