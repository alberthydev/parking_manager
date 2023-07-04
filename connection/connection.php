<?php
    $hostdb = "localhost";
    $userdb = "root";  // You must add this user to your local database or change for 
    $passdb = "1413Hyg";  // some user that exists already and have all permissions
    $dbname = "pessoal";

    $conn = mysqli_connect($hostdb, $userdb, $passdb, $dbname);

    if($conn->connect_error){
        die("Connection Failed: ".$conn->error);
    }else{
        echo "Connected Successfully\n";
    }
?>