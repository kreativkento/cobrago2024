<?php
require_once 'connection.php';

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['student_id']) && isset($_POST['copies']) && isset($_POST['purpose'])) {
        $student_id = $_POST['student_id'];
        $copies = $_POST['copies'];
        $purpose = $_POST['purpose'];

        $id = '';

        $getIdQuery = "SELECT id FROM doc_request ORDER BY id DESC LIMIT 1";
        $result = mysqli_query($con, $getIdQuery);

        if ($result) {
            $row = mysqli_fetch_assoc($result);

            if ($row) {
                $id = $row['id'];
            } else {
                $id = 0;
                $firstID = "INSERT INTO doc_request (id) VALUES ($id)";
                mysqli_query($con, $firstID);
            }
        }

        // Check if $id is numeric
        if (is_numeric($id)) {
            $track_id = "GM_" . ($id + 1);
            $currentDateTime = date("Y-m-d H:i:s");
            $default_status = 1;
            $temp = "temp_path";
            $pay = "NP";

            // Prepare the SQL statement with placeholders
            $sql = "INSERT INTO doc_request (track_id, student_id, file_orf, file_id, copies, purpose, status_id, dt_request, status_pay, file_pay, auth_finance, dt_payment, auth_dean, dt_dean, auth_go, dt_go, auth_sl, dt_sl) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, null, null, null, null, null, null, null, null, null)";

            // Prepare the statement
            $stmt = mysqli_prepare($con, $sql);

            if ($stmt) {
                // Bind parameters and execute the statement
                mysqli_stmt_bind_param($stmt, "sssssisss", $track_id, $student_id, $temp, $temp, $copies, $purpose, $default_status, $currentDateTime, $pay);

                if (mysqli_stmt_execute($stmt)) {
                    $response['success'] = true;
                    $response['message'] = "Request submitted successfully";
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