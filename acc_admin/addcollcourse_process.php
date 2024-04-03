<?php

// Check if submit button was clicked
if (isset($_POST["submit"])) {
    $hostName = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "database2_group7";

    // Connect to the database
    $con = mysqli_connect($hostName, $hostUsername, $hostPassword, $hostDB);

    // Check if the connection was successful
    if (!$con) {
        die("Error in Database Connection: " . mysqli_connect_error());
    }

    // Get values from textfields
    $coursecode = mysqli_real_escape_string($con, $_POST['txtcoursecode']);
    $coursetitle = mysqli_real_escape_string($con, $_POST['txtcoursetitle']);
    $deptcode = mysqli_real_escape_string($con, $_POST['txtdeptcode']);

    // Prepare SQL statement to add a record
    $sql = "INSERT INTO college_course (course_code, course_title, dept_code) VALUES ('$coursecode', '$coursetitle', '$deptcode')";

    // Execute the insertion of the record
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if ($result) {
        echo "<html><head><title>GMC</title></head><body bgcolor='white'><br/>";
        echo "<center> <br/><br/><br/><table><tr>";
        echo "<td>New course has been successfully added</td></tr>. <tr><td>Click <a href='../course/addcollcourse_form.html'>HERE</a> to add another course or <a href='/schooldocumentsprocessing'>HERE</a> to go back to the homepage.</td></tr></table>";
    } else {
        echo "Error in SQL query: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>
