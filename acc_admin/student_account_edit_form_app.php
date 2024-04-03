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
            background-image: url('../assets/background2.png');
            background-size: cover;
            background-repeat: no-repeat; 
        }

        .container {
            max-width: 2000px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        a {
            color: #800000;
            text-decoration: none;
            padding: 5px 15px;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            border-collapse: collapse;
            width: 60%;
            margin: 20px auto;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus {
            border-color: #800000;
        }

        input[type="submit"] {
            background-color: #800000;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #a04000;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

    
        
    </style>
</head>
<body>
    <div class="container">
        <h1><a href="./student_account_applications.php">EDIT STUDENT INFORMATION</a></h1>

        <?php
        include '../connection.php';

        $id = '';
        if(isset($_GET['student_id'])) {
            $id = $_GET['student_id'];
            $sql = "SELECT * FROM student_account WHERE student_id='$id'";
            $result = mysqli_query($con, $sql) or die("Error in SQL statement, please check coder under SELECT");

            while ($row = mysqli_fetch_array($result)) {
                $studentid = $row['student_id'];
                $password = $row['password'];
                $lastname = $row['last_name'];
                $firstname = $row['first_name'];
                $middlename = $row['middle_name'];
                $coursecode = $row['course_code'];
                $yearlevel = $row['year_level'];
                $email = $row['email'];
                $phoneno = $row['phone_no'];
                $verification = $row['verification'];
            }
        }
        ?>

        <form method="post" action="./student_account_edit_process.php?source=student_account_applications">
            <table>
                <input type="hidden" name="txtid" value="<?php echo $id; ?>">
                <tr>
                    <td><label for="txtstudentid">ID No.</label></td>
                    <td><input type="text" name="txtstudentid" value="<?php echo $studentid; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtstudentid">Password</label></td>
                    <td><input type="text" name="txtpassword" value="<?php echo $password; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtlastname">Lastname</label></td>
                    <td><input type="text" name="txtlastname" value="<?php echo $lastname; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtfirstname">Firstname</label></td>
                    <td><input type="text" name="txtfirstname" value="<?php echo $firstname; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtmiddlename">Middlename</label></td>
                    <td><input type="text" name="txtmiddlename" value="<?php echo $middlename; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtcoursecode">Course</label></td>
                    <td>
                        <select name="txtcoursecode" required>
                            <?php
                            require_once '../connection.php';
                    
                            // Perform a SQL query to fetch course data from the college_course table
                            $courseQuery = "SELECT course_code, course FROM college_course";
                            $courseResult = mysqli_query($con, $courseQuery);
                    
                            if ($courseResult) {
                                while ($row = mysqli_fetch_assoc($courseResult)) {
                                    $coursecode = $row['course_code'];
                                    $coursename = $row['course'];
                    
                                    // Output each course as an option
                                    echo "<option value=\"$coursecode\" " . ($coursecode == $coursecode ? "selected" : "") . ">$coursename</option>";
                                }
                            } else {
                                echo "<option value=\"\">No courses found</option>";
                            }
                    
                            // Close the database connection when you're done
                            mysqli_close($con);
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>    
                    <td><label for="txtyearlevel">Year Level</label></td>
                    <td>
                        <select name="txtyearlevel">
                            <option value="1st" <?php if ($yearlevel == "1st") echo "selected"; ?>>1st Year</option>
                            <option value="2nd" <?php if ($yearlevel == "2nd") echo "selected"; ?>>2nd Year</option>
                            <option value="3rd" <?php if ($yearlevel == "3rd") echo "selected"; ?>>3rd Year</option>
                            <option value="4th" <?php if ($yearlevel == "4th") echo "selected"; ?>>4th Year</option>
                            <option value="5th" <?php if ($yearlevel == "5th") echo "selected"; ?>>5th Year</option>
                            <option value="6th" <?php if ($yearlevel == "6th") echo "selected"; ?>>6th Year</option>
                            <option value="6th" <?php if ($yearlevel == "7th") echo "selected"; ?>>7th Year</option>
                            <option value="6th" <?php if ($yearlevel == "8th") echo "selected"; ?>>8th Year</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="txtemail">Email</label></td>
                    <td><input type="email" name="txtemail" value="<?php echo $email; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtphoneno">Mobile Number</label></td>
                    <td><input type="text" name="txtphoneno" value="<?php echo $phoneno; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtverification">Verification</label></td>
                    <td>
                        <select name="txtverification" required>
                            <option value="DENIED" <?php if ($verification == 'DENIED') echo 'selected'; ?>>Invalidate</option>
                            <option value="VALID" <?php if ($verification == 'VALID') echo 'selected'; ?>>Validate</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="submit" value="UPDATE">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
