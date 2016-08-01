<?php
session_start();//session starts here
?>
<html>
<head lang="en">
<link rel="icon" href="../database/logo.ico" type="image/ico" />
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../boot/css/bootstrap.css">
	
	
  <script src="../boot/js/jquery.min.js"></script>
  <script src="../boot/js/bootstrap1.min.js"></script>
    
	
    <title>Login</title>
</head>
<style>
    .login-panel {
        margin-top: 80px;
</style>

<body>


<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title"><a href="index.php">Sign In</a></h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="index.php">
                        <fieldset>
                            <div class="form-group"  >
                                <input class="form-control" placeholder="User Name" name="username" type="text" pattern="[\w\_]+" required>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
                            </div>


                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Login" name="login" ><br/>
								
</br>
						<center>
						  <p class="lf"><!--img src="../database/logo.png" style="text-align:center;margin-bottom:0px;height:90;width:90;"/--></p>
  
						</center>
		
						</fieldset>
                    </form>
				
                </div>
				
            </div>
        </div>
    </div>
</div>
</body>

</html>
<?php

include("../database/db_conection.php");

if(isset($_POST['login']))
{
    $user_name=$_POST['username'];
    $user_pass=$_POST['pass'];
    $check_user="select * from adminuser WHERE user_name='$user_name'AND user_pass='$user_pass'";
    $run=$dbcon->query($check_user);
	if($run->num_rows > 0)
    {
      // header('Location :user.php');
	   echo "<script>window.open('admin_dashboard.php','_self')</script>";

        $_SESSION['username']=$user_name;//here session is used and value of $user_email store in $_SESSION.

    }
    else
    {
        echo "<script>alert('Error:You are not allowed to access this site!')</script>";
		
	}
}
?>