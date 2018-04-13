<?php
    session_start();
    if(isset($_POST['change']))
    {
        if(isset($_POST['first']))
            $ffirst=$_POST['first']; 
        else   
            $ffirst="";

        if(isset($_POST['roll']))
            $froll=$_POST['roll']; 
        else   
           $froll="";

        if(isset($_POST['last']))
            $flast=$_POST['last']; 
        else   
            $flast="";
        
        if(isset($_POST['mail']))
            $fmail=$_POST['mail']; 
        else   
            $fmail="";
        
        if(isset($_POST['number']))
           $fnumber=$_POST['number']; 
        else   
           $fnumber="" ;  

        if(isset($_POST['address']))
            $faddress=$_POST['address']; 
        else   
            $faddress="";

        if(isset($_POST['branch']))
            $fbranch=$_POST['branch']; 
        else   
            $fbranch="";
        
        if(isset($_POST['sem']))
            $fsem=$_POST['sem']; 
        else   
            $fsem="";  
        
        if($ffirst=="" || $flast=="" || $froll=="" || $faddress=="" || $fmail=="" || $fnumber=="" || $fbranch=="" || $fsem=="")
        {
            $error = "Error! some of  the required fields are empty!!";
            echo "<script type='text/javascript'>alert(\"$error\");</script>";
        }
        else
        { 
            $fsem = (int)$fsem;
            $fnumber = (int)$fnumber;
            echo $fsem;
            $con = mysqli_connect("localhost", "root","");
            mysqli_select_db($con, "university");
            $sql = "DELETE FROM student WHERE Enno = '$froll'";
            $rs1 = mysqli_query($con, $sql);

            $sql1 = "INSERT INTO student (Enno,FirstName,LastName,CurrentSemester,Email,Address,Branch,ContactNo) VALUES ('$froll','$ffirst','$flast','$fsem','$fmail','$faddress','$fbranch','$fnumber')";
            $rs2 = mysqli_query($con, $sql1);
            $delsql = "DELETE FROM studentcourse where Enno = '$froll'";
			$delrs = mysqli_query($con, $delsql);
			if(!empty($_POST['check_list']))
			{
				// Loop to store and display values of individual checked checkbox.
				foreach($_POST['check_list'] as $selected)
				{
					$sql = "INSERT INTO studentcourse(Enno,CourseName) VALUES ('$froll','$selected')";
					$rs = mysqli_query($con, $sql);
				}
			}
            $error = "Susscessfully Modified";
            $_SESSION['fname']=$ffirst;
            $_SESSION['lname']=$flast;
            $_SESSION['email']=$fmail;
            $_SESSION['contact']=$fnumber;
            $_SESSION['address']=$faddress;
            $_SESSION['branch']=$fbranch;    
            $_SESSION['sem']=$fsem;
            echo "<script type='text/javascript'>alert(\"$error\");</script>";
            echo("<script>location.href = 'http://localhost/university/dbms/findedit.php';</script>");
       }   
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
            <li class="breadcrumb-item"><a href="STUDENT.php">Student</a></li>
            <li class="breadcrumb-item"><a href="findedit.php"><?php echo $_SESSION['roll']?></a>
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
      <form action="edit_student.php" method="POST">
          <div style="align-content: center;">
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;
              <img src="<?php echo $_SESSION['imagepath']?>" style="width:150px;height:150px;">
          </div>
         <div class="form-group">
            <label >Enrollment Number : &nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['roll']?> name="roll" readonly>
        </div>
          <div class="form-group" >
          <label >First Name : &nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['fname']?> name="first" >
        </div>
        <div class="form-group">
          <label >Last Name : &nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['lname']?> name="last" >
        </div>

        <div class="form-group">
          <label >Email : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="email" value=<?php echo $_SESSION['email']?> name="mail" >
        </div>
        <div class="form-group">
          <label >Contact Number : &nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['contact']?> name="number" >
        </div>
        <div class="form-group">
          <label >Address : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['address']?> name="address" >
        </div>
        <div class="form-group">
          <label >Semester : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['sem']?>  name="sem">
        </div>
       <div class="form-group">
          <label >Branch : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <input class="form-control" type="text" value=<?php echo $_SESSION['branch']?>  name="branch">
        </div>
          <div class="form-group">
              <label for="addcourses">Courses : &nbsp;&nbsp;&nbsp;</label>
              </br>
			  <?php
			  $con=mysqli_connect("localhost","root","");
			  mysqli_select_db($con,"university");
			  $enno = $_SESSION['roll'];
			  $sql = "Select CourseName from studentcourse where Enno='$enno'";
			  $sql2 = "Select CourseName from courses";
			  $rs2=mysqli_query($con,$sql2);
			  while ($row2 = mysqli_fetch_array($rs2))
              {
                  $allcourse = $row2['CourseName'];
                  $rs = mysqli_query($con, $sql);
                  $flago=0;
                  while ($row = mysqli_fetch_array($rs))
				  {
					  $studcour = $row['CourseName'];
					  if($studcour==$allcourse)
                      {
                          $flago=1;
                      }
				  }
				  if($flago==1)
                  {
					  echo '<input type="checkbox" name="check_list[]" value='.$allcourse.' checked>'.'&nbsp;&nbsp;&nbsp;'.$allcourse.'<br>';
				  }
				  else
                  {
					  echo '<input type="checkbox" name="check_list[]" value='.$allcourse.'>'.'&nbsp;&nbsp;&nbsp;'.$allcourse.'<br>';
                  }
			  }
			  ?>
          </div>
        <div class="input-group">
        <button  class="btn btn-primary" type="submit" style="background: green;" name="change" >Make Changes</button>
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
