<?php
session_start();
extract($_POST);
extract($_SESSION);

error_reporting(1);
include("database/dbconfig.php");

include('includes/header.php'); 
include('includes/navbar.php'); 
$user=$_SESSION['stud_name'];
    $query = "select * from stud_table where stud_name = '$user' ";
    $run_query = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($run_query);
    $id = $row["stud_id"];

extract($_SESSION);
$rs=mysqli_query($connection,"select t.test_name,t.total_que,r.test_date,r.score from mst_test t, mst_result r where
t.test_id=r.test_id and r.stud_id='$id'",$cn) or die(mysqli_error());

echo "<h1 class=head1> Result </h1>";
if(mysqli_num_rows($rs)<1)
{
	echo "<br><br><h1 class=head1> You have not given any quiz</h1>";
	exit;
}
echo "<table border=1 align=center><tr class=style2><td width=300>Test Name <td> Total<br> Question <td> Score";
while($row=mysqli_fetch_row($rs))
{
echo "<tr class=style8><td>$row[0] <td align=center> $row[1] <td align=center> $row[3]";
}
echo "</table>";
?>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
