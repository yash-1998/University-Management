<?php
	
	require('fpdf.php');
	// Begin configuration

	$textColour = array( 255,1,255 );
	$headerColour = array( 100, 100, 100 );
	$tableHeaderTopTextColour = array( 255, 255, 255 );
	$tableHeaderTopFillColour = array( 125, 152, 179 );
	$tableHeaderTopProductTextColour = array( 0, 0, 0 );
	$tableHeaderTopProductFillColour = array( 143, 173, 204 );
	$tableHeaderLeftTextColour = array( 99, 42, 57 );
	$tableHeaderLeftFillColour = array( 184, 207, 229 );
	$tableBorderColour = array( 50, 50, 50 );
	$tableRowFillColour = array( 213, 170, 170 );
	$reportName = "2009 Widget Sales Report";
	$reportNameYPos = 160;
	$logoFile = "widget-company-logo.png";
	$logoXPos = 50;
	$logoYPos = 108;
	$logoWidth = 110;
	$columnLabels = array( "Q1", "Q2", "Q3", "Q4" );
	$rowLabels = array( "SupaWidget", "WonderWidget", "MegaWidget", "HyperWidget" );
	$chartXPos = 20;
	$chartYPos = 250;
	$chartWidth = 160;
	$chartHeight = 80;
	$chartXLabel = "Product";
	$chartYLabel = "2009 Sales";
	$chartYStep = 20000;

	$chartColours = array
					(
	                  	array( 255, 100, 100 ),
	                  	array( 100, 255, 100 ),
	                  	array( 100, 100, 255 ),
	                  	array( 255, 255, 100 ),
	                );

	$data = array
			(
	          	array( 9940, 10100, 9490, 11730 ),
	         	array( 19310, 21140, 20560, 22590 ),
	         	array( 25110, 26260, 25210, 28370 ),
	          	array( 27650, 24550, 30040, 31980 ),
	        );

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