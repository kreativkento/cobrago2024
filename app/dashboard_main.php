<?php
require_once "connection.php"; // Make sure connection.php is in the same directory

header("Content-Type: application/json"); // Set JSON response header

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postdata = file_get_contents("php://input");
    $request = json_decode($postdata, true); // Decode as an associative array

    if (isset($request['userID']) && isset($request['userPass'])) {
        $userID = $request['userID'];
        $userPass = $request['userPass'];

        if (!$con) {
            echo json_encode(array("success" => false, "error" => "Database connection error: " . mysqli_connect_error()));
        } else {
            // Query to retrieve user data from the student_account table
            $userQuery = "SELECT student_id, first_name, middle_name, last_name, email, phone_no, course_code, year_level
                FROM student_account
                WHERE student_id = ?";

            if ($stmt = mysqli_prepare($con, $userQuery)) {
                mysqli_stmt_bind_param($stmt, "s", $userID);
                if (mysqli_stmt_execute($stmt)) {
                    $userResult = mysqli_stmt_get_result($stmt);

                    if ($userRow = mysqli_fetch_assoc($userResult)) {
                        // User data found
                        $idNumber = $userRow['student_id'];
                        $firstName = $userRow['first_name'];
                        $middleName = $userRow['middle_name'];
                        $lastName = $userRow['last_name'];
                        $email = $userRow['email'];
                        $phone_no = $userRow['phone_no'];
                        $course_code = $userRow['course_code'];
                        $year_level = $userRow['year_level'];
                    }
                }
                mysqli_stmt_close($stmt);
            }

            // Query to retrieve course information
            $courseQuery = "SELECT course, dept_code
                FROM college_course
                WHERE course_code = ?";

            if ($courseStmt = mysqli_prepare($con, $courseQuery)) {
                mysqli_stmt_bind_param($courseStmt, "s", $course_code);
                if (mysqli_stmt_execute($courseStmt)) {
                    $courseResult = mysqli_stmt_get_result($courseStmt);

                    if ($courseRow = mysqli_fetch_assoc($courseResult)) {
                        $course = $courseRow['course'];
                        $dept_code = $courseRow['dept_code'];
                    } else {
                        $course = ""; // Set to an empty string if the course is not found
                        $dept_code = "";
                    }
                }
                mysqli_stmt_close($courseStmt);
            }

            // Check if dept_code is not empty before querying the department
            if (!empty($dept_code)) {
                // Query to retrieve department information
                $deptQuery = "SELECT dept_name FROM college_department WHERE dept_code = ?";

                if ($deptStmt = mysqli_prepare($con, $deptQuery)) {
                    mysqli_stmt_bind_param($deptStmt, "s", $dept_code);
                    if (mysqli_stmt_execute($deptStmt)) {
                        $deptResult = mysqli_stmt_get_result($deptStmt);

                        if ($deptRow = mysqli_fetch_assoc($deptResult)) {
                            $department = $deptRow['dept_name'];
                        } else {
                            $department = ""; // Set to an empty string if the department is not found
                        }
                    }
                    mysqli_stmt_close($deptStmt);
                } else {
                    $department = ""; // Set to an empty string if query preparation fails
                }
            } else {
                $department = ""; // Set to an empty string if dept_code is empty
            }

            if (isset($idNumber, $firstName, $middleName, $lastName, $email, $phone_no, $course_code, $year_level, $course, $department)) {
                // Send a success response with the user data
                $response = array(
                    "success" => true,
                    "student_id" => $idNumber,
                    "first_name" => $firstName,
                    "middle_name" => $middleName,
                    "last_name" => $lastName,
                    "email" => $email,
                    "phone_no" => $phone_no,
                    "course_code" => $course_code,
                    "year_level" => $year_level,
                    "course" => $course,
                    "department" => $department
                );

                echo json_encode($response);
            } else {
                // User not found or other errors
                echo json_encode(array("success" => false, "error" => "User not found or other errors"));
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
?>
