<?php include 'banner.php'; ?>

<?php
include 'condb.php';
$id=$_GET['id'];
$sql="DELETE FROM tool_data WHERE ID_Tool='$id'";
if(mysqli_query($conn,$sql)){
    echo"<script>alert('Successfully deleted data');</script>";
    echo"<script>window.location='tool_show.php';</script>";
}else{
    echo"Error :".$sql."<br>".mysqli_error($conn);
    echo"<script>alert('Unable to delete data');</script>";
}

mysqli_close($conn);

?>