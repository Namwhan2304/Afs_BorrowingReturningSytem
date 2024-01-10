<?php
include 'condb.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool</title>

    <!-- Boostrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css"> 

</head>
<body>

<?php include 'banner.php'; ?>

    <div class="container"> 
    <h1 class="display-4 text-center mb-2">Tool</h1>

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="tool_add.php" class="btn btn-success mb-2">Add</a>
    </div>

    <table class="table">
    <tr>
        <th>Image</th>
        <th>ID Tool</th>
        <th>Name</th>
        <th>Maincategory</th>
        <th>Subcategory</th>
        <th>SubSubcategory</th>
        <th>Amount</th>

        <th>Edit</th>
        <th>Delete</th>
    </tr>
    
<?php
$sql = "SELECT * FROM tool_data";
$result=mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($result)){
?>
        <tr>
        <td><img src="tool_image/<?= $row["Tool_Image"]?>" width="60px" hieght="60px"></td>
        <td><?= $row["ID_Tool"] ?></td>
        <td><?= $row["Tool_Name"] ?></td>
        <td><?= $row["ID_MainCategoryTool"] ?></td>
        <td><?= $row["ID_SubcategoryTool"] ?></td>
        <td><?= $row["ID_SubSubcategoryTool"] ?></td>
        <td><?= $row["Tool_Amount"] ?></td>
        <td> <a href="tool_edit.php?id=<?=$row["ID_Tool"]?>" class="btn btn-secondary ">Edit</a> </td> 
        <td> <a href="tool_delete.php?id=<?=$row["ID_Tool"]?>" class="btn btn-danger" onclick="Del(this.href);return false;">Delete</a> </td>
        </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
        