<?php
    $hostname = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "db_warung";

    // For Create Connection
    $conn = mysqli_connect($hostname, $username, $password, $dbname);

    // For Check Connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

?>
