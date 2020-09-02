<?php
//include connection file 
include_once("database/dbconfig.php");
include_once('libs/fpdf.php');
$id = $_GET['id'];
$sql1 = "SELECT * FROM subject WHERE subject_id = $id";
$data1 = mysqli_query($connection, $sql1);
$row1 = mysqli_fetch_array($data1);
$subject_name = $row1['subject_name'];

$sql = "SELECT * FROM syllabus WHERE subject_id = $id";
$data = mysqli_query($connection, $sql);
$row = mysqli_fetch_array($data);
$name = $row['topic_name'];


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont("Arial","B",16);
$pdf->setTextColor(252,3,3);
  $pdf->Cell(200,20,"Syllabus of '$subject_name'","0","1","C");
//table column
$pdf->setLeftMArgin(30);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(20,10,"No","1","0","C");
$pdf->Cell(130,10,"Topic Name","1","1","C");
$pdf->SetFont("Arial","",14);

//table rows
if(isset($_GET['id'])){
$query = "SELECT * FROM syllabus WHERE subject_id = $id";
$run_query =  mysqli_query($connection, $query);
$check_course = mysqli_num_rows($run_query);
    if($check_course !=0){
      $count = 1;
      while($row = mysqli_fetch_array($run_query)){
        
        $pdf->Cell(20,10, $count ,"1","0","C");
        $pdf->Cell(130,10,$row['topic_name'],"1","1","C");

        $count = $count+1;
      }
    }
    else{
       ?>
 <script type="text/javascript">
alert("No syllabus found.");
location="studentsyllabus.php";
</script>
<?php
}
    } 
    
$pdf->Output();
?>