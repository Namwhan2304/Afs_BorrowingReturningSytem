<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>

<body>

<style>
    body {margin:0;}

    .bar {
        position: fixed;
        margin: 0;
        list-style-type: none;
        background-color: #fff;
        display: flex;
        top: 0;
        width: 100%;
        box-shadow: 0 0px 10px 0 rgba(0, 0, 0, 0.2);
        align-items: center;
    }

    .banner{
        height: 50px;
        background-color: #fff;
        /*border: 2px solid green;*/
        width: 100%;
        left: 50%;
    }

    .banner img{
        width: 120px;
    }

    .account a{
        text-decoration: none;
        float: right;
    }
        
    .toplink {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
        width: 100%;
    }

    .toplink li a {
        display: block;
        color: #000;
        background-color: #f0f0f0;
        transition-duration: 0.4s; /* ระยะเวลาที่ใช้ในการเปลี่ยนสี (0.4 วินาที) */
        text-decoration: none;
    }

    .toplink li a:hover {
        background-color: #9999;
        color: white;
    }

    
    .left-column {
        float: left;
        width: 50%;
        text-align: center;
        padding: 10px 10px;
    }
    .right-column {   
        float: left;
        width: 50%;
        text-align: center;
        padding: 10px 10px;
    }

    .footer {
        margin: 0;
        padding: 5px 10%;
        width: 100%;
        height: 65px;
        /*border: 2px solid green;*/
        background-color: #ffff;
        position: fixed;
        bottom: 0;
        color: black;
        justify-content: space-between;
        vertical-align: middle;
        box-shadow: 0 10px 20px 0 rgba(0, 0, 0, 0.2);
    }
    
    /*-------Home-------*/
    .home-container {
        text-align: center;
        /*border: 1px solid red;*/
    }
    .home-container a {
        text-decoration: none;
        display: block;
    }
    .home {
        color: #909090;
        /*border: 1px solid green;*/
    }
    .home svg{
        color: #909090;
    }
    .home p{
        color: #9f9f9f;
    }

    /*-------Borrow-------*/
    .borrow-container {
        text-align: center;
        /*border: 1px solid red;*/
    }
    .borrow-container a {
        text-decoration: none;
        display: block;
    }
    .borrow {
        color: #909090;
        /*border: 1px solid green;*/
    }
    .borrow svg{
        color: #909090;
    }
    .borrow p{
        color: #9f9f9f;
    }

    /*-------Return-------*/
    .return-container {
        text-align: center;
        /*border: 1px solid red;*/
    }
    .return-container a {
        text-decoration: none;
        display: block;
    }
    .return {
        color: #909090;
        /*border: 1px solid green;*/
    }
    .return svg{
        color: #909090;
    }
    .return p{
        color: #9f9f9f;
    }

    /*-------Tool-------*/
    .tool-container {
        text-align: center;
        /*border: 1px solid red;*/
    }
    .tool-container a {
        text-decoration: none;
        display: block;
    }
    .tool {
        color: #909090;
        /*border: 1px solid green;*/
    }
    .tool svg{
        color: #909090;
    }
    .tool p{
        color: #9f9f9f;
    }

    /*-------Account-------*/
    .account-container {
        text-align: center;
        /*border: 1px solid red;*/
    }
    .account-container a {
        text-decoration: none;
        display: block;
    }
    .account {
        color: #909090;
        /*border: 1px solid green;*/
    }
    .account svg{
        color: #909090;
    }
    .account p{
        color: #9f9f9f;
    }
    
</style>


    <section class="bar">
        <div class="banner">
            <img src="image/AFSLogo.png">
        </div>

    </section>

    <section class="footer">
        <div class="home-container">
            <a href="mobile_home.php">
                <div class="home" style="margin:0px 10px">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
                        <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z"/>
                    </svg>
                    <p>Home</p>
                </div>
            </a>
        </div>
        
        <div class="borrow-container">
            <a href="mobile_borrow.php">
                <div class="borrow" style="margin:0px 10px">
                    <i class="bi bi-upc-scan"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-upc-scan" viewBox="0 0 16 16">
                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5M.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5M3 4.5a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0zm2 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm3 0a.5.5 0 0 1 1 0v7a.5.5 0 0 1-1 0z"/>
                    </svg>
                    <p>Borrow</p>
                </div>
            </a>
        </div>
            
        <div class="return-container">
            <a href="mobile_return.php">
                <div class="return" style="margin:0px 10px">
                    <i class="bi bi-bootstrap-reboot"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-bootstrap-reboot" viewBox="0 0 16 16">
                        <path d="M1.161 8a6.84 6.84 0 1 0 6.842-6.84.58.58 0 1 1 0-1.16 8 8 0 1 1-6.556 3.412l-.663-.577a.58.58 0 0 1 .227-.997l2.52-.69a.58.58 0 0 1 .728.633l-.332 2.592a.58.58 0 0 1-.956.364l-.643-.56A6.8 6.8 0 0 0 1.16 8z"/>
                        <path d="M6.641 11.671V8.843h1.57l1.498 2.828h1.314L9.377 8.665c.897-.3 1.427-1.106 1.427-2.1 0-1.37-.943-2.246-2.456-2.246H5.5v7.352zm0-3.75V5.277h1.57c.881 0 1.416.499 1.416 1.32 0 .84-.504 1.324-1.386 1.324z"/>
                    </svg>
                    <p>Return</p>
                </div>
            </a>
        </div>

        <div class="tool-container">
            <a href="mobile_tool.php">
                <div class="tool" style="margin:0px 10px">
                    <i class="bi bi-tools"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tools" viewBox="0 0 16 16">
                        <path d="M1 0 0 1l2.2 3.081a1 1 0 0 0 .815.419h.07a1 1 0 0 1 .708.293l2.675 2.675-2.617 2.654A3.003 3.003 0 0 0 0 13a3 3 0 1 0 5.878-.851l2.654-2.617.968.968-.305.914a1 1 0 0 0 .242 1.023l3.27 3.27a.997.997 0 0 0 1.414 0l1.586-1.586a.997.997 0 0 0 0-1.414l-3.27-3.27a1 1 0 0 0-1.023-.242L10.5 9.5l-.96-.96 2.68-2.643A3.005 3.005 0 0 0 16 3q0-.405-.102-.777l-2.14 2.141L12 4l-.364-1.757L13.777.102a3 3 0 0 0-3.675 3.68L7.462 6.46 4.793 3.793a1 1 0 0 1-.293-.707v-.071a1 1 0 0 0-.419-.814zm9.646 10.646a.5.5 0 0 1 .708 0l2.914 2.915a.5.5 0 0 1-.707.707l-2.915-2.914a.5.5 0 0 1 0-.708M3 11l.471.242.529.026.287.445.445.287.026.529L5 13l-.242.471-.026.529-.445.287-.287.445-.529.026L3 15l-.471-.242L2 14.732l-.287-.445L1.268 14l-.026-.529L1 13l.242-.471.026-.529.445-.287.287-.445.529-.026z"/>
                    </svg>
                    <p>Tool</p>
                </div>
            </a>
        </div>

        <div class="account-container">
            <a href="mobile_account.php">
                <div class="account" style="margin:0px 10px">
                    <i class="bi bi-person-circle"></i>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
                    </svg>
                    <p>Account</p>
                </div>
            </a>
        </div>

    </section>
</body>
</html>


