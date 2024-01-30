<?php
include 'php_session_start.php';

// ตรวจสอบว่ามีการรับค่า ID มาจากหน้าที่แล้วหรือไม่
if (isset($_GET['id'])) {
    // Escape the user input to prevent SQL injection
    $borrowedItemId = mysqli_real_escape_string($conn, $_GET['id']);


    // Use $borrowedItemId in your SQL query to fetch data for the specific borrowed item
    $sql = "SELECT * FROM borrowing WHERE ID_Borrowing = '$borrowedItemId'";

    // Execute the query and fetch the result
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Fetch the data associated with the borrowed item
        $borrowedItemData = mysqli_fetch_assoc($result);

        // เพิ่มส่วนนี้เพื่อดึงค่า ID_Tool
        $ID_Tool = $borrowedItemData["ID_Tool"];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Handle the case when the 'id' parameter is not set
    echo "ID parameter is missing in the URL.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $Date_Return = mysqli_real_escape_string($conn, $_POST['return_date']);

    // เขียน SQL Query เพื่ออัพเดตข้อมูลในตาราง borrowing
    $updateBorrowingSql = "UPDATE borrowing SET Date_Return = ?, Status = 2 WHERE ID_Borrowing = ?";
    $updateBorrowingStmt = mysqli_prepare($conn, $updateBorrowingSql);

    // สร้างตัวแปรสำหรับ Status ที่คุณต้องการให้เป็น 1
    $newStatus = 1;

    // Bind parameters
    mysqli_stmt_bind_param($updateBorrowingStmt, "si", $Date_Return, $borrowedItemId);

    // Execute the update statement for borrowing table
    if (mysqli_stmt_execute($updateBorrowingStmt)) {
        // ปิด statement ของ update สำหรับ borrowing
        mysqli_stmt_close($updateBorrowingStmt);

        // เขียน SQL Query เพื่ออัพเดตข้อมูลในตาราง tool_data
        $updateToolSql = "UPDATE tool_data SET Status = 0 WHERE ID = ?";
        $updateToolStmt = mysqli_prepare($conn, $updateToolSql);

        // Bind parameters
        mysqli_stmt_bind_param($updateToolStmt, "i", $ID_Tool);

        // Execute the update statement for tool_data table
        if (mysqli_stmt_execute($updateToolStmt)) {
            // ปิด statement ของ update สำหรับ tool_data
            mysqli_stmt_close($updateToolStmt);

            // แสดงข้อความว่าคืนอุปกรณ์สำเร็จ
            echo '<div class="overlay-message" style="color:green;text-align:center;top:70px">Tool returned successfully!</div>';

            echo '<script>';
            echo 'console.log("Before redirect");';
            echo 'window.location.href = "mobile_home.php";';
            echo 'console.log("After redirect");';
            echo '</script>';
        } else {
            echo "Error updating tool_data: " . mysqli_stmt_error($updateToolStmt);
        }
    } else {
        echo "Error updating borrowing: " . mysqli_stmt_error($updateBorrowingStmt);
    }   

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

        tbody tr td{
            height: 45px;
            font-size: 16px;
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
            font-size: 18px;
        }
    </style>

    <div class="table-box" style="margin-top:65px">
        <h1 class="display-5 text-center">Return Tool</h1>

        <table>
            <thead></thead>

            <tbody>
                <!-- แก้ไขส่วนนี้ -->
                <form method="POST" action="">

                    <!-- แก้ชื่อฟอร์มเป็น 'return_date' -->
                    <tr>
                        <td style="width:40%">
                            <label>Borrow No. </label>
                        </td>
                        <td style="width:60%">
                            <?php
                                echo "<div style='color:gray'>";
                                echo $borrowedItemData["ID_Borrowing"];
                                echo "</div>";
                            ?>
                        </td>
                    </tr>

                    <!-- แก้ชื่อฟอร์มเป็น 'return_date' -->
                    <tr>
                        <td style="width:40%">
                            <label>Return Date</label>
                        </td>
                        <td style="width:60%">
                            <input type="date" name="return_date" required class="form-control" value="<?php echo date('Y-m-d'); ?>">
                        </td>
                    </tr>

                    <!-- แก้ชื่อฟอร์มเป็น 'return_date' -->
                    <div class="st-right">
                        <input type="submit" class="btn btn-success mt-2" value="Return">
                    </div>
                </form>
            </table>
        </div>
    </body>
</html>
