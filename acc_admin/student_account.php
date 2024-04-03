<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOOD MORAL CERTIFICATE DOCUMENT PROCESSING</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            justify-content: center;
            align-items: center;
            background-color: maroon;
            margin: 0;
            padding: 0;
            background-image: url('../assets/background2.png');
            background-position: center;
            height: 1000px;
            margin-left: 220px;
            margin-right: -40px;
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

        .edit-button,
        .delete-button {
            display: inline-block;
            padding: 5px 10px;
            margin: 2px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            background-color: maroon;
            color: white;
            text-decoration: none;
        }

        .edit-button:hover,
        .delete-button:hover {
            background-color: #a04000;
            text-decoration: none;
        }

        h1 {
            margin-top: 75px;
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

        table {
            width: 85%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #a04000;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #800000;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .search-box {
            text-align: center;
            margin: 20px;
        }

        input[type="text"],
        input[type="submit"] {
            padding: 10px;
            margin: 5px;
            border: 1px solid #aaa;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #800000;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #a04000;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <img src='../assets/logo1.png' alt='../assets/logo1.png' class="logo">
        <a href="./admin_dashboard.php">Dashboard</a>
        <a href="./college_course.php">College Courses</a>
        <a href="./college_department.php">College Departments</a>
        <a href="./student_account_applications.php">Accounts Approval</a>
        <a href="./student_account.php">Student Accounts</a>
        <a href="./doc_request.php">Document Requests</a>
        <a href="./admin_account.php">Administrators</a>
        <a href="./dean_account.php">College Deans</a>
        <a href="./guidance_account.php">Guidance Office</a>
        <a href="./finance_account.php">Finance Office</a>
        <a href="./sl_account.php">Student Life</a>
        <a href="./admin_logout.html"><span>Logout</span></a>
    </div>
    <div class="container">
        <center>
            <h1>VALIDATED STUDENT ACCOUNTS</h1>
            <button class="student-account-button"><a href="./student_add_form.php">Add Student</a></button>
            <div class="search-box">
                <form method='post'>
                    SEARCH: <input type='text' name='txtsearch' value='<?php echo (isset($txtsearch) ? $txtsearch : ""); ?>'>
                    <input type='submit' name='btnsearch' value="Search">
                </form>
            </div>

            <?php
            require_once '../connection.php';

            $sql = "SELECT sa.*, cc.course AS course_name FROM student_account sa
                    LEFT JOIN college_course cc ON sa.course_code = cc.course_code
                    WHERE sa.verification = 'VALID'";

            $txtsearch = '';

            if (isset($_POST['btnsearch'])) {
                $txtsearch = $_POST['txtsearch'];
                $sql .= " AND 
                        (sa.student_id LIKE '%$txtsearch%' OR 
                        sa.last_name LIKE '%$txtsearch%' OR 
                        sa.first_name LIKE '%$txtsearch%' OR 
                        sa.middle_name LIKE '%$txtsearch%' OR 
                        sa.course_code LIKE '%$txtsearch%' OR 
                        sa.year_level LIKE '%$txtsearch%' OR 
                        sa.email LIKE '%$txtsearch%' OR 
                        sa.phone_no LIKE '%$txtsearch%')";
            }

            $sql .= " ORDER BY sa.student_id, sa.last_name, sa.first_name, sa.middle_name, sa.course_code, cc.course, sa.year_level, sa.phone_no, sa.email, sa.verification";

            $result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
            ?>

            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Surname</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Course Code</th>
                        <th>Course</th>
                        <th>Year Level</th>
                        <th>Mobile No.</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) == 0) {
                        echo "<tr><td colspan=9> NO RECORDS FOUND. Please add a record into the database.</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_array($result)) {
                            $studentid = $row['student_id'];
                            $lastname = $row['last_name'];
                            $firstname = $row['first_name'];
                            $middlename = $row['middle_name'];
                            $coursecode = $row['course_code'];
                            $course = $row['course_name']; // Changed to course_name
                            $yearlevel = $row['year_level'];
                            $phone = $row['phone_no'];
                            $email = $row['email'];

                            echo "<tr>";
                            echo "<td>$studentid</td>";
                            echo "<td>$lastname</td>";
                            echo "<td>$firstname</td>";
                            echo "<td>$middlename</td>";
                            echo "<td>$coursecode</td>";
                            echo "<td>$course</td>";
                            echo "<td>$yearlevel</td>";
                            echo "<td>$phone</td>";
                            echo "<td>$email</td>";
                            echo "<td><a class='edit-button' href='./student_account_edit_form.php?student_id=$studentid'>EDIT</a> | 
                                <a class='delete-button' href='./student_account_delete_confirmation.php?student_id=$studentid'>DELETE</a></td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </center>
    </div>
</body>

</html>
