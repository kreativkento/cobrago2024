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
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 500px;
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent background */
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
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
            border-radius: 5px;
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
        $course_code = mysqli_real_escape_string($con, $_POST['txtcoursecode']);
        $course_name = mysqli_real_escape_string($con, $_POST['txtcourse']);
        $dept_code = mysqli_real_escape_string($con, $_POST['txtdeptcode']);

        $updateCourseQuery = "UPDATE college_course SET course_code = '$course_code', course = '$course_name', dept_code = '$dept_code' WHERE course_code = '$course_code'";
        $resultCourse = mysqli_query($con, $updateCourseQuery);

        if ($resultCourse) {
            echo "<div class='container'>";
            echo "<h1>Update Successful!</h1>";
            echo "<p>The course has been updated successfully.</p>";
            echo "<a href='./college_course.php'>Go Back to View Record</a>";
            echo "</div>";
            exit();
        } else {
            echo "Error updating record: " . mysqli_error($con);
        }
    } else {
        echo "Invalid request.";
    }
    ?>
</body>

</html>
