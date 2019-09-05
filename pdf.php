<?php
require_once('function.php');

require('./pdf/fpdf.php');
if(!isset($_SESSION))
{
  session_start();
}
$sessName = $_SESSION['name'];
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,"Thank you for your visit: $sessName! But our time is over!;)");
$pdf->Output();
