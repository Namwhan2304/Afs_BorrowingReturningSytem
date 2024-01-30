<?php
include 'php_session_start.php'; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล

// ตรวจสอบการเชื่อมต่อ
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
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

<?php include 'mobile_banner.php';?>


    <style>
        body {
            scrollbar-width: none; /* ซ่อน scrollbar ใน Firefox */
        }

        body::-webkit-scrollbar {
            display: none; /* ซ่อน scrollbar ใน Chrome, Safari, และ Edge */
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
        .add-box {
            margin-top: 5px;
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            align-items: center;
            border: 1px solid lightgray;
            padding: 5px 15px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
        }

        .add-box svg{
            /*border: 1px solid green;*/
            margin: 5px;
            color: gray;
        } 

        .add-box p{
            font-size: 14px;
            color: gray;
            margin: 5px;
            /*border: 1px solid green;*/
        }
        

    </style>


<div class="table-box">
    <div class="add-box">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
            </svg>
            <p> <?php
                // ตรวจสอบว่ามีข้อผิดพลาดหรือไม่
                if(isset($_SESSION["username"])) {
                echo $_SESSION["firstname"]." ".$_SESSION["lastname"]." ";
                echo "<style='color:gray'>";
                echo "( "."AFS".$_SESSION["username"]." )";
                }
                ?>
            </p>
        
    </div>

    <style>
        .custom-link {
            color: black;
            text-decoration: none; /* เอาเส้นล้างข้อความออก */
        }
        
        table {
            width: 90%;
            border-collapse: collapse;
            border-bottom: 1px solid #DDD;
            margin-left: 5%;
            margin-right: 5%;
            margin-top: 10PX;
        }
    
        thead th, tbody td {
            /*border: 1px solid black;*/
            padding: 5px; /* เพิ่มขอบรอบของข้อความในเซลล์ */
        }

        thead tr {
            text-align: center;
            font-weight:normal;
            font-size: 14px;
        }

        tbody tr {
            border-bottom: 1px solid #DDD; /* ขอบด้านล่างสำหรับแถวใน tbody */

        }

    
        tbody tr:hover {
            background-color: #F0F8FF; /* พื้นหลังเปลี่ยนสีเมื่อโฮเวอร์ทุกรายการใน tbody */
        }
    

        tbody td {
            line-height: 1.5;
            font-size: 11px;
            
        }

        .button {
            background-color: #009860; 
            padding: 5px 5px; /*ระยะห่างของขอบปุ่มและข้อความภายใน*/
            text-align: center; /*การจัดวางข้อความในปุ่ม (ตรงกลาง)*/
            text-decoration: none; /*การจัดรูปแบบข้อความ (ไม่มีขีดเส้นใต้)*/
            display: inline-block; /*การแสดงผลเป็น inline-block*/
            font-size: 12px; /*ขนาดตัวอักษร*/
            margin: 2px 2px; /*ระยะห่างรอบขอบปุ่ม*/
            cursor: pointer; /*รูปลูกศรของเมาส์เมื่อชี้ไปยังปุ่ม*/
            border-radius: 10px; /*ขอบมน*/
        }
    
        .buttongreen {
            background-color: rgb(50, 180, 112); 
            color: white;
        }

    </style>

    
        <div style="margin-top:10px;" class="display-6 text-center">
            <a href="mobile_home.php" class="custom-link">Borrowing List</a>
        </div>

    <table>
        <thead></thead>


        <tbody>
        <?php
            $sql = "SELECT borrowing.*, tool_data.Tool_Name, tool_data.Tool_Image, Equipment_Sequence
            FROM borrowing
            JOIN tool_data ON borrowing.ID_Tool = tool_data.ID
            WHERE borrowing.ID_Employee = '$username'AND borrowing.Status= 1";

            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            
            while ($row = mysqli_fetch_array($result)) {
        ?>
                <tr>
                    <td style="width:10%">
                        <img src="tool_image/<?= $row["Tool_Image"] ?>" width="70px" height="70px" class="center">
                    </td>

                    <td style="width:80%">
                        <div style="font-weight: bold;">Borrow No. <?= $row["ID_Borrowing"] ?> </div>
                        Tool ID <?= $row["ID_Tool"] ?> 
                        <br><?= $row["Tool_Name"] ?> (<?= $row["Equipment_Sequence"] ?>)
                        <br>Site <?= $row["Site"] ?>
                        <br>Date <?= $row["Date_Borrow"] ?>
                    </td>

                    <td style="width:10%">
                    <a href="mobile_return_id.php?id=<?php echo $row["ID_Borrowing"]; ?>" class="button buttongreen">Return</a>
                        <br><a href="mobile_borrow.php" class="button buttongreen">Borrow</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

</div>
    

</body>
</html>