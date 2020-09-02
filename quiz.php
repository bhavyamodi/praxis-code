<?php
session_start();
include("database/dbconfig.php");
 include('includes/header.php');
 include('includes/studnav.php');

$test_bank_id = $_POST['id'];

$query = mysqli_query($connection , "SELECT * FROM mst_test where test_bank_id= $test_bank_id");
$row=mysqli_fetch_array($query);
$id = $row['test_id'];
$time = $row['time_in_minutes'];
$_SESSION["test_id"] = $row['test_id'];

$query1 = mysqli_query($connection , "SELECT * FROM mst_question where test_id= $id");
$row1 = mysqli_fetch_array($query1);
?> 

<div class="row">
  <div class="col-8">
      <div class="container-fluid">
        
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Online Quiz :
                    </h4>

                    <p class="card-description">
                    </p>
                    <div class="table-responsive">

                      <form method="post" action="answer.php">
                        <?php $count= 1 ; ?>
                        <?php foreach ($query1 as $key) {
                           ?>
                      <table class="table">
                        <thead>
                          <tr class="danger">
                            <th class="text-white">Question.<?php echo $count ?>&emsp;<?php echo wordwrap($key['question'],75,"<br>\n"); ?></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php if (isset($key['option_1'])) { ?>
                            <tr>
                                <td>1.   &nbsp;<input type="radio" value="1" name="<?php echo $key['question_id']; ?>" > &emsp; <?php echo wordwrap($key['option_1'],90,"<br>\n"); ?> </td>
                            </tr>
                            <?php } ?>
                            <?php if (isset($key['option_2'])) { ?>
                            <tr>
                                <td>2.   &nbsp;<input type="radio" value="2" name="<?php echo $key['question_id']; ?>"> &emsp; <?php echo wordwrap($key['option_2'],90,"<br>\n"); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if (isset($key['option_3'])) { ?>
                            <tr>
                                <td>3.   &nbsp;<input type="radio" value="3" name="<?php echo $key['question_id']; ?>"> &emsp; <?php echo wordwrap($key['option_3'],90,"<br>\n"); ?></td>
                            </tr>
                            <?php } ?>
                            <?php if (isset($key['option_4'])) { ?>
                            <tr>
                                <td>4.   &nbsp;<input type="radio" value="4" name="<?php echo $key['question_id']; ?>"> &emsp; <?php echo wordwrap($key['option_4'],90,"<br>\n"); ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <td><input type="radio" value="0" checked="checked" style="display:none;" name="<?php echo $key['question_id']; ?>"></td>
                            </tr>
                 <?php
                 $count = $count +1 ;
              }          ?>
                        </tbody>

                      </table>
                      <center><input type="submit" value="Submit" class="btn btn-success" name="submit"></center>

                    </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  <div class="col-4">

    <div class="container-fluid">
        
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Timer :
                      <button id="countdown" class="timer btn btn-outline-danger float-right"></button>
                    </h4>                
<div id="btnContainer">
  <button class="btn btn-outline-info" onclick="listView()"><i class="fa fa-bars"></i> List</button> 
  <button class="btn btn-outline-success active" onclick="gridView()"><i class="fa fa-th-large"></i> Grid</button>
</div>
<br>

<div class="row">
   <?php $count= 1 ; ?>
  <?php foreach ($query1 as $key) {
  ?>
  <div class="column">
    <button class="btn btn-outline-primary"><?php echo $count ?></button>
  </div>
<?php
$count ++;
 } ?>
 
</div>


</div>
</div>
</div>

<script>
// Get the elements with class="column"
var elements = document.getElementsByClassName("column");

// Declare a loop variable
var i;

// List View
function listView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "50%";
  }
}

// Grid View
function gridView() {
  for (i = 0; i < elements.length; i++) {
    elements[i].style.width = "20%";
  }
}

/* Optional: Add active class to the current button (highlight it) */
var container = document.getElementById("btnContainer");
var btns = container.getElementsByClassName("btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}
</script>
<script>
var seconds = <?php echo $time ?>;
    function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds; 
    }
    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "Buzz Buzz";
    } else {    
        seconds--;
    }
    }
var countdownTimer = setInterval('secondPassed()', 1000);
</script>
</div>
</div>
<?php
include('includes/scripts.php');
include('includes/footer.php');
?>