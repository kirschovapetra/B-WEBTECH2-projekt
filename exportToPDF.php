<?php
//export tabulky "logs" do pdf [Petra]

require "config.php";
require 'fpdf/fpdf.php';


//https://phpflow.com/php/generate-pdf-file-mysql-database-using-php/
class PDF extends FPDF {

    function Header()    {
        $this->SetFont('Arial','B',13);
        $this->Cell(100);
        $this->Cell(80,10,'Logy',1,0,'C');
        $this->Ln(20);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        $this->Cell(0,10,'Strana '.$this->PageNo().'/{nb}',0,0,'C');
    }

    //rozdelenie dlheho textu v bunke do viacerych riadkov
    //https://stackoverflow.com/questions/1419719/line-break-problem-with-multicell-in-fpdf/30359325#30359325
    function MultiAlignCell($w,$h,$text,$border=0,$ln=0,$align='L',$fill=false) {

        $x = $this->GetX() + $w;
        $y = $this->GetY();

        $this->MultiCell($w,$h,$text,$border,$align,$fill);

        if( $ln==0 ) {
            $this->SetXY($x,$y);
        }
    }
}

//pripojenie do databazy
$query = $db->query("SELECT * FROM logs ORDER BY id ASC");
$rows = $query->fetchAll();

//inicializacia pdf
$pdf = new PDF("L");
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','B',8);

//zapis headeru do pdf
$pdf->Cell(5, 5, "id", 1);
$pdf->Cell(30, 5,"timestamp", 1);
$pdf->Cell(180, 5, "command", 1);
$pdf->Cell(15, 5, "status", 1);
$pdf->Cell(50, 5, "eorror_info", 1);

//zapis riadkov do pdf
foreach($rows as $row) {
    $pdf->Ln();
    $pdf->Cell(5, 20, $row["id"], 1);
    $pdf->Cell(30, 20, $row["timestamp"], 1);
    //viacriadkova bunka s paddingom
    $pdf->MultiAlignCell( 180, 4, str_pad(trim($row["command"]), 850), 1);
    $pdf->Cell(15, 20, $row["status"], 1);
    $pdf->Cell(50, 20, $row["error_info"], 1);
}
//zapis vystupu do pdf, otvori sa nova stranka
$pdf->Output("logs_" . date('Y-m-d') . ".pdf",'I');
?>