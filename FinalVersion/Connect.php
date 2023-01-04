<?php

    $dbConnection = mysqli_connect("db-final.c7zpa203kknk.us-east-1.rds.amazonaws.com", "admin", "db-final", "my_db");

    if(mysqli_connect_errno()){
        echo "Failed to connect MySQL: " . mysqli_connect_error();
        exit();
    }

    // echo "成功連線";

    mysqli_set_charset($dbConnection, "utf8");

?>