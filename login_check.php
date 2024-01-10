<?php
include 'condb.php';
session_start();

$username = $_POST["username"];
$password = $_POST["password"];

//$password=hash('sha512', $password);

$sql = "SELECT * FROM `employee_data` WHERE username='$username' AND Password='$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($row > 0) {
    $_SESSION["username"] = $row['UserName'];
    $_SESSION["password"] = $row['Password'];
    $_SESSION["firstname"] = $row['Em_FirstName'];
    $_SESSION["lastname"] = $row['Em_LastName'];
    $show=header("location:home.php");
} else {
    $_SESSION["Error"] = "<p>Your username or password is invalid</p>";
}
?>
