<?php
//https://phpflow.com/php/generate-pdf-file-mysql-database-using-php/
require "config.php";
require_once 'fpdf/fpdf.php';



class PDF extends FPDF {

    function Header()
    {
        $this->SetFont('Arial','B',13);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(80,10,'Logy',1,0,'C');
        // Line break
        $this->Ln(20);
    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Strana '.$this->PageNo().'/{nb}',0,0,'C');
    }

    //https://stackoverflow.com/questions/1419719/line-break-problem-with-multicell-in-fpdf/30359325#30359325
    function MultiAlignCell($w,$h,$text,$border=0,$ln=0,$align='L',$fill=false)
    {
        // Store reset values for (x,y) positions
        $x = $this->GetX() + $w;
        $y = $this->GetY();

        // Make a call to FPDF's MultiCell
        $this->MultiCell($w,$h,$text,$border,$align,$fill);

        // Reset the line position to the right, like in Cell
        if( $ln==0 )
        {
            $this->SetXY($x,$y);
        }
    }
}

$header = array('id', 'timestamp',"command", 'status', 'error_info');
$query = $db->query("SELECT * FROM logs ORDER BY id ASC");
$rows = $query->fetchAll();


$pdf = new PDF("L");
//header
$pdf->AddPage();
//foter page
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);


$pdf->Cell(5, 5, $header[0], 1);
$pdf->Cell(30, 5, $header[1], 1);
$pdf->Cell(180, 5, $header[2], 1);
$pdf->Cell(15, 5, $header[3], 1);
$pdf->Cell(50, 5, $header[4], 1);



foreach($rows as $row) {
    $pdf->Ln();
    $pdf->Cell(5, 20, $row["id"], 1);
    $pdf->Cell(30, 20, $row["timestamp"], 1);
    $command = implode("\n",str_split($row["command"], 20));
//    echo "<pre>";
//    echo strlen(str_pad(trim($row["command"]), 850))." ".str_pad(trim($row["command"]), 850)."<br>";
//    echo "</pre>";

    $pdf->MultiAlignCell( 180, 4, str_pad(trim($row["command"]), 850), 1);
    $pdf->Cell(15, 20, $row["status"], 1);
    $pdf->Cell(50, 20, $row["error_info"], 1);

}
$pdf->Output();
?>