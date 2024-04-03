<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMC</title>
    <style>
        body {
            background-image: url('../assets/logoutbg.jpg');
            background-position: center;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            height: 1000px;
            margin-left: 0px;
            margin-right: 0px;
        }

        h1 {
            text-align: center;
            color: #800000;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 15px 20px 40px 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
            background: #FFFFFF98;
        }

        a {
            text-decoration: none;
            background-color: #800000;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin: 5px;
        }

        a:hover {
            background-color: #a04000;
        }
    </style>
</head>
<body>
    <?php
    require_once '../connection.php';

    // Check if the ID is set and not empty in the URL
    if (isset($_GET['dean_id']) && !empty($_GET['dean_id'])) {
        $id = $_GET['dean_id'];

        // Prepare and execute the SQL query to fetch account information
        $sql = "SELECT * FROM dean_account WHERE dean_id='$id'";
        $result = mysqli_query($con, $sql) or die("Error in querying the database...");

        // Check if a matching account record was found
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Assign retrieved values to variables
            $dean_id = $row['dean_id'];
            $dean_pass = $row['dean_pass'];
            $dean_firstname = $row['dean_firstname'];
            $dean_lastname = $row['dean_lastname'];
            $dean_email = $row['dean_email'];

            // Display account information and confirmation buttons
            echo "<h1>Delete Account Confirmation</h1>";
            echo "<div class='container'>";
            echo "<p>Are you sure you want to delete the account?</p>";
            echo "<p><strong>($dean_id, $dean_pass, $dean_firstname, $dean_lastname, $dean_email)</strong></p>";
            echo "<a href='./dean_account_delete_process.php?dean_id=$dean_id'>Yes</a>";
            echo "<a href='./dean_account.php'>No</a>";
            echo "</div>";
        } else {
            // No matching records found
            echo "<h1>Delete Account Confirmation</h1>";
            echo "<div class='container'>";
            echo "<p>No matching records found.</p>";
            echo "<a href='./dean_account.php'>Go Back</a>";
            echo "</div>";
        }
    } else {
        // If account id is not set in the URL
        echo "<h1>Delete Account Confirmation</h1>";
        echo "<div class='container'>";
        echo "<p>ID not provided in the URL.</p>";
        echo "<a href='./dean_account.php'>Go Back</a>";
        echo "</div>";
    }

    // Close the database connection
    mysqli_close($con);
    ?>
</body>
</html>
