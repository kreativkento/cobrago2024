<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GMC REQUESTOR SYSTEM</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            justify-content: center;
            align-items: center;
            background-color: white;
            margin: 0;
            padding: 0;

            background-image: url("reqbackground.png");
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
            /* Apply a gradient from maroon to black */
            padding-top: 15px;
            overflow-y: auto;
        }
        
        .sidebar img.logo {
            display: block;
            max-width: 80%;
            /* Adjust this to your desired size */
            margin: 0 auto 20px;
            /* Centering and spacing below the logo */
            padding: 5px 0;
            /* Padding around the logo */
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
            /* Slightly lighter shade for hover effect */
        }

        .add-course-button {
            display: inline-block;
            padding: 10px 10px;
            background-color: maroon;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .add-course-button:hover {
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
        <a href="./admin_dashboard.html">Dashboard</a>
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
        <h4>
            
        </h4>
        <h1>DOCUMENT REQUEST</h1>

        <div class="search-box">
            <form method='post'>
                SEARCH: 
                <input type='text' name='txtsearch' value='<?php echo (isset($txtsearch) ? $txtsearch : ""); ?>'>
                <input type='submit' name='btnsearch' value="Search">
            </form>
        </div>

        <?php
            require_once '../connection.php';

            $sql = "SELECT * FROM doc_requests";

            $txtsearch = '';
            if(isset($_POST['btnsearch'])) {
                $txtsearch = $_POST['txtsearch'];
                $sql .= " WHERE track_id LIKE '$txtsearch%' OR student_id LIKE '$txtsearch%' OR file_orf LIKE '$txtsearch%' OR file_id LIKE '$txtsearch%'
                OR copies LIKE '$txtsearch%' OR purpose LIKE '$txtsearch%' OR status_id LIKE '$txtsearch%' OR dt_request LIKE '$txtsearch%'
                OR file_pay LIKE '$txtsearch%' OR status_pay LIKE '$txtsearch%' OR auth_finance LIKE '$txtsearch%' OR dt_payment LIKE '$txtsearch%'
                OR auth_dean LIKE '$txtsearch%' OR dt_dean LIKE '$txtsearch%' OR auth_go LIKE '$txtsearch%' OR dt_go LIKE '$txtsearch%'
                OR auth_sl LIKE '$txtsearch%' OR dt_sl LIKE '$txtsearch%'";
            }
            $sql .= " ORDER BY track_id, student_id, file_orf, file_id, copies, purpose, status_id, dt_request, file_pay, status_pay,
                auth_finance, dt_payment, auth_dean, dt_dean, auth_go, dt_go, auth_sl, dt_sl";
            $result = mysqli_query($con, $sql) or die("Error: Please check the query statement");
        ?>

        <table>
            <thead>
                <tr>
                    <th>Tracking No.</th>
                    <th>Student ID</th>
                    <th>File ORF</th>
                    <th>File ID</th>
                    <th>Copies</th>
                    <th>Purpose</th>
                    <th>Status ID</th>
                    <th>Date Requested</th>
                    <th>File Pay</th>
                    <th>Status Pay</th>
                    <th>Auth Finance</th>
                    <th>Date Payment</th>
                    <th>Auth Dean</th>
                    <th>Date Dean</th>
                    <th>Auth GO</th>
                    <th>Date GO</th>
                    <th>Auth SL</th>
                    <th>Date SL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require_once '../connection.php';
                    if(mysqli_num_rows($result) == 0) {
                        echo "<tr><td colspan=19> NO RECORDS FOUND. Please add a record into the database</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>{$row['track_id']}</td>";
                            echo "<td>{$row['student_id']}</td>";
                            echo "<td>{$row['file_orf']}</td>";
                            echo "<td>{$row['file_id']}</td>";
                            echo "<td>{$row['copies']}</td>";
                            echo "<td>{$row['purpose']}</td>";
                            echo "<td>{$row['status_id']}</td>";
                            echo "<td>{$row['dt_request']}</td>";
                            echo "<td>{$row['file_pay']}</td>";
                            echo "<td>{$row['status_pay']}</td>";
                            echo "<td>{$row['auth_finance']}</td>";
                            echo "<td>{$row['dt_payment']}</td>";
                            echo "<td>{$row['auth_dean']}</td>";
                            echo "<td>{$row['dt_dean']}</td>";
                            echo "<td>{$row['auth_go']}</td>";
                            echo "<td>{$row['dt_go']}</td>";
                            echo "<td>{$row['auth_sl']}</td>";
                            echo "<td>{$row['dt_sl']}</td>";
                            echo "<td class='action-cell'>
                                    <a href='doc_request_edit_form.php?track_id={$row['track_id']}'>EDIT</a> |
                                    <a href='doc_request_delete_confirmation.php?track_id={$row['track_id']}'>DELETE</a>
                                  </td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    </center>
</body>
</html>
