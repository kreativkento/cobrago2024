<?php
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trackId = $_POST['track_id'];
    $newStatus = $_POST['new_status'];

    // Sanitize inputs to prevent SQL injection
    $trackId = mysqli_real_escape_string($con, $trackId);
    $newStatus = mysqli_real_escape_string($con, $newStatus);

    // Perform database update here
    $updateQuery = "UPDATE doc_request SET status_pay = '$newStatus' WHERE track_id = '$trackId'";
    
    if (mysqli_query($con, $updateQuery)) {
        echo 'Status updated successfully';
    } else {
        echo 'Error updating status: ' . mysqli_error($con);
    }
} else {
    echo 'Invalid request method';
}
?>
