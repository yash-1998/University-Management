<?php
	$con=mysqli_connect("localhost","root","");
	mysqli_select_db($con,"university");
	$sql = "Select * from student group by Branch";
	$rs = mysqli_query($con, $sql);
	if(mysqli_num_rows($rs))
	{
		$data = array();
		while ($row = mysqli_fetch_array($rs)) {
			$data[] = array(
				'id' => $row['id'],
				'Branch' => $row['Branch']
			);
		}
		header('Content-type : application/json');
		echo json_encode($data);
	}
?>