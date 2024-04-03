<?php
//check if the submit button was clicked
if(isset($_POST['submit'])) {
    $hostName="localhost";
    $hostUsername="root";
    $hostPassword="";
    $hostDB="database2_group7";

//connect to database
    $con=mysqli_connect($hostName, $hostUsername, $hostPassword, $hostDB)or die("Error in Database connection...");

//get input from textfield
    $txtid = $_POST['txtid'];
    $txtdoctypeid = $_POST['txtdoctypeid'];
    $txtdocname = $_POST['txtdocname'];

//prepare sql statement
    $sql = "UPDATE doc_type SET doctype_id='$txtdoctypeid', doc_name='$txtdocname' WHERE doctype_id='$txtid'";

//execute sql statement
    $result = mysqli_query($con, $sql)or die("ERROR in updating database...");


    if($result) {
        echo "<center>The department has been updated successfully. Click
        <a href='doc_type.php'>HERE</a> to view record</center>";
    }
}