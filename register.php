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
            if(isset($_REQUEST['rfirstname']))
            {
                $rfirstname = $_REQUEST['rfirstname'];
            }
            else
            {
                $rfirstname = "";
            }
            if(isset($_REQUEST['rlastname']))
            {
                $rlastname = $_REQUEST['rlastname'];
            }
            else
            {
                $rlastname = "";
            }
            if(isset($_REQUEST['rusername']))
            {
                $rusername = $_REQUEST['rusername'];
            }
            else
            {
                $rusername = "";
            }
            if(isset($_REQUEST['remail']))
            {
                $remail = $_REQUEST['remail'];
            }
            else
            {
                $remail = "";
            }
            if(isset($_REQUEST['rpassword']))
            {
                $rpassword = $_REQUEST['rpassword'];
            }
            else
            {
                $rpassword = "";
            } 
            if(isset($_REQUEST['rconfirmpassword']))
            {
                $rconfirmpassword = $_REQUEST['rconfirmpassword'];
            }
            else
            {
                $rconfirmpassword = "";
            }  
            
            if($rfirstname=="" || $rlastname=="" || $remail=="" || $rpassword=="" || $remail=="" || $rconfirmpassword=="")
            {
                  $error = "Error! some of  the required fields are empty!!";
                  echo "<script type='text/javascript'>alert(\"$error\");</script>";
                  $flag = false;
            }
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
                    //echo $row1['username'];
                    if($row1['username']==$rusername)
                    {
                        $flag1 = 1;
                        
                    }
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
                    //header('location : http://localhost/University/dbms/confirm.php');
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
                <input name="rfirstname" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter first name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputLastName">Last name</label>
                <input name="rlastname" class="form-control" id="exampleInputLastName" type="text" aria-describedby="nameHelp" placeholder="Enter last name">
              </div>
              <div class="col-md-6">
                <label for="exampleInputName">User name</label>
                <input name="rusername" class="form-control" id="exampleInputName" type="text" aria-describedby="nameHelp" placeholder="Enter Username">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input name="remail" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email" value=>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <label for="exampleInputPassword1">Password</label>
                <input name="rpassword" class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
              </div>
              <div class="col-md-6">
                <label for="exampleConfirmPassword">Confirm password</label>
                <input name="rconfirmpassword" class="form-control" id="exampleConfirmPassword" type="password" placeholder="Confirm password">
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
