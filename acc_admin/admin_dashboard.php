<?php
// Include the connection file
require_once '../connection.php';

// Get admin information
session_start();
$adminInfo = getAdminInfo();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GOOD MORAL CERTIFICATE DOCUMENT PROCESSING</title>
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

    <div class="content">
        <h1>Welcome to the Dashboard</h1>

        <?php if ($adminInfo) : ?>
            <p>Hello, <?= htmlspecialchars($adminInfo['admin_id']) ?> -- <?= htmlspecialchars($adminInfo['admin_firstname'] . ' ' . $adminInfo['admin_lastname']) ?></p>
        <?php else : ?>
            <p>Hello, Admin</p>
        <?php endif; ?>

        <div class="stats">
            <div class="stat-card">
                <h3>Valid Student Accounts</h3>
                <p><?= getCountStudent('VALID', 'student_account') ?></p>
            </div>
            <div class="stat-card">
                <h3>Pending Student Accounts</h3>
                <p><?= getCountStudent('DENIED', 'student_account') ?></p>
            </div>
            <div class="stat-card">
                <h3>College Courses</h3>
                <p><?= getCountEntries('college_course') ?></p>
            </div>
            <div class="stat-card">
                <h3>College Departments</h3>
                <p><?= getCountEntries('college_department') ?></p>
            </div>
            <div class="stat-card">
                <h3>Document Requests</h3>
                <p><?= getCountEntries('doc_request') ?></p>
            </div>
            <div class="stat-card">
                <h3>Administrators</h3>
                <p><?= getCountEntries('admin_account') ?></p>
            </div>
            <div class="stat-card">
                <h3>College Deans</h3>
                <p><?= getCountEntries('dean_account') ?></p>
            </div>
            <div class="stat-card">
                <h3>Guidance Officers</h3>
                <p><?= getCountEntries('guidance_account') ?></p>
            </div>
            <div class="stat-card">
                <h3>Finance Officers</h3>
                <p><?= getCountEntries('finance_account') ?></p>
            </div>
            <div class="stat-card">
                <h3>Student Life</h3>
                <p><?= getCountEntries('sl_account') ?></p>
            </div>
        </div>
    </div>
</body>

</html>

<?php
function getCountStudent($criteria, $table) {
    global $con;

    // Your SQL query to count records based on the criteria
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE verification = ?"; // Adjust this query based on your table and criteria

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $criteria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        return $row['count'];
    }

    return 0; // Return 0 if there's an error or no records found
}

function getCountEntries($table) {
    global $con;

    // Your SQL query to count records in the specified table
    $sql = "SELECT COUNT(*) AS count FROM $table";

    $result = $con->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        return $row['count'];
    }

    return 0; // Return 0 if there's an error or no records found
}

function getAdminInfo() {
    global $con;

    // Get the admin's information from the database based on the user's session
    if (isset($_SESSION['user_id'])) {
        $adminId = $_SESSION['user_id'];
        $sql = "SELECT admin_id, admin_firstname, admin_lastname FROM admin_account WHERE admin_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $adminId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $row = $result->fetch_assoc()) {
            return $row;
        }
    }

    return null; // Return null if there's an error or no data found
}

?>
