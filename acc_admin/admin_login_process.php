<?php
session_start();

// Include the connection file
require_once '../connection.php';

// Check the connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $account_id = $_POST['account_id'];
    $password = $_POST['password'];

    // Your SQL query to check if the user exists
    $sql = "SELECT * FROM admin_account WHERE admin_id = ? LIMIT 1";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $account_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        // Verify the password as plain text
        if ($password === $row['admin_pass']) { // Compare plain text passwords
            // Password matches, login successful
            $_SESSION['user_id'] = $row['admin_id'];
            header("Location: ./admin_dashboard.php");
            exit();
        } else {
            // Password doesn't match
            echo 'Password is incorrect.';
        }
    } else {
        // Account doesn't exist
        echo 'Account not found.';
    }

    // Close the statement and database connection
    $stmt->close();
} else {
    // Handle invalid request
    echo 'Invalid request.';
}

// Close the database connection
$con->close();
?>