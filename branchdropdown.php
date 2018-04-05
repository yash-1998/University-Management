<?php
	$con=mysqli_connect("localhost","root","");
	mysqli_select_db($con,"university");
	$sql = "Select distinct Branch from student";
	$rs = mysqli_query($con, $sql);
	$data = array();
	while($row = mysqli_fetch_array($rs))
	{
		echo $row['Branch'];
		$data[] = array('Branc' => $row['Branch']);
	}
	header('Content-type : application/json');
	echo json_encode($data);
?>