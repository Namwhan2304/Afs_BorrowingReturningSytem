<?php
include 'condb.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
    <!---Link to css-->
    <link rel="stylesheet" href="home.css"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
   
    <meta http-equiv="refresh" content="0;url=home.php">
</head>
<body>

<?php include 'banner.php'; ?>

<div class="container"> 
    <h1 class="display-4 text-center mb-2">Report</h1>
    
    <div class="col-7 mb-2 mx-auto "> 
        <a href="home_vertification.php" class="btn btn-outline-success mb-2 mt-2">Waiting for verification</a>
        <a href="home_approved.php" class="btn btn-outline-success mb-2 mt-2">Approved</a>
        <a href="home_not-approved.php" class="btn btn-outline-success mb-2 mt-2">Not approved</a>
        <a href="home_due-for-return.php" class="btn btn-outline-success mb-2 mt-2">Items due for return</a>
        <a href="home_returned.php" class="btn btn-outline-success mb-2 mt-2">returned</a>
    </div>

    
    <table class="table">
            <thead>
              <tr>
                <th scope="col">Borrow No.</th>
                <th scope="col">Name</th>
                <th scope="col">ID Tool</th>
                <th scope="col">Borrower</th>
                <th scope="col">Borrowing Date</th>
                <th scope="col">Returning Date</th>
                <th scope="col">Construction site</th>

                <th scope="col">Status</th>
              </tr>
            </thead>

    <!-- ข้อมูลการยืม
    <?php
        $sql = "SELECT * FROM ";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result)){
        ?>
            <tr>
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
        -->
        </table>

</div>

    
    
    



</body>
</html>