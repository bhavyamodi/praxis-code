<?php
session_start();
include("database/dbconfig.php");

if(!isset($_SESSION['student_email'])){
  header('location:studentlogin.php');
}

?>