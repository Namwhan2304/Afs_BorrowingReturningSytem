<?php
include 'condb.php';
session_start();

// Check if the form is submitted
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    //$password=hash('sha512',$password);

    // Check if username and password match in the database
    $sql = "SELECT * FROM `employee_data` WHERE ID_Employee ='$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($row) {
        // If login is successful, set session variables and redirect
        // Use password_verify for plaintext password comparison
        if ($password == $row['Password']) {
            $_SESSION["username"] = $row['ID_Employee'];
            $_SESSION["password"] = $row['Password'];
            $_SESSION["firstname"] = $row['Em_FirstName'];
            $_SESSION["lastname"] = $row['Em_LastName'];


            // Check if 'status' index exists in the array
            if (isset($row['Status'])) {
                $status = $row['Status'];

                if ($status == '0') {
                    header("location:mobile_home.php");
                } elseif ($status == '1') {
                    header("location:home_page.php");
                }

                exit();
            } else {
                // 'status' index is not present in the array
                $_SESSION["Error"] = "<p style='color:red;text-align:center;'>Your account status is undefined</p>";
                header("location: login.php");
                exit();
            }
        } else {
            // If login fails, set an error message
            $_SESSION["Error"] = "<p style='color:red;text-align:center;'>Your username or password is invalid</p>";
            header("location: login.php");
            exit();
        }
    } else {
        // If login fails, set an error message
        $_SESSION["Error"] = "<p style='color:red;text-align:center;'>Your username or password is invalid</p>";
        header("location: login.php");
        exit();
    }
} else {
    // If form is not submitted, set a different error message
    $_SESSION["Error"] = "Please enter username and password";
    header("location: login.php");
    exit();
}
?>
