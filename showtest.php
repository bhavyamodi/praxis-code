<?php
session_start();
include("database/dbconfig.php");

if(!isset($_SESSION['stud_email'])){
  header('location:login.php');
}
include('includes/header.php'); 
include('includes/navbar.php'); 
$user=$_SESSION['stud_name'];
    $query = "select * from stud_table where stud_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    // print_r($row);
     $id = $row['inst_id'];
 $subid = $_GET['subid'];

$rs1=mysqli_query($connection,"select * from course where course_id=$subid");
$row1=mysqli_fetch_array($rs1);
echo "<h1 align=center><font color=blue> $row1[1]</font></h1>";
$rs=mysqli_query($connection,"select * from mst_test where course_id=$subid");
if(mysqli_num_rows($rs)<1)
{
	echo "<br><br><h2 class=head1> No Quiz for this Subject </h2>";
	exit;
}
echo "<h2 class=head1> Select Quiz Name to Give Quiz </h2>";
echo "<table align=center>";

while($row=mysqli_fetch_row($rs))
{
	echo "<tr><td align=center ><a href=quiz.php?testid=$row[0]&subid=$subid><font size=4>$row[2]</font></a>";
}
echo "</table>";
?>
 <?php
include('includes/scripts.php');
include('includes/footer.php');
?>
