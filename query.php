<?php 
include("security1.php");
include("includes/header.php");
include("includes/teachernav.php");
$id = $_GET['id'];



if(isset($_POST['coursebtn']))
{
     $response = $_POST['response'];

   
            $query = "UPDATE student_query SET teacher_response='$response' where query_id = $id ";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                
                ?>
 <script type="text/javascript">
alert("Doubt answered successfully");
location="studentquery.php";
</script>
<?php
            }
            else 
            {
                echo ("Connection failed: " . mysqli_error($connection));
               ?>
 <script type="text/javascript">
alert("Doubts cannot be answered right now!!");
</script>
<?php 
            }
        
    }
?>
  <div class="container-fluid col-6">
            <div class="card">
                  <div class="card-body">
                     <h3 class="m-2 text-white text-center">Resolve Doubts
    </h3>
<form action="" method="POST">

      

            <div class="form-group text-center">
                <label>Solution </label><br>
               <textarea name="response" placeholder="Describe your answer here..."></textarea>
            </div> 
            
            </div>
            <div class="form-group text-center">
            <button type="submit" name="coursebtn" class="btn btn-primary ">Save</button>
            </div>
      </form>
        </div>
    </div>
</div>
<?php
include('includes/footer.php');
include('includes/scripts.php');
?>