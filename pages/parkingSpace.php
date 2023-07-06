<?php 
    require "../structure/header.php";    
    include_once "../connection/connection.php";
    session_start();
?>

    <h1>Parking <?php echo $_GET['space']?></h1>
    <?php
        $space_id = $_GET['space'];

        $result = $conn->query("SELECT vehicles.Vehicle_Desc, vehicles.Vehicle_Plate, customers.Customer_Name 
        FROM parking 
        JOIN customers ON parking.Customer_ID = customers.Customer_ID 
        JOIN vehicles ON parking.Vehicle_ID = vehicles.Vehicle_ID WHERE parking.Parking_Space_ID = $space_id;");
        $parking_info = mysqli_fetch_assoc($result);

        if(isset($parking_info['Vehicle_Desc']) && $parking_info['Vehicle_Plate'] && $parking_info['Customer_Name']){
            echo "<p>Vehicle: ". $parking_info['Vehicle_Desc']."</p><br>";
            echo "<p>Plate: ". $parking_info['Vehicle_Plate']."</p><br>";
            echo "<p>Customer: ". $parking_info['Customer_Name']."</p><br>";
        }else{
            echo "<p>Parking Space Available</p>";
        }
    ?>
    <button><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>

<?php require "../structure/footer.php" ?>