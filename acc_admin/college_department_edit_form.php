<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GMC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url("../assets/logoutbg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            max-width: 2000px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h1 {
            color: #800000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="submit"], input[type="reset"], select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 5px;
        }

        input[type="submit"], input[type="reset"], input[type="button"] {
            width: auto;
            padding: 10px;
            background-color: #800000;
            color: white;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            margin-top: 20px;
        }

        input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover {
            background-color: #a04000;
        }

        a {
            color: #800000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>EDIT COLLEGE DEPARTMENT</h1>
        <a href="./college_department.php"></a>
        
        <?php
        //prepare system to connect to database
        require_once '../connection.php';
        
        $sql = "SELECT * FROM college_department";
        $result = mysqli_query($con, $sql)or die("ERROR. Please check query statement");
        $id = '';

        if(isset($_GET['dept_code'])) {
            $id = $_GET['dept_code'];
            $sql = "SELECT * FROM college_department WHERE dept_code='$id'";
            //execute sql statement
            $result = mysqli_query($con, $sql)or die("Error in SQL statement, please check coder under SELECT");
            $dept_name='';
            $dean_id='';

            while ($row = mysqli_fetch_array($result)) {
                $dept_name = $row['dept_name'];
                $dean_id = $row['dean_id'];
            }
        }
        ?>

        <form method="post" action="./college_department_edit_process.php">
            <table>
                <input type="hidden" name="txtid" value="<?php echo $id; ?>">

                <tr>
                    <td><label for="txtdeptcode">Department Code</label></td>
                    <td><input type="text" name="txtdeptcode" value="<?php echo $id; ?>"></td>
                </tr>


                <tr>
                    <td><label for="txtdeptname">Department Name</label></td>
                    <td><input type="text" name="txtdeptname" value="<?php echo $dept_name; ?>"></td>
                </tr>

                <tr>
                    <td><label for="txtdeptcode">Dean In-Charge</label></td>
                    <td>
                        <select name="txtdean">
                        <?php
                            require_once '../connection.php';

                            $deanQuery = "SELECT dean_id, dean_firstname, dean_lastname FROM dean_account";
                            $deanResult = mysqli_query($con, $deanQuery);

                            while ($deanRow = mysqli_fetch_array($deanResult)) {
                                $selected = ($dean_id == $deanRow['dean_id']) ? "selected" : "";
                                $optionValue = $deanRow['dean_id'];
                                $optionText = "{$deanRow['dean_id']} -- {$deanRow['dean_firstname']} {$deanRow['dean_lastname']}";
                                echo "<option value='$optionValue' $selected>$optionText</option>";
                            }
                        ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="submit" value="UPDATE">
                        <input type="button" value="CANCEL" onclick="window.location.href='./college_department.php';">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>

</html>
