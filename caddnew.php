<?php
    session_start();
    if(isset($_POST['add']))
    {
        $cCourseName = $_SESSION['coursequery'];
        $cCredits=$_POST['cCredits'];
        $lCredits=$_POST['lCredits']; 
        $cBranchName=$_POST['cBranchName'] ;
        $con = mysqli_connect("localhost", "root","");
        $f1=0 ; $f2=0 ;
        if (!empty($_POST['item1'])) $f1=1 ; 
        if (!empty($_POST['item2'])) $f2=1 ;
        if ($f1==1 || $f2==1)
        {
              mysqli_select_db($con, "university");
             if($f1==1)
             {
              $sql = "INSERT INTO courses(CourseName,Type,Credits) VALUES ('$cCourseName','Theory','$cCredits')";
              $rs = mysqli_query($con, $sql);
             }    
             if($f2==1)
             {
              $sq2 = "INSERT INTO courses(CourseName,Type,Credits) VALUES ('$cCourseName','Lab','$lCredits')";
              $rs2 = mysqli_query($con, $sq2);
             } 

              $sql3 = "INSERT INTO coursebranch(CourseName,Branch) VALUES ('$cCourseName','$cBranchName')";
              $rs3 = mysqli_query($con, $sql3);   
        } 
       else
       {
         $error = "Select Type";
         echo "<script type='text/javascript'>alert(\"$error\");</script>";
         echo("<script>location.href = 'http://localhost/university/dbms/caddnew.php';</script>");
       }
        $error = "Susscessfully registered";
        echo "<script type='text/javascript'>alert(\"$error\");</script>";
        echo("<script>location.href = 'http://localhost/university/dbms/courses.php';</script>");
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
  <title>Dashboard</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
   <script type="text/javascript">
    function ShowHideDiv()
     {
        var checkt=document.getElementById("checkt");

        var inputt = document.getElementById("cCredits");
        inputt.style.display = checkt.checked ? "block" : "none";
    }
    function ShowHideDiv2()
     {
        var checkl=document.getElementById("checkl");

        var inputl = document.getElementById("lCredits");
        inputl.style.display = checkl.checked ? "block" : "none";
    }
</script>
</head>

<body class="fixed-nav sticky-footer bg-dark sidenav-toggled " id="page-top">
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
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
      <a class="nav-link text-white" href="admindetails.php">
      <i class="fa fa-fw fa-user"></i>
      <span class="nav-link-text">Admin Details</span>
      </a>
    </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Departments">
            <a class="nav-link text-white" href="department.php">
                <i class="fa fa-fw fa-bank"></i>
                <span class="nav-link-text">Departments</span>
            </a>
        </li>
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
        <li class="breadcrumb-item"><a href="courses.php">Course</a></li>
        <li class="breadcrumb-item text-white" active>Add Course : <?php echo $_SESSION['coursequery']?>
    </ol>
  <div class="container">
      <div class="card card-login mx-auto mt-9">
          <div class="card-header"><i class="fa fa-book" style="font-size:48px;padding-left: 150px"></i></div>
          <div class="card-body">
          <form action="caddnew.php" method="POST">
              <div class="form-group" >
              <label for="cCourseName">Course Name : &nbsp;&nbsp;&nbsp;</label>
              <input name="cCourseName" class="form-control" type="text" value=<?php echo $_SESSION['coursequery']?> id="cCourseName" > 
              </div>
              <div class="form-group" >
              <label for="cBranchname"> Branch: &nbsp;&nbsp;&nbsp;</label>
              <select name="cBranchName" class="form-control" type="text" placeholder="Branch Name" id="cBranchName" required>
                  <option value="">Select Branch</option>
				  <?php
				  $con=mysqli_connect("localhost","root","");
				  mysqli_select_db($con,"university");
				  $sql = "Select distinct Branch from coursebranch";
				  $rs = mysqli_query($con, $sql);
				  while($row = mysqli_fetch_array($rs))
				  {
					  $brn = $row['Branch'];
					  echo '<option>'.$brn.'</option>';
				  }
				  ?>
              </select>
              </div>

             <div>

                  <label for="addtype">Type : &nbsp;&nbsp;&nbsp;</label>
                  </br>
                  <input id="checkt" type="checkbox" name="item1" value=Theory onclick="ShowHideDiv()">&nbsp;&nbsp;&nbsp;Theory<br><br>
                  <div class="form-group">
                      <input style = "display : none;" name="cCredits" class="form-control" type="text" placeholder="Theory Credits" id="cCredits">
                  </div>
                  <input id="checkl" type="checkbox" name="item2" value=Lab onclick="ShowHideDiv2()">&nbsp;&nbsp;&nbsp;Lab<br><br> 
                  <div class="form-group" >
                      <input style = "display : none;" name="lCredits" class="form-control" type="text" placeholder="Lab Credits" id="lCredits">
                  </div>   
              </div>
              <button class="btn btn-primary btn-block" type="submit" name="add">ADD</button>
          </form>
          </div>
      </div>
    </div>
    <br>
    <!-- Icon Cards-->
    <!-- Area Chart Example-->
      <!-- Example Bar Chart Card-->
      <!-- Card Columns Example Social Feed-->
      <!-- Example Social Card-->
  <!-- /.container-fluid-->
  <!-- /.content-wrapper-->
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
