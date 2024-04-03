<?php
// Check if submit button was clicked
if (isset($_POST["submit"])) {
    require_once '../connection.php';

    // Get values from textfields
    $studentid = $_POST['txtstudentid'];
    $password = $_POST['txtpassword'];
    $lastname = $_POST['txtlastname'];
    $firstname = $_POST['txtfirstname'];
    $middlename = $_POST['txtmiddlename'];
    $coursecode = $_POST['txtcoursecode'];
    $yearlevel = $_POST['txtyearlevel'];
    $email = $_POST['txtemail'];
    $phoneno = $_POST['txtphoneno'];
    $verification = 'VALID';  // since Admin created, account is automatically VALID

    // Prepare the SQL statement using prepared statements
    $sql = "INSERT INTO student_account (student_id, password, last_name, first_name, middle_name, course_code, year_level, email, phone_no, verification) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement for execution
    $stmt = mysqli_prepare($con, $sql);

    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt, 'ssssssssss', $studentid, $password, $lastname, $firstname, $middlename, $coursecode, $yearlevel, $email, $phoneno, $verification);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Display confirmation message and buttons
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <title>GMC</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-image: url('../assets/background2.png'); /* Add your background image path here */
                    background-size: cover;
                    background-position: center;
                    background-repeat: no-repeat;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }

                .container {
                    text-align: center;
                    max-width: 400px;
                    padding: 20px;
                    border: 1px solid #ccc;
                    background-color: #f5f5f5;
                }

                h1 {
                    color: maroon;
                }

                .confirmation-message {
                    margin-bottom: 20px;
                }

                .btn-go-back, .btn-add-new {
                    padding: 10px 20px;
                    background-color: maroon;
                    color: white;
                    border: none;
                    cursor: pointer;
                    margin-right: 10px;
                    text-decoration: none;
                }

                .btn-add-new {
                    margin-left: 10px;
                }

                .btn-go-back:hover, .btn-add-new:hover {
                    background-color: darkred; /* Change color on hover */
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h1> Account Has Been Added Successfully</h1>
                <a href="./student_account.php" class="btn-go-back">Click Here to Go Back to Student Account Page</a>
            </div>
        </body>
        </html>
HTML;
    } else {
        // Display an error message if the query fails
        echo "Error: " . mysqli_error($con);
    }

    // Close the statement and the connection
    mysqli_stmt_close($stmt);
    mysqli_close($con);
}
?>