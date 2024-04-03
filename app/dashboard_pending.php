<?php
require_once "connection.php"; // Make sure connection.php is in the same directory

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata);

    if (isset($request->userID) && isset($request->userPass)) {
        $userID = $request->userID;
        $userPass = $request->userPass;
        
        if (!$con) {
            echo "Database connection error: " . mysqli_connect_error();
        } else {
            // Query to retrieve user data
            $query = "SELECT sa.student_id, sa.first_name, sa.last_name
                    FROM student_account sa
                    WHERE sa.student_id = ?";

if ($stmt = mysqli_prepare($con, $query)) {
    mysqli_stmt_bind_param($stmt, "s", $userID);
    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

                    if ($row = mysqli_fetch_assoc($result)) {
                        // User data found, send a success response with the user data
                        $idNumber = $row['student_id'];
                        $firstName = $row['first_name'];
                        $lastName = $row['last_name'];

                        $response = array(
                            "success" => true,
                            "student_id" => $idNumber,
                            "first_name" => $firstName,
                            "last_name" => $lastName
                        );

                        echo json_encode($response);
                    } else {
                        // User not found
                        echo json_encode(array("success" => false, "error" => "User not found"));
                    }
                } else {
                    // Execution failed
                    echo json_encode(array("success" => false, "error" => "Execution failed"));
                }

                mysqli_stmt_close($stmt);
            } else {
                // Query preparation failed
                echo json_encode(array("success" => false, "error" => "Query preparation error"));
            }

            // Close the database connection
            mysqli_close($con);
        }
    } else {
        echo json_encode(array("success" => false, "error" => "Invalid JSON data"));
    }
} else {
    echo json_encode(array("success" => false, "error" => "Invalid request method"));
}
