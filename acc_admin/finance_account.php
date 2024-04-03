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

        .add-account-button {
            display: inline-block;
            padding: 10px 10px;
            background-color: maroon;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-account-button:hover {
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
        <a href="./admin_logout.html"><span>Logout</a>
    </div>
    <center>
        <h1>FINANCE OFFICE USERS</h1>
        <button class="add-account-button"><a href="./finance_account_add_form.html">Add Account</button></a>
        <div class="search-box">
            <form method='post'>
                SEARCH: <input type='text' name='txtsearch' value='<?php echo (isset($txtsearch) ? $txtsearch : ""); ?>'>
                <input type='submit' name='btnsearch' value="Search">
            </form>
        </div>

        <?php
        require_once '../connection.php';

        $sql = "SELECT * FROM finance_account";

        $txtsearch = '';
        if (isset($_POST['btnsearch'])) {
            $txtsearch = $_POST['txtsearch'];
            $sql .= "WHERE fin_id LIKE '%$txtsearch%' OR 
                    fin_firstname LIKE '%$txtsearch%' OR 
                    fin_lastname LIKE '%$txtsearch%' OR 
                    fin_email LIKE '%$txtsearch%'";
        } else {
            $sql .= "";
        }

        $sql .= " ORDER BY fin_id, fin_pass, fin_firstname, fin_lastname, fin_email";

        $result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
        ?>

        <table>
            <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Password</th>
                    <th>First Name</th>
                    <th>Last Name</th>
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
                        $fin_id = $row['fin_id'];
                        $fin_pass = $row['fin_pass'];
                        $fin_firstname = $row['fin_firstname'];
                        $fin_lastname = $row['fin_lastname'];
                        $fin_email = $row['fin_email'];
                        

                        echo "<tr>";
                        echo "<td>$fin_id</td>";
                        echo "<td>$fin_pass</td>";
                        echo "<td>$fin_firstname</td>";
                        echo "<td>$fin_lastname</td>";
                        echo "<td>$fin_email</td>";
                        echo "<td><a class='edit-button' href='finance_account_edit_form.php?fin_id=$fin_id'>EDIT</a> | 
                             <a class='delete-button' href='finance_account_delete_confirmation.php?fin_id=$fin_id'>DELETE</a></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </center>
</body>

</html>
