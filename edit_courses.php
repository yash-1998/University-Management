<?php
    session_start();
    if(isset($_POST['change']))
    {
       $_SESSION['cCredits']=-1 ;
       $_SESSION['lCredits']=-1 ; 
       $_SESSION['lType']=-1 ;  
       $_SESSION['cType']=-1 ; 
		$cCourseName = $_POST['cCourseName'];
		$cBrname = $_POST['cBrname'];

		$cCredits = $_POST['cCredits'];
    $lCredits = $_POST['lCredits']; 
		$con = mysqli_connect("localhost", "root", "");
		mysqli_select_db($con, "university");

		$sql = "DELETE FROM courses WHERE CourseName = '$cCourseName'";
		$rs1 = mysqli_query($con, $sql);
//		$sql1 = "INSERT INTO courses (CourseName,Type,Credits) VALUES ('$cCourseName','Theory','$cCredits')";
//		$rs2 = mysqli_query($con, $sql1);
//    $sql0 = "INSERT INTO courses (CourseName,Type,Credits) VALUES ('$cCourseName','Lab','$lCredits')";
//   $rs0 = mysqli_query($con, $sql0);
		$sqll = "DELETE FROM coursebranch WHERE CourseName = '$cCourseName'";
		$rsll = mysqli_query($con, $sqll);
		$sqlll = "INSERT INTO coursebranch(CourseName,Branch) VALUES ('$cCourseName','$cBrname')";
		$rslll = mysqli_query($con, $sqlll);

      $f1=0 ; $f2=0 ;
       if (!empty($_POST['item1'])) $f1=1 ; 
       if (!empty($_POST['item2'])) $f2=1 ;
       if ($f1==1 || $f2==1)
        {
               if($f1==1)
               {
                $sql = "INSERT INTO courses(CourseName,Type,Credits) VALUES ('$cCourseName','Theory','$cCredits')";
                $rs = mysqli_query($con, $sql);
                $_SESSION['cCredits']=$cCredits ; 
                $_SESSION['cType']="Theory";  
               }    
               if($f2==1)
               {
                $sq2 = "INSERT INTO courses(CourseName,Type,Credits) VALUES ('$cCourseName','Lab','$lCredits')";
                $rs2 = mysqli_query($con, $sq2);
                $_SESSION['lCredits']=$lCredits ; 
                $_SESSION['lType']="Lab"; 
               }    
          } 
		$error = "Susscessfully Modified";

		$_SESSION['cCourseName'] = $cCourseName;
		$_SESSION['cBranch'] = $cBrname;
		//$_SESSION['cType'] = $cType;
		//$_SESSION['cCredits'] = $cCredits;
		echo "<script type='text/javascript'>alert(\"$error\");</script>";
		echo("<script>location.href = 'http://localhost/university/dbms/cfindedit.php';</script>");
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <style> 
   input[type=text] 
  {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    box-sizing: border-box;
    border: none;
    background-color: white;
    color: Black;
    border: 1px solid gray;
    border-radius: 6px;
  }
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>COURSES</title>
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
            <li class="breadcrumb-item"><a href="courses.php">Courses</a></li>
            <li class="breadcrumb-item"><a href="cfindedit.php"><?php echo $_SESSION['cCourseName']?></a>
             </li>
             <li class="breadcrumb-item text-white" active>Edit
             </li>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;   
              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;  
      </ol>
      <form action="edit_courses.php" method="POST">
         <div class="form-group">
            <label >Course Name : &nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['cCourseName']?> name="cCourseName" readonly>
        </div>
          <div class="form-group" >
          <label >Branch : &nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['cBranch']?>  name="cBrname" required>
        </div>
         <div class="form-group" >
                  <label for="addtype">Type : &nbsp;&nbsp;&nbsp;</label>
                  </br>
                  <?php
                      
                        echo '<input type="checkbox" name="item1"  value=Theory>'.'&nbsp;&nbsp;&nbsp;Theory<br>';
                        echo '<input type="checkbox" name="item2" value=Lab>'.'&nbsp;&nbsp;&nbsp;Lab<br>'; 
                    ?>
              </div>
        <div class="form-group">
          <label >Theory Credits : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['cCredits']?> name="cCredits" required>
        </div>
       <div class="form-group">
          <label >Lab Credits : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['lCredits']?> name="lCredits" required>
        </div> 
        <div class="input-group">
        <button  class="btn btn-primary" type="submit" style="background: green;" name="change">Make Changes</button>
        </div>
      </form>
      <br>
      <!-- Icon Cards-->
      <!-- Area Chart Example-->
          <!-- Example Bar Chart Card-->
          <!-- Card Columns Example Social Feed-->
            <!-- Example Social Card-->
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer" >
      <div class="container" >
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
