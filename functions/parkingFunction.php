<?php
    session_start();
    include_once "../connection/connection.php";
    
    var_dump($_POST);

    $func = $_POST ['func'];
    $vehicle_id = $_POST['vehicle_id'];
    if(isset($_POST['parking_space'])){
        $parking_space = $_POST['parking_space'];
    }
    if(isset($_POST['customer_id'])){
        $customer_id = $_POST['customer_id'];
    }
    $timestamp = time();
    $date = date('Y-m-d H:i:s', $timestamp);

    echo "Function: " . $func."\n";

    if($func == "park"){
        parkingVehicle($conn, $parking_space, $vehicle_id, $customer_id, $date);
    }
    if($func == "pay"){
        echo "I'm inside the function";
        payParking($conn, $date, $vehicle_id);
    }
    function parkingVehicle($conn, $parking_space, $vehicle_id, $customer_id, $date){
        $stmt = $conn->prepare ("INSERT INTO parking (Parking_Space_ID, Vehicle_ID, Customer_ID, 
        Parking_Arrived_Date) values (?,?,?,?)");
        $stmt->bind_param("ssss", $parking_space, $vehicle_id, $customer_id, $date);
        $stmt->execute();

        $stmt = $conn->prepare("UPDATE vehicles SET Vehicle_Parked = 1 WHERE Vehicle_ID = $vehicle_id");
        $stmt->execute();
    };

    function payParking($conn, $date, $vehicle_id){
        $stmt = $conn->prepare("UPDATE parking SET Parking_Departure_Date = ? WHERE Vehicle_ID = ?");
        $stmt->bind_param("si", $date, $vehicle_id);
        $stmt->execute();
    
        $stmt = $conn->prepare ("UPDATE vehicles SET Vehicle_Parked = 0 WHERE Vehicle_ID = ?");
        $stmt->bind_param("i", $vehicle_id);
        $stmt->execute();
    }
?>