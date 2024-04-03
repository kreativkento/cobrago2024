<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $inpIDNum = $_POST['userID'];
    $inpPass = $_POST['userPass'];

    $sql_login = "SELECT student_id, verification FROM student_account WHERE student_id = '$inpIDNum' AND password = '$inpPass'";
    $query_result = mysqli_query($con, $sql_login);

    if ($query_result) {
        $row = mysqli_fetch_assoc($query_result);
        if ($row) {
            $verifiedStatus = $row['verification'];
            if ($verifiedStatus === 'VALID') {
                $response['Success'] = true;
                $response['Message'] = "Login Successful";
                $response['verified'] = "VALID";
            } else {
                $response['Success'] = true; // Set Success to true since credentials are correct
                $response['Message'] = "Account not verified"; // Modify the message
                $response['verified'] = "INVALID";
            }
        } else {
            $response['Success'] = false;
            $response['Message'] = "Wrong Credentials";
            $response['verified'] = "INVALID";
        }
    } else {
        $response['Success'] = false;
        $response['Message'] = "Error querying the database";
        $response['verified'] = "INVALID";
    }

    echo json_encode($response);
    mysqli_close($con);
}
?>
