<?php

session_start();
include("database/dbconfig.php");

if(!isset($_SESSION['teacher_email'])){
  header('location:login.php');
}

?>