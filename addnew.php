<?php
    session_start();
    if(isset($_POST['add']))
    {
		function GetImageExtension($imagetype)
		{
			if (empty($imagetype))
			    return false;
			switch ($imagetype)
            {
				case 'image/bmp':
					return '.bmp';
				case 'image/gif':
					return '.gif';
				case 'image/jpeg':
					return '.jpg';
				case 'image/png':
					return '.png';
				default:
					return false;
			}
		}
        $enno = $_SESSION['queryenno'];
        $addfname =$_POST['addfname'];
        $addlname=$_POST['addlname'];
        $adddob=$_POST['adddob'];
        $addemail=$_POST['addemail'];
        $addcontactno=$_POST['addcontactno'];
        $addaddress=$_POST['addaddress'];
        $addcs=$_POST['addcs'];
        $addbranch=$_POST['addbranch'];
        $addcontactno = (int)$addcontactno;
        $addcs = (int)$addcs;
        $con = mysqli_connect("localhost","root","");
        mysqli_select_db($con, "university");
        if (!empty($_FILES["uploadedimage"]["name"]))
        {
    	    $file_name=$_FILES["uploadedimage"]["name"];
    	    $temp_name=$_FILES["uploadedimage"]["tmp_name"];
    	    $imgtype=$_FILES["uploadedimage"]["type"];
    	    $ext= GetImageExtension($imgtype);
    	    $imagename=$enno.$ext;
    	    $target_path = "images/".$imagename;
	        if(move_uploaded_file($temp_name, $target_path))
            {
                $sql = "INSERT INTO student (Enno,FirstName,LastName,Dob,ContactNo,Email,Address,CurrentSemester,Branch,ImagePath) VALUES ('$enno','$addfname','$addlname','$adddob','$addcontactno','$addemail','$addaddress','$addcs','$addbranch','$target_path')";
                $rs = mysqli_query($con, $sql);
                $error = "Susscessfully registered";
                echo "<script type='text/javascript'>alert(\"$error\");</script>";
                echo("<script>location.href = 'http://localhost/University/dbms/STUDENT.php';</script>");
            }
            else
            {
                $error = "Please Try Again";
                echo "<script type='text/javascript'>alert(\"$error\");</script>";
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
      <a class="nav-link" href="index.php">
      <i class="fa fa-fw fa-dashboard"></i>
      <span class="nav-link-text">Dashboard</span>
      </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
      <a class="nav-link" href="admindetails.php">
      <i class="fa fa-fw fa-area-chart"></i>
      <span class="nav-link-text">Admin Details</span>
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
      <a href="#">Add New Student</a>
    </li>
    </ol>
  <div class="container">
      <div class="card card-login mx-auto mt-9">
          <div class="card-header"><i class="fa fa-user" style="font-size:48px;padding-left: 150px"></i></div>
          <div class="card-body">
          <form action="addnew.php" method="POST" enctype = "multipart/form-data">
              <div class="form-group" >
                  <label for="addenno">Enrollment Number : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addenno" class="form-control" type="text" value=<?php echo $_SESSION['queryenno']?> id="addenno" required>
              </div>
              <div class="form-group" >
                  <label for="addfname">First Name : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addfname" class="form-control" type="text" placeholder="First Name" id="addfname" required>
              </div>
              <div class="form-group" >
                  <label for="addlname">Last Name : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addlname" class="form-control" type="text" placeholder="Last Name" id="addlname" required>
              </div>
              <div class="form-group" >
                  <label for="dob">Date of Birth : &nbsp;&nbsp;&nbsp;</label>
                  <input name="adddob" class="form-control" type="date" placeholder="Date of Birth" id="dob" required>
              </div>
              <div class="form-group" >
                  <label for="addemail">Email : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addemail" class="form-control" type="email" placeholder="Email" id="addemail" required>
              </div>
              <div class="form-group" >
                  <label for="addcontactno">Contact Number : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addcontactno" class="form-control" type="text" placeholder="Contact" id="addcontactno" required>
              </div>
              <div class="form-group" >
                  <label for="addaddress">Address : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addaddress" class="form-control" type="textarea" placeholder="Address" id="addaddress" required>
              </div>
              <div class="form-group" >
                  <label for="addcs">Current Semester : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addcs" class="form-control" type="textarea" placeholder="Current Semester" id="addcs" required>
              </div>
              <div class="form-group" >
                  <label for="addbranch">Branch : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addbranch" class="form-control" type="textarea" placeholder="Branch" id="addbranch" required>
              </div>
              <div class="form-group" >
                  <input name="uploadedimage" class="form-control" type="file"  required>
              </div>

              <button class="btn btn-primary btn-block" type="submit" name="add">ADD</button>
          </form>
          </div>
      </div>
    </div>

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
