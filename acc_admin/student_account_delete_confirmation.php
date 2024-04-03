<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMC</title>
    <style>
        body {
            background-image: url('../assets/background2.png');
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
        }

        .form-container {
            width: 30%;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 20px;
            background-color: rgba(249, 249, 249, 0.8);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .student-info {
            text-align: left;
            margin-bottom: 20px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .redirect-button {
            padding: 10px 20px;
            background-color: maroon;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            margin: 0 10px;
            text-decoration: none;
        }

        .redirect-button:hover {
            background-color: #800000;
        }
    </style>
</head>
<body>
    <?php
    require_once '../connection.php';

    // Check if the student ID is set and not empty in the URL
    if (isset($_GET['student_id']) && !empty($_GET['student_id'])) {
        $id = $_GET['student_id'];

        // Prepare and execute the SQL query to fetch student information
        $sql = "SELECT * FROM student_account WHERE student_id='$id'";
        $result = mysqli_query($con, $sql) or die("Error in querying the database...");

        // Check if a matching student record was found
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Assign retrieved values to variables
            $studentid = $row['student_id'];
            $lastname = $row['last_name'];
            $firstname = $row['first_name'];
            $middlename = $row['middle_name'];
            $coursecode = $row['course_code'];
            $yearlevel = $row['year_level'];
            $email = $row['email'];
            $phoneno = $row['phone_no'];

            // Display student information and confirmation buttons
            echo "<h1 align='center'>Delete Student Information</h1>";
            echo "<div class='container'>";
            echo "<div class='form-container'>";
            echo "<div class='student-info'>";
            echo "<label>ID:</label><span>$studentid</span><br>";
            echo "<label>Last Name:</label><span>$lastname</span><br>";
            echo "<label>First Name:</label><span>$firstname</span><br>";
            echo "<label>Middle Name:</label><span>$middlename</span><br>";
            echo "<label>Course Code:</label><span>$coursecode</span><br>";
            echo "<label>Year Level:</label><span>$yearlevel</span><br>";
            echo "<label>Email:</label><span>$email</span><br>";
            echo "<label>Phone No:</label><span>$phoneno</span><br>";
            echo "</div>";
            echo "<div class='button-container'>";
            echo "<a href='./student_account_delete_process.php?student_id=$studentid' class='redirect-button'>Yes</a>";
            echo "<a href='./student_account.php' class='redirect-button'>No</a>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        } else {
            // No matching records found
            echo "<h1 align='center'><a href='./student_account.php' class='redirect-button'>Go Back</a> &nbsp;&nbsp;&nbsp; Delete Student Information</h1>";
            echo "<div class='container'>";
            echo "<p>No matching records found.</p>";
            echo "</div>";
        }
    } else {
        // If student_id is not set in the URL
        echo "<h1 align='center'><a href='./student_account.php' class='redirect-button'>Go Back</a> &nbsp;&nbsp;&nbsp; Delete Student Information</h1>";
        echo "<div class='container'>";
        echo "<p>Student ID not provided in the URL.</p>";
        echo "</div>";
    }

    // Close the database connection
    mysqli_close($con);
    ?>
</body>
</html>
