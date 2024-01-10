<?php
include 'condb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (
        isset($_POST["toolname"]) &&
        isset($_POST["maintype"]) &&
        isset($_POST["subtype"]) &&
        isset($_POST["subsubtype"]) &&
        isset($_POST["toolamount"])
    ) {
        $toolname = mysqli_real_escape_string($conn, $_POST["toolname"]);
        $maintype = mysqli_real_escape_string($conn, $_POST["maintype"]);
        $subtype = mysqli_real_escape_string($conn, $_POST["subtype"]);
        $subsubtype = mysqli_real_escape_string($conn, $_POST["subsubtype"]);
        $toolamount = mysqli_real_escape_string($conn, $_POST["toolamount"]);
        
        // Upload image
        if (is_uploaded_file($_FILES['toolimage']['tmp_name'])) {
            $new_image_name = 'tool_'.uniqid().".".pathinfo(basename($_FILES['toolimage']['name']), PATHINFO_EXTENSION);
            $image_upload_tool = "./tool_image/".$new_image_name;
            move_uploaded_file($_FILES['toolimage']['tmp_name'], $image_upload_tool);
        } else {
            $new_image_name = "";
        }

        // Insert data into database
        for ($i = 0; $i < $toolamount; $i++) {
            $product_code = uniqid($maintype . $subtype . $subsubtype . $i);

            $sql = "INSERT INTO tool_data (Tool_Name, ID_MainCategoryTool, ID_SubcategoryTool, ID_SubSubcategoryTool, Tool_Amount, Tool_Image, Product_Code)
                    VALUES ('$toolname', (SELECT ID_MainCategory FROM main_category WHERE MainCategory_Name = '$maintype'), 
                               (SELECT ID_Subcategory FROM subcategory WHERE Subcategory_Name = '$subtype'), 
                               (SELECT ID_SubSubcategory FROM subsubcategory WHERE SubSubcategory_Name = '$subsubtype'), 
                               1, '$new_image_name', '$product_code')";

            // ทำการ escape ค่าใน SQL Query
            $sql = mysqli_real_escape_string($conn, $sql);


                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Record added successfully');</script>";
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

    <!-- Boostrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 

</head>
<body>

<?php include 'banner.php'; ?>

    <div class="container"> 
        <!-- <div class="row">
        <div class="col-sm-6"> -->

        <h1 class="display-5 text-center mb-2">Add Tool</h1>

    <form name="form1" method="post" action="tool_add.php" enctype="multipart/form-data">

        <div class="h6 mt-2"> 
        <label>Name tool</label>
        <input type="text" name="toolname" required class="form-control"> <!--required ห้ามเว้นช่องว่าง-->
            
    <div class="h6 mt-2"> 
    <label>Maincategory</label> 
    <select class="form-select form-select" id="MainCategoryDropdown" aria-label="Default select example">
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

    <!-- เพิ่มแอตทริบิวต์ name ให้กับ dropdown ของ subsubcategory -->
    <div class="h6 mt-2"> 
        <label>Subsubcategory</label>
        <select class="form-select form-select" name="subsubtype" id="SubsubCategoryDropdown" aria-label="Default select example">
            <option disabled selected>Open this select menu</option>
            <!-- ตัวเลือก Subsubcategory จะถูกเพิ่มผ่าน JavaScript -->
        </select>
    </div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    var MainCategoryDropdown = document.getElementById("MainCategoryDropdown");
    var selectedSubCategory = document.getElementById("SubCategoryDropdown").value;
    var selectedSubSubCategory = document.getElementById("SubsubCategoryDropdown").value;

    SubCategoryDropdown.innerHTML = '<option disabled selected>Open this select menu</option>';
    SubsubCategoryDropdown.innerHTML = '<option disabled selected>Open this select menu</option>';

    var subcategories = {
        "Electrical tools": ["Set A", "Set B"],
        "Ladders": ["Platform ladders", "A-Frame", "Single/Extension ladder"],
        "Trolley": ["AFS1", "AFS2", "AFS3", "AFS4", "AFS5", "AFS6"]
    };

    var subsubcategories = {
        "Set A": ["Impact screw gun", "Screw driver gun", "Hammer drill", "Charger", "Battery (3 Batteries per pack)"],
        "Platform ladders": ["6ft", "7ft"],
        "A-Frame": ["10ft"],
        "Single/Extension ladder": ["6ft (Single)", "7ft (Single)", "10ft (Extend to 18ft)"]
    };

    MainCategoryDropdown.addEventListener("change", function () {
        var SelectedMainCategory = MainCategoryDropdown.value;

        SubCategoryDropdown.innerHTML = '<option disabled selected>Open this select menu</option>';
        SubsubCategoryDropdown.innerHTML = '<option disabled selected>Open this select menu</option>';

        subcategories[SelectedMainCategory].forEach(function (subcategory) {
            var option = document.createElement("option");
            option.value = subcategory;
            option.textContent = subcategory;
            SubCategoryDropdown.appendChild(option);
        });
    });

    SubCategoryDropdown.addEventListener("change", function () {
    var selectedSubCategory = SubCategoryDropdown.value;

    SubsubCategoryDropdown.innerHTML = '<option disabled selected>Open this select menu</option>';

    subsubcategories[selectedSubCategory].forEach(function (subsubcategory) {
        var option = document.createElement("option");
        option.value = subsubcategory;
        option.textContent = subsubcategory;
        SubsubCategoryDropdown.appendChild(option);
        });
    });

    // เพิ่มส่วนนี้เพื่อให้ค่าเริ่มต้นถูกต้องเมื่อโหลดหน้า
    var SelectedMainCategory = MainCategoryDropdown.value;
    subcategories[SelectedMainCategory].forEach(function (subcategory) {
        var option = document.createElement("option");
        option.value = subcategory;
        option.textContent = subcategory;
        SubCategoryDropdown.appendChild(option);
    });

    var selectedSubCategory = SubCategoryDropdown.value;
    subsubcategories[selectedSubCategory].forEach(function (subsubcategory) {
        var option = document.createElement("option");
        option.value = subsubcategory;
        option.textContent = subsubcategory;
        SubsubCategoryDropdown.appendChild(option);
    });
});
</script>

                
        
        <div class="h6 mt-2">   
        <label>Amount</label>
        <input type="number" name="toolamount" required class="form-control">

        <div class="h6 mt-2">   
        <label>Image</label>
        <input type="file" name="toolimage" required class="form-control">

        
        <input type="submit" class="btn btn-success mt-2" value="Submit">
        <a href="tool_show.php" class="btn btn-secondary mt-2">Back</a>
</form>



</form>
            </div>
        </div>
    </div>  
    
</body>
</html>