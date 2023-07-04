<?php
    session_start();
    include_once "../connection/connection.php";

    var_dump($_POST);

    // Check if the variables have been set
    if(!empty($_POST['id'])){
        $customer_id = $_POST['id'];
    };
    $func=$_POST['func'];
    $name = $_POST['name'];
    if(!empty($_POST['cpf'])){
        $cpf = $_POST['cpf'];

    $cpf = preg_replace('/[^0-9\s]/u', '', $cpf);
    };
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $timestamp = time();
    $date = date('Y-m-d H:i:s', $timestamp);

    // Remove every special characters from data
    $name = preg_replace('/[áàãâä]/u', 'a', $name);
    $name = preg_replace('/[éèêë]/u', 'e', $name);
    $name = preg_replace('/[íìîï]/u', 'i', $name);
    $name = preg_replace('/[óòõôö]/u', 'o', $name);
    $name = preg_replace('/[úùûü]/u', 'u', $name);
    $name = preg_replace('/ç/u', 'c', $name);
    $name = preg_replace('/[^a-zA-Z\s]/u', ' ', $name);

    $address = preg_replace('/[áàãâä]/u', 'a', $address);
    $address = preg_replace('/[éèêë]/u', 'e', $address);
    $address = preg_replace('/[íìîï]/u', 'i', $address);
    $address = preg_replace('/[óòõôö]/u', 'o', $address);
    $address = preg_replace('/[úùûü]/u', 'u', $address);
    $address = preg_replace('/ç/u', 'c', $address);
    $address = preg_replace('/[^a-zA-Z0-9\s]/u', ' ', $address);
        
    $phone = preg_replace('/[^0-9\s]/u', '', $phone);
    $phone = preg_replace('/\s+/', '', $phone);
        
    if(isset($func)){
        if($func == "create"){
            echo "Create Working";
            // Call the createCustomer function to make a new register in the database
            createCustomer($conn, $name, $cpf, $phone, $address, $date);
        }
        if($func == "edit"){
            echo "Edit working\n";
            // Call the editCustomer function to change customer information
            editCustomer($conn, $name, $phone, $address, $date, $customer_id);
        }
        if($func == "delete"){
            echo "Delete Working\n";
            // Call the deleteCustomer function to delete current the customer
            deleteCustomer($conn, $customer_id);
        } 
    }

    function createCustomer($conn, $name, $cpf, $phone, $address, $date){
        $stmt = $conn->prepare ("INSERT INTO customers (Customer_Name,Customer_CPF,Customer_Phone,Customer_Address, 
        Customer_Registration_Date) values (?,?,?,?,?)");
        $stmt->bind_param("sssss", $name, $cpf, $phone, $address, $date);
        $stmt->execute();
    };

    function editCustomer($conn, $name, $phone, $address, $date, $customer_id){
        echo "I'm in edit the function\n";
        $stmt = $conn->prepare ("UPDATE customers SET Customer_Name='$name', Customer_Phone='$phone', 
        Customer_Address='$address', Customer_Registration_Date='$date' WHERE Customer_ID='$customer_id'");
        $stmt->execute();
    };

    function deleteCustomer($conn, $customer_id){
        echo "I'm in delete the function\n";
        $stmt = $conn->prepare("DELETE FROM customers WHERE Customer_ID = '$customer_id'");
        $stmt->execute();
    }
?>
