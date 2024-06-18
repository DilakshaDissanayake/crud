<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crud";

    //cretae Connection
    $connection = new mysqli($servername,$username,$password,$database);


    // check the connection
    if ($connection->connect_error) {
        die("Connection failed: pelase Check The conncation". $connection->connect_error);
    }
                    

