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
    <h1>Delete College Department</h1>
    <div class="container">
        <?php
        require_once '../connection.php';
        // Get id from URL
        if (isset($_GET['dept_code'])) {
            $id = $_GET['dept_code'];
            $sql = "SELECT * FROM college_department WHERE dept_code='$id'";
            $result = mysqli_query($con, $sql) or die("Error in updating database...");
            while ($row = mysqli_fetch_array($result)) {
                $dept_code = htmlspecialchars($row['dept_code']);
                $dept_name = htmlspecialchars($row['dept_name']);
                $dean_id = htmlspecialchars($row['dean_id']);
            }
        }
        ?>
        <p>Are you sure you want to delete the course?</p>
        <p><strong><?php echo "$deptcode ($dept_name, $dean_id)"; ?></strong></p>
        <a href='./college_department_delete_process.php?dept_code=<?php echo $dept_code; ?>'>Yes</a>
        <a href='./college_department.php'>No</a>
    </div>
</body>

</html>
