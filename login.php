<?php
session_start();
include("Includes/loginConnection.php");
$error = " ";
if(isset($_POST["btnsignin"])){
	
	$username = $_POST["username"];
	$password = $_POST["password"];
//	echo($username);
//	echo($password);
	  $sql = "SELECT UserID, Username FROM users WHERE username = '$username' AND userpassword = '$password'";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        // Authentication successful, redirect to dashboard
        $row = $result->fetch_assoc();
        $_SESSION['user_id'] = $row['UserID'];
        $_SESSION['username'] = $row['Username'];
        header("Location: index.php");
        exit();
    } else {
        // Authentication failed, display error message
        $error = "Invalid username or password.";
    }
	
	
}



?>




<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> POS | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
 <?php 
	include("Includes/links.php");
	?>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>POS</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
		<span style="color: red;font-weight: bolder"><?php echo($error);  ?></span>

      <form method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="Enter username" name="username" require>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user-alt"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Enter Password" name="password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label><br>

				
            </div>
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
		  <hr/>
		   <div class="row">
          <div class="col-12" align="center">
            <button type="submit" class="btn btn-primary btn-block" name="btnsignin">Sign In</button>
			   <p class="mb-1">
        <a href="forget_password.php">I forgot my password</a>
      </p>
          </div>
          <!-- /.col -->
          
          <!-- /.col -->
        </div>
      </form>

      
      <!-- /.social-auth-links -->

     
     
    </div>
   
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
