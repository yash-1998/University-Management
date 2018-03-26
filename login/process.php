<?php
	$username = $_POST['user'];
	$password = $_POST['pass'];

	$con=mysqli_connect("localhost","root","gotenssj19");
	mysqli_select_db($con,"login");

	$result = mysqli_query("select * from users where username='$username' and password='$password' ");
	$row = mysqli_fetch_array($result);

	if($row['username']==$username && $row['password']==$password)
	{
		echo "Login successful Welcome " .$row['username'] ;
	}
	else
	{
		echo "failed to login";
	}

?>