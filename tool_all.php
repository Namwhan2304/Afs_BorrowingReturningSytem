<?php
include 'php_session_start.php';; //เรียกใช้ condb.php เพื่อเชื่อมฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tool</title>

    <!-- Boostrap CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css.css">
    <link rel="stylesheet" href="buttonbg.css">

</head>
<body>
<style>
    .custom-link {
        color: black;
        text-decoration: none; /* เอาเส้นล้างข้อความออก */
    }
    .bar-box {
        width: 100%;
        /*border: 1px solid green;*/
        vertical-align: middle;
        position: relative;
        height: 45px;
        display: flex;
        justify-content: space-between;
    }

    .search-box {
        /*border: 1px solid red;*/
        width: 230px;
        padding: 4px;
        align-items: center;
    }

    .search {
        width: 230px;
        border: 1px solid gray;
        border-radius: 25px;
        padding: 4px 0px;
    }

    .search input {
        width: 80%;
        border: none;
        padding: 0px 6px;
        border-radius: 20px;
        margin-left: 5px;
    }

    input[type="search"]:focus,
        select:focus {
            outline: none;
            background-color: none;
            box-shadow: none;
        }

    
    input[type="search"] :active{
        border: none;
        background-color: none;
        outline: none;
        box-shadow: none;
    }

    .bt-box {
        /*border: 1px solid red;*/
        width: 60px;
    }

    .btsearch {
        background-color: white;
        color: lightgray;
        display: inline-block; /*การแสดงผลเป็น inline-block*/
        transition-duration: 0.4s; /*ระยะเวลาที่ใช้ในการเปลี่ยนสีเมื่อ hover (0.4 วินาที)*/
        cursor: pointer; /*รูปลูกศรของเมาส์เมื่อชี้ไปยังปุ่ม*/
        border: none;
        /*border: 1px solid yellow;*/
    }
    .btsearch:hover{
        color: gray;
        border: none;
    }

    .btsearch svg{
        margin-top: -3px;
    }

</style>

<?php include 'banner.php'; ?>

<div class="container"> 

    <div class="display-5 text-center mb-2">
        <a href="tool_show.php" class="custom-link">Tool</a>
    </div>
    
    <div class="bar-box">

        <div class="" style="width: 60px;"></div>

            <form class="search-box" method="GET" action="tool_all.php">
                <div class="search">
                <input type="search" name="keyword" value="<?php echo isset($_GET['keyword']) ? $_GET['keyword'] : ''; ?>">
                    <button class="btsearch">
                        <i class="bi bi-search"></i>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                    </button>
                </div>
            </form>

        <div class="bt-box">
            <a href="tool_show.php" class="button buttongreen">Back</a>
        </div>
            
    </div>
    
    <!--  Start Table  -->
    <?php
    $perpage = 6;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }else{
        $page = 1;
    }
    $start = ($page - 1) * $perpage;
    ?>
    <table style="width:80%;margin-left: auto;margin-right: auto">
        <!-- Heading Table -->
        <thead>
            <tr> 
                <th style="width:10%">Image</th>
                <th style="width:10%">ID</th>
                <th style="width:20%">Name</th>
                <th style="width:20%">Category</th>
                <th style="width:10%">Status</th>
            </tr>
        </thead>
        
        <!-- Body Table -->
        <tbody>
        <?php
        $key_word = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        if($key_word !="") {
            $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory
                    FROM tool_data
                    JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                    WHERE ID like '%$key_word%' or Tool_Name like '%$key_word%' or Name_MainCategory like '%$key_word%'
                    limit {$start}, {$perpage}";
    
        } else {
            $sql = "SELECT tool_data.*, tool_maincategory.Name_MainCategory
                    FROM tool_data
                    JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                    limit {$start}, {$perpage}";
        }
    
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {
            
        ?>

        <tr>
            <td><img src="tool_image/<?= $row["Tool_Image"] ?>" width="60px" height="60px"></td>
            <td><?= $row["ID"] ?></td>
            <td><?= $row["Tool_Name"] ?> (No.<?= $row["Equipment_Sequence"] ?>)</td>
            <td><?= $row["Name_MainCategory"] ?></td>
            <td>    <?php
                if ($row["Status"] == 0) {
                    echo "<div style=color:green;>";
                    echo "Available";
                    echo "</div>";
                } elseif ($row["Status"] == 1) {
                    echo "<div style=color:red;>";
                    echo "Unavailable";
                    echo "</div>";
                } else {
                    echo "<div style=color:gray;>";
                    echo "Unknown"; // หรือค่าเริ่มต้นอื่น ๆ ที่คุณต้องการแสดง
                    echo "</div>";
                }
                ?></td>
        </tr>
    <?php
        }
        if($key_word !="") {
            $sql1 = "SELECT tool_data.*, tool_maincategory.Name_MainCategory
                    FROM tool_data
                    JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory
                    WHERE ID like '%$key_word%' or Tool_Name like '%$key_word%' or Name_MainCategory like '%$key_word%'";
    
        } else {
            $sql1 = "SELECT tool_data.*, tool_maincategory.Name_MainCategory
                    FROM tool_data
                    JOIN tool_maincategory ON tool_data.ID_MainCategoryTool = tool_maincategory.ID_MainCategory";
        }
        
        $query1 = mysqli_query($conn, $sql1); 
        $total_record = mysqli_num_rows($query1);
        $total_page = ceil($total_record/$perpage);
        ?>
        </tbody>
    </table>


<nav aria-label="Page navigation example" >
    <ul class="pagination" style="margin-left: auto;margin-right: auto">

        <?php for ($i = 1; $i <= $total_page; $i++) { ?>
            <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>" style="color: <?php echo ($i == $page) ? 'gray' : '#555'; ?>">
            <a  class="page-link" 
                style="color: <?php echo ($i == $page) ? 'gray' : '#7777'; ?>; 
                    background-color: <?php echo ($i == $page) ? 'lightgray' : 'parent'; ?>;
                    border: 1px solid <?php echo ($i == $page) ? 'lightgray' : 'parent'; ?>" 
                href="tool_all.php?page=<?php echo $i; ?>&keyword=<?php echo $key_word; ?>">
            <?php echo $i; ?>
            </a>
            </li>
        <?php } ?>

    </ul>
</nav>

</div>
</body>
</html>
        