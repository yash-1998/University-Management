<?php
	session_start();
	include('config.php');
	$branc = "";
	if(isset($_GET['bida']))
	{
		$_SESSION['selectedbrancha']=$_GET['bida'];
		$branc=$_GET['bida'];
	}
	else
	{
		$_SESSION['selectedbrancha']="Select Branch";
	}
	if(isset($_POST['add']))
	{
		$cours = "";
		if (isset($_POST['CourseSelect']))
		{
			if ($_POST['CourseSelect'] != "Select Course")
			{
				$_SESSION['selectedcoursea'] = $_POST['CourseSelect'];
                $cours = $_POST['CourseSelect'];
			}
		}

		if ($branc == "" || $cours == "")
		{
			$error = "Please Select a Branch and Course";
			echo "<script>alert(\"$error\");</script>";
		}
		else
		{
			echo("<script>location.href = 'http://localhost/university/dbms/add_marks.php';</script>");
		}
       
        if (isset($_POST['TypeSelect']))
		{
			if ($_POST['TypeSelect'] != "Select Type")
			{
				$_SESSION['selectedtype'] = $_POST['TypeSelect'];
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Add Attendence</title>
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
				<a class="nav-link text-white" href="index.php">
					<i class="fa fa-fw fa-dashboard"></i>
					<span class="nav-link-text">Dashboard</span>
				</a>
			</li>
			<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admin">           <a class="nav-link text-white" href="admindetails.php">             <i class="fa fa-fw fa-user"></i>             <span class="nav-link-text">Admin Details</span>           </a>         </li>         <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Departments">           <a class="nav-link text-white" href="department.php">               <i class="fa fa-fw fa-bank"></i>               <span class="nav-link-text">Departments</span>           </a>         </li>

		</ul>
		<ul class="navbar-nav sidenav-toggler">
			<li class="nav-item">
				<a class="nav-link text-center text-white" id="sidenavToggler">
					<i class="fa fa-fw fa-angle-left"></i>
				</a>
			</li>
		</ul>
		<ul class="navbar-nav ml-auto">
			<li class="nav-item" style="padding-top: 7px;">
				<b style="color: white ;"><?php echo "Welcome " . $_SESSION['username']; ?></b>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" data-toggle="modal" data-target="#exampleModal">
					<i class="fa fa-fw fa-sign-out"></i>Logout</a>
			</li>
		</ul>
	</div>
</nav>
<div class="content-wrapper" style="background-color : #ede1c7">
	<div class="container-fluid">
		<!-- Breadcrumbs-->
		<ol class="breadcrumb" style="background-color: #343a40" >
			<li class="breadcrumb-item">
				<a href="index.php">Dashboard</a>
			</li>
			<li class="breadcrumb-item active text-white">Exams</li>
		</ol>
		<div class="container">
			<div class="card card-login mx-auto mt-9">
				<div class="card-header"><i class="fa fa-calendar" style="font-size:48px;padding-left: 150px"></i></div>
				<div class="card-body">
					<form action="" method="POST">
						<div class="form-group" >
							<label for="BranchSelect">Branch  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<select name="BranchSelect" class="attsearch" type="Select" id="Branchid" onchange="window.location.href=this.value;">
								<option value="http://localhost/university/dbms/addattendence.php"><?php echo $_SESSION['selectedbrancha'];?></option>
								<?php
								$con=mysqli_connect("localhost","root","");
								mysqli_select_db($con,"university");
								$sql = "Select DISTINCT  Branch from student";
								$rs = mysqli_query($con, $sql);
								if(mysqli_num_rows($rs))
								{
									while ($row = mysqli_fetch_array($rs))
									{
										$brn = $row['Branch'];
										if($_SESSION['selectedbrancha']!=$brn)
											echo "<option value='http://localhost/university/dbms/update_marks.php?bida=".$brn."'>".$brn."</option>";
									}
								}
								?>
							</select>
						</div>
						<div class="form-group" >
							<label for="CourseSelect">Course  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<select name="CourseSelect" class="attsearch" type="Select" id="Courseid">
								<option>Select Course</option>
								<?php
								if($_SESSION['selectedbrancha']!="Select Branch")
								{
									$con = mysqli_connect("localhost", "root", "");
									mysqli_select_db($con, "university");
									$selecbrn = $_SESSION['selectedbrancha'];
									$sql = "Select CourseName from courses where Branch='$selecbrn'";
									$rs = mysqli_query($con, $sql);
									if (mysqli_num_rows($rs)) {
										while ($row = mysqli_fetch_array($rs)) {
											$brn = $row['CourseName'];
											echo "<option> ". $brn . "</option>";
										}
									}
								}
								?>
							</select>
						</div>
						<div class="form-group" >
							<label for="TypeSelect">Type  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
							<select name="TypeSelect" class="attsearch" type="Select" id="Typeid">
								<option>Select Type</option>
								<?php
											echo "<option> ". "Theory" . "</option>";
											echo "<option> ". "Lab" . "</option>";			    
								?>
							</select>
						</div>
						<button class="btn btn-primary btn-block" type="submit" name="add">ADD</button>
					</form>
				</div>
			</div>
		</div>
		<br>
		<footer class="sticky-footer" style="background-color : #343a40;">
			<div class="container">
				<div class="text-center text-white">
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
	</div>
</div>
</body>

</html>


