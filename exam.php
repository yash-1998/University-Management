<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Attendence</title>
	<!-- Bootstrap core CSS-->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- Custom fonts for this template-->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<!-- Page level plugin CSS-->
	<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
	<!-- Custom styles for this template-->
	<link href="css/sb-admin.css" rel="stylesheet">
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
		<div class="row">
			<div class="col-xl-2 col-sm-4 mb-3">
				<div class="card text-white bg-primary o-hidden h-100">
					<a class="card-footer text-white clearfix small z-1" href="view_marks.php">
						<span class="float-left">View Marks</span>
						<span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
					</a>
				</div>
			</div>

			<div class="col-xl-2 col-sm-4 mb-3">
				<div class="card text-white bg-primary o-hidden h-100" >
					<a class="card-footer text-white clearfix small z-1" style="background-color: #28a745;" href="update_marks.php">
						<span class="float-left">Update Marks </span>
						<span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
					</a>
				</div>
			</div>
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
			<script src="vendor/chart.js/Chart.min.js"></script>
			<script src="vendor/datatables/jquery.dataTables.js"></script>
			<script src="vendor/datatables/dataTables.bootstrap4.js"></script>
			<!-- Custom scripts for all pages-->
			<script src="js/sb-admin.min.js"></script>
			<!-- Custom scripts for this page-->
			<script src="js/sb-admin-datatables.min.js"></script>
			<script src="js/sb-admin-charts.min.js"></script>
		</div>
</body>

</html>
