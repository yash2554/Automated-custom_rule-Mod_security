
<html>
<head lang="en">
    <meta charset="UTF-8">
		<link rel="icon" href="./database/logo.ico" type="image/ico" />
    <link type="text/css" rel="stylesheet" href="boot/css/bootstrap.css">
	
	
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	
    <title>Registration</title>
</head>
<style>
    .login-panel {
        margin-top: 80px;

</style>
<body>

<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
    <div class="row"><!-- row class is used for grid system in Bootstrap-->
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
            <div class="login-panel panel panel-success">
                <div class="panel-heading">
                    <h3 class="panel-title">Registration</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="registration.php">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Username" name="name" type="text" pattern="[\w\d]{5,10}" required autofocus>
                            </div>

                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" pattern="[\w\d]{5,20}\@\w+\.\w+" required autofocus>
                            </div>
							
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
                            </div>
							<div class="form-group">
                                <input class="form-control" placeholder="Repeat Password" name="pass2" type="password" value="" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>
                            </div>
				
							<div class="form-group">
                                <input class="form-control" placeholder="Security Question" name="question" type="text" pattern="[\w\d\s]+.{6,}" required autofocus>
                            </div>
							
							<div class="form-group">
                                <input class="form-control" placeholder="Answer" name="answer" type="text" pattern="[\w\d\s]+.{6,}" required autofocus>
                            </div>
								
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="register" name="register" >

                        </fieldset>
                    </form>
                    <center><b><a href="index.php" style="color:black;">Already registered ?</b></a></center><!--for centered text-->
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<?php

include("database/db_conection.php");//make connection here
if(isset($_POST['register']))
{
    $user_name=$_POST['name'];//here getting result from the post array after submitting the form.
    $user_pass=$_POST['pass'];
	$user_pass2=$_POST['pass2'];//same
    $user_email=$_POST['email'];//same
	$user_question=$_POST['question'];
	$user_answer=$_POST['answer'];

	if($user_pass2 != $user_pass)
	{
	//javascript use for input checking
        echo"<script>alert('Please enter the same password')</script>";
exit();//this use if first is not work then other will not show
    }
    
//here query check weather if user already registered so can't register again.
    $check_email_query="select * from users WHERE user_name='$user_name'";
    $run_query=$dbcon->query($check_email_query);
	
	if ($run_query->num_rows > 0)
    {
echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";
exit();
    }
//insert the user into the database.
    $insert_user="insert into users (user_name,user_pass,user_email,user_question,user_answer) VALUE ('$user_name','$user_pass','$user_email','$user_question','$user_answer')";
    if($dbcon->query($insert_user))
    {	
		echo"<script>alert('Registration Successfully')</script>";
		echo"<script>window.open('index.php','_self')</script>";
    }

}

?>