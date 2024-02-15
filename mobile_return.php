<?php
include 'php_session_start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ตรวจสอบว่ามีการรับค่า ID มาจากหน้าที่แล้วหรือไม่
    if (isset($_POST['equipment_id'])) {
        // Escape the user input to prevent SQL injection
        $equipment_id = mysqli_real_escape_string($conn, $_POST['equipment_id']);
        $return_date = mysqli_real_escape_string($conn, $_POST['return_date']);

        // ดึง ID_Employee จาก session
        $username = mysqli_real_escape_string($conn, $_SESSION["username"]);

        // ดึงข้อมูลการยืมจาก ID_Borrowing
        $sql = "SELECT * FROM borrowing WHERE ID_Tool = ?";
        $selectStmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($selectStmt, "i", $equipment_id);
        mysqli_stmt_execute($selectStmt);
        $result = mysqli_stmt_get_result($selectStmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $borrowedItemId = $row['ID_Tool'];

            // เขียน SQL Query เพื่ออัพเดตข้อมูลในตาราง borrowing
            $updateBorrowingSql = "UPDATE borrowing SET Date_Return = ?, Status = 2 WHERE ID_Tool = ?";
            $updateBorrowingStmt = mysqli_prepare($conn, $updateBorrowingSql);

            // สร้างตัวแปรสำหรับ Status ที่คุณต้องการให้เป็น 1
            $newStatus = 1;

            // Bind parameters
            mysqli_stmt_bind_param($updateBorrowingStmt, "si", $return_date, $borrowedItemId);

            // Execute the update statement for borrowing table
            if (mysqli_stmt_execute($updateBorrowingStmt)) {
                // อัพเดตสถานะในตาราง tool_data เป็น 0
                $updateToolDataSql = "UPDATE tool_data SET Status = 0 WHERE ID = ?";
                $updateToolDataStmt = mysqli_prepare($conn, $updateToolDataSql);

                // Bind parameters
                mysqli_stmt_bind_param($updateToolDataStmt, "i", $equipment_id);

                // Execute the update statement for tool_data table
                if (mysqli_stmt_execute($updateToolDataStmt)) {
                    // ปิด statement ของ update สำหรับ tool_data
                    mysqli_stmt_close($updateToolDataStmt);

                    // แสดงข้อความว่าคืนอุปกรณ์สำเร็จ
                    echo '<div class="overlay-message" style="color:green">' . htmlspecialchars("Tool returned successfully") . '</div>';
                } else {
                    echo "Error updating tool_data: " . mysqli_error($conn);
                }
            } else {
                echo "Error updating borrowing: " . mysqli_error($conn);
            }
        } else {
            // กรณีไม่พบข้อมูลการยืม
            echo "No borrowing record found for the provided equipment ID.";
        }

        // ปิด statement ของ select
        mysqli_stmt_close($selectStmt);

    } else {
        // ในกรณีที่ไม่ได้รับ ID มาจากฟอร์ม
        echo "Equipment ID is missing in the form.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Tool</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="mobile.css">
    <!-- Link to other CSS files if needed -->
</head>
<body>

    <?php include 'mobile_banner.php'; ?>

    <style>
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

        table {
            width: 85%;
            border-collapse: collapse;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10PX;
        }

        tbody tr {
            height: 45px;
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

        .overlay-message {
            color: green;
            font-size: 16px;
            position: absolute;
            top: 410px;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            z-index: 999; /* ค่า z-index ที่สูงกว่าจะทับตัวที่มีค่าน้อยกว่า */
        }

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

    <div class="table-box" style="margin-top:65px">
        <h1 class="display-5 text-center">Return Tool</h1>

        <table>
            <thead></thead>

            <tbody>
                <form method="POST" action="mobile_return.php">
                    <!-- Add your form fields here, e.g., Equipment ID, Return Date, etc. -->

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
                            <label for="equipment_id">Tool ID</label>
                        </td>
                        <td style="width:75%;height: 100px;display: flex;margin-bottom:3px">
                                
                                <!--input type="number" name="id_tool" required class="form-control"-->
                                <!-- Video feed from the camera -->
                                <video id="video" autoplay></video>
                                <button id="captureButton" onclick="captureQRCode()">📷</button>
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
                            <input type="text" name="equipment_id" required class="form-control">
                        </td>
                    </tr>

                    <tr>
                        <td style="width:25%">
                            <label for="return_date">Return Date</label>
                        </td>
                        <td style="width:75%">
                            <input type="date" name="return_date" required class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>
            </tbody>
            </table>
            
            <div style="text-align: center;margin-top:35px ;margin-bottom:15px">
                <input type="submit" class="btn btn-success mt-2" value="Return">
            </div>
            </form>
        </div>

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

    // Process the captured image data (send to server, etc.)
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

    </body>
    </html>
