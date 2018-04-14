<?php
    session_start();
    if(isset($_POST['findedit']))
    {
        $queryen = $_POST['ennoquery'];
        $con=mysqli_connect("localhost","root","");
        mysqli_select_db($con,"university");
        $sql = "Select * from Student where Enno = '".$queryen."'";
        $rs = mysqli_query($con, $sql);
        $_SESSION['queryenno']=$_POST['ennoquery'];
        $flag=0;
        while($row = mysqli_fetch_array($rs))
        {
            if($row['Enno']==$queryen)
            {
               $_SESSION['roll']=$queryen ;
               $_SESSION['fname']=$row['FirstName'] ;
               $_SESSION['lname']=$row['LastName'] ;
               $_SESSION['email']=$row['Email'] ;
               $_SESSION['contact']=$row['ContactNo'] ;
               $_SESSION['address']=$row['Address'] ;
               $_SESSION['branch']=$row['Branch'] ;
               $_SESSION['sem']=$row['CurrentSemester'] ;
               $_SESSION['imagepath']=$row['ImagePath'];
               $flag=1;
            }
        }
        if($flag==1)
            echo("<script>location.href = 'http://localhost/university/dbms/findedit.php';</script>");
        else
        {
            $error = "Enrollment Number does not exist";
            echo "<script type='text/javascript'>alert(\"$error\");</script>";
        }
    }
    else if(isset($_POST['delete']))
	{
		$queryen = $_POST['ennoquery'];
		$con=mysqli_connect("localhost","root","");
		mysqli_select_db($con,"university");
		$sql = "Select * from Student where Enno = '".$queryen."'";
		$rs = mysqli_query($con, $sql);
		$_SESSION['queryenno']=$_POST['ennoquery'];
		$flag=0;
		while($row = mysqli_fetch_array($rs))
		{
			if($row['Enno']==$queryen)
			{
				$_SESSION['roll']=$queryen ;
				$_SESSION['fname']=$row['FirstName'] ;
				$_SESSION['lname']=$row['LastName'] ;
				$_SESSION['email']=$row['Email'] ;
				$_SESSION['contact']=$row['ContactNo'] ;
				$_SESSION['address']=$row['Address'] ;
				$_SESSION['branch']=$row['Branch'] ;
				$_SESSION['sem']=$row['CurrentSemester'] ;
				$_SESSION['imagepath']=$row['ImagePath'];
				$flag=1;
			}

		}
		if($flag==1)
			echo("<script>location.href = 'http://localhost/university/dbms/deletestudent.php';</script>");
		else
		{
			$error = "Enrollment Number does not exist";
			echo "<script type='text/javascript'>alert(\"$error\");</script>";
		}
	}
    if(isset($_POST['addnew']))
    {
        $queryen = $_POST['ennoquery'];
        $con=mysqli_connect("localhost","root","");
        mysqli_select_db($con,"university");
        $sql = "Select * from Student";
        $rs = mysqli_query($con, $sql);
        $_SESSION['queryenno']=$_POST['ennoquery'];
        $flag=0;
        while($row = mysqli_fetch_array($rs))
        {
            if($row['Enno']==$queryen)
                $flag=1;
        }
        if($flag==0)
            echo("<script>location.href = 'http://localhost/university/dbms/addnew.php';</script>");
        else
        {
            $error = "Enrollment Number already exist";
            echo "<script type='text/javascript'>alert(\"$error\");</script>";
        }
    }
    if(isset($_POST['deletebatch']))
    {
        if(isset($_POST['delbatch']))
        {
            if($_POST['delbatch']!='Select Batch to delete whole batch')
            {
                $delsem=$_POST['delbatch'];
				$con=mysqli_connect("localhost","root","");
				mysqli_select_db($con,"university");
				$sql1 = "Select Enno from Student where CurrentSemester = '".$delsem."'";
				$rs1 = mysqli_query($con, $sql1);
				while($row=mysqli_fetch_array($rs1))
                {
                    $delenno=$row['Enno'];
					$sql = "Delete from Student where Enno = '$delenno'";
					$rs = mysqli_query($con, $sql);
					$sql = "Delete from studentcourse where Enno = '$delenno'";
					$rs = mysqli_query($con, $sql);
					$sql = "Delete from marks where Enno = '$delenno'";
					$rs = mysqli_query($con, $sql);
					$sql = "Delete from attendence where Enno = '$delenno'";
					$rs = mysqli_query($con, $sql);
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">s
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>STUDENT</title>
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
        <li class="breadcrumb-item active text-white">Student</li>
      </ol>
        <br>
        <div class="row" style="margin-left: 15%;">
            <div class="col-xl-30 col-sm-10 mb-xl-5">
                <div class="card text-white bg-primary o-hidden h-200">
                    <a class="card-footer text-center text-white z-1" href="viewall.php">
                        <span class="text-center">View All Student Details</span>
                        <span class="text-center"><i class="fa fa-angle-right"></i></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="card card-login mx-auto mt-9">
            <div class="card-body " style="background-color : #ede1c7">
                <form action="" method="POST">
                    <div class="form-group" >
                        <input style="text-align: center" class="form-control" type="text" placeholder="Enter Student Enrollment Number" name="ennoquery" required>
                        <br>
                        <button class="btn btn-primary btn-block" type="submit" name="findedit">Find/Edit</button>
                        <br>
                        <button class="btn btn-primary btn-block" type="submit" style = "background: green" name="addnew">Add New</button>
                        <br>
                        <button class="btn btn-primary btn-block" type="submit" style = "background: darkred" name="delete">Delete</button>
                        <br>
                        <br>
                </form>
                <form action="" method="POST">
                    <select id="delbatch" class="form-control" type="select" name="delbatch" required>
                        <option>Select Batch to delete whole batch</option>
						<?php
						$con=mysqli_connect("localhost","root","");
						mysqli_select_db($con,"university");
						$sql = "Select distinct CurrentSemester from Student order by CurrentSemester";
						$rs = mysqli_query($con, $sql);
						while($row = mysqli_fetch_array($rs))
						{
							echo '<option>'.$row['CurrentSemester'].'</option>';
						}
						?>
                    </select>
                    <br>
                    <button class="btn btn-primary btn-block" type="submit" style = "background: darkred" name="deletebatch">Delete Whole Batch</button>
                    <br>
                </form>
            </div>
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
