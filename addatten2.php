<?php
	session_start();
	if(isset($_POST['addatten']))
	{
		$con=mysqli_connect("localhost","root","");
		mysqli_select_db($con,"university");
		$selecourse = $_SESSION['selectedcoursea'];
		$totalclasses = $_POST['maxclasses'];
		$sqll = "Select * from attendence2 where CourseName='$selecourse'";
		$rsl = mysqli_query($con, $sqll);
		if(mysqli_num_rows($rsl))
		{
			$sqll6="UPDATE attendence2 SET TotalClasses = $totalclasses WHERE CourseName='$selecourse'";
			$rsl6 = mysqli_query($con, $sqll6);
		}
		else
		{
			$sql3 = "INSERT INTO attendence2(CourseName,TotalClasses) VALUES ('$selecourse',$totalclasses)";
			$rs3 = mysqli_query($con, $sql3);
		}

		$sql4 = "Select * from studentcourse where CourseName='$selecourse'";
		$rs4 = mysqli_query($con, $sql4);
		while($row4 = mysqli_fetch_array($rs4))
		{
			$enno = $row4['Enno'];
			$sql5 = "Select * from attendence where CourseName='$selecourse' and Enno='$enno'";
			$rs5 = mysqli_query($con, $sql5);
			$present = $_POST[$enno];
			if(mysqli_num_rows($rs5))
			{
				$sql6="UPDATE attendence SET Present = $present WHERE CourseName='$selecourse' and Enno='$enno'";
				$rs6 = mysqli_query($con, $sql6);
			}
			else
			{
				$sql7="INSERT INTO attendence(Enno,CourseName,Present) VALUES ('$enno','$selecourse',$present)";
				$rs7 = mysqli_query($con, $sql7);
			}
		}
		echo("<script>location.href = 'http://localhost/university/dbms/addattendence.php';</script>");
	}
?>
<!DOCTYPE html>
</bod lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>View Attendence</title>
	<!-- Bootstrap core CSS-->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="css/sb-admin.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

</head>

<body class="fixed-nav sticky-footer bg-dark sidenav-toggled" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
	<a class="navbar-brand" href="index.php">University Management System</a>
	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarResponsive">
		<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
				<a class="nav-link" href="index.php">
					<i class="fa fa-fw fa-dashboard"></i>
					<span class="nav-link-text">Dashboard</span>
				</a>
			</li>
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admin">           <a class="nav-link" href="admindetails.php">             <i class="fa fa-fw fa-user"></i>             <span class="nav-link-text">Admin Details</span>           </a>         </li>         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Departments">           <a class="nav-link" href="department.php">               <i class="fa fa-fw fa-bank"></i>               <span class="nav-link-text">Departments</span>           </a>         </li>

		</ul>
		<ul class="navbar-nav sidenav-toggler">
			<li class="nav-item">
				<a class="nav-link text-center" id="sidenavToggler">
					<i class="fa fa-fw fa-angle-left"></i>
				</a>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item" style="padding-top: 7px;">
				<b style="color: gray ;"><?php echo "Welcome " . $_SESSION['username']; ?></b>
			</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="modal" data-target="#exampleModal">
					<i class="fa fa-fw fa-sign-out"></i>Logout</a>
			</li>
		</ul>
	</div>
</nav>
<div class="content-wrapper">
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb">
			<li class="breadcrumb-item">
				<a href="index.php">Dashboard</a>
			</li>
            <li class="breadcrumb-item">
                <a href="attendence.php">Attendence</a>
            </li>
			<li class="breadcrumb-item active">Add Attendence</li>
		</ol>
		<div class="container">
            <div class="text-center"><h1>Add Attendence for <?php echo $_SESSION['selectedcourse'];?></h1></div>
            </br>
			<form action="addatten2.php" method="POST">
				<label for="maxclasses">Enter the total number of classes</label>
                <input name="maxclasses" class ="attsearch" type="number" id="maxclasses" type="number" step="1" placeholder="Enter the total number of classes held for <?php echo $_SESSION['selectedcoursea'];?>" required>
			<div class="card mb-3">
				<br class="card-body">
				<div class="table-responsive">
					<table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
						<thead>
						<tr>
							<th>Enrollment Number</th>
							<th>Name</th>
							<th>Enter Attendence</th>
						</tr>
						</thead>
						<tbody>
						<?php
							$con=mysqli_connect("localhost","root","");
							mysqli_select_db($con,"university");
							$selecourse = $_SESSION['selectedcoursea'];
							$sql = "Select * from studentcourse where CourseName='$selecourse'";
							//echo "<script>alert(\"$sql\");</script>";
							$rs = mysqli_query($con, $sql);
							while($row = mysqli_fetch_array($rs))
							{
								$enno = $row['Enno'];
								echo '<tr>
												<td>'.$row['Enno'].'</td>';
												$sql2 = "Select * from student where Enno='$enno'";
												//echo "<script>alert(\"$sql\");</script>";
												$rs2 = mysqli_query($con, $sql2);
												$row2 = mysqli_fetch_array($rs2);
											echo '<td>'.$row2['FirstName'].' '.$row2['LastName'].'</td>
												<td><input name='.$enno.' type="number" required></td>
										  </tr>';
							}
						?>
						</tbody>
					</table>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						&nbsp;&nbsp;
						<button class="btn btn-primary " type="submit" name="addatten" style="width: 18%; margin-left: 10%; margin-bottom: 0.5%; padding: 1%;">ADD ATTENDANCE</button>
					</form>
				</div>
	</div>
</div>
		<br>
		<footer class="sticky-footer">
			<div class="container">
				<div class="text-center">
					<small>Copyright © Funkyfunks 2018</small>
				</div>
			</div>
		</footer>
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
			<i class="fa fa-angle-up"></i>
		</a>
		<!-- Logout Modal-->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
						<button class="close" type="button" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
					<div class="modal-footer">
						<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
						<a class="btn btn-primary" href="login.php">Logout</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Bootstrap core JavaScript-->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- Core plugin JavaScript-->
		<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
		<!-- Page level plugin JavaScript-->
		<!-- Custom scripts for all pages-->
		<script src="js/sb-admin.min.js"></script>
		<!-- Custom scripts for this page-->
		<script src="js/sb-admin-datatables.min.js"></script>
		<script src="js/sb-admin-charts.min.js"></script>


</body>

</html>


