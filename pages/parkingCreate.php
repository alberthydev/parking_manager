<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";    
?>
    <h1>Parking a Vehicle</h1>
        <div id="parking">
            <form onsubmit="park(customer)" action="index.php">
                <table>
                    <thead>
                        <th>#</th>
                        <th>Parking Space</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" name="parking_space" value="1" required></td>
                            <td>Parking Space 1</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="parking_space" value="2" required></td>
                            <td>Parking Space 2</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="parking_space" value="3" required></td>
                            <td>Parking Space 3</td>
                        </tr>
                    </tbody>
                </table><br>
                <div id="vehicles">
                    <table>
                        <thead>
                            <strong><legend>Available Vehicles</legend></strong><br>
                            <th>Vehicle</th>
                            <th>Plate</th>
                            <th>#</th>
                        </thead>
                        <tbody>
                            <?php
                                $result = $conn->query("SELECT * FROM vehicles WHERE Vehicle_ID 
                                NOT IN (SELECT Vehicle_ID FROM parking);");
                                while($row_vehicle = mysqli_fetch_assoc($result)){
                                    echo "<tr onclick=lineSelect(this)>";
                                    echo "  <input type='hidden' value=".$row_vehicle['Customer_ID']." name='customer_id'>";
                                    echo "  <td>". $row_vehicle['Vehicle_Desc']. "</td>";
                                    echo "  <td>". $row_vehicle['Vehicle_Plate']. "</td>";
                                    echo "  <td><input type='radio' name='vehicle_id' value=".$row_vehicle['Vehicle_ID']." required></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                        <script>
                            let customer = null;

                            function lineSelect(line){
                                customer = line.querySelector('input[name="customer_id"]').value;
                            }
                        </script>
                    </table><br>
                    <table>
                            <thead>
                                <strong><legend>Parked Vehicles</legend></strong><br>
                                <th>Vehicle</th>
                                <th>Plate</th>
                                <th>Parked Space</th>
                            </thead>
                            <tbody>
                                <?php
                                    $result = $conn->query("SELECT vehicles.*, parking.* FROM vehicles
                                    JOIN parking ON vehicles.Vehicle_ID = parking.Vehicle_ID
                                    WHERE parking.Parking_Departure_Date IS NULL;");
                                    while($row_vehicle = mysqli_fetch_assoc($result)){
                                        echo "<tr>";
                                        echo "  <td>". $row_vehicle['Vehicle_Desc']. "</td>";
                                        echo "  <td>". $row_vehicle['Vehicle_Plate']. "</td>";
                                        echo "  <td>". $row_vehicle['Parking_Space_ID']. "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                    </table>
                </div>
                <button type="submit">Park Vehicle</button>
            </form>
        </div>
    <button><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>