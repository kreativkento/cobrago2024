<?php
function getCountStudent($criteria, $table) {
    // Include the connection file
    require_once '../connection.php';

    // Your SQL query to count records based on the criteria
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE verification = ?"; // Adjust this query based on your table and criteria

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $criteria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        return $row['count'];
    }

    return 0; // Return 0 if there's an error or no records found
}
function getCountEntries($table) {
    require_once '../connection.php';

    function getCountEntries($table) {
    global $con;

    // Your SQL query to count records in the specified table
    $sql = "SELECT COUNT(*) AS count FROM $table";

    $result = $con->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        return $row['count'];
    }

    return 0; // Return 0 if there's an error or no records found
}
}

function getAdminInfo() {
    // Include the connection file
    require_once '../connection.php';

    // Get the admin's information from the database based on the user's session
    if (isset($_SESSION['user_id'])) {
        $adminId = $_SESSION['user_id'];
        $sql = "SELECT admin_id, admin_firstname, admin_lastname FROM admin_account WHERE admin_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $adminId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            return $row;
        }
    }

    return null; // Return null if there's an error or no data found
}

?>