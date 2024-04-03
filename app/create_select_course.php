<?php
require_once "connection.php";

// SQL query to fetch course data
$sql = "SELECT course_code, course FROM college_course";

// Execute the SQL query
$result = mysqli_query($con, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

// Create an array to store the course data
$courses = array();

// Fetch and store course data in the array
while ($row = mysqli_fetch_assoc($result)) {
    $courses[] = $row;
}

// Close the database connection
mysqli_close($con);

// Return the course data as JSON
echo json_encode($courses);
?>
