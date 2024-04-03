<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GMC Requestor System</title>
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
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #800000;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #800000;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .search-box {
            text-align: center;
            margin: 20px;
        }

        input[type="text"], input[type="submit"] {
            padding: 10px;
            margin: 5px;
            border: 1px solid #aaa;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #800000;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #a04000;
        }

        /* New style to center the action items */
        td.actions {
            text-align: center;
        }
    </style>
</head>

<body>

<center>
    <h4><a href="/schooldocumentsprocessing/admin"><<< Back to main page</a></h4>
    <h1>Documentation Information</h1>
    <h4><a href="/schooldocumentsprocessing/adddoctype_form.html">Add Course</a></h4>

    <div class="search-box">
        <form method='post'>
            SEARCH: <input type='text' name='txtsearch' value='<?php echo (isset($txtsearch) ? $txtsearch : ""); ?>'>
            <input type='submit' name='btnsearch' value="Search">
        </form>
    </div>

    <?php
    $hostName = "localhost";
    $hostUsername = "root";
    $hostPassword = "";
    $hostDB = "database2_group7";

    $con = mysqli_connect($hostName, $hostUsername, $hostPassword, $hostDB) or die("Error in Database connection...");

    $sql = "SELECT * from doc_type";

    $txtsearch = '';
    if (isset($_POST['btnsearch'])) {
        $txtsearch = $_POST['txtsearch'];
        $sql .= " WHERE doctype_id like '$txtsearch%' OR doc_name like '$txtsearch%'";
    }
    $sql .= " ORDER BY doctype_id, doc_name";
    
    $result = mysqli_query($con, $sql) or die("Error: Please check the query statement");
    ?>

    <table>
        <thead>
            <tr>
                <th>No. of Copies</th>
                <th>Document Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan=3> NO RECORDS FOUND. Please add record into the database.</td></tr>";
        } else {
            while ($row = mysqli_fetch_array($result)) {
                $doctypeid = $row['doctype_id'];
                $docname = $row['doc_name'];

                echo "<tr>";
                echo "<td>$doctypeid</td>";
                echo "<td>$docname</td>";
                // Note the added 'actions' class
                echo "<td class='actions'><a href='doc_type_edit_form.php?doctype_id=$doctypeid'>EDIT</a> | 
                      <a href='doc_type_delete_confirmation.php?doc_name=$docname'>DELETE</a></td>";
                echo "</tr>";
            }
        }
        ?>
        </tbody>
    </table>

</center>
</body>
</html>