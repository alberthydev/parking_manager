<?php
    session_start();
    include_once "../connection/connection.php";

    var_dump($_POST);
    
    if(!empty($_POST['id'])){
        $vehicle_id = intval($_POST['id']);
    };
    $func=$_POST['func'];
    $desc = $_POST['desc'];
    $plate = $_POST['plate'];
    $customer_id = intval($_POST['customer_id']);
    $timestamp = time();
    $date = date('Y-m-d H:i:s', $timestamp);

    if(isset($func)){
        if($func == "create"){
            // Call the createVehicle function to make a new register in the database
            createVehicle($conn, $desc, $plate, $date, $customer_id);
        }
        if($func == "edit"){
            // Call the editVehicle function to change vehicle information
            editVehicle($conn, $desc, $plate, $date, $customer_id, $vehicle_id);
        }
        if($func == "delete"){
            // Call the deleteVehicle function to delete the current vehicle
            deleteVehicle($conn, $vehicle_id);
        } 
    }
    

    function createVehicle($conn, $desc, $plate, $date, $customer_id){
        $stmt = $conn->prepare ("INSERT INTO vehicles (Vehicle_Desc,Vehicle_Plate,Vehicle_Registration_Date, Customer_ID) values (?,?,?,?)");
        $stmt->bind_param("sssi", $desc, $plate, $date, $customer_id);
        $stmt->execute();
    };

    function editVehicle($conn, $desc, $plate, $date, $customer_id, $vehicle_id){
        $stmt = $conn->prepare ("UPDATE vehicles SET Vehicle_Desc='$desc', Vehicle_Plate='$plate', 
        Vehicle_Registration_Date='$date', Customer_ID='$customer_id' WHERE Vehicle_ID='$vehicle_id'");
        $stmt->execute();
    };

    function deleteVehicle($conn, $vehicle_id){
        $stmt = $conn->prepare("DELETE FROM vehicles WHERE Vehicle_ID = '$vehicle_id'");
        $stmt->execute();
    }
?>
