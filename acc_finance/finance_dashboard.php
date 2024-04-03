<?php
// Include the connection file
require_once '../connection.php';

// Get finance information
session_start();
$adminInfo = getFinanceInfo();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CobraGO -- Finance</title>
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
        <a href="./finance_dashboard.php">Dashboard</a>
        <a href="./finance_payments.php">Payments Processing</a>
        <a href="./finance_requests.php">Request Approval</a>
        <a href="./finance_logout.html"><span>Logout</span></a>
    </div>

    <div class="content">
        <h1>Welcome to the Dashboard</h1>

        <?php if ($adminInfo) : ?>
            <p>Hello, <?= htmlspecialchars($adminInfo['fin_id']) ?> -- <?= htmlspecialchars($adminInfo['fin_firstname'] . ' ' . $adminInfo['fin_lastname']) ?></p>
        <?php else : ?>
            <p>Hello, Finance</p>
        <?php endif; ?>

        <h2>Payment Processes</h2>
        <div class="stats">
            <div class="stat-card">
                <h3>Total Submissions</h3>
                <p><?= getCountEntries('payment_request') ?></p>
            </div>
            <div class="stat-card">
                <h3>Pending Receipt Validation</h3>
                <p><?= getCountPayments('--', 'payment_request') ?></p>
            </div>
            <div class="stat-card">
                <h3>Validated Receipts</h3>
                <p><?= getCountPayments('YES', 'payment_request') ?></p>
            </div>
            <div class="stat-card">
                <h3>Declined Receipts</h3>
                <p><?= getCountPayments('NO', 'payment_request') ?></p>
            </div>
        </div><br><br>

        <h2>Request Approvals</h2>
        <div class="stats">
            <div class="stat-card">
                <h3>Current Requests</h3>
                <p><?= getCountEntriesFinance('doc_request', 'FV') + getCountEntriesFinance('doc_request', 'NP') ?></p>
            </div>
            <div class="stat-card">
                <h3>Request Flagged</h3>
                <p><?= getCountEntriesFinance('doc_request', 'FV')?></p>
            </div>
            <div class="stat-card">
                <h3>Request Not Paid</h3>
                <p><?= getCountEntriesFinance('doc_request', 'NP') ?></p>
            </div>
        </div>
        

    </div>
</body>

</html>

<?php
function getCountPayments($criteria, $table) {
    global $con;

    // Your SQL query to count records based on the criteria
    $sql = "SELECT COUNT(*) AS count FROM $table WHERE valid = ?"; // Adjust this query based on your table and criteria

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

function getFinanceInfo() {
    global $con;

    // Get the user's information from the database based on the user's session
    if (isset($_SESSION['user_id'])) {
        $finId = $_SESSION['user_id'];
        $sql = "SELECT fin_id, fin_firstname, fin_lastname FROM finance_account WHERE fin_id = ?";
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

function getCountEntriesFinance($table, $criteria) {
    global $con;

    $sql = "SELECT COUNT(*) AS count FROM $table WHERE status_pay = ?";

    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $criteria);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        return $row['count'];
    }

    return 0; // Return 0 if there's an error or no records found
}

?>
