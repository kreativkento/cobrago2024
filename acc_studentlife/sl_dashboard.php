<?php
// Include the connection file
require_once '../connection.php';

// Get finance information
session_start();
$userInfo = getDeanInfo();
$deanID = $userInfo['dean_id']

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CobraGO -- College Dean</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
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

        .content {
            background-image: url("../assets/background.jpg");
            background-position: center;
            height: 100vh;
            margin-left: 250px;
            margin-top: 0;
            padding: 20px;
            color: #333;
        }

        .content h1,
        .content p {
            color: #333;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .stat-card {
            padding: 20px 20px 10px 20px;
            border: 5px solid #800000;
            border-radius: 8px;
            text-align: center;
            background: #FFFFFF90;
        }

        .stat-card h3 {
            margin-top: 0;
        }

        .stat-card p {
            font-size: 24px;
            color: #333;
            margin-top: 5px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <img src='../assets/logo1.png' alt='../assets/logo1.png' class="logo">
        <a href="./dean_dashboard.php">Dashboard</a>
        <a href="./dean_requests.php">Request Approval</a>
        <a href="./dean_flag_requests.php">Flagged Requests</a>
        <a href="./dean_logout.html"><span>Logout</span></a>
    </div>

    <div class="content">
        <h1>Welcome to the Dashboard</h1>

        <?php if ($userInfo) : ?>
            <p>Hello, <?= htmlspecialchars($userInfo['dean_id']) ?> -- <?= htmlspecialchars($userInfo['dean_firstname'] . ' ' . $userInfo['dean_lastname']) ?></p>
        <?php else : ?>
            <p>Hello, College Dean</p>
        <?php endif; ?>

        <h2>Request Approval</h2>
        <div class="stats">
            <div class="stat-card">
                <h3>Pending Requests</h3>
                <p><?= getCountEntries('doc_request', '2') ?></p>
            </div>
            <div class="stat-card">
                <h3>Flagged Requests</h3>
                <p><?= getCountEntries('doc_request', '3') ?></p>
            </div>
            <div class="stat-card">
                <h3>Student Headcount in Department</h3>
                <p><?= getCountStudents($deanID) ?></p>
            </div>
        </div>
    </div>
</body>

</html>

<?php
function getCountEntries($criteria, $table) {
    global $con;

    // Your SQL query to count records based on the criteria
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE status_id = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $criteria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        return $row['count'];
    }

    return 0; // Return 0 if there's an error or no records found
}

function getCountStudents($deanID) {
    global $con;

    $sql = "SELECT COUNT(*) AS count
            FROM student_account sa
            INNER JOIN college_course cc ON sa.course_code = cc.course_code
            INNER JOIN college_department cd ON cc.dept_code = cd.dept_code
            WHERE cd.dean_id = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $deanID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        return $row['count'];
    }

    return 0; // Return 0 if there's an error or no records found
}

function getDeanInfo() {
    global $con;

    // Get the user's information from the database based on the user's session
    if (isset($_SESSION['user_id'])) {
        $finId = $_SESSION['user_id'];
        $sql = "SELECT dean_id, dean_firstname, dean_lastname FROM dean_account WHERE dean_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $finId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            return $row;
        }
    }

    return null; // Return null if there's an error or no data found
}

?>