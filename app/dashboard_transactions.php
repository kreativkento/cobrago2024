<?php
require_once 'connection.php';

// Get the user's idNumber from the request (you can pass it in your URL)
$idNumber = $_GET['idNumber'];

// SQL query to retrieve data from the requests table for a specific user
$sql = "SELECT track_id, status_id, DATE_FORMAT(dt_request, '%Y-%m-%d') AS request_date FROM doc_request WHERE student_id = '$idNumber'";
$result = $con->query($sql);

$requestDataList = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Create an associative array for each row
        $requestData = array(
            "trackId" => $row["track_id"],
            "statusId" => $row["status_id"],
            "requestDate" => $row["request_date"],
        );

        // Fetch additional data from the status_update table using the status_id
        $status_id = $row["status_id"];
        $statusSql = "SELECT status_name, status_color FROM status_update WHERE status_id = $status_id";
        $statusResult = $con->query($statusSql);

        if ($statusResult->num_rows > 0) {
            $statusRow = $statusResult->fetch_assoc();
            $requestData["statusName"] = $statusRow["status_name"];
            $requestData["statusColor"] = $statusRow["status_color"];
        }

        // Add this array to the requestDataList
        $requestDataList[] = $requestData;
    }
}

// Close the database connection
$con->close();

// Return the JSON representation of requestDataList
echo json_encode($requestDataList);
?>