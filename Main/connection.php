<?php   // include this in PHP files to connect Database

    // prepare database connect
        $hostName="mysql8002.site4now.net";
        $hostUsername="aa0151_cobrago";
        $hostPassword="@SWUITtrojans11";
        $hostDB="db_aa0151_cobrago";
    // connect to database
        $con = mysqli_connect($hostName, $hostUsername, $hostPassword, $hostDB) or die("Error in Database connection...");

?>