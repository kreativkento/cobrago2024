<?php
require_once "connection.php";

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idNumber = $_POST["idNumber"];
    $password = $_POST["password"];
    $lastname = $_POST["lastname"];
    $firstname = $_POST["firstname"];
    $middlename = $_POST["middlename"];
    $year_level = $_POST["year_level"];
    $email = $_POST["email"];
    $contact = $_POST["contact"];
    $course_code = $_POST["course_code"];
    $verification = "DENIED";

    // Insert the data into the database
    $sql = "INSERT INTO student_account (student_id, password, last_name, first_name, middle_name, year_level, email, phone_no, verification, course_code)
           VALUES ('$idNumber', '$password', UPPER('$lastname'), UPPER('$firstname'), UPPER('$middlename'), '$year_level', '$email', '$contact', '$verification', '$course_code')";

    if ($con->query($sql) === TRUE) {
        $response["Success"] = 1;
        $response["Message"] = "Record inserted successfully";
    } else {
        $response["Success"] = 0;
        $response["Message"] = "Error inserting record: " . $con->error;
    }
} else {
    $response["Success"] = 0;
    $response["Message"] = "Invalid request method";
}

// Close the connection
mysqli_close($con);

// Encode the response directly without enclosing it in an array
echo json_encode($response);
?>