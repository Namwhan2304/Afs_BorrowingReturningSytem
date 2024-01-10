<?php
include 'condb.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>

    <!-- Boostrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 

</head>

<body>
<?php
// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // ตรวจสอบว่ามีค่าที่ส่งมาจริง ๆ หรือไม่
    if (isset($_POST["MainCate"]) 
        && isset($_POST["SubCate"]) 
        && isset($_POST["SubsubCate"])
        && isset($_POST["SelectMainCate"])
        && isset($_POST["SelectSubCate"])) {
        
        // นำข้อมูลจากฟอร์ม
        $MainCate = $_POST["MainCate"];
        $SubCate = $_POST["SubCate"];
        $SelectMainCate = $_POST["SelectMainCate"];
        $SubsubCate = $_POST["SubsubCate"];
        $SelectSubCate = $_POST["SelectSubCate"];

        
        // เขียนคำสั่ง SQL เพื่อบันทึกข้อมูล
        $sql = "INSERT INTO tool_maincategory (MainCate) VALUES ('$MainCate')";
        $sql = "INSERT INTO tool_Subcategory (SubCate, Selectmaincate) VALUES ('$SubCate', '$SelectMainCate')";
        $sql = "INSERT INTO tool_Subsubcategory (SubsubCate, SelectSubCate) VALUES ('$SubsubCate', '$SelectSubCate')";

        // ทำการ query และตรวจสอบการทำงาน
        if (mysqli_query($conn, $sql)) {

            echo"<script>alert('Record added successfully');</script>";

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // ปิดการเชื่อมต่อ
        mysqli_close($conn);
    } else {
        echo "All fields are required!";
    }
}
?>  


<body>
    <div class="container">
        <div class="h3 text-center alert alert-success  mb-4 mt-4" role="alert">Add Category Tool</div>
        <form method="POST" action="">
        
        <div class="mt-2">    
            <label>Maincategory</label>
            <input type="text" name="maincate" required class="form-control">
        
        <div class="mt-2 row">  
            <label class="col-form-label">Subcategoty</label>
            <div class="col-sm-3 ">
                <input type="text" name="subcate" required class="form-control">
        </div>
        
              
        <div class="mt-2"> 
            <label class="col-form-label">Select Maincategory</label>
            <select class="form-select" name="selectmain" > <!--ตัวเลือกแบบลงมา-->
            <option disabled selected>Open this select type</option> 
            <?php
            $sql="SELECT * FROM `tool_maincategory` ORDER BY ID_MainCategory"; //เลือกข้อมูลจากฐานข้อมูล tool_maincategory เรียงตาม ID_MainCategoryTool 
            $hand=mysqli_query($conn,$sql); 
            while($row=mysqli_fetch_array($hand)){
            ?>
            <option value="<?=$row['ID_MainCategory']?>"><?=$row['Name_MainCategory']?></option>
            <?php
            }
            ?>
        </select>
        
            <div class="mt-2">
            <label>Subsubcategory</label>
            <input type="text" name="lname" required class="form-control">
        

            <input type="submit" class="btn btn-success mt-2" value="Submit">
            <a href="home.php" class="btn btn-secondary mt-2">Back</a>
        </form>
    </div>
</body>
</body>
</html>