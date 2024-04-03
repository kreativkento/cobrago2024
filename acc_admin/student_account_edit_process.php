<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GMC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('background2.png'); /* Replace 'your-image.jpg' with the path to your background image */
            background-size: cover; /* This ensures the background image covers the entire viewport */
            background-repeat: no-repeat;
        }

        /* Center-align content */
        .center-content {
            text-align: center;
        }

        .container {
            background-color: white;
            padding: 40px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            display: inline-block; /* To center-align the content */
        }

        .success-message {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .back-button {
            background-color: #800000;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #a04000;
        }
    </style>
</head>
<body>
    <div class="center-content">
        <h1>
        <a href="./student_account.php"></a>
    </h1>
        <?php
        include '../connection.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $txtid = mysqli_real_escape_string($con, $_POST['txtid']);
            $txtstudentid = mysqli_real_escape_string($con, $_POST['txtstudentid']);
            $txtpassword = mysqli_real_escape_string($con, $_POST['txtpassword']);
            $txtlastname = mysqli_real_escape_string($con, $_POST['txtlastname']);
            $txtfirstname = mysqli_real_escape_string($con, $_POST['txtfirstname']);
            $txtmiddlename = mysqli_real_escape_string($con, $_POST['txtmiddlename']);
            $txtcoursecode = mysqli_real_escape_string($con, $_POST['txtcoursecode']);
            $txtyearlevel = mysqli_real_escape_string($con, $_POST['txtyearlevel']);
            $txtemail = mysqli_real_escape_string($con, $_POST['txtemail']);
            $txtphoneno = mysqli_real_escape_string($con, $_POST['txtphoneno']);
            $txtverification = mysqli_real_escape_string($con, $_POST['txtverification']);

            $sql = "UPDATE student_account SET student_id='$txtstudentid', password = '$txtpassword', last_name='$txtlastname', first_name='$txtfirstname', middle_name='$txtmiddlename',
                    course_code='$txtcoursecode', year_level='$txtyearlevel', email='$txtemail', phone_no='$txtphoneno', verification='$txtverification'
                    WHERE student_id='$txtid'";

            if (mysqli_query($con, $sql)) {
                echo '<div class="container">';
                echo '<div class="success-message">Student information has been updated successfully.</div>';
                echo '<a href="../website/student_account.php" class="back-button">Go Back to View Records</a>';
                echo '</div>';
            } else {
                echo '<div class="container">';
                echo '<div class="error-message">Error updating student information: ' . mysqli_error($con) . '</div>';
                echo '<a href="../website/student_account.php" class="back-button">Go Back to View Records</a>';
                echo '</div>';
            }

            if (mysqli_query($con, $sql)) {
                if ($_GET['source'] === 'student_account') {
                    echo '<script>';
                    echo 'console.log("Account successfully updated!");';
                    echo '</script>';
                    header("Location: ./student_account.php");
                } elseif ($_GET['source'] === 'student_account_applications') {
                    echo '<script>';
                    echo 'console.log("Account successfully updated!");';
                    echo '</script>';
                    header("Location: ./student_account_applications.php");
                } else {
                    header("Location: ./student_account.php");  // Default redirection
                }
                exit();
            } else {
                // Error handling code
            }
        }
        ?>
    </div>
</body>
</html>
