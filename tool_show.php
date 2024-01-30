<?php
include 'php_session_start.php'; // เรียกใช้ condb.php เพื่อเชื่อมต่อฐานข้อมูล
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool</title>

    <!-- Boostrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css"> 

</head>
<body>

<?php include 'banner.php'; ?>

<div class="container"> 
    <h1 class="display-5 text-center mb-2">Tool</h1>
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="tool_all.php" class="button buttongreen">All tool</a>
        <a href="barcode.php" class="button buttongreen">Barcode</a>
        <a href="tool_add.php" class="button buttongreen">Add New Tool</a>
    </div>
    
    <!--  Start Table  -->
    
    <table>
        <!-- Heading Table -->
        <thead>
            <tr> 
                <th style="width:10%">Image</th>
                <th style="width:10%">ID</th>
                <th style="width:20%">Name</th>
                <th style="width:15%">Category</th>
                <th style="width:15%">Subcategory</th>
                <th style="width:15%">Amount</th>
                <th style="width:10%"></th>
                
                <!--<th style="width:5%"></th>-->
            </tr>
        </thead>
        
        <!-- Body Table -->
        <tbody>

        
    <?php
        $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory, tool_subcategory.Name_SubCategory, COUNT(*) as EquipmentCount
        FROM tool_data
        JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
        JOIN tool_subcategory ON tool_data.ID_SubCategoryTool = tool_subcategory.ID_SubCategory
        GROUP BY tool_data.Tool_Name";

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="60px" height="60px"></td>
            <td><?= $row["ID"] ?></td>
            <td><?= $row["Tool_Name"] ?></td>
            <td><?= $row["Name_MainCategory"] ?></td>
            <td><?= $row["Name_SubCategory"] ?></td>
            <td><?= $row["EquipmentCount"] ?></td>
            <td> <a href="tool_view.php?id=<?= $row["Tool_Name"] ?>" class="btn btn-secondary ">View</a> </td>
            <!--td> <a href="tool_add_sequence.php?id=<?= $row["Tool_Name"] ?>" class="btn btn-success" >Add</a></td-->

        </tr>
    <?php
        }
    ?>


</div>
</body>
</html>
        