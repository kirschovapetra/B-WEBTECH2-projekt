<?php
//export tabulky "logs" do pdf [Petra]

require "../config.php";
require 'fpdf/fpdf.php';


//https://phpflow.com/php/generate-pdf-file-mysql-database-using-php/
class PDF extends FPDF {
    private $lang; //jazyk stranky

    public function __construct($lang) {
        parent::__construct("L"); //landscape orientacia stranky
        $this->lang = $lang;
    }

    public function Header()    {
        $this->SetFont('Arial','B',13);
        $this->Cell(100);
        if ($this -> lang == "en"){
            $this->Cell(80,10,'Logs',1,0,'C');
        }
        else if ($this -> lang == "sk") {
            $this->Cell(80,10,'Logy',1,0,'C');
        }
        $this->Ln(20);
    }

    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial','I',8);
        if ($this -> lang == "en"){
            $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
        }
        else if ($this -> lang == "sk") {
            $this->Cell(0,10,'Strana '.$this->PageNo().'/{nb}',0,0,'C');
        }
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

//jazyk stranky
$language = $_GET["lang"];

if (isset($language)) {

    //pripojenie do databazy
    $query = $db->query("SELECT * FROM logs ORDER BY id ASC");
    $rows = $query->fetchAll();

    //inicializacia pdf
    $pdf = new PDF($language);
    $pdf->AddPage();
    $pdf->AliasNbPages();
    $pdf->SetFont('Arial','B',8);

    //zapis headeru do pdf
    $pdf->Cell(10, 5, "id", 1);
    $pdf->Cell(30, 5,"timestamp", 1);
    $pdf->Cell(180, 5, "command", 1);
    $pdf->Cell(15, 5, "status", 1);
    $pdf->Cell(40, 5, "error_info", 1);

    //zapis riadkov do pdf
    foreach($rows as $row) {
        $pdf->Ln();
        $pdf->Cell(10, 20, $row["id"], 1);
        $pdf->Cell(30, 20, $row["timestamp"], 1);
        //viacriadkova bunka s paddingom
        $pdf->MultiAlignCell( 180, 4, str_pad(trim($row["command"]), 900), 1);
        $pdf->Cell(15, 20, $row["status"], 1);
        $pdf->Cell(40, 20, $row["error_info"], 1);
    }

    //zapis vystupu do pdf, otvori sa nova stranka
    if ($language == "en"){
        $pdf->Output("logs_" . date('Y-m-d') . ".pdf",'I');
    }
    else if ($language == "sk") {
        $pdf->Output("logy_" . date('Y-m-d') . ".pdf",'I');
    }
}
?>