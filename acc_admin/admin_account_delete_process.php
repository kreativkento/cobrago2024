<?php
if (isset($_GET['admin_id'])) {
    require_once '../connection.php';

    $id = $_GET['admin_id'];

    $sql = "DELETE FROM admin_account WHERE admin_id='$id'";

    $result = mysqli_query($con, $sql) or die("Error in deleting the account...");

    if ($result) {
        echo <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Deleted Successfully</title>
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
            margin right: 5px;
        }

        a:hover {
            text-decoration: underline;
        }

        .confirmation-message {
            width: 50%;
            margin: 60px;
            padding:  10px 20px 40px 20px;
            background-color: rgba(249, 249, 249, 0.8);
            border-radius: 20px;
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
        <div class="confirmation-message">
            <h1>Account Has Been Deleted Successfully</h1>
            <a href="./admin_account.php" class="btn-go-back">Go Back to Admin Account Page</a>
        </div>
    </center>
</body>
</html>
HTML;
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Invalid request.";
}
?>
