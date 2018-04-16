<?php
	session_start();
	require('fpdf.php');

	class PDF extends FPDF
	{
		// Page header
		function Header()
		{
			$this->Image('unimage.jpg',25,6,20);
			// Arial bold 15
			$this->SetFont('Arial','B',15);
			// Move to the right
			$this->Cell(80);
			// Title
			$this->Cell(30,10,'RESULT',1,0,'C');
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
			$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
		}
	}

	// Instanciation of inherited class
	$pdf = new PDF();
	$pdf->AliasNbPages();
	$pdf->AddPage();
	$pdf->SetFont('Times','',12);
	$con = mysqli_connect("localhost", "root","");
	mysqli_select_db($con, "university");

	$EnnoFind = $_SESSION['ResultEnno'];

	$query1 = mysqli_query($con,"Select * from student where Enno = '$EnnoFind'");
	$row1 = mysqli_fetch_array($query1);

	$pdf->Cell(35,10,'Name',0	,0,'L');
	$pdf->Cell(0,10,":   ".$row1['FirstName']." ".$row1['LastName'],0,1,'L');

	$pdf->Cell(35,10,'Current semester',0,0,'L');
	$pdf->Cell(0,10,":   ".$row1['CurrentSemester'],0,1,'L');

	$pdf->Cell(35,10,'Branch',0,0,'L');
	$pdf->Cell(0,10,":   ".$row1['Branch'],0,1,'L');

	$pdf->Cell(35,10,'Date of Birth',0,0,'L');
	$pdf->Cell(0,10,":   ".$row1['Dob'],0,1,'L');

	$pdf->Cell(35,10,'Contact',0,0,'L');
	$pdf->Cell(0,10,":   ".$row1['Email']." , ".$row1['ContactNo'],0,1,'L');

	$pdf->Cell(0,10,'',0,1,'L');
	//$pdf->Cell(0,10,'Grades',1,1,'C');
	$query2 = mysqli_query($con,"Select * from studentcourse where Enno = '$EnnoFind'");
	$up = 0;
	$down = 0;
	$sig = 0;

	$pdf->Cell(140,10,'Course Name',1,0,'C');
	$pdf->Cell(0	,10,'Grade',1,1,'C');

	while($row = mysqli_fetch_array($query2))
	{
		$ThisCourse = $row['CourseName'];
		$Credits = 0;
		if($row['Type'] == 'Theory')
			$Credits = 3;
		else
			$Credits = 2;

		$query3 = mysqli_query($con,"Select * from marks where Enno = '$EnnoFind' and CourseName = '$ThisCourse'");
		$row3 = mysqli_fetch_array($query3);
		$marks = $row3['Scored'];

		$grade = 'A+';
		$weight = 0;

		if($Credits == 3) {
			if($marks > 120) {
				$grade = 'A+';
				$weight = 10;
			}
			else if($marks > 100){
				$weight = 9;
				$grade = 'A';
			}
			else if($marks > 80) {
				$grade = 'B+';
				$weight = 8;
			}
			else if($marks > 60) {
				$grade = 'B';
				$weight = 7;
			}
			else if($marks > 40) {
				$grade = 'C';
				$weight = 6;
			}
			else if($marks > 30){
				$grade = 'D';
				$weight = 5;
			}
			else {
				$grade = 'F';
				$weight = 0;
			}
		}
		else {
			if($marks > 90) {
				$grade = 'A+';
				$weight = 10;
			}
			else if($marks > 80){
				$weight = 9;
				$grade = 'A';
			}
			else if($marks > 70) {
				$grade = 'B+';
				$weight = 8;
			}
			else if($marks > 60) {
				$grade = 'B';
				$weight = 7;
			}
			else if($marks > 50) {
				$grade = 'C';
				$weight = 6;
			}
			else if($marks > 40){
				$grade = 'D';
				$weight = 5;
			}
			else {
				$grade = 'F';
				$weight = 0;
			}
		}

		$query4 = mysqli_query($con,"select * from attendence where Enno = '$EnnoFind' and CourseName = '$ThisCourse'");
		$row4 = mysqli_fetch_array($query4);
		$present = $row4['Present'];

		$query5 = mysqli_query($con,"select * from attendence2 where CourseName = '$ThisCourse'");
		$row5 = mysqli_fetch_array($query5);
		$total = $row5['TotalClasses'];

		$percents = ($present * 100)/$total;
		if($percents < 75.0){
			$grade = 'F';
			$weight = 0;
		}

		if($weight == 0){
			$sig = 1;
		}

		$up = $up + $weight * $Credits;
		$down = $down + $Credits;

		if($Credits == 3)
			$pdf->Cell(140,10,$ThisCourse.' '.'Theory',0,0,'C');
		else
			$pdf->Cell(140,10,$ThisCourse.' '.'Lab',0,0,'C');
		$pdf->Cell(10	,10,'                                       '.$grade,0,1,'C');
	}

	if($sig == 1)
		$up = 0;

	$pointers = $up/$down;
	$final = number_format((float)$pointers, 2, '.', '');
	$pdf->Cell(0,15,"",0,1,'L');
	$pdf->Cell(30,10,"CGPI",0,0,'L');
	$pdf->Cell(0	,10,' :    '.$final,0,1,'L');

	$pdf->Output();
	?>
