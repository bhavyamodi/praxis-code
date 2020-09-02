<?php
include("security1.php");
include('includes/header.php'); 
include('includes/teachernav.php');

$id = $_GET['id'];

?>
<?php  
            

            if(isset($_POST['submit'])){
            
              $status = $_POST['status'];

              $insertquery = "update schedule set a_date=curdate(), a_time= now(), schedule_status = '$status' where schedule_id = $id";
              $run_query = mysqli_query($connection, $insertquery);
              if($run_query){
                ?>
                <script>
                  alert("Schedule updated");
                </script>
                <?php
              }else{
                ?>
                <script>
                  alert("Schedule  cannot be updated right now.");
                </script>
                <?php
              }
            }
?>
<div class="container-fluid col-6">
  <div class="card shadow mb-4">
  <div class="card-header py-3"> 
            <h3>
              Update Schedule  
            <button class="btn btn-outline-primary float-right"><a href="schedule.php" class="text-white">Back</a></button>
            </h3>
  </div>
<div class="card-body">
<form name="form1" method="post" action="">
                 <select name="status" class="float-center">
             	<option value="pending">Pending</option>
             	<option value="completed">Completed</option>
             </select>
             <br>
                   <input class="btn btn-primary" type="submit" name="submit" ></td>
                   
    </form>
  </div>
  </div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>