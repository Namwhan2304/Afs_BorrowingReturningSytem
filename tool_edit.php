<?php
include 'php_session_start.php';

// ตรวจสอบว่ามีค่า Name ที่ถูกส่งมาจาก URL หรือไม่
if (isset($_GET['name'])) {
    $name = mysqli_real_escape_string($conn, $_GET['name']);

    // เตรียม SQL Query สำหรับดึงข้อมูลอุปกรณ์ที่ต้องการ
    $sql = "SELECT * FROM tool_data WHERE Tool_Name = '$name'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        // ทำต่อตามความต้องการเพื่อแสดงข้อมูล
        // เช่น echo $row['Tool_Name'];
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    // ถ้าไม่มี Name ที่ถูกส่งมา
    echo "Invalid request. Please provide a Name.";
}
?>