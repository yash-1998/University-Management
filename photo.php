<?php
session_start();
  if(isset($_POST['Submit']))
  {  

  	 $target_dir = "images/";
     $target_file = $target_dir . basename($_FILES["UploadFileName"]["name"]);
   
     echo $target_file ;
  }
?>
<html>
<style>
input[type="file"] {
    display: none;
} 
</style>
<style type="text/css"> 
  .custom-file-upload
  {
    border: 10px solid #ccc;
    display: inline-block;
    padding: 6px 12px;
    cursor: pointer;
  }
</style>
<head>
</head>
<body>
<form method="POST" action="photo.php" enctype="multipart/form-data">
    <label class="custom-file-upload">
    <input type="file" value="enter">
    </label>

    <input type = "submit" name = "Submit" value = "Press THIS to upload">
</form>
</body>
</html>