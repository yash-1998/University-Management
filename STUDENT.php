<?php
    session_start();
    if(isset($_POST['findedit']))
    {
        $queryen = $_POST['ennoquery'];
        $con=mysqli_connect("localhost","root","");
        mysqli_select_db($con,"University");
        $sql = "Select * from Student where Enno = '".$queryen."'";
        $rs = mysqli_query($con, $sql);
        $_SESSION['queryenno']=$_POST['ennoquery'];
        $flag=0;
        while($row = mysqli_fetch_array($rs))
        { 
            if($row['Enno']==$queryen)
                $flag=1;
        }
        if($flag==1)
            echo("<script>location.href = 'http://localhost/University/WebD-master/findedit.php';</script>");
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
        mysqli_select_db($con,"University");
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
            echo("<script>location.href = 'http://localhost/University/WebD-master/addnew.php';</script>");
        else
        {
            $error = "Enrollment Number already exist";
            echo "<script type='text/javascript'>alert(\"$error\");</script>";
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

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
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
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="admindetails.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Admin Details</span>
          </a>
        </li>   
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
          <a class="nav-link" href="#">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Link</span>
          </a>
        </li>
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
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Student</li>
      </ol>
      <div class="row">
        <div class="col-xl-2 col-sm-4 mb-3">
          <div class="card text-white bg-primary o-hidden h-100">
            <a class="card-footer text-white clearfix small z-1" href="viewall.php">
              <span class="float-left">View All</span>
              <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
            </a>
          </div>
        </div>
        <form class="form-inline my-2 my-lg-0 mr-lg-2" style="height: 50px" method="POST" action="">
            <div class="input-group">
              <input class="form-control" type="text" placeholder="Enter Enrollment No" name="ennoquery">
              <span class="input-group-append">
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary" type="submit" name="findedit">Find/Edit</button>
                &nbsp;&nbsp;&nbsp;
                <button class="btn btn-primary" type="submit" style = "background: green" name="addnew">Add New</button>
              </span>
            </div>
          </form>
      
      <!-- Icon Cards-->
      <!-- Area Chart Example-->
          <!-- Example Bar Chart Card-->
          <!-- Card Columns Example Social Feed-->
            <!-- Example Social Card-->
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
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
