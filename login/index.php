<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="login-page">
  	<div class="form">
    	<form class="register-form">
      		<input type="text" placeholder="name"/>
      		<input type="password" placeholder="password"/>
      		<input type="text" placeholder="email address"/>
      		<button>create</button>
      		<p class="message">Already registered? <a href="#">Sign In</a></p>
    	</form>
    	<form class="login-form" action="process.php" method="POST">
      		<input type="text" id="username" name="user" placeholder="username"/>
      		<input type="password" id="password" name="pass" placeholder="password"/>
      		<button>login</button>
      		<p class="message">Not registered? <a href="register.php">Create an account</a></p>
    	</form>
  	</div>
</div>
</body>
</html>