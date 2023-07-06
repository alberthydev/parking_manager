<?php
    session_start();
    include_once "../connection/connection.php";
    
    $parking_space = $_POST['parking_space'];
    $vehicle_id = $_POST['vehicle_id'];
    $customer_id = $_POST['customer_id'];
    $timestamp = time();
    $date = date('Y-m-d H:i:s', $timestamp);

    parkingVehicle($conn, $parking_space, $vehicle_id, $customer_id, $date);

    function parkingVehicle($conn, $parking_space, $vehicle_id, $customer_id, $date){
        $stmt = $conn->prepare ("INSERT INTO parking (Parking_Space_ID, Vehicle_ID, Customer_ID, 
        Parking_Arrived_Date) values (?,?,?,?)");
        $stmt->bind_param("ssss", $parking_space, $vehicle_id, $customer_id, $date);
        $stmt->execute();
    };
?>