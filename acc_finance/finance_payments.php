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

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            padding-top: 50px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        var selectedTrackId;  // Add this variable

        function openModal(trackId) {
            selectedTrackId = trackId;  // Store the track_id
            document.getElementById('myModal').style.display = 'block';
        }

        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }

        function confirmUpdate() {
            var selectedValue = document.getElementById('validOption').value;

            var url = './update_valid.php';
            var params = 'track_id=' + selectedTrackId + '&new_valid=' + selectedValue;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', url, true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle response
                    console.log(xhr.responseText);

                    // Close modal after successful update
                    closeModal();
                }
            };

            xhr.send(params);
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
        <h1>Validating Payments Process</h1>
        <div class="search-box">
            <form method='post'>
                SEARCH: <input type='text' name='txtsearch' value='<?php echo (isset($txtsearch) ? $txtsearch : ""); ?>'>
                <input type='submit' name='btnsearch' value="Search">
            </form>
        </div>

        <?php
        require_once '../connection.php';

        $sql = "SELECT * FROM payment_request";

        $txtsearch = '';
        if (isset($_POST['btnsearch'])) {
            $txtsearch = $_POST['txtsearch'];
            $sql .= " WHERE track_id LIKE '%$txtsearch%' OR 
                    student_id LIKE '%$txtsearch%' OR 
                    receipt LIKE '%$txtsearch%' OR 
                    date_submit LIKE '%$txtsearch%' OR 
                    valid LIKE '%$txtsearch%'";
        } else {}

        $sql .= " ORDER BY id, track_id, student_id, receipt, date_submit, valid";

        $result = mysqli_query($con, $sql) or die("Error: " . mysqli_error($con));
        ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tracking ID</th>
                    <th>Student ID</th>
                    <th>Receipt</th>
                    <th>Date Submitted</th>
                    <th>Valid</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan=9> NO RECORDS FOUND. Please add a record into the database.</td></tr>";
                } else {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $track_id = $row['track_id'];
                        $student_id = $row['student_id'];
                        $receipt = $row['receipt'];
                        $date_submit = $row['date_submit'];
                        $valid = $row['valid'];
                        

                        echo "<tr>";
                        echo "<td>$id</td>";
                        echo "<td>$track_id</td>";
                        echo "<td>$student_id</td>";
                        echo "<td>$receipt</td>";
                        echo "<td>$date_submit</td>";
                        echo "<td>$valid</td>";
                        echo "<td><button class='edit-button' onclick='openModal(\"$track_id\")'>UPDATE</button></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Update Valid Field</h2>
                <form id="updateForm">
                    <label for="validOption">Select Valid Option:</label>
                    <select name="validOption" id="validOption">
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                    </select>
                    <br>
                    <button type="button" onclick="confirmUpdate()">Confirm</button>
                    <button type="button" onclick="closeModal()">Cancel</button>
                </form>
            </div>
        </div>
    </center>
</body>

</html>
