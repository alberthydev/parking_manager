<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php"
?>
<style>
    .grid-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      grid-gap: 10px;
      padding: 2vh 5vw;
    }
    .grid-item {
      background-color: #ddd;
      padding: 10px;
      text-align: center;
    }
</style>
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
                    $result = $conn->query("SELECT parking.Parked_ID, parking.Parking_Space_ID, parking.Vehicle_ID, parking.Parking_Arrived_Date, 
                    parking.Parking_Departure_Date, vehicles.Vehicle_Desc, vehicles.Vehicle_Plate, customers.Customer_Name 
                    FROM parking 
                    JOIN customers ON parking.Customer_ID = customers.Customer_ID 
                    JOIN vehicles ON parking.Vehicle_ID = vehicles.Vehicle_ID
                    ORDER BY parking.Parked_ID ASC;");
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
                            echo "  <td><button onclick='lineSelect(this)'><input type='hidden' name='vehicle_id'
                         value='". $row_parked['Vehicle_ID'] ."'>Pay</button></td>";
                        }
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <script>
                let vehicle = null;

                function lineSelect(line){
                    vehicle = line.querySelector('input[name="vehicle_id"]').value;
                    payParking(vehicle);
                }
            </script>
        </table>
    </div>
    <h2>Parking Spaces</h2>
    <div class="grid-container"></div>
    <script>
        const n = 9; // número de itens
        const container = document.querySelector('.grid-container');
        for (let i = 1; i <= n; i++) {
            const item = document.createElement('div');
            item.classList.add('grid-item');
            item.textContent = i;
            item.addEventListener('click', () => {
              window.location.href = 'parkingSpace.php?space=' + i;
            });
            container.appendChild(item);
        }
    </script>
    </div>
    <button><a href="parkingCreate.php" style="text-decoration: none; color: black;">Park a car</a></button>
<?php
    require "../structure/footer.php"
?>