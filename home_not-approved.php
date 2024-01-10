<?php
include 'condb.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
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


    </table>

</div>

    
    
    



</body>
</html>