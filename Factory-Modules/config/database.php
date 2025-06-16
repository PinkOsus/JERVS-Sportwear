<?php
    $db_server = "localhost";
    $db_host = "root";
    $db_pass = "";
    $db_name = "studentinfo_db";

    $conn = mysqli_connect("localhost", "root", "", "jervsdb");

    if(!$conn){
        die("Connection Failed" . mysqli_connect_error());
    }
?>