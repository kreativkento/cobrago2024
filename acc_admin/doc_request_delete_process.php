<?php
if(isset($_GET['id'])) {

    $hostName = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "database2_group7";

$con = mysqli_connect($hostName, $hostUsername, $hostPassword, $hostDB)or die("Error in connecting database...");

$id = $_GET['id'];

$sql = "DELETE FROM college_course WHERE course_code='$id'";

$result = mysqli_query($con, $sql)or die("Error in updating database...");

if($result) {
    echo "<center>The employee info has been deleted successfully.
           Click <a href='college_course.php'>HERE</a> to view Course Information </center>";
}
}