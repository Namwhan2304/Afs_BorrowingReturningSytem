<?php
include 'php_session_start.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $equipment_id = mysqli_real_escape_string($conn, $_POST['equipment_id']);
    $return_date = mysqli_real_escape_string($conn, $_POST['return_date']);

    // เขียน SQL Query เพื่ออัพเดตข้อมูลในตาราง borrowing
    $updateBorrowingSql = "UPDATE borrowing SET Date_Return = ? WHERE ID_Tool = ? AND ID_Employee = ?";
    $updateBorrowingStmt = mysqli_prepare($conn, $updateBorrowingSql);
    
    // ดึง ID_Employee จาก session
    $username = mysqli_real_escape_string($conn, $_SESSION["username"]);

    // Bind parameters
    mysqli_stmt_bind_param($updateBorrowingStmt, "ssi", $return_date, $equipment_id, $username);

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
            echo '<div class="overlay-message" style="color:green">Equipment returned successfully!</div>';
        } else {
            echo "Error updating tool_data: " . mysqli_error($conn);
        }
    } else {
        echo "Error updating borrowing: " . mysqli_error($conn);
    }

    // ปิด statement ของ update สำหรับ borrowing
    mysqli_stmt_close($updateBorrowingStmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Equipment</title>
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
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            color: green;
            font-size: 20px;
        }
    </style>

    <div class="table-box" style="margin-top:65px">
        <h1 class="display-5 text-center">Return Tool</h1>

        <table>
            <thead></thead>

            <tbody>
                <form method="POST" action="mobile_return.php">
                    <!-- Add your form fields here, e.g., Equipment ID, Return Date, etc. -->

                    <tr>
                        <td style="width:25%">
                            <label for="equipment_id">Tool ID</label>
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
            <div class="st-right">
                <input type="submit" class="btn btn-success mt-2" value="Return">
            </div>
            </form>
        </div>

    </body>
    </html>
