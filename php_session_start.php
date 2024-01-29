<?php
session_start();
if(!isset($_SESSION["username"])) {
    header("location: login.php");
    exit(); // ตรวจสอบครบแล้วให้ทำการออกจาก script
}

include 'condb.php'; // เรียกใช้ condb.php เพื่อเชื่อมต่อฐานข้อมูล
?>