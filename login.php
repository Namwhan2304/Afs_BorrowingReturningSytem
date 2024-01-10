<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css"> 
</head>
<body>
<!-----------------------------Banner--------------------------------------->
<!-----------------------------fifa--------------------------------------->
<section class="banner">
    <div class="banner-logo">
        img src="tool_image/Logo.png">
    </div>
</section>
<!--------------------------------------------------------------------------->

<br><br>

<div class="container">
    <div class="row g-3 align-items-center col-md-5 p-2 border border-dark-subtle mx-auto">
    
    <h1 class="display-5 text-center mb-2 mt-1">Login</h1>
    <form method="POST" action="">
        <div class="mb-3 row">
            <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
        <div class="col-sm-10">
            <input type="text" name="username"class="form-control" required>
        </div>
        </div>

        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" name="password">
        </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <input type="submit" name="submit" class="btn btn-success mb-2" value="Login">
        </div>
            <p class="text-center">or <a href="register.php"> Register </a></p>

</body>
</html>

