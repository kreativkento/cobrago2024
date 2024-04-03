<?php
// Check if submit button was clicked
if (isset($_POST["submit"])) {
    require_once '../connection.php';

    // Get values from textfields
    $fin_id = $_POST['fin_id'];
    $fin_pass = $_POST['fin_pass'];
    $fin_firstname = $_POST['fin_firstname'];
    $fin_lastname = $_POST['fin_lastname'];
    $fin_email = $_POST['fin_email'];

    // Prepare the SQL statement using prepared statements
    $sql = "INSERT INTO finance_account (fin_id, fin_pass, fin_firstname, fin_lastname, fin_email) 
            VALUES (?, ?, ?, ?, ?)";

    // Prepare the SQL statement for execution
    $stmt = mysqli_prepare($con, $sql);

    // Bind the parameters to the statement
    mysqli_stmt_bind_param($stmt, 'sssss', $fin_id, $fin_pass, $fin_firstname, $fin_lastname, $fin_email);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        // Display confirmation message and buttons
        echo <<<HTML
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Account Added Successfully</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: maroon;
                    margin: 0;
                    padding: 0;
                    background-image: url('../assets/background2.png');
                    background-position: center;
                    height: 1000px;
                    margin-left: 0px;
                    margin-right: 0px;
                    margin-top: -28px;
                    padding: 20px;
                }

                .sidebar {
                    width: 250px;
                    height: 100vh;
                    position: fixed;
                    left: 0;
                    top: 0;
                    background: linear-gradient(to bottom, maroon, black);
                    padding-top: 15px;
                    overflow-y: auto;
                }

                .sidebar img.logo {
                    display: block;
                    max-width: 80%;
                    margin: 0 auto 20px;
                    padding: 5px 0;
                }

                .sidebar a {
                    display: block;
                    color: white;
                    text-decoration: none;
                    padding: 15px 20px;
                    margin-bottom: 2px;
                    transition: background-color 0.3s;
                }

                .sidebar a:hover {
                    background-color: #a04000;
                }

                .student-account-button {
                    display: inline-block;
                    padding: 10px 10px;
                    background-color: maroon;
                    color: white;
                    border: none;
                    border-radius: 5px;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }

                .student-account-button:hover {
                    background-color: #a04000;
                }

                h1 {
                    margin-top: 30px;
                }

                a {
                    color: white;
                    text-decoration: none;
                    padding: 5px 15px;
                    display: inline-block;
                    margin-right: 5px;
                }

                a:hover {
                    text-decoration: underline;
                }

                .form-container {
                    width: 50%;
                    margin: 60px;
                    padding: 15px 20px 40px 20px;
                    background-color: rgba(249, 249, 249, 0.8);
                    border-radius: 20px;
                    
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
                    border-radius: 20px;
                    font-size: small;
                }

                .btn-add-new {
                    margin-left: 10px;
                }

                .btn-go-back:hover, .btn-add-new:hover {
                    background-color: darkred;
                }
            </style>
        </head>
        <body>
            <center>
                <div class="form-container">
                    <h1>Account Has Been Added Successfully</h1>
                    <a href="./finance_account.php" class="btn-go-back">Go Back to Finance Account Page</a>
                    <a href="./finance_account_add_form.html" class="btn-add-new">Add Another Account</a>
                </div>
            </center>
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
