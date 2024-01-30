<?php
include 'php_session_start.php';;

if (isset($_GET['id'])) {
    $toolName = mysqli_real_escape_string($conn, $_GET['id']);
    
    $sql = "SELECT ID_MainCategoryTool, ID_SubcategoryTool, Tool_Image, MAX(Equipment_Sequence) AS max_sequence
            FROM tool_data WHERE Tool_Name = '$toolName'";
    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    
    $maxSequence = $row['max_sequence'];
    $ID_MainCategoryTool = $row['ID_MainCategoryTool'];
    $ID_SubcategoryTool = $row['ID_SubcategoryTool'];
    $Tool_Image = $row['Tool_Image'];

    $sqlData = "SELECT * FROM tool_data WHERE Tool_Name = '$toolName'";
    $resultData = mysqli_query($conn, $sqlData);
    $rowData = mysqli_fetch_assoc($resultData);


    $sqlInsert = "INSERT INTO tool_data (Tool_Name, ID_MainCategoryTool, ID_SubcategoryTool, Tool_Image, Equipment_Sequence) VALUES ('$toolName','$ID_MainCategoryTool', '$ID_SubcategoryTool', '$Tool_Image' , $maxSequence + 1)";
    
    if (mysqli_query($conn, $sqlInsert)) {
        $newToolId = mysqli_insert_id($conn); // รับค่า ID ของ Tool ที่ถูกสร้างขึ้น
            echo "<script>alert('Record added successfully');</script>";
            echo "<script>window.location = 'tool_view.php?id=<?= $toolName?>';</script>";

    } else {
        echo "Error: " . $sqlInsert . "<br>" . mysqli_error($conn);
    }
} else {
    echo "Error: Tool ID not provided.";
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
    <link rel="stylesheet" href="css.css"> 
</head>
<body>

<?php include 'banner.php'; ?>

<div class="container"> 
    <h1 class="display-5 text-center mb-2">Add Tool</h1>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
    <td> <a href="tool_view.php?id=<?= $toolName ?>" class="btn btn-secondary ">Back</a> </td>
    </div>
    
    <!--  Start Table  -->
    
    <table style="width:90%;margin-left: auto;margin-right: auto">
        <!-- Heading Table -->
        <thead>
            <tr> 
                <th style="width:10%">Image</th>
                <th style="width:10%">ID</th>
                <th style="width:20%">Name</th>
                <th style="width:15%">Category</th>
                <th style="width:15%">Subcategory</th>
                <th style="width:10%">Sequence</th>
            </tr>
        </thead>
        
        <!-- Body Table -->
        <tbody>
        
    <?php
        $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory, tool_subcategory.Name_SubCategory
        FROM tool_data
        LEFT JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
        LEFT JOIN tool_subcategory ON tool_data.ID_SubCategoryTool = tool_subcategory.ID_SubCategory
        WHERE tool_data.ID = $newToolId"; // ใช้ ID ที่ถูกสร้างขึ้นใหม่เพื่อดึงข้อมูล
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="60px" height="60px"></td>
            <td><?= $row["ID"] ?></td>
            <td><?= $row["Tool_Name"] ?></td>
            <td><?= $row["Name_MainCategory"] ?></td>
            <td><?= $row["Name_SubCategory"] ?></td>
            <td><?= $row["Equipment_Sequence"] ?></td>
        </tr>
        
    <?php
        }
    ?>
    </tbody>
</div>
</body>
</html>
