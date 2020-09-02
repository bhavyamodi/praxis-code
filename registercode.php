<?php
session_start();
include('database/dbconfig.php');

if(isset($_POST['submit']))
{
    $username = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $inst_id = $_POST['id'];

    

    $email_query = "SELECT * FROM student WHERE student_email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        ?><script>alert('Email Already Taken. Please Try Another one.')</script>
        <?php
    }

    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO request (student_name,student_email,student_mobile,student_gender,student_address,student_password,institution_id,requested_on) VALUES ('$username','$email','$mobile','$gender','$address','$password',$inst_id, now())";
            $query_run = mysqli_query($connection, $query);
            if($query_run){
        
             $last_id = mysqli_insert_id($connection);
  $query = "SELECT * FROM request WHERE request_id= $last_id";
$run = mysqli_query($connection,$query);
$res = mysqli_fetch_array($run);
$institution_id = $res['institution_id'];


?>

                <script>alert('Your account request is now pending for approval. Please wait for confirmation. Thank you.')</script>
                <?php


            }else{
                echo "error:" .mysqli_error($connection);
            ?><script>alert("Instructor id does not exists !!")</script>
            <?php
        
            }
        }
        else 
        {
            
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            echo "<script>alert('password does not match')</script>";
        }
    }

}
?>