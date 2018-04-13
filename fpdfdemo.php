<?php
	
	require('fpdf.php');
	// Begin configuration

	// End configuration
	$pdf = new FPDF();
	$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',18);
	$pdf->Cell(40,10,'This is a fpdf demo');
	$pdf->AddPage();
	$pdf->Cell(40,10,'This is a fpdf demo');
	$pdf->output();
?>