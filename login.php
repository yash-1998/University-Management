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
  <title>Login</title>
  <!-- Bootstrap core CSS-->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="login.php" method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Username</label>
            <input name="user" class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Enter Username" required>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" name="pass" id="exampleInputPassword1" type="password" placeholder="Password" required>
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input name="remem" class="form-check-input" type="checkbox" > Remember Password</label>
            </div>
          </div>
          <button class="btn btn-primary btn-block">Login</button>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Register an Account</a>
          <a class="d-block small" href="forgot-password.php">Forgot Password?</a>
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


<?php
  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    
    $con=mysqli_connect("localhost","root","");
    mysqli_select_db($con,"university");

    $result = mysqli_query($con,"select * from users where username='". $username ."' and Password='". $password ."'");
    $row = mysqli_fetch_array($result);
    $count = mysqli_num_rows($result);

    if($count == 1)
    {
       $_SESSION['username'] = $username;
       $_SESSION['adminfirst'] = $row['FirstName'];
       $_SESSION['adminlast'] = $row['LastName'];
       $_SESSION['adminemail'] = $row['Email'];
       header('location: http://localhost/university/dbms/index.php');
    }
    else
    {
      $error = "Invalid Credentials";
      echo "<script type='text/javascript'>alert(\"$error\");</script>";
    }
  }
?>