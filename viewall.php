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
        <title>ViewAll</title>
        <!-- Bootstrap core CSS-->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom fonts for this template-->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <!-- Page level plugin CSS-->
        <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- Custom styles for this template-->
        <link href="css/sb-admin.css" rel="stylesheet"?
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
        <ol class="breadcrumb" style = "margin-bottom: 7px;">
            <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
            <a href="STUDENT.php">Students</a>
            </li>
            <li class="breadcrumb-item active">
            ViewAll
            </li>
        </ol>
        <form action="viewall.php" method="POST">
	        <input name="namesearch" class = "namesearch" type="text" id="nameselect" placeholder="Search Name">
	        <select name="semsearch" class="semsearch" type="Select" id="semselect">
	        	<option value="">Select Semester</option>
	            <option value="1">1</option>
	            <option value="2">2</option>
	            <option value="3">3</option>
	            <option value="4">4</option>
	            <option value="5">5</option>
	            <option value="6">6</option>
	            <option value="7">7</option>
	            <option value="8">8</option>  
	        </select>
	        <select class = "branchsearch" type="Select" id="branchselect" name="branchsearch">
	        	<option value="">Select Branch</option>
	            <option value="Information Technology">Information Technology</option>
	            <option value="Electronics">Electronics</option>
	            <option value="MBA">MBA</option>	
	        </select>
	        <button class="btn btn-primary " type="submit" name="filter" style="width: 18%; margin-left: 10%; margin-bottom: 0.5%; padding: 1%;">Apply Filter</button>
    	</form>
        <div class="card mb-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Enrollment Number</th>
                                <th>Name</th>
                                <th>Date Of Birth</th>
                                <th>Contact Number</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Current Semester</th>
                                <th>Branch</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
	                        $con=mysqli_connect("localhost","root","");
	                        mysqli_select_db($con,"University");
	                        $sql = "Select * from student";
	                        $ssem="";
	                        $sname="";
	                        $sbranch="";
	                        $filter=0;
	                        if(isset($_POST['filter']))
	                        {
	                        	if(isset($_POST['namesearch']))
						            $sname=$_POST['namesearch']; 
						        
						        if(isset($_POST['branchsearch']))
						            $sbranch=$_POST['branchsearch']; 
						        
						        if(isset($_POST['semsearch']))
						            $ssem=$_POST['semsearch'];

						        $flag1=0;
		                        
		                        if($sname!="")
		                        {
		                        	$sql.=" where FirstName like '$sname%'";
		                        	$flag1=1;
		                        }
		                        $flag2=0;
		                        if($sbranch!="")
		                        {
		                        	if($flag1==1)
		                        		$sql.=" and Branch = '$sbranch'";
		                        	else
		                        		$sql.=" where Branch = '$sbranch'";
		                        	
		                        	$flag2=1;
		                        }
		                        if($ssem!="")
		                        {	
		                        	if($flag2==1 || $flag1==1)
		                        		$sql.=" and CurrentSemester = $ssem";
		                        	else
		                        		$sql.=" where CurrentSemester = '$ssem'";
		                        }
		                    }
                            $sql.=" order by CurrentSemester ASC,Enno ASC";
	                        //echo "<script>alert(\"$sql\");</script>";
	                        $rs = mysqli_query($con, $sql);
	                        while($row = mysqli_fetch_array($rs))
	                        { 
	                            echo '<tr>
	                                        <td>'.$row['Enno'].'</td>
	                                        <td>'.$row['FirstName'].' '.$row['LastName'].'</td>
	                                        <td>'.$row['Dob'].'</td>
	                                        <td>'.$row['ContactNo'].'</td>
	                                        <td>'.$row['Email'].'</td>
	                                        <td>'.$row['Address'].'</td>
	                                        <td>'.$row['CurrentSemester'].'</td>
	                                        <td>'.$row['Branch'].'</td>
	                                  </tr>';
	                        }
		                ?>
		              	</tbody>
		            </table>
		        </div>
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
