<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php"
?>
    <nav class="nav-menu">
        <img src="../img/logo.png" alt="logo PM - Parking Manager" class="logo">
        <div class="nav-buttons">
            <button class="button-system"><a href="customer.php">Customers</a></button>
            <button class="button-system"><a href="vehicle.php"">Vehicles</a></button>
        </div>
    </nav>
    <div class="vehicles-parked">
        <div class="vp-structure">
            <h1>Vehicles Parked</h1>
        </div>
        <div class="vehicle-table-right">
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
                    $result_parked = $conn->query("SELECT Parking_Space_ID, Parking_Departure_Date FROM parking WHERE Parking_Departure_Date IS NULL");
                    $parking_space_used = array();
                    if($num_rows > 0){
                        while($row_parking_space = $result_parked->fetch_assoc()){
                            array_push($parking_space_used, $row_parking_space['Parking_Space_ID']);
                        }
                    }
               ?>
                <table cellpadding="0" cellspacing="0" border="0">
                    <tbody> 
                        <?php
                            if($num_rows>0){
                                while ($row_parked = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "  <td>".$row_parked['Parked_ID']."</td>";
                                    echo "  <td>".$row_parked['Vehicle_Desc']."</td>";
                                    echo "  <td>".$row_parked['Customer_Name']."</td>";
                                    echo "  <td>".$row_parked['Parking_Space_ID']."</td>";
                                    echo "  <td>".$row_parked['Parking_Arrived_Date']."</td>";
                                    if(!$row_parked['Parking_Departure_Date']==null){
                                        echo "  <td id='situation'>".$row_parked['Parking_Departure_Date']."</td>";
                                        echo '  <td><button class="button-delete"><a href="'.$_SERVER["PHP_SELF"].'?Parked_ID='.$row_parked["Parked_ID"].
                            '&del=true" id="delete-parking">DELETE</a></button></td>';
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

                            if(isset($_GET["del"])){
                                $del_parking_ID = $_GET["Parked_ID"];
        	                	$stmt = $conn->prepare("DELETE FROM parking WHERE Parked_ID = ?");
        	                	$stmt->bind_param('i', $del_parking_ID);
        	                	$stmt->execute();
                                echo "<script>window.location.href='index.php';</script>";
        	                	exit;
        	                }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
    <div class="grid-parking-create">
        <div class="grid-container grid-container-right"></div>
        <div>
            <div class="vp-structure">
                <h1>Parking Spaces</h1>
            </div>
            <button class="button-system park-button"><a href="parkingCreate.php"">PARK</a></button>
        </div>
    </div>
    <script>
        const parkingSpacesTotal = 10; // número de itens
        const container = document.querySelector('.grid-container');
        const parkingSpacesUsed = <?php echo json_encode($parking_space_used);?>;
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

        for (let i = 1; i <= parkingSpacesTotal; i++) {
            const item = document.createElement('div');
            item.classList.add('grid-item');
            item.textContent = i;
            if(!parkingSpacesUsed.includes(item.textContent)){
                item.classList.remove('has-vehicle');
                item.classList.add('dont-has-vehicle');
                item.addEventListener('click', () => {
                    window.location.href = 'parkingSpace.php?space=' + i;
                });
                }else{
                item.classList.remove('dont-has-vehicle');
                item.classList.add('has-vehicle');
                item.addEventListener('click', () => {
                    window.location.href = 'parkingSpace.php?space=' + i;
                });
            }
            item.addEventListener('click', () => {
              
            });
            container.appendChild(item);
        }
    </script>
<?php
    require "../structure/footer.php"
?>