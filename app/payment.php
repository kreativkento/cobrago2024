<?php
require_once 'connection.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['track_id']) && isset($_POST['student_id'])) {
        $track_id = $_POST['track_id'];
        $student_id = $_POST['student_id'];
        $currentDateTime = date("Y-m-d H:i:s");
        $temp = "--";
        $img = "image path";

        $id = '';

        $getIdQuery = "SELECT id FROM payment_request ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con, $getIdQuery);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $id = $row['id'];
            } else {
                $id = 0;
                $firstID = "INSERT INTO payment_request (id) VALUES ($id)";
                mysqli_query($con, $firstID);
            }
        }

        // Check if $id is numeric
        if (is_numeric($id)) {
        
            // Prepare the SQL statement with placeholders
            $sql = "INSERT INTO payment_request (track_id, student_id, receipt, date_submit, valid) 
                VALUES (?, ?, ?, ?, ?)";

            // Prepare the statement
            $stmt = mysqli_prepare($con, $sql);

            if ($stmt) {
                // Bind parameters and execute the statement
                mysqli_stmt_bind_param($stmt, "sssss", $track_id, $student_id, $img, $currentDateTime, $temp);

                if (mysqli_stmt_execute($stmt)) {
                    $response['success'] = true;
                    $response['message'] = "Payment details submitted successfully";
                } else {
                    $response['success'] = false;
                    $response['message'] = "Error: " . mysqli_error($con);
                }

                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                $response['success'] = false;
                $response['message'] = "Error: " . mysqli_error($con);
            }
        } else {
            $response['success'] = false;
            $response['message'] = "Error: The value of \$id is not numeric.";
        }
    } else {
        $response['success'] = false;
        $response['message'] = "Error: Missing student_id, copies, or purpose field in the POST request.";
    }
} else {
    $response['success'] = false;
    $response['message'] = "Invalid request";
}

mysqli_close($con);

// Convert the response array to JSON
$json_response = json_encode($response);

// Send the JSON response back to the client (in this case, the Android app)
header('Content-type: application/json; charset=utf-8');
echo $json_response;
?>