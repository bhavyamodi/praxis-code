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

    // print_r($row);
    $id = $row['stud_id'];
if($submit=='Finish')
{
	mysqli_query($connection,"delete from mst_useranswer where sess_id='" . session_id() ."'") or die(mysqli_error());
	unset($_SESSION[qn]);
	header("Location: index.php");
	exit;
}
?>
<?php
echo "<h1 class=head1> Review Test Question</h1>";

if(!isset($_SESSION[qn]))
{
		$_SESSION[qn]=0;
}
else if($submit=='Next Question' )
{
	$_SESSION[qn]=$_SESSION[qn]+1;
	
}

$rs=mysqli_query($connection,"select * from mst_useranswer where sess_id='" . session_id() ."'",$cn) or die(mysqli_error());
mysqli_data_seek($rs,$_SESSION[qn]);
$row= mysqli_fetch_row($rs);
echo "<form name=myfm method=post action=review.php>";
echo "<table width=100%> <tr> <td width=30>&nbsp;<td> <table border=0>";
$n=$_SESSION[qn]+1;
echo "<tR><td><span class=style2>Que ".  $n .": $row[2]</style>";
echo "<tr><td class=".($row[7]==1?'tans':'style8').">$row[3]";
echo "<tr><td class=".($row[7]==2?'tans':'style8').">$row[4]";
echo "<tr><td class=".($row[7]==3?'tans':'style8').">$row[5]";
echo "<tr><td class=".($row[7]==4?'tans':'style8').">$row[6]";
if($_SESSION[qn]<mysqli_num_rows($rs)-1)
echo "<tr><td><input type=submit name=submit value='Next Question'></form>";
else
echo "<tr><td><input type=submit name=submit value='Finish'></form>";
header("result.php");

echo "</table></table>";
?>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>
