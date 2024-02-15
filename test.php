<?php
require_once('tcpdf-main/tcpdf.php');

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8');

$pdf->SetCreator('Mindphp');
$pdf->SetAuthor('Mindphp Developer');
$pdf->SetTitle('Mindphp Example 04');
$pdf->SetSubject('Mindphp Example');
$pdf->SetKeywords('Mindphp, TCPDF, PDF, example, guide');

// กำหนดรูปแบบตัวอักษรให้กับส่วนหัวของเอกสาร 
// freeserif = ชื่อตัวอักษร
// B = กำหนดให้เป็นตัวหนา
// 12 = ขนาดตัวอักษร
$pdf->setHeaderFont(array('freeserif', 'B', 12));

$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 'Mindphp Example 04', 'การใช้คำสั่ง Cell(), Multicell(), WriteHTML(), writeHTMLCell()', array (0, 64, 255), array (0, 64, 128));
$pdf->setFooterData(array (0, 64, 0), array (0, 64, 128));

$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->AddPage();

// กำหนดรูปแบบตัวอักษรให้กับเนื้อหา
$pdf->SetFont('freeserif', '', 16);

// การใช้คำสั่ง Cell()

$pdf->Cell(40, 30, 'Cell: ซ้าย', 1, 0, 'L', false, 'http://www.mindphp.com');
$pdf->Cell(40, 30, 'Cell: กลาง', 1, 0, 'C', false, 'http://www.mindphp.com');
$pdf->Cell(40, 30, 'Cell: ขวา', 1, 0, 'R', false, 'http://www.mindphp.com');

// การใช้คำสั่ง MultiCell()
$pdf->MultiCell(50, 30, 'MultiCell: ซ้าย', 1, 'L', false, 0, '', 60);
$pdf->MultiCell(50, 30, 'MultiCell: กลาง', 1, 'C', false, 0, 80, 60);
$pdf->MultiCell(50, 30, 'MultiCell: ขวา', 1, 'R', false, 1, 145, 60);

$html = '<h3>หัวข้อ writeHTML()</h3>';
$html .= '<table border="1" width="720" cellpadding="10">';
$html .= '<tr>';
$html .= '<td width="150"><img src="http://www.mindphp.com/images/info/mindphp.png" width="150" /></td>';
$html .= '<td>';
$html .= '<b>PHP ยินดีต้อนรับสู่ MIND PHP.COM</b>';
$html .= '<p style="font-size: 12px;">PHP ยินดีต้อนรับสู่ MIND PHP.COM (รูปแบบใหม่)   ปรับปรุง Mindphp เป็นรูปแบบใหม่ ได้ใช้ ตัว Convert จาก phpnuke เป็น Joomla 1.5 และได้อัพเดดอย่างต่อเนื่องเป็น Joomla 2.5 ปัจจุบัน ใช้ Joomla 3.6 </p>';
$html .= '</td>';
$html .= '</tr></table>';
// การใช้คำสั่ง writeHTML()
$pdf->writeHTML($html);

// การใช้คำสั่ง writeHTMLCell()
$pdf->writeHTMLCell(50, '', '', 150, 'writeHTMLCell()<br /><img src="http://www.mindphp.com/images/info/mindphp.png" width="150" />', 1);
$pdf->writeHTMLCell(50, '', 145, 150, 'writeHTMLCell()<br /><img src="http://www.mindphp.com/images/info/mindphp.png" width="150" />', 1);
$pdf->writeHTMLCell(50, '', 80, 200, 'writeHTMLCell()<br /><img src="http://www.mindphp.com/images/info/mindphp.png" width="150" />', 1);

$pdf->Output('mindphp04.pdf', 'I'); 


    // วนลูปผ่านทุก ID และเพิ่ม HTML
    foreach ($selectedIds as $id) {

        $html .= '<div style="display: flex; border:1px solid #fc0000; margin: 0; padding: 0;">';
        // สร้าง Barcode
        $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
        $barcodeData = base64_encode($generator->getBarcode($id, $generator::TYPE_EAN_13, 1, 25));
        $barcodeImage = 'data:image/png;base64,' . $barcodeData;

        $sql = "SELECT * FROM tool_data WHERE ID = $id";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($result)) {

            $html = '<div style="font-size: 9px; margin-top: 10px;text-align: center;">' . '<br />'
                    . $row["Tool_Name"] . ' (' . $row["Equipment_Sequence"] . ')<br />' .
                    '<center><img src="' . $barcodeImage . '"></center>
                    <div style="font-size: 9px;">' . $id . '</div></div>';

            $html .= '</div>';

            $pdf->writeHTML($html);

            $pdf->writeHTMLCell(50, '', 80, 200, 'writeHTMLCell()<br /><img src="http://www.mindphp.com/images/info/mindphp.png" width="150" />', 1);

            //$html .=    '<td width="150"><div style="border:1px solid #DDD; width:50 !important; text-align: center;">';
            //$html .=        '<div style="font-size: 9px; margin-bottom: 10px;">' . $row["Tool_Name"] . ' (' . $row["Equipment_Sequence"] . ')' . '</div>';
            // เพิ่ม HTML สำหรับรูปภาพ Barcode
            //$html .=        '<center><img src="' . $barcodeImage . '"></center>';
             //เพิ่ม HTML สำหรับข้อความด้านล่าง
            //$html .=        '<div style="margin-top: 10px; font-size: 9px;">' . $id . '</div>';
            //$html .=    '</div>';  
            //$html .= '</table>';  
        }
    }

    $html .= '<div style="font-size: 9px; margin-top: 10px;text-align: center;">' . '<br /><br />'
    . $row["Tool_Name"] . ' (' . $row["Equipment_Sequence"] . ')<br />' .
    '<center><img src="' . $barcodeImage . '"></center>
    <div style="font-size: 9px;">' . $id . '</div></div>';

$html .= '</div>';


$pdf->writeHTMLCell(45, 15, '', '', $html, 1, 0, false, true, 'c');