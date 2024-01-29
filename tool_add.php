<?php
include 'php_session_start.php';;

// ตัวแปร $subcategories ที่เก็บข้อมูลเกี่ยวกับ subcategory
$subcategories = array(
    "Electrical tools" => ["Set A", "Set B"],
    "Ladders" => ["Platform ladders", "A-Frame", "Single/Extension ladder"],
    "Trolley" => ["AFS1", "AFS2", "AFS3", "AFS4", "AFS5", "AFS6"]
);

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ตรวจสอบว่าข้อมูลที่จำเป็นไม่ว่างเปล่าหรือไม่
    if (
        !empty($_POST["toolname"]) &&
        !empty($_POST["maintype"]) &&
        !empty($_POST["subtype"]) &&
        !empty($_POST["toolamount"])
    ) {
        $toolname = mysqli_real_escape_string($conn, $_POST["toolname"]);
        $maintype = mysqli_real_escape_string($conn, $_POST["maintype"]);
        $subtype = mysqli_real_escape_string($conn, $_POST["subtype"]);
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
            $subCategoryID = sprintf('%02d', array_search($subtype, $subcategories[$maintype]) + 1);
        
            // เตรียม SQL Query สำหรับการเพิ่มข้อมูลลงในฐานข้อมูล
            $sql = "INSERT INTO tool_data (Tool_Name, ID_MainCategoryTool, ID_SubcategoryTool, Tool_Image, Equipment_Sequence, Status)
                    VALUES ('charger', '01', '01', 'tool_65b1a1004cfc8.jpg'," . ($i + 1) . ", '0')";
        
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

<div class="margin-addpage"> 
    <h1 class="display-5 text-center mb-2">Add Tool</h1>

    <form name="form1" method="post" action="tool_add.php" enctype="multipart/form-data">

        <div class="h6 mt-2"> 
            <label>Name tool</label>
            <input type="text" name="toolname" required class="form-control"> <!--required ห้ามเว้นช่องว่าง-->
        </div>

        <div class="h6 mt-2"> 
            <label>Maincategory</label> 
            <select class="form-select form-select" id="MainCategoryDropdown" name="maintype" aria-label="Default select example">
                <option disabled selected>Open this select menu</option>
                <option value="Electrical tools">Electrical tools</option>
                <option value="Ladders">Ladders</option>
                <option value="Trolley">Trolley</option>
            </select>
        </div>

        <!-- เพิ่มแอตทริบิวต์ name ให้กับ dropdown ของ subcategory -->
        <div class="h6 mt-2"> 
            <label>Subcategory</label>
            <select class="form-select form-select" name="subtype" id="SubCategoryDropdown" aria-label="Default select example">
                <option disabled selected>Open this select menu</option>
                <!-- ตัวเลือก Subcategory จะถูกเพิ่มผ่าน JavaScript -->
            </select>
        </div>



        <!-- JavaScript dropdown -->
    <script>
    // ฟังก์ชันที่ถูกเรียกเมื่อหน้าเว็บโหลดเสร็จ
    document.addEventListener("DOMContentLoaded", function () {
        // รับ reference ของ dropdown แรก
        var MainCategoryDropdown = document.getElementById("MainCategoryDropdown");

        // รับ reference ของ dropdown ที่สอง
        var SubCategoryDropdown = document.getElementById("SubCategoryDropdown");

        // กำหนด option เริ่มต้นสำหรับ dropdown ที่สอง
        SubCategoryDropdown.innerHTML = '<option disabled selected>Open this select menu</option>';

        // รายการของหมวดหมู่ย่อยที่จะใส่เข้าไปใน dropdown ที่สอง
        var subcategories = {
            "Electrical tools": ["Set A", "Set B"],
            "Ladders": ["Platform ladders", "A-Frame", "Single/Extension ladder"],
            "Trolley": ["AFS1", "AFS2", "AFS3", "AFS4", "AFS5", "AFS6"]
        };

        // เพิ่ม Event Listener สำหรับ dropdown แรก
            MainCategoryDropdown.addEventListener("change", function () {
                // ดึงค่าที่ถูกเลือกจาก dropdown แรก
                var SelectedMainCategory = MainCategoryDropdown.value;

                // ล้าง option ใน dropdown ที่สอง
            SubCategoryDropdown.innerHTML = '<option disabled selected>Open this select menu</option>';

            // เติม option ใหม่ลงใน dropdown ที่สอง ตามหมวดหมู่ที่ถูกเลือก
            subcategories[SelectedMainCategory].forEach(function (subcategory) {
                var option = document.createElement("option");
                option.value = subcategory;
                option.textContent = subcategory;
                SubCategoryDropdown.appendChild(option);
            });
        });

        // เพิ่ม option ใน dropdown ที่สอง เมื่อหน้าเว็บโหลดเสร็จ
        var SelectedMainCategory = MainCategoryDropdown.value;
        subcategories[SelectedMainCategory].forEach(function (subcategory) {
            var option = document.createElement("option");
            option.value = subcategory;
            option.textContent = subcategory;
            SubCategoryDropdown.appendChild(option);
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