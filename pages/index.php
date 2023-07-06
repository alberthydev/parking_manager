<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php"
?>

<h1>Parking Manager</h1>
    <button><a href="customer.php" style="text-decoration: none; color: black;">Customers</a></button>
    <button><a href="vehicle.php" style="text-decoration: none; color: black;">Vehicles</a></button>
    <div id="vehicles_parked">
        <h2>Vehicles Parked</h2>
        <table>
            <thead>
                <th>#</th>
                <th>Vehicle</th>
                <th>Customer</th>
                <th>Parking Slot</th>
                <th>Arrived Date</th>
                <th>Departured Date</th>
            </thead>
            <tbody> 
                <?php
                    $result = $conn->query("SELECT parking.Parked_ID, parking.Parking_Space_ID, parking.Parking_Arrived_Date, 
                    parking.Parking_Departure_Date, vehicles.Vehicle_Desc, vehicles.Vehicle_Plate, customers.Customer_Name 
                    FROM parking 
                    JOIN customers ON parking.Customer_ID = customers.Customer_ID 
                    JOIN vehicles ON parking.Vehicle_ID = vehicles.Vehicle_ID");
                    while ($row_parked = mysqli_fetch_array($result)){
                        echo "<tr>";
                        echo "  <td>".$row_parked['Parked_ID']."</td>";
                        echo "  <td>".$row_parked['Vehicle_Desc']."</td>";
                        echo "  <td>".$row_parked['Customer_Name']."</td>";
                        echo "  <td>".$row_parked['Parking_Space_ID']."</td>";
                        echo "  <td>".$row_parked['Parking_Arrived_Date']."</td>";
                        if(!$row_parked['Parking_Departure_Date']==null){
                            echo "  <td id='situation'>".$row_parked['Parking_Departure_Date']."</td>";
                        }else{
                            echo "  <td id='situation'>Still Parked</td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="parking-spaces">
        <h2>Parking Spaces</h1>
        <div>
            <p><a href="parkingSpace.php?space=1" style="text-decoration: none; color: black;">Parking Space 1</a></p>
        </div>
        <div>
            <p><a href="parkingSpace.php?space=2" style="text-decoration: none; color: black;">Parking Space 2</a></p>
        </div>
        <div>
            <p><a href="parkingSpace.php?space=3" style="text-decoration: none; color: black;">Parking Space 3</a></p>
        </div>
    </div>

    <button><a href="parkingCreate.php" style="text-decoration: none; color: black;">Park a car</a></button>
<?php
    require "../structure/footer.php"
?>