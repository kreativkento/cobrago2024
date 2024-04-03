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
            background-color: white;
            margin: 0;
            padding: 0;
            background-image: url("../assets/background2.png");
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

        .add-button {
            display: inline-block;
            padding: 10px 10px;
            background-color: maroon;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-button:hover {
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
            background-color: maroon; /* Set the background color to maroon */
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
            color: black;
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

        input[type="text"], input[type="submit"] {
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
    <center>
        <h1>COLLEGE DEPARTMENTS</h1>
        <button class="add-button"><a href="./college_department_add_form.php">Add Department</a></button>
        <div class="search-box">
            <form method='post'>
                SEARCH: <input type='text' name='txtsearch' value='<?php echo (isset($txtsearch) ? $txtsearch : ""); ?>'>
                <input type='submit' name='btnsearch' value="Search">
            </form>
        </div>

        <?php
        require_once '../connection.php';

        $sql = "SELECT * FROM college_department";

        $txtsearch = '';
        if (isset($_POST['btnsearch'])) {
            $txtsearch = $_POST['txtsearch'];
            $sql .= " WHERE dept_code like '$txtsearch%' OR dept_name like '$txtsearch%' OR dean_id like '$txtsearch%' ";
        }
        $sql .= " ORDER BY dept_code, dept_name, dean_id";

        $result = mysqli_query($con, $sql) or die("Error: Please check the query statement");
        ?>

        <table>
            <thead>
                <tr>
                    <th>Department Code</th>
                    <th>Department Name</th>
                    <th>College Dean</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan=4> NO RECORDS FOUND. Please add a record into the database.</td></tr>";
                } else {
                    while ($row = mysqli_fetch_array($result)) {
                        $dept_code = $row['dept_code'];
                        $dept_name = $row['dept_name'];
                        $dean_id = $row['dean_id'];

                        echo "<tr>";
                        echo "<td>$dept_code</td>";
                        echo "<td>$dept_name</td>";
                        echo "<td>$dean_id</td>";
                    
                        echo "<td><a href='./college_department_edit_form.php?dept_code=$dept_code' class='edit-button'>EDIT</a> |
                        <a href='./college_department_delete_confirmation.php?dept_code=$dept_code' class='delete-button'>DELETE</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </center>
</body>

</html>
