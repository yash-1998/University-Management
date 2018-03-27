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
            <input name="remail" class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
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
          <button class="btn btn-primary btn-block" name="submitbtn">Submit</button>
        </form>
        <form action="" method="POST">
                <div class="col-md-6" id="otp">
                <label for="exampleConfirmPassword">Enter Verification Code</label>
                <input name="rotp" class="form-control" id="exampleConfirmPassword" type="number" placeholder="Verification Code">
                <button class="btn btn-primary btn-block" name="registerbtn">Register</button>
              </div>
              
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

<?php
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

            $otp = rand()%10000;
            $_SESSION['checkotp']=$otp;
            if($flag == true)
            {
                if(rmail($otp,$remail))
                {
                    $error = "Please enter the verificaiton code sent to your mail for registering";
                    echo "<script type='text/javascript'>alert(\"$error\");</script>";
                }
                else
                {
                    $error = "Invalid email";
                    echo "<script type='text/javascript'>alert(\"$error\");</script>";
                }
            }
    }

    function rmail($otp,$remail)
    {
            $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
            try {
                //Server settings                              // Enable verbose debug output
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'yashcoderiiita@gmail.com';                 // SMTP username
                $mail->Password = 'eternalblizzard1998';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('yashcoderiiita@gmail.com', 'Yash');
                $mail->addAddress($remail);     // Add a recipient
                //$mail->addAddress('ellen@example.com');               // Name is optional
                //$mail->addReplyTo('info@example.com', 'Information');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                //Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'OTP';
                $mail->Body    = 'Enter this OTP to register successfully. '.$otp;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                  return true;
            } catch (Exception $e) {
                return false;
            }
    }
    if(isset($_REQUEST['registerbtn']))
    {
        if(isset($_REQUEST['rotp']))
        {
            $enterotp = $_REQUEST['rotp'];
            
            if($enterotp != $_SESSION['checkotp'])
            {
                $error = "Wrong Verification Code";
                echo "<script type='text/javascript'>alert(\"$error\");</script>";
            }
            else
            {
                $error = "Susscessful";
                echo "<script type='text/javascript'>alert(\"$error\");</script>";
            }
        }
    }


?>