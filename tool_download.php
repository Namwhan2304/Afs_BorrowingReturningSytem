<?php
include 'php_session_start.php';
require_once("vendor/autoload.php");


// เรียกไฟล์ TCPDF Library เข้ามาใช้งาน กำหนดที่อยู่ตามที่แตกไฟล์ไว้
require_once('tcpdf-main/tcpdf.php');

// เรียกใช้ Class TCPDF กำหนดรายละเอียดของหน้ากระดาษ
// PDF_PAGE_ORIENTATION = กระดาษแนวตั้ง
// PDF_UNIT = หน่วยวัดขนาดของกระดาษเป็นมิลลิเมตร (mm)
// PDF_PAGE_FORMAT = รูปแบบของกระดาษเป็น A4
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8');

// กำหนดคุณสมบัติของไฟล์ PDF เช่น ผู้สร้างไฟล์ หัวข้อไฟล์ คำค้น 
$pdf->SetCreator('AFS');
$pdf->SetAuthor('AFS Admin');
$pdf->SetTitle('Barcode');

// กำหนดรายละเอียดของหัวกระดาษ สีข้อความและสีของเส้นใต้
// PDF_HEADER_LOGO = ไฟล์รูปภาพโลโก้
// PDF_HEADER_LOGO_WIDTH = ขนาดความกว้างของโลโก้
// กำหนดตำแหน่งและขนาดของรูปภาพ
$pdf->Image('image/AFSLogo.png', 10, 10, 30, 30);

// กำหนดรายละเอียดของหัวกระดาษ
$pdf->SetHeaderData('image/AFSLogo.png', 116, '         Absolute Fire Solution', 'Borrowing and Returning system', array(0, 0, 0), array(0, 0, 0));


// กำหนดรายละเอียดของท้ายกระดาษ สีข้อความและสีของเส้น
$pdf->setFooterData(array(0, 0, 0), array(0, 0, 0));

// กำหนดตัวอักษร รูปแบบและขนาดของตัวอักษร (ตัวอักษรดูได้จากโฟลเดอร์ fonts)
// PDF_FONT_NAME_MAIN = ชื่อตัวอักษร helvetica
// PDF_FONT_SIZE_MAIN = ขนาดตัวอักษร 10
$pdf->setHeaderFont(Array (PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array (PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// กำหนดระยะขอบกระดาษ
// PDF_MARGIN_LEFT = ขอบกระดาษด้านซ้าย 15mm
// PDF_MARGIN_TOP = ขอบกระดาษด้านบน 27mm
// PDF_MARGIN_RIGHT = ขอบกระดาษด้านขวา 15mm
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);

// กำหนดระยะห่างจากขอบกระดาษด้านบนมาที่ส่วนหัวกระดาษ
// PDF_MARGIN_HEADER = 5mm
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// กำหนดระยะห่างจากขอบกระดาษด้านล่างมาที่ส่วนท้ายกระดาษ
// PDF_MARGIN_FOOTER = 10mm
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// กำหนดให้ขึ้นหน้าใหม่แบบอัตโนมัติ เมื่อเนื้อหาเกินระยะที่กำหนด
// PDF_MARGIN_BOTTOM = 25mm นับจากขอบล่าง
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(true, 10);

// กำหนดตัวอักษรสำหรับส่วนเนื้อหา ชื่อตัวอักษร รูปแบบและขนาดตัวอักษร
$pdf->SetFont('dejavusans', '', 10);

// กำหนดให้สร้างหน้าเอกสาร
$pdf->AddPage();

// กำหนดตำแหน่งให้ขึ้นหน้าใหม่ทุกครั้งที่เรียก writeHTMLCell และเพิ่มค่า 
$pdf->SetY($pdf->GetY()-8);


$cellCount = 0; 
$allcell = 0;  
// สร้างตัวแปร $html เพื่อเก็บข้อมูล HTML

$html = '';

if(isset($_GET['ids'])) {
    $ids = $_GET['ids'];

    // แปลงเป็น array หากมีมากกว่า 1 ID
    $selectedIds = explode(',', $ids);
    
    // วนลูปผ่านทุก ID และเพิ่ม HTML
    foreach ($selectedIds as $id) {
        // สร้าง Barcode
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcodeData = base64_encode($generator->getBarcode($id, $generator::TYPE_EAN_13, 1, 25));
        $barcodeImage = 'data:image/png;base64,' . $barcodeData;

        $sql = "SELECT * FROM tool_data WHERE ID = $id";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_array($result)) {
            
            $html .=    '<div style="font-size: 9px;text-align: center;"><br />';
            $html .=        $row["Tool_Name"] . ' (' . $row["Equipment_Sequence"] . ')<br />';
            $html .=        '<center><img src="' . $barcodeImage . '"></center>';
            $html .=        $id . '<br /></div>';

            
            $pdf->writeHTMLCell(45, 15, '', '', $html, 1, 0, false, true, 'c');
            $html;
            $cellCount++;
            $html = '';
            //$html .= '</div>';
            }
            if ($cellCount == 4) {
                $newY = $pdf->GetY() + 26.30; // เพิ่มค่าขึ้นไป 20 หน่วย หรือค่าที่ต้องการ
                $pdf->SetY($newY);
                // รีเซ็ตจำนวน Cell เป็น 0
                $cellCount = 0;
                $allcell++;
            }

            if ($allcell == 10) {
                $cellCount = 0;
                $pdf->AddPage();
                $pdf->SetY($pdf->GetY()-8);
                $allcell = 0;
            }

        } 
        

} else {
    echo 'No IDs provided.';
}



// กำหนดการแสดงข้อมูลแบบ HTML 
// สามารถกำหนดความกว้างความสูงของกรอบข้อความ 
// กำหนดตำแหน่งที่จะแสดงเป็นพิกัด x กับ y ซึ่ง x คือแนวนอนนับจากซ้าย ส่วน y คือแนวตั้งนับจากด้านล่าง
$pdf->writeHTMLCell(0, 0, '', '', '', 0, 0, 0, true, '', true);

// กำหนดการชื่อเอกสาร และรูปแบบการแสดงผล
$pdf->Output('Barcode_tool.pdf', 'I');