<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CobraGO -- Finance</title>
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
    <script>
        async function updateStatus(trackId, newStatus) {
            try {
                const url = './update_status.php';
                const params = new URLSearchParams({ track_id: trackId, new_status: newStatus });

                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: params,
                });

                if (response.ok) {
                    const responseData = await response.text();
                    // Handle the response if needed
                    console.log(responseData);
                } else {
                    console.error('Failed to update status:', response.status, response.statusText);
                }
            } catch (error) {
                console.error('An error occurred during the update:', error);
            }
        }

        function updateStatusClear(trackId) {
            updateStatus(trackId, 6);
        }

        function updateStatusFlag(trackId) {
            updateStatus(trackId, 5);
        }
    </script>
</head>

<body>
    <div class="sidebar">
        <img src='../assets/logo1.png' alt='../assets/logo1.png' class="logo">
        <a href="./finance_dashboard.php">Dashboard</a>
        <a href="./finance_payments.php">Payments Processing</a>
        <a href="./finance_requests.php">Request Approval</a>
        <a href="./finance_logout.html"><span>Logout</span></a>
    </div>
    <center>
        <h1>Document Request Payment Confirmation</h1>
        <div class="search-box">
            <form method='post'>
                SEARCH: <input type='text' name='txtsearch' value='<?php echo (isset($txtsearch) ? $txtsearch : ""); ?>'>
                <input type='submit' name='btnsearch' value="Search">
            </form>
        </div>

        <?php
        require_once '../connection.php';

        $sql = "SELECT * FROM doc_request WHERE status_pay = 'NP' AND status_id = '4'";

        $txtsearch = '';
        if (isset($_POST['btnsearch'])) {
            $txtsearch = $_POST['txtsearch'];
            $sql .= " AND (track_id LIKE '%$txtsearch%' OR 
                    student_id LIKE '%$txtsearch%' OR 
                    status_pay LIKE '%$txtsearch%' OR 
                    copies LIKE '%$txtsearch%')";
        } else {
            // No need for an empty else block
        }

        $sql .= " ORDER BY track_id, student_id, status_pay, copies";

        $result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
        ?>

        <table>
            <thead>
                <tr>
                    <th>Tracking ID</th>
                    <th>Student ID</th>
                    <th>No. of Copies</th>
                    <th>Charge</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cost = 100.00;
                if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan=9> NO RECORDS FOUND. Please add a record into the database.</td></tr>";
                } else {
                    while ($row = mysqli_fetch_array($result)) {
                        $track_id = $row['track_id'];
                        $student_id = $row['student_id'];
                        $copies = $row['copies'];
                        $charge = $copies*$cost;
                        $status = $row['status_pay'];
                        
                        echo "<tr>";
                        echo "<td>$track_id</td>";
                        echo "<td>$student_id</td>";
                        echo "<td>$copies</td>";
                        echo "<td>$charge</td>";
                        echo "<td>$status</td>";
                        echo "<td><button class='edit-button' onclick='updateStatusClear($track_id)'>CONFIRM PAY</button>  ||  <button class='edit-button' onclick='updateStatusFlag($track_id)'>FLAG</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </center>
</body>

</html>
