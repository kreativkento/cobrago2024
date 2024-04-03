<?php
// Include your database connection file
require_once '../connection.php';

// Check if track_id and new_valid are set
if (isset($_POST['track_id']) && isset($_POST['new_valid'])) {
    $trackId = $_POST['track_id'];
    $newValid = $_POST['new_valid'];

    // Update the 'valid' field in the database
    $updateSql = "UPDATE payment_request SET valid = '$newValid' WHERE track_id = '$trackId'";

    if (mysqli_query($con, $updateSql)) {
        // Update successful
        echo "Update successful!";
    } else {
        // Update failed
        echo "Error updating record: " . mysqli_error($con);
    }
} else {
    // If track_id or new_valid is not set
    echo "Invalid parameters";
}

// Close the database connection
mysqli_close($con);
?>
