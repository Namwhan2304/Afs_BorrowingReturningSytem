<?php
include 'php_session_start.php';

// ตรวจสอบว่ามีค่า Name ที่ถูกส่งมาจาก URL หรือไม่
if (isset($_GET['id'])) {
    $id_tool = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM tool_data WHERE ID = $id_tool";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $toolname = $row["Tool_Name"];
        $maintype = $row["ID_MainCategoryTool"];
        $sequence = $row["Equipment_Sequence"];

        // Upload image
        if (isset($_FILES['toolimage']) && is_uploaded_file($_FILES['toolimage']['tmp_name'])) {
            $new_image_name = 'tool_'.uniqid().".".pathinfo(basename($_FILES['toolimage']['name']), PATHINFO_EXTENSION);
            $image_upload_tool = "./tool_image/".$new_image_name;
            move_uploaded_file($_FILES['toolimage']['tmp_name'], $image_upload_tool);
        } else {
            $new_image_name = $row["Tool_Image"];
        }

    } else {
        echo "Tool not found";
        exit;
    }
} else {
    // ถ้าไม่มี Name ที่ถูกส่งมา
    echo "Invalid request. Please provide a Name.";
}

// ตรวจสอบว่ามีการส่งข้อมูลแบบ POST มาหรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["toolname"]) && isset($_POST["maintype"]) && isset($_POST["sequence"])) {
        $toolname = $_POST["toolname"];
        $maintype = $_POST["maintype"];
        $sequence = $_POST["sequence"];

        // ทำการอัปเดตข้อมูลในฐานข้อมูล
        $update_sql = "UPDATE tool_data SET Tool_Name='$toolname', ID_MainCategoryTool='$maintype', Tool_Image='$new_image_name', Equipment_Sequence='$sequence' WHERE ID=$id_tool";

        if (mysqli_query($conn, $update_sql)) {
            echo"<script>alert('Successfully edited data');</script>";
            echo "<script>window.location.href='tool_view.php?id=" . $row["Tool_Name"] . "';</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "All fields are required!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tool</title>

    <!-- Bootstrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"> 
</head>
<body>
<?php include 'banner.php'; ?>

<div class="container">
    <div class="box-table" style="width:40%;margin-left:auto;margin-right: auto">
        <h1 class="display-5 text-center mb-2">Edit Tool</h1>
    <style>
    table {
        width: 100%;
        margin-left: auto;
        margin-right: auto;
        border-collapse: collapse;
        margin-top: 20px; /* เพิ่มระยะห่างด้านบนของตาราง */
        /*border: 1px solid red;*/
    }

    th, td {
        /*border: 1px solid black;*/
        padding: 5px; /* เพิ่มขอบรอบของข้อความในเซลล์ */
    }
    

    </style>

    <table>
            <thead>
            </thead>

        <tbody>
            <form method="POST" action="" enctype="multipart/form-data" class="row g-2 align-items-center">
                <tr>
                    <td style="width:20%"><label>Tool ID</label></td>
                    <td>
                    <?php
                            echo "<div style='color:gray'>";
                            echo $id_tool;
                            echo "</div>";
                        ?>
                    </td>
                </tr>

               <tr>
                    <td style="width:20%"><label>Name tool</label></td>
                    <td><input type="text" name="toolname" value="<?php echo $toolname; ?>" required class="form-control"></td>
                </tr>

                <tr>
                    <td style="width:20%"><label></label>Category</td>
                    <td><div class="dropdown" style="width: 250px">
                            <select class="form-select form-select" name="maintype" id="maintype" aria-label="Default select example">
                                <option value="1" <?php if ($maintype == 1) echo 'selected'; ?>>Electrical</option>
                                <option value="2" <?php if ($maintype == 2) echo 'selected'; ?>>Ladders</option>
                                <option value="3" <?php if ($maintype == 3) echo 'selected'; ?>>Trolley</option>
                            </select>
                        </div>
                    </td>
                </tr>

                <tr>
                    <td style="width:20%"><label>Sequence</label></td>
                    <td><input type="number" name="sequence" value="<?php echo $sequence; ?>" required class="form-control"></td>
                    <td>
                        
                    </td>
                </tr>

                <tr>
                    <td style="width:20%"><label>Image</label></td>
                    <td>
                        <img src="tool_image/<?= $row["Tool_Image"] ?>" alt="Tool Image" style="max-width: 150px; max-height: 150px;">
                        <input type="file" name="toolimage" class="form-control">
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <div class="right" style="">
                            <input type="submit" class="btn btn-success mt-2" value="Update">
                            <a href="tool_view.php?id=<?= $row["Tool_Name"] ?>" class="btn btn-secondary mt-2">Cancel</a>
                        </div>
                    </td>
                </tr>
            </form>
        </tbody>
    </table>
</div>

</body>
</html>
