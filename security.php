<?php

session_start();
include("database/dbconfig.php");

if(!isset($_SESSION['inst_email'])){
  header('location:login.php');
}

?>