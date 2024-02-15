<?php
include 'php_session_start.php';;

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ตรวจสอบว่าข้อมูลที่จำเป็นไม่ว่างเปล่าหรือไม่
    if (
        !empty($_POST["tool_name"]) &&
        !empty($_POST["maintype"]) &&
        !empty($_POST["toolamount"])
    ) {
        $tool_name = mysqli_real_escape_string($conn, $_POST["tool_name"]);
        $maintype = mysqli_real_escape_string($conn, $_POST["maintype"]);
        $toolamount = mysqli_real_escape_string($conn, $_POST["toolamount"]);
        
        // Upload image
        if (is_uploaded_file($_FILES['toolimage']['tmp_name'])) {
            $new_image_name = 'tool_'.uniqid().".".pathinfo(basename($_FILES['toolimage']['name']), PATHINFO_EXTENSION);
            $image_upload_tool = "./tool_image/".$new_image_name;
            move_uploaded_file($_FILES['toolimage']['tmp_name'], $image_upload_tool);
        } else {
            $new_image_name = "";
        }

        for ($i = 0; $i < $toolamount; $i++) {
            // สร้างรหัสตามที่กำหนด
            $mainCategoryID = sprintf('%02d', array_search($maintype, array("Electrical tools", "Ladders", "Trolley")) + 1);
        
            // เตรียม SQL Query สำหรับการเพิ่มข้อมูลลงในฐานข้อมูล
            $sql = "INSERT INTO tool_data (Tool_Name, ID_MainCategoryTool, Tool_Image, Equipment_Sequence, Status)
                    VALUES ('$tool_name', '$maintype', '$new_image_name'," . ($i + 1) . ", '0')";
        
            // ทำการ query และตรวจสอบผลลัพธ์
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Record added successfully');</script>";
                echo "<script>window.location = 'tool_show.php';</script>";  // เพิ่มบรรทัดนี้เพื่อให้ไปยังหน้า tool_show.php
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Tool</title>

    <!-- Boostrap CSS 
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="buttonbg.css"> 

</head>
<body>

<?php include 'banner.php'; ?>

<div style="width:50%;margin-left: auto;margin-right: auto"> 
    <h1 class="display-5 text-center mb-2">Add Tool</h1>

    <form name="form1" method="post" action="tool_add.php" enctype="multipart/form-data">

        <div class="h6 mt-2"> 
            <label>Name tool</label>
            <input type="text" name="tool_name" required class="form-control"> <!--required ห้ามเว้นช่องว่าง-->
        </div>

        <div class="h6 mt-2"> 
            <label>Maincategory</label> 
            <select class="form-select form-select" id="MainCategoryDropdown" name="maintype" aria-label="Default select example">
                <option disabled selected>Open this select menu</option>
                <option value="1">Electrical tools</option>
                <option value="2">Ladders</option>
                <option value="3">Trolley</option>
            </select>
        </div>




        <!-- JavaScript dropdown -->
    <script>
    // ฟังก์ชันที่ถูกเรียกเมื่อหน้าเว็บโหลดเสร็จ
    document.addEventListener("DOMContentLoaded", function () {
        // รับ reference ของ dropdown แรก
        var MainCategoryDropdown = document.getElementById("MainCategoryDropdown");

        // เพิ่ม Event Listener สำหรับ dropdown แรก
            MainCategoryDropdown.addEventListener("change", function () {
                // ดึงค่าที่ถูกเลือกจาก dropdown แรก
                var SelectedMainCategory = MainCategoryDropdown.value;
        });

    });
    </script>
    <!-- End JavaScript -->

        
        <div class="h6 mt-2">   
            <label>Amount</label>
            <input type="number" name="toolamount" required class="form-control">
        </div> 

        <div class="h6 mt-2">   
            <label>Image</label>
            <input type="file" name="toolimage" required class="form-control">
        </div> 

    <div class="position">
        <div class="right">
            <input type="submit" class="buttonbg buttonbggreen" value="Submit">    
            <a href="tool_show.php" class="buttonbg buttonbgback">Back</a>
        </div>
    </div>

    </form>





</div>  
    
</body>
</html>