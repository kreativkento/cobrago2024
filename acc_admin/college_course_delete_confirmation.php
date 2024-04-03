<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Course Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            background-image: url("../assets/background2.png");
            background-position: center;
        }

        h1 {
            text-align: center;
            color: #800000;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
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
    <h1>Delete College Course</h1>
    <div class="container">
        <?php
        require_once '../connection.php';
        // Get id from URL
        if (isset($_GET['course_code'])) {
            $id = $_GET['course_code'];
            $sql = "SELECT * FROM college_course WHERE course_code='$id'";
            $result = mysqli_query($con, $sql) or die("Error in updating database...");
            while ($row = mysqli_fetch_array($result)) {
                $course_code = htmlspecialchars($row['course_code']);
                $coursetitle = htmlspecialchars($row['course']);
                $deptcode = htmlspecialchars($row['dept_code']);
            }
        }
        ?>
        <p>Are you sure you want to delete the course?</p>
        <p><strong><?php echo "$deptcode ($coursetitle, $course_code)"; ?></strong></p>
        <a href='./college_course_delete_process.php?course_code=<?php echo $course_code; ?>'>Yes</a>
        <a href='./college_course.php'>No</a>
    </div>
</body>

</html>
