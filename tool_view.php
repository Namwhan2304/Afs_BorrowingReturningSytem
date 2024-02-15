<?php
// tool_view.php

include 'php_session_start.php'; 



if (isset($_GET['id'])) {
    $toolName = mysqli_real_escape_string($conn, $_GET['id']);

        
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
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
    
    <div class="d-grid gap-2 d-md-flex justify-content-md-end" style = "margin-right:5%">
        <a href="tool_show.php" class="button buttongreen">Back</a>
        <a href="tool_add_sequence.php?id=<?= $toolName ?>" class="button buttongreen">Add +</a>
    </div>
    
    <!--  Start Table  -->
    
    <table style="width:90%;margin-left: auto;margin-right: auto">
        <!-- Heading Table -->
        <thead>
            <tr> 
                <th style="width:10%">Image</th>
                <th style="width:10%">ID</th>
                <th style="width:10%">Name</th>
                <th style="width:10%">Category</th>
                <th style="width:10%">Sequence</th>
                <th style="width:10%">Status</th>
                <th style="width:5%">Edit</th>
                <th style="width:5%">Delete</th>
            </tr>
        </thead>

    
        <!-- Body Table -->
        <tbody>
        
    <?php
        $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory
        FROM tool_data
        LEFT JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
        WHERE tool_data.Tool_Name = '$toolName'";

        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
    ?>
        <tr>
            <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="60px" height="60px"></td>
            <td><?= $row["ID"] ?></td>
            <td><?= $row["Tool_Name"] ?></td>
            <td><?= $row["Name_MainCategory"] ?></td>
            <td><?= $row["Equipment_Sequence"] ?></td>
            <td>    <?php
                if ($row["Status"] == 0) {
                    echo "<div style=color:green;>";
                    echo "Available";
                    echo "</div>";
                } elseif ($row["Status"] == 1) {
                    echo "<div style=color:red;>";
                    echo "Unavailable";
                    echo "</div>";
                } else {
                    echo "<div style=color:gray;>";
                    echo "Unknown"; // หรือค่าเริ่มต้นอื่น ๆ ที่คุณต้องการแสดง
                    echo "</div>";
                }
                ?></td>
            <td> <a href="tool_edit.php?id=<?= $row["ID"] ?>" class="btn btn-secondary ">Edit</a> </td>
            <td> <a href="tool_delete.php?id=<?= $row["ID"] ?>" class="btn btn-danger" onclick="Del(this.href);return false;">Delete</a> </td>
        </tr>
        
    <?php
        }
    ?>

    </tbody>
</div>
</body>
</html>
        