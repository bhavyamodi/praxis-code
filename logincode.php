<?php 
session_start();
include("database/dbconfig.php");


if(isset($_REQUEST["submit"])){
	$user=$_REQUEST["inst_email"];
	$password=$_REQUEST["inst_password"];
	$select = ("select * from student where student_email='$user' && inst_password = '$password'");
	$query_run =mysqli_query($connection,$select);
	$res = mysqli_num_rows($query_run);

	$select1 = ("select * from student where student_email='$user' && teacher_password = '$password'");
	$query1_run =mysqli_query($connection,$select1);
	$res1 = mysqli_num_rows($query1_run);

	if($res == true){
		$_SESSION['inst_email']= $user;

		$email_pass = mysqli_fetch_assoc($query_run);
	    $db_pass = $email_pass['inst_password'];

	    $_SESSION['inst_name'] = $email_pass['inst_name'];
	    $_SESSION['inst_id'] = $email_pass['inst_id'];
		header("location: index.php");
	}
	elseif ($res1 == true) {
		$_SESSION['teacher_email']= $user;

		$email_pass = mysqli_fetch_assoc($query1_run);
	    $db_pass = $email_pass['teacher_password'];

	    $_SESSION['teacher_name'] = $email_pass['teacher_name'];
	    $_SESSION['teacher_id'] = $email_pass['teacher_id'];
		header("location: teacherindex.php");
	}
	else{
        $_SESSION['status'] = "Invalid Email or Password !!";
        $_SESSION['status_code'] = "error";
        ?>
         <script type="text/javascript">
        alert("Invalid email or password!");
        location="login.php?failed";
        </script>
        <?php
	}
}


 ?>