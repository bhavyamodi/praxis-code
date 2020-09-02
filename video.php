<?php 
include("security1.php");
include("includes/header.php");
include("includes/teachernav.php");

$id = $_GET['id'];
$q = "SELECT * FROM teacher_video where video_id = $id";
$query = mysqli_query($connection, $q);
$row = mysqli_fetch_assoc($query);
$name = $row['video_file'];

?>
<h3>You are watching <?php echo $row['video_topic'] ?></h3>

<?php
echo '<div align="center">';
echo '<video width="auto" height="300" controls>';
echo '<source src= "files/'.$name.'" type="video/mp4">';
echo "Your browser does not support the video tag.";
echo '</video>';
echo '</div>';
?>


 <?php
include('includes/footer.php');
include('includes/scripts.php');
?>