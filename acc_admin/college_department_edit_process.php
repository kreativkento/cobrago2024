<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("../assets/background2.png"); /* Add your background image URL here */
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: baseline;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            margin-top: 60px;
            background-color: rgba(249, 249, 249, 0.8); /* Semi-transparent background */
            padding: 10px 20px 40px 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 20px; /* Increase border radius for a rounded look */
            text-align: center;
            width: 600px;
        }

        h1 {
            color: #800000;
        }

        p {
            margin-bottom: 20px; /* Add space between the message and the button */
        }

        a {
            text-decoration: none;
            background-color: #800000;
            color: white;
            padding: 10px 20px;
            border-radius: 20px; /* Match the border radius with the container */
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #a04000;
        }
    </style>
</head>

<body>
    <?php
    require_once '../connection.php';

    if (isset($_POST['submit'])) {
        $deptcode = mysqli_real_escape_string($con, $_POST['txtdeptcode']);
        $deptname = mysqli_real_escape_string($con, $_POST['txtdeptname']);
        $deanid = mysqli_real_escape_string($con, $_POST['txtdean']);
        $id = mysqli_real_escape_string($con, $_POST['txtid']);

        // Add WHERE clause to specify the record to update
        $updateDeptQuery = "UPDATE college_department SET dept_code = '$deptcode', dept_name = '$deptname', dean_id = '$deanid' WHERE dept_code = '$id'";
        $resultDept = mysqli_query($con, $updateDeptQuery);

        if ($resultDept) {
            echo "<div class='container'>";
            echo "<h1>Update Successful!</h1>";
            echo "<p>The department has been updated successfully.</p>";
            echo "<a href='./college_department.php'>Go Back to View Record</a>";
            echo "</div>";
            exit();
        } else {
            echo "Error updating department: " . mysqli_error($con);
        }
    } else {
        echo "Invalid request.";
    }
    ?>
    <div class="container">
        <h1>Update Successful!</h1>
        <p>The department has been updated successfully.</p>
        <a href="./college_department.php">Go Back to View Record</a>
    </div>
</body>

</html>
