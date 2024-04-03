<?php

// Check if submit button was clicked
if (isset($_POST["submit"])) {
    require_once '../connection.php';

    // Get values from textfields
    $dept_code = mysqli_real_escape_string($con, $_POST['txtdeptcode']);
    $dept_name = mysqli_real_escape_string($con, $_POST['txtdeptname']);
    $dean_id = mysqli_real_escape_string($con, $_POST['txtdean']);

    // Prepare SQL statement to add a record
    $sql = "INSERT INTO college_department (dept_code, dept_name, dean_id) VALUES ('$dept_code', '$dept_name', '$dean_id')";

    // Execute the insertion of the record
    $result = mysqli_query($con, $sql);

    // Check if the query was successful
    if ($result) {
        echo "<html><head><title>GMC</title></head><body bgcolor='white'><br/>";
        echo "<center> <br/><br/><br/><table><tr>";
        echo "<td>New department has been successfully added</td></tr>. <tr><td>Click <a href='./college_department_add_form.php'>HERE</a> to add another department or <a href='./college_department.php'>HERE</a> to go back to records.</td></tr></table>";
    } else {
        echo "Error in SQL query: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
}
?>
