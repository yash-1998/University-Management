<?php
    session_start();
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
    if($_SESSION['active']==0)
    {
        if(rmail($_SESSION['checkotp'],$_SESSION['remail']))
        {
            $error = "Enter the verification code";
            $_SESSION['active']=1;
            echo "<script type='text/javascript'>alert(\"$error\");</script>";
        }
        else
        {
            $error = "Try Again";
            echo "<script type='text/javascript'>alert(\"$error\");</script>";
        //    header('location : http://localhost/university/dbms/confirm.php');
           echo("<script>location.href = 'http://localhost/university/dbms/register.php';</script>");
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
                $con = mysqli_connect("localhost", "root","");
                mysqli_select_db($con, "university");
                $sql = "insert into users(username,FirstName,LastName,Password,Email)values('".$_SESSION['rusername']."','".$_SESSION['rfirstname']."','".$_SESSION['rlastname']."','".$_SESSION['rpassword']."','".$_SESSION['remail']."');";
                $rs = mysqli_query($con, $sql);
              //  echo $_SESSION['rusername']." ".$_SESSION['rfirstname']." ".$_SESSION['rlastname'];
                $error = "Susscessfully registered";
                echo "<script type='text/javascript'>alert(\"$error\");</script>";
               // header('location : http://localhost/university/dbms/login.php');
                echo("<script>location.href = 'http://localhost/university/dbms/login.php';</script>");
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
      <div class="card-header">Confirm your registration</div>
      <div class="card-body">
        <form action="confirm.php" method="POST">
          <div class="form-group">
            <div class="form-row">
                <div class="col-md-6" id="otp" style="margin: auto;">
                <label for="exampleConfirmPassword">Enter Verification Code</label>
                </br>
                <input name="rotp" class="form-control" id="exampleConfirmPassword" type="text" placeholder="Verification Code">
                </br>   
                <button class="btn btn-primary btn-block" name="registerbtn">Register</button>
                </div>
            </div>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.php">Login Page</a>
        </div>
      </div>
    </div>
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

