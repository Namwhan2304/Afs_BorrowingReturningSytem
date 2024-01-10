<?php
include 'condb.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
   
    <!-- Boostrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="home.css"> 

</head>
<body>

<?php include 'banner.php'; ?>
 
    <h1 class="display-4 text-center mb-2">Employee</h1>
    <!-- h3 ขนาดหัวข้อ -->
    <!-- text-center จัดรูปแบบตรงกลาง-->
    <!-- alert alert-light รูปแบบข้อความ -->
    <!-- mb-4 เพิ่มช่องว่างล่าง mt-4 เพิ่มช่องว่างบน -->
<div class="container"> 

    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="employee_add.php" class="btn btn-success mb-2">Add</a>
    <!-- ปุ่มเพิ่มข้อมูล ลิ้งค์ไปอีกหน้า -->
    </div>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Lastname</th>
            <th>Phone number</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    <?php
        $sql = "SELECT * FROM employee_data";
        $result=mysqli_query($conn,$sql);
        while($row=mysqli_fetch_array($result)){
        ?>
            <tr>
            <td><?=$row["ID_Employee"]?></td>
            <td><?=$row["Em_FirstName"]?></td>
            <td><?=$row["Em_LastName"]?></td>
            <td><?=$row["Em_Phone"]?></td>
            <td> <a href="employee_edit.php?id=<?=$row["ID_Employee"]?>" class="btn btn-secondary ">Edit</a> </td> 
            <td> <a href="employee_delete.php?id=<?=$row["ID_Employee"]?>" class="btn btn-danger" onclick="Del(this.href);return false;">Delete</a> </td>


            </tr>
    <?php
        }
        mysqli_close($conn); //ปิดการเชื่อมต่อฐานข้อมูล
        ?>

    </table>

    </div>

    </body>
    </html>

    <script language="JavaScript">
    function Del(mypage){
        var agree=confirm("Do you want to delete the data?");
        if(agree){
            window.location=mypage;
        }

    }
</div>

</script>