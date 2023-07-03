<?php
    require "../connection/connection.php";

    function createCustomer($conn, $name, $cpf, $phone, $address, $date){
        $stmt = $conn->prepare ("INSERT INTO customers (Customer_Name,Customer_CPF,Customer_Phone,Customer_Address, Customer_Registration_Date) values (?,?,?,?,?)");
        $stmt->bind_param("sssss", $name, $cpf, $phone, $address, $date);
        $stmt->execute();
    };

    if(isset($_POST['name'])&&isset($_POST['cpf'])&&isset($_POST['phone'])&&isset($_POST['address'])){
        
        // Check if the variables have been set
        if (empty($name)||empty($cpf)||empty($phone)||empty($address)){
            echo "<script>alert('No data sended')</script>";
            return 1;
        };

        $name = $_POST['name'];
        $cpf = $_POST['cpf'];
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
        $address = preg_replace('/[^a-zA-Z\s]/u', ' ', $address);

        $cpf = preg_replace('/[^0-9\s]/u', '', $cpf);

        $phone = preg_replace('/[^0-9\s]/u', '', $phone);
        $phone = preg_replace('/\s+/', '', $phone);

        // Call the createCustomer function to make a new register in the database
        createCustomer($conn, $name, $cpf, $phone, $address, $date);
    };
?>
