<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";    
?>
    <h1>Parking a Vehicle</h1>
    <div id="formulario">
        <form method="POST" id="form" onsubmit="park()" action="parking.php">
            <table>
                <thead>
                    <th>#</th>
                    <th>Parking Space</th>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="radio" name="parking_space" value="1">1</td>
                        <td>Parking Space</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="parking_space" value="2">2</td>
                        <td>Parking Space</td>
                    </tr>
                    <tr>
                        <td><input type="radio" name="parking_space" value="3">3</td>
                        <td>Parking Space</td>
                    </tr>
                </tbody>
            </table>
            <div>
                <table>
                    <thead>
                        <legend>Registered Vehicles</legend>
                        <th>#</th>
                        <th>Vehicle</th>
                        <th>Customer</th>
                    </thead>
                    <tbody>
                        <?php
                            $result = $conn->query("SELECT * FROM vehicles");
                            while($row_vehicle = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "  <td><input type='radio' name='vehicle_id' value=".$row_vehicle['Vehicle_ID'].">". $row_vehicle['Vehicle_ID']. "</td>";
                                echo "  <td>". $row_vehicle['Vehicle_Desc']. "</td>";
                                echo "  <td><input type='hidden' name='customer_id' value=".$row_vehicle['Customer_ID'].">". $row_vehicle['Customer_ID']."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <button type="submit">Park the Vehicle</button>
        </form>
        <button><a href="parking.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>