<?php
	$con=mysqli_connect("localhost","root","");
	mysqli_select_db($con,"university");
	$branchname = $_GET['bid'];
	$sql = "Select CourseName from courses where Branch='$branchname'";
	$rs = mysqli_query($con, $sql);
	$data = array();
	while($row = mysqli_fetch_array($rs))
	{
		$data[] = array('Cour' => $row['CourseName']);
	}
	header('Content-type : application/json');
	echo json_encode($data);
?>