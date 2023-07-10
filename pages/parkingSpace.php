<?php 
    require "../structure/header.php";    
    include_once "../connection/connection.php";
    session_start();
?>
<nav class="nav-menu">
    <img src="../img/logo.png" alt="logo PM - Parking Manager" class="logo">
    <div class="nav-buttons">
        <button class="button-system"><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
</nav>
<div class="parking">
    <div>
        <div class="vp-structure">
            <h1>Parking <?php echo $_GET['space']?></h1>
        </div>
    </div>
    <div class="park-info-structure">
        <?php
            $space_id = $_GET['space'];

            $result = $conn->query("SELECT vehicles.Vehicle_Desc, vehicles.Vehicle_Plate, customers.Customer_Name 
            FROM parking 
            JOIN customers ON parking.Customer_ID = customers.Customer_ID 
            JOIN vehicles ON parking.Vehicle_ID = vehicles.Vehicle_ID WHERE 
            parking.Parking_Space_ID = $space_id AND (Parking_Departure_Date IS NULL);");
            $parking_info = mysqli_fetch_assoc($result);

            if(isset($parking_info['Vehicle_Desc']) && $parking_info['Vehicle_Plate'] && $parking_info['Customer_Name']){
                echo "<p class='park-info'>Vehicle: ". $parking_info['Vehicle_Desc']."</p><br>";
                echo "<p class='park-info'>Plate: ". $parking_info['Vehicle_Plate']."</p><br>";
                echo "<p class='park-info'>Customer: ". $parking_info['Customer_Name']."</p>";
            }else{
                    echo "<p class='park-info'>Parking Space Available</p>";
            }
        ?>
    </div>
</div>

<?php require "../structure/footer.php" ?>