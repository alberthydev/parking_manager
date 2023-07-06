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
                            <td><input type="radio" name="parking_space" value="1" required>1</td>
                            <td>Parking Space</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="parking_space" value="2" required>2</td>
                            <td>Parking Space</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="parking_space" value="3" required>3</td>
                            <td>Parking Space</td>
                        </tr>
                    </tbody>
                </table>
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
                                echo "<tr onclick=lineSelect(this)>";
                                echo "  <input type='hidden' value=".$row_vehicle['Customer_ID']." name='customer_id'>";
                                echo "  <td><input type='radio' name='vehicle_id' value=".$row_vehicle['Vehicle_ID']." required>". $row_vehicle['Vehicle_ID']. "</td>";
                                echo "  <td>". $row_vehicle['Vehicle_Desc']. "</td>";
                                echo "  <td>". $row_vehicle['Customer_ID']. "</td>";
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
                </table>
                <button type="submit">Park the Vehicle</button>
            </form>
        </div>
    <button><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>