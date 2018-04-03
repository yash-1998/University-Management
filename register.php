<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    $flag = true;
    $rfirstname = "";
    $rlastname = "";
    $rusername = "";
    $rpassword = "";
    $reamil = "";
    $otp = 1000000;
    
    if(isset($_REQUEST['submitbtn']))
    {
      $rfirstname = $_REQUEST['rfirstname'];
      $rlastname = $_REQUEST['rlastname'];
      $rusername = $_REQUEST['rusername'];
      $remail = $_REQUEST['remail'];
      $rpassword = $_REQUEST['rpassword'];
      $rconfirmpassword = $_REQUEST['rconfirmpassword'];
            
      if($rpassword != $rconfirmpassword)
      {
            $error = "Error! Both passwords do not match";
            echo "<script type='text/javascript'>alert(\"$error\");</script>";
            $flag = false;
      }
      if($flag==true)
      {
          $_SESSION['remail']=$remail;
          $_SESSION['rfirstname']=$rfirstname;
          $_SESSION['rlastname']=$rlastname;
          $_SESSION['rpassword']=$rpassword;
          $_SESSION['rusername']=$rusername;
          $con = mysqli_connect("localhost", "root","");
          mysqli_select_db($con, "university");
          $sql1 = "select * from users;";
          $rs1 = mysqli_query($con, $sql1);
          $flag1=0;

          while($row1 = mysqli_fetch_array($rs1))
          { 
              if($row1['username']==$rusername)
                  $flag1 = 1;
          }
          if($flag1==1)
          {
              $error = "username already exists";
              echo "<script type='text/javascript'>alert(\"$error\");</script>";  
          }
          else
          {
              $otp = rand()%10000;
              $_SESSION['checkotp']=$otp;
              $_SESSION['active']=0;
              echo("<script>location.href = 'http://localhost/University/dbms/confirm.php';</script>"); 
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
  <title>Register</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <div class="card-body">
        <form action="register.php" method="POST">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputName">First name</label>
                <input name="rfirstname" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name" required>
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input name="rlastname" class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name" required>
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">User name</label>
                <input name="rusername" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter Username" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="remail" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" required>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input name="rpassword" class="form-control" id="exampleInputPassword1" type="password" placeholder="Password" required>
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input name="rconfirmpassword" class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password" required>
              </div>
            </div>
          </div>
          <button class="btn btn-primary btn-block" name="submitbtn" >Submit</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
        </div>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>

</html>
