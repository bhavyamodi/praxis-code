<?php
session_start();
include "../database/dbconfig.php";
$test_id=$_GET["id"];
$_SESSION["test_id"]=$test_id;

$res=mysqli_query($link,"select * from mst_test where test_id='$test_id' ");
while($row=mysqli_fetch_array($res))
{
    $_SESSION["exam_time"]=$row["time_in_minutes"];
}
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d H:i:s");
$_SESSION["end_time"]=date("Y-m-d H:i:s", strtotime($date . "+$_SESSION[exam_time] minutes"));
$_SESSION["exam_start"]="yes";
?>