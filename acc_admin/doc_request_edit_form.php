<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GMC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #800000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="submit"], input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-top: 5px;
        }

        input[type="submit"] {
            width: auto;
            background-color: #800000;
            color: white;
            cursor: pointer;
            border: none;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #a04000;
        }

        a {
            color: #800000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Request Information</h1>
        <a href="/schooldocumentsprocessing/doc_type.php"> <<< Go back</a>
        <?php
            // Your PHP code here
        ?>
        <form method="post" action="doc_request_edit_process.php">
            <input type="hidden" name="txtid" value="<?php echo $id; ?>">
            <table>
                <tr>
                    <td><label for="txttrackingid">Tracking No.</label></td>
                    <td><input type="text" name="txttrackingid" value="<?php echo $trackingid; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtstudentid">Student ID</label></td>
                    <td><input type="text" name="txtstudentid" value="<?php echo $studentid; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtcoursecode">Course Code</label></td>
                    <td><input type="text" name="txtcoursecode" value="<?php echo $coursecode; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtdoctypeid">Document Name</label></td>
                    <td><input type="text" name="txtdoctypeid" value="<?php echo $doctypeid; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtstatusid">Status</label></td>
                    <td><input type="text" name="txtstatusid" value="<?php echo $statusid; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtdeanid">Dean No.</label></td>
                    <td><input type="text" name="txtdeanid" value="<?php echo $deanid; ?>"></td>
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
