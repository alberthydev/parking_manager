<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php"
?>
    <nav class="nav-menu">
        <h1>PM</h1>
        <button class="button-system"><a href="customer.php">Customers</a></button>
        <button class="button-system"><a href="vehicle.php"">Vehicles</a></button>
    </nav>
    <div class="vehicles-parked">
        <div>
            <h1>Vehicles Parked</h1>
        </div>
        <div class="vehicles-table">
            <div class="tbl-header">
                <table cellpadding="0" cellspacing="0" border="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Vehicle</th>
                            <th>Customer</th>
                            <th>Parking Slot</th>
                            <th>Arrived Date</th>
                            <th>Departured Date</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="tbl-content">
               <?php
                    $result = $conn->query("SELECT parking.Parked_ID, parking.Parking_Space_ID, parking.Vehicle_ID, parking.Parking_Arrived_Date, 
                    parking.Parking_Departure_Date, vehicles.Vehicle_Desc, vehicles.Vehicle_Plate, customers.Customer_Name 
                    FROM parking 
                    JOIN customers ON parking.Customer_ID = customers.Customer_ID 
                    JOIN vehicles ON parking.Vehicle_ID = vehicles.Vehicle_ID
                    ORDER BY parking.Parked_ID ASC;");
                    $num_rows = mysqli_num_rows($result);
               ?>
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody> 
                        <?php
                            if(mysqli_num_rows($result)>0){
                                while ($row_parked = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "  <td>".$row_parked['Parked_ID']."</td>";
                                    echo "  <td>".$row_parked['Vehicle_Desc']."</td>";
                                    echo "  <td>".$row_parked['Customer_Name']."</td>";
                                    echo "  <td>".$row_parked['Parking_Space_ID']."</td>";
                                    echo "  <td>".$row_parked['Parking_Arrived_Date']."</td>";
                                    if(!$row_parked['Parking_Departure_Date']==null){
                                        echo "  <td id='situation'>".$row_parked['Parking_Departure_Date']."</td>";
                                        echo "  <td><button class='button-delete'>Delete</button></td>";
                                    }else{
                                        echo "  <td id='situation'>Still Parked</td>";
                                        echo "  <td><button onclick='lineSelect(this)' class='button-pay'><input type='hidden' name='vehicle_id'
                                     value='". $row_parked['Vehicle_ID'] ."'>Pay</button></td>";
                                    }
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td>No vehicles parked</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            let vehicle = null;

            let table = document.querySelector('.tbl-content');
            let numRowsTable = <?php echo $num_rows;?>;
            if(numRowsTable>=4){
                table.classList.add('fixo');
            }else{
                table.classList.remove('fixo');
            }

            function lineSelect(line){
                vehicle = line.querySelector('input[name="vehicle_id"]').value;
                payParking(vehicle);
            }
        </script>
    </div>    
    <h2>Parking Spaces</h2>
    <div class="grid-container"></div>
    <script>
        const parkingSpacesTotal = 9; // número de itens
        const container = document.querySelector('.grid-container');
        for (let i = 1; i <= parkingSpacesTotal; i++) {
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
    <button class="button-system"><a href="parkingCreate.php"">Park a car</a></button>
<?php
    require "../structure/footer.php"
?>