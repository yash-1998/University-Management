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
           <b style="color: gray ;"><?php echo "Welcome " . $_SESSION['username']; ?></b>
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
        <ol class="breadcrumb" style = "margin-bottom: 7px;background-color: #343a40;">
            <li class="breadcrumb-item">
            <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
            <a href="courses.php">Courses</a>
            </li>
            <li class="breadcrumb-item active text-white">
            All Courses
            </li>
        </ol>
            <br>
        <form action="cviewall.php" method="POST">
	        <input name="namesearch" class = "namesearch" type="text" id="nameselect" placeholder="Search Course">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select name="brnsearch" class="semsearch" type="Select" id="semselect">
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
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <select class = "branchsearch" type="Select" id="branchselect" name="typesearch">
                <option value="">Select Type</option>
                <option value="Theory">Theory</option>
                <option value="Lab">Lab</option>
            </select>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	        <button class="btn btn-primary " type="submit" name="filter" style="width: 18%; margin-left: 0.5%; margin-bottom: 0.5%; padding: 1%;">Apply Filter</button>
    	</form>
           <br class="card-body" >
                <div class="table-responsive" style="background-color : #ede1c7">
                    <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                        <thead>
                            <tr style="background-color : #20c997">
                                <th>SNo.</th>
                                <th>Course Name</th>
                                <th>Type</th>
                                <th>Credits</th>
                                <th>Branch</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
	                        $con=mysqli_connect("localhost","root","");
	                        mysqli_select_db($con,"university");
	                        $sql = "Select * from courses";
	                        $scourse="";
	                        $sbrn="";
	                        $stype="";
                            if(isset($_POST['filter']))
	                        {
	                        	if(isset($_POST['namesearch']))
						                    $scourse=$_POST['namesearch']; 
						        
	                        	if(isset($_POST['brnsearch']))
						                    $sbrn=$_POST['brnsearch'];
						        
	                        	if(isset($_POST['typesearch']))
						                    $stype=$_POST['typesearch'];
                                $flag1=0;

		                        if($scourse!="")
		                        {
		                        	$sql.=" where CourseName like '$scourse%'";
		                        	$flag1=1;
		                        }
		                        $flag2=0;
		                        if($stype!="")
		                        {
		                        	if($flag1==1)
		                        		$sql.=" and Type = '$stype'";
		                        	else
		                        		$sql.=" where Type = '$stype'";

		                        	$flag2=1;
		                        }
		                    }
                            $sql.=" order by CourseName,Type,Credits";
	                        $rs = mysqli_query($con, $sql);
	                        $count=1;
	                        while($row = mysqli_fetch_array($rs))
	                        {
	                            $cour=$row['CourseName'];
								$con=mysqli_connect("localhost","root","");
								mysqli_select_db($con,"university");
								$sqlc = "Select Branch from coursebranch where CourseName = '$cour'";
	                            $rsc=mysqli_query($con, $sqlc);
								$rowc = mysqli_fetch_array($rsc);
								if($sbrn=="")
                                {
                                    echo '<tr style="background-color: #eac25f">
                                            <td>'.$count.'</td>
	                                        <td>'.$row['CourseName'].'</td>
	                                        <td>'.$row['Type'].'</td>
	                                        <td>'.$row['Credits'].'</td>
	                                        <td>'.$rowc['Branch'].'</td>
	                                  </tr>';
									$count=$count+1;
								}
								else
                                {
                                    if($rowc['Branch']==$sbrn)
                                    {
										echo '<tr style="background-color: #eac25f">
                                            <td>'.$count.'</td>
	                                        <td>'.$row['CourseName'].'</td>
	                                        <td>'.$row['Type'].'</td>
	                                        <td>'.$row['Credits'].'</td>
	                                        <td>'.$rowc['Branch'].'</td>
	                                  </tr>';
										$count=$count+1;
                                    }
                                }

	                        }
		                ?>
		              	</tbody>
		            </table>
		        </div>
		    </br>
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
