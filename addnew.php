<?php
    session_start();
    if(isset($_GET['branchh']))
    {
        $_SESSION['branchh']=$_GET['branchh'];
        $branc =$_GET['branchh'];
    }
    else
    {
        $_SESSION['branchh']="Select Branch";
    }
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
        $addcontactno=$_POST['addcontactno'];
        $addcontactno2=$_POST['addcontactno2'];
        $addaddress=$_POST['addaddress'];
        $addcs=$_POST['addcs'];
        $addbranch=$_POST['addbranch'];
        $addcontactno = (int)$addcontactno;
        $addcs = (int)$addcs;
  		$addemail=$_POST['addemail'];
  		if (!filter_var($addemail, FILTER_VALIDATE_EMAIL))
  		{
  			$error = "Invalid Email ID";
  			echo "<script type='text/javascript'>alert(\"$error\");</script>";
  		}
  		else
  		{
  			$con = mysqli_connect("localhost", "root", "");
  			mysqli_select_db($con, "university");
  			if (!empty($_FILES["uploadedimage"]["name"]))
        {
  				$file_name = $_FILES["uploadedimage"]["name"];
  				$temp_name = $_FILES["uploadedimage"]["tmp_name"];
  				$imgtype = $_FILES["uploadedimage"]["type"];
  				$ext = GetImageExtension($imgtype);
  				$imagename = $enno . $ext;
  				$target_path = "images/" . $imagename;
  				if (move_uploaded_file($temp_name, $target_path)) {
  					$sql = "INSERT INTO student (Enno,FirstName,LastName,Dob,ContactNo,ContactNo2,Email,Address,CurrentSemester,Branch,ImagePath) VALUES ('$enno','$addfname','$addlname','$adddob','$addcontactno','$addcontactno2','$addemail','$addaddress','$addcs','$addbranch','$target_path')";
  					$rs = mysqli_query($con, $sql);
  					if (!empty($_POST['check_list']))
            {
  						// Loop to store and display values of individual checked checkbox.
  						foreach ($_POST['check_list'] as $selected)
              {
                $sql2 = "select Type from courses where CourseName = '$selected'";
                $rs2 = mysqli_query($con, $sql2); 
  							while($row = mysqli_fetch_array($rs2))
                {
                  $tpp = $row['Type'];
                  $sql3 = "INSERT INTO studentcourse(Enno,CourseName,Type) VALUES ('$enno','$selected','$tpp')";
  							  $rs3 = mysqli_query($con, $sql3);
  						  }
              }
  					}
  					$error = "Susscessfully registered";
  					echo "<script type='text/javascript'>alert(\"$error\");</script>";
  					echo("<script>location.href = 'http://localhost/university/dbms/STUDENT.php';</script>");
  				}
  				else
  				{
  					$error = "Please Try Again";
  					echo "<script type='text/javascript'>alert(\"$error\");</script>";
  				}
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
      <a class="nav-link text-white" href="index.php">
      <i class="fa fa-fw fa-dashboard"></i>
      <span class="nav-link-text">Dashboard</span>
      </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
      <a class="nav-link text-white" href="admindetails.php">
      <i class="fa fa-fw fa-area-chart"></i>
      <span class="nav-link-text">Admin Details</span>
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
                  <input name="uploadedimage" class="form-control" type="file"  required>
              </div>
              <div class="form-group" >
                  <label for="addemail">Email : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addemail" class="form-control" type="email" placeholder="Email" id="addemail" required>
              </div>
              <div class="form-group" >
                  <label for="addcontactno">Contact Number 1 : &nbsp;&nbsp;&nbsp;</label>
                  <input name="addcontactno" class="form-control" type="text" placeholder="Contact" id="addcontactno" required>
              </div>
               <div class="form-group" >
                  <label for="addcontactno">Contact Number 2: &nbsp;&nbsp;&nbsp;</label>
                  <input name="addcontactno2" class="form-control" type="text" placeholder="Contact" id="addcontactno2" required>
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
                  <select name="addbranch" class="form-control" type="select" id="addbranch" required>
                        <option>Select Branch</option>
                        <?php
                            $con=mysqli_connect("localhost","root","");
                            mysqli_select_db($con,"university");
                            $sql = "Select DISTINCT Branch from coursebranch";
                            $rs = mysqli_query($con, $sql);
                            if(mysqli_num_rows($rs))
                            {
                                while ($row = mysqli_fetch_array($rs))
                                {
                                    $brn = $row['Branch'];
                                    echo "<option>".$brn."</option>";
                                }
                            }
                        ?>
                  </select>
              </div>
              <div class="form-group" >
                  <label for="addcourses">Courses : &nbsp;&nbsp;&nbsp;</label>
                  </br>
                  <?php
                        $con=mysqli_connect("localhost","root","");
                        mysqli_select_db($con,"university");
                        $sql = "Select CourseName from coursebranch";
                        $rs = mysqli_query($con, $sql);
                        if(mysqli_num_rows($rs))
                        {
                            while ($row = mysqli_fetch_array($rs))
                            {
                                $Cour = $row['CourseName'] ;
                                echo '<input type="checkbox" name="check_list[]" value='.$Cour.'>'.'&nbsp;&nbsp;&nbsp;'.$Cour.'<br>';
                            }
                        }
                    ?>
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
