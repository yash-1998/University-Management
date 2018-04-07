<?php

	$con=mysqli_connect("localhost","root","");
	mysqli_select_db($con,"university");
	$sql = "Select * from student group by Branch";
	$rs = mysqli_query($con, $sql);
	if(mysqli_num_rows($rs))
	{
		$count=0;
		while ($row = mysqli_fetch_array($rs)) {
			$brn = $row['Branch'];
			echo "<option onclick='show($count)' id='$count'>".$brn."</option>";
			$count=$count+1;
			$sql1 = "Select CourseName from courses where Branch = '$brn' ";
			$rs1 = mysqli_query($con, $sql1);

			while ($row1 = mysqli_fetch_array($rs1)) {
				echo "<option>".$row['CourseName']."</option>";
			}
		}
	}
?>


