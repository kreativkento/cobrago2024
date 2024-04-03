<?php
require_once '../connection.php';

$courseOptions = '';
// Perform a SQL query to fetch course data from the college_course table
$courseQuery = "SELECT course_code, course FROM college_course";
$courseResult = mysqli_query($con, $courseQuery);

if ($courseResult) {
    while ($row = mysqli_fetch_assoc($courseResult)) {
        $coursecode = $row['course_code'];
        $coursename = $row['course'];

        // Output each course as an option
        $courseOptions .= "<option value=\"$coursecode\">$coursename</option>";
    }
} else {
    $courseOptions = "<option value=\"\">No courses found</option>";
}

// Close the database connection when you're done
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Student</title>
    <style>
        body {
            background-image: url('../assets/logoutbg.jpg');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            font-family: Arial, sans-serif;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
        }

        .form-container {
            width: 20%;
            margin: 200px auto;
            padding: 50px;
            border: 1px solid #ccc;
            border-radius: 20px;
            background-color: rgba(249, 249, 249, 0.8);
        }

        label {
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="text"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: maroon;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: small;
        }

        .form-container table {
            margin: 0 auto;
        }

        .form-container label {
            width: 120px;
            display: inline-block;
        }

        .button-container {
            text-align: center;
            margin-top: 10px;
        }

        .redirect-button {
            padding: 9px 14px;
            background-color: maroon;
            color: #fff;
            border: none;
            border-radius: 20px;
            cursor: pointer;
            font-size: small;
        }

        .redirect-button:hover {
            cursor: pointer;
        }
    </style>
</head>

<body bgcolor="white">
    <center>
        <div class="form-container">
            <h1>ADD STUDENT ACCOUNT</h1>
            <form method="post" action="./student_add_process.php">
                <table>
                    <tr>
                        <td><label for="txtstudentid">ID No.</label></td>
                        <td><input type="text" name="txtstudentid" required></td>
                    </tr>
                    <tr>
                        <td><label for="txtstudentid">Password</label></td>
                        <td><input type="text" name="txtpassword" required></td>
                    </tr>
                    <tr>
                        <td><label for="txtlastname">Lastname</label></td>
                        <td><input type="text" name="txtlastname" required></td>
                    </tr>
                    <tr>
                        <td><label for="txtfirstname">Firstname</label></td>
                        <td><input type="text" name="txtfirstname" required></td>
                    </tr>
                    <tr>
                        <td><label for="txtmiddlename">Middlename</label></td>
                        <td><input type="text" name="txtmiddlename" required></td>
                    </tr>
                    <tr>
                        <td><label for="txtcoursecode">Course</label></td>
                        <td>
                            <select name="txtcoursecode" required>
                                <option value="" disabled selected>Select One</option>
                                <?php echo $courseOptions; ?>
                            </select>
                        </td>
                    </tr>
                    <td><label for="txtyearlevel">Year Level</label></td>
                    <td>
                        <select name="txtyearlevel" required>
                            <option value="" disabled selected>Select One</option>
                            <option value="1st">1st Year</option>
                            <option value="2nd">2nd Year</option>
                            <option value="3rd">3rd Year</option>
                            <option value="4th">4th Year</option>
                            <option value="5th">5th Year</option>
                            <option value="6th">6th Year</option>
                            <option value="7th">7th Year</option>
                            <option value="8th">8th Year</option>
                        </select>
                    </td>
                    </tr>
                    <tr>
                        <td><label for="txtemail">Email</label></td>
                        <td><input type="text" name="txtemail" required></td>
                    </tr>
                    <tr>
                        <td><label for="txtphoneno">Mobile Number</label></td>
                        <td><input type="text" name="txtphoneno" required></td>
                    </tr>
                </table>
                <div class="button-container">
                    <input type="submit" value="SAVE" name="submit">&nbsp;&nbsp;&nbsp;
                    <input type="reset" value="CLEAR">&nbsp;&nbsp;&nbsp;
                    <span class="redirect-button" onclick="window.location.href='./student_account.php'">CANCEL</span>
                </div>
            </form>
        </div>
    </center>
</body>

</html>
