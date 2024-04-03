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
        <h1><a href="./admin_account.php">EDIT ADMIN ACCOUNT</a></h1>

        <?php
        include '../connection.php';

        $id = '';
        if(isset($_GET['admin_id'])) {
            $id = $_GET['admin_id'];
            $sql = "SELECT * FROM admin_account WHERE admin_id='$id'";
            $result = mysqli_query($con, $sql) or die("Error in SQL statement, please check coder under SELECT");

            while ($row = mysqli_fetch_array($result)) {
                $id = $row['admin_id'];
                $pass = $row['admin_pass'];
                $last = $row['admin_firstname'];
                $first = $row['admin_lastname'];
                $email = $row['admin_email'];
            }
        }
        ?>

        <form method="post" action="./admin_account_edit_process.php?id=<?php echo $id; ?>">
            <table>
                <input type="hidden" name="txtid" value="<?php echo $id; ?>">
                <tr>
                    <td><label for="txtid">ID No.</label></td>
                    <td><input type="text" name="txtid" value="<?php echo $id; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtpass">Password</label></td>
                    <td><input type="text" name="txtpass" value="<?php echo $pass; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtfirst">Lastname</label></td>
                    <td><input type="text" name="txtfirst" value="<?php echo $first; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtlast">Firstname</label></td>
                    <td><input type="text" name="txtlast" value="<?php echo $last; ?>"></td>
                </tr>
                <tr>
                    <td><label for="txtemail">Middlename</label></td>
                    <td><input type="text" name="txtemail" value="<?php echo $email; ?>"></td>
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
