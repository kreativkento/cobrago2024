<?php
require_once '../connection.php';

$dean_id = '';

$deanQuery = "SELECT dean_id, dean_firstname, dean_lastname FROM dean_account";
$deanResult = mysqli_query($con, $deanQuery);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Department</title>
    <style>
        body {
            background-image: url("../assets/logoutbg.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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
            margin-top: 20px;
        }

        input[type="reset"] {
            margin-left: 10px;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto; /* Center the form horizontally */
            padding: 40px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            background-color: rgba(255, 255, 255, 0.8);
        }

        .form-container h1 {
            margin-bottom: 20px;
        }

        .form-container table {
            margin: 0 auto;
        }

        .form-container label {
            width: 120px;
            display: inline-block;
        }

        .form-container select {
            width: calc(100% - 6px); /* Adjusted width for better alignment */
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body bgcolor="white">
    <div class="container">
        <div class="form-container">
            <h1>Add College Department</h1><br>
            <form method="post" action="./college_department_add_process.php">
                <table style="width: 100%;">
                    <tr align="left">
                        <td><label for="txtcoursecode"> Dept Code </label></td>
                        <td><input type="text" name="txtdeptcode" required></td>
                    </tr>
                    <tr align="left">
                        <td><label for="txtcoursetitle"> Dept Name </label></td>
                        <td><input type="text" name="txtdeptname" required></td>
                    </tr>
                    <tr>
                        <td align="left"><label for="txtdean">Dept Dean</label></td>
                        <td>
                            <select name="txtdean">
                            <option value="" disabled selected>Select One</option>
                                <?php
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
                        <td colspan="2">
                            <input type="submit" value="SAVE" name="submit">
                            &nbsp;&nbsp;&nbsp;
                            <input type="reset" value="CLEAR">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</body>

</html>
