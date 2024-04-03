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

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
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
    </style>
</head>

<body>
    <center>

    <?php
    // Prepare system to connect to database
    $hostName = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "database2_group7";
    
    $con = mysqli_connect($hostName, $hostUsername, $hostPassword, $hostDB) or die("Error in connecting database");

    $sql = "SELECT * FROM doc_type";

    $result = mysqli_query($con, $sql) or die("ERROR. Please check query statement");

    $id = '';
    if(isset($_GET['doctype_id'])) {
        $id = $_GET['doctype_id'];

        $sql = "SELECT * FROM doc_type WHERE doctype_id='$id'";
        $result = mysqli_query($con, $sql) or die("Error in SQL statement, please check coder under SELECT");

        $doctypeid = '';
        $docname = '';
   
        while ($row = mysqli_fetch_array($result)) {
            $doctypeid = $row['doctype_id'];
            $docname = $row['doc_name'];
        }
    }
    ?>

        <h1>
            <a href="/schooldocumentsprocessing/doc_type.php"> <<<</a> Edit Document Information
        </h1>
        <form method="post" action="doc_type_edit_process.php">
            <table>
                <input type="hidden" name="txtid" value="<?php echo $id; ?>">
                <tr>
                    <td><label for="txtdoctypeid">No. of Copies</label></td>
                    <td><input type="text" name="txtdoctypeid" value="<?php echo $doctypeid; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtdocname">Document Name</label></td>
                    <td><input type="text" name="txtdocname" value="<?php echo $docname; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" name="submit" value="UPDATE">
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>

</html>