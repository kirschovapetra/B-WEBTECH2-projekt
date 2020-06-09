<?php
//export tabulky "logs" do pdf [Petra]

require "../config.php";
require('tfpdf/tfpdf.php');


$pdf = new tFPDF();
$pdf->AddPage();
//$pdf->AddFont('DejaVu','','DejaVuSans.ttf',true);
//$pdf->SetFont('DejaVu','',14);
$pdf->AddFont('DejaVu','','DejaVuSansCondensed.ttf',true);
$pdf->SetFont('DejaVu','',8);
$txt = mb_convert_encoding(file_get_contents('descSK.txt'), 'UTF-8', 'auto');
$pdf->Write(8,$txt);
$pdf->Output("popis".".pdf", 'I', "true");

?>