<?php
include 'php_session_start.php';

// ตรวจสอบว่า form ถูกส่งมาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $ID_Tool = mysqli_real_escape_string($conn, $_POST['id_tool']);
    $Site = mysqli_real_escape_string($conn, $_POST['site']);
    $Date_Borrow = mysqli_real_escape_string($conn, $_POST['date_borrow']);
    $Status = 1;

    // ดึง ID_Employee จาก session
    $username = mysqli_real_escape_string($conn, $_SESSION["username"]);

    // เขียน SQL Query เพื่อบันทึกข้อมูล
    $sql = "INSERT INTO borrowing (ID_Employee, ID_Tool, Site, Date_Borrow, Status) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sissi", $username, $ID_Tool, $Site, $Date_Borrow, $Status);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // บันทึกข้อมูลสำเร็จ

        // อัพเดตสถานะในตาราง tool_data เป็น 1
        $updateSql = "UPDATE tool_data SET Status = 1 WHERE ID = ?";
        $updateStmt = mysqli_prepare($conn, $updateSql);

        // Bind parameters
        mysqli_stmt_bind_param($updateStmt, "i", $ID_Tool);

        // Execute the update statement
        if (mysqli_stmt_execute($updateStmt)) {
        // อัพเดตสถานะสำเร็จ
        echo '<div class="overlay-message" style="color:green">Successful</div>';

        } else {
        echo "Error updating tool_data: " . mysqli_error($conn);
        }

        // ปิด statement ของ update
        mysqli_stmt_close($updateStmt);
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // ปิด statement ของ insert
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrow tool</title>

    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
    <!-- Link to css -->
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="mobile.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
</head>

<body>

<?php include 'mobile_banner.php';?>


    <!--  Heading Status of tools  -->
    <style>
        .overlay-message {
            position: absolute;
            top: 190px;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            margin-top: 300px;
            z-index: 999; /* ค่า z-index ที่สูงกว่าจะทับตัวที่มีค่าน้อยกว่า */
        }
        div.table-box {
            margin-top: 65px;
            margin-bottom: 80px;
            margin-left: auto;
            margin-right: auto;
            padding: 10px;
            width: 85%;
            box-shadow: 0 1px 15px 0 rgba(0, 0, 0, 0.15);
            border-radius: 10px;
        }
        .custom-link {
            color: black;
            text-decoration: none; /* เอาเส้นล้างข้อความออก */
        }

    </style>

<style>
        #video {
            width: 100%;
            height: 100px;
            margin-right:5px;
            display: block;
            border: 1px solid lightgray;
            border-radius: 6px
        }

        #captureButton {
            height: 40px;
            padding: 0px 15px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 6px;
            border: 1px solid lightgray;
            background-color: #eeee;
        }

        #result {
            margin-top: 20px;
            font-size: 18px;
        }
</style>

    <div class="table-box" style="margin-top:65px;">
        <div class="display-5 text-center">
            <a href="mobile_borrow.php" class="custom-link">Borrow Tool</a>
        </div>
        <!-- End Heading Status of tools  -->

        <style>
            table {
                width: 85%;
                border-collapse: collapse;
                margin-left: auto;
                margin-right: auto;
                margin-top: 10PX;
            }

            tbody tr td{
                height: 43px;
                /*border: 1px solid red;*/
            }

            .st-right {
                justify-content: center;
                align-items: center;
            }

            .st-right input {
                justify-content: center;
                align-items: center;
                margin-left: 70%;
            }
        </style>

        <table>
            <thead></thead>
            <tbody>
                <div class="container">
                    <form method="POST" action="">
                        <tr style="height: 35px">
                            <td style="width:25%">
                                <label>ID</label>
                            </td>
                            <td style="width:75%">
                                <?php
                                // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
                                if(isset($_SESSION["username"])) {
                                echo "<div style='color:gray'>";
                                echo "AFS".$_SESSION["username"];
                                echo "</div>";
                                }
                                ?>
                            </td>
                        </tr>
                        
                        <tr style="height: 40px">
                            <td style="width:25%;" >
                                <label>Name</label>
                            </td>
                            <td style="width:75%">
                                <?php
                                // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
                                if(isset($_SESSION["username"])) {
                                echo "<div style='color:gray'>";
                                echo $_SESSION["firstname"]." ".$_SESSION["lastname"];
                                echo "</div>";
                                }
                                ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="width:25%">
                                <label>Tool ID</label>
                            </td>
                            <td style="width:75%;height: 100px;display: flex;margin-bottom:3px">
                                
                                <!--input type="number" name="id_tool" required class="form-control"-->
                                <!-- Video feed from the camera -->
                                <video id="video" autoplay></video>

                                <!-- Capture button with camera icon -->
                                <button id="captureButton" onclick="captureQRCode()">
                                📷
                                </button>
                                <script>
                                    // Get the video element and set up camera access
                                    const video = document.getElementById('video');

                                    navigator.mediaDevices.getUserMedia({ video: true })
                                        .then((stream) => {
                                            video.srcObject = stream;
                                        })
                                        .catch((error) => {
                                            console.error('Error accessing camera: ', error);
                                        });
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:25%">
                                <label></label>
                            </td>
                            <td style="width:75%">
                                <!-- Input field for Tool ID -->
                                <input type="number" name="id_tool" class="form-control">
                            </td>
                            
                        </tr>

                        <tr>
                            <td style="width:25%">
                                <label>Site</label>
                            </td>
                            <td style="width:75%">
                                <input type="text" name="site" required class="form-control">
                            </td>
                        </tr>

                        <tr>
                            <td style="width:25%">
                                <label>Date</label>
                            </td>
                            <td style="width:75%">
                            <input type="Date" name="date_borrow" required class="form-control" value="<?php echo date('Y-m-d'); ?>">
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <div class="st-right">
                                    <br>
                                    <input type="submit" class="btn btn-success mt-2" value="Borrow">
                                </div>
                            </td>
                        </tr>
                    </form>
                </div>
            </tbody>
        </table>

<!-- Include the ZXing library -->
<script src="https://cdn.rawgit.com/zxing-js/library/gh-pages/dist/instascan.min.js"></script>

<script>
    // Create an instance of Instascan
    const instascan = new Instascan.Scanner({ video: document.getElementById('video') });

    // Attach a listener for QR Code scanning
    instascan.addListener('scan', function (content) {
        // Update the input field with the scanned QR Code data
        document.getElementById('toolIdInput').value = content;

        // Optionally, you can perform further actions with the scanned data
        // For example, submit a form or make an AJAX request to the server
        // ...

        // Stop the camera after a successful scan
        instascan.stop();
    });

    // Get the video element and set up camera access
    const video = document.getElementById('video');

    navigator.mediaDevices.getUserMedia({ video: true })
        .then((stream) => {
            video.srcObject = stream;
        })
        .catch((error) => {
            console.error('Error accessing camera: ', error);
        });

    // Function to capture QR Code from the video feed
    function captureQRCode() {
        // Create a canvas element to draw the captured photo
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');

        // Set the canvas dimensions to match the video feed
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

        // Draw the current video frame onto the canvas
        context.drawImage(video, 0, 0, canvas.width, canvas.height);

        // Convert the canvas content to a data URL (base64 encoded image)
        const imageDataUrl = canvas.toDataURL('image/png');

        // Send the image data to the server or process it as needed
        processImageData(imageDataUrl);
    }

    // Function to process the captured image data (send to server, etc.)
    function processImageData(imageDataUrl) {
        // Decode the QR Code image data using Instascan
        const decodedData = instascan.decode(imageDataUrl);

        // Update the input field with the decoded data
        document.getElementById('toolIdInput').value = decodedData;
    }
</script>



    </div>

</body>
</html>