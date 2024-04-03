<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        GMC
    </title>
</head>
<body bgcolor="white">

<?php
//Prepare system to connect to database
    $hostName = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "database2_group7";

//connect to database
$con = mysqli_connect($hostName, $hostUsername, $hostPassword, $hostDB)or die("Error in connecting database...");

//get id from url
if(isset($_GET['tracking_id'])) {
    $id=$_GET['tracking_id'];

$sql = "SELECT * FROM doc_requests WHERE tracking_id='$id'";

$result = mysqli_query($con, $sql)or die("Error in updating database...");
while($row=mysqli_fetch_array($result)) {
    $trackingid=$row['tracking_id'];
    $studentid=$row['student_id'];
    $coursecode=$row['course_code'];
    $doctypeid=$row['doctype_id'];
    $statusid=$row['status_id'];
    $deanid=$row['dean_id'];
	
}
}
 ?>
 <h1 align="center"><a href="doc_request.php"> <<< Go Back</a> &nbsp;&nbsp;&nbsp; Delete Course </h1>
 <?php
 echo "<center> ARE YOU SURE YOU WANT TO DELETE IT? $tracking_id($student_id, $course_code, $doctype_id, $status_id, $dean_id)
        <a href='doc_request_delete_process.php?id=$id'> YES </a> | 
        <a href='doc_request.php'> NO </a></center>";
  ?>
</body>
</html>