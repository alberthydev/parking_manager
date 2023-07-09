<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";    
?>  
    <h1>Parking a Vehicle</h1>
        <div>
            <div class="tbl-header">
                <table>
                    <thead>
                        <th>Vehicle</th>
                        <th>Plate</th>
                        <th>Parked Space</th>
                    </thead>
                </table>
            </div>
            <div class="tbl-content"> 
                <table>
                    <tbody>
                        <?php
                            $result = $conn->query("SELECT vehicles.*, parking.* FROM vehicles
                            JOIN parking ON vehicles.Vehicle_ID = parking.Vehicle_ID
                            WHERE parking.Parking_Departure_Date IS NULL
                            ORDER BY vehicles.Vehicle_ID ASC;;");
                            $num_rows = mysqli_num_rows($result);
                            if($num_rows>0){
                                while($row_vehicle = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    echo "  <td>". $row_vehicle['Vehicle_Desc']. "</td>";
                                    echo "  <td>". $row_vehicle['Vehicle_Plate']. "</td>";
                                    echo "  <td>". $row_vehicle['Parking_Space_ID']. "</td>";
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td>No vehicles registred</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <form onsubmit="park(customer, space)">
                <div>
                    <div class="tbl-header">
                        <table>
                            <thead>
                                <th>Vehicle</th>
                                <th>Plate</th>
                                <th>#</th>
                            </thead>
                        </table>
                    </div>
                    <div class="tbl-content"> 
                        <table>
                            <tbody>
                                <?php
                                    $result = $conn->query("SELECT * FROM vehicles WHERE Vehicle_Parked = 0");
                                    if($num_rows>0){
                                        while($row_vehicle = mysqli_fetch_assoc($result)){
                                            echo "<tr onclick=lineSelect(this)>";
                                            echo "  <input type='hidden' value=".$row_vehicle['Customer_ID']." name='customer_id'>";
                                            echo "  <td>". $row_vehicle['Vehicle_Desc']. "</td>";
                                            echo "  <td>". $row_vehicle['Vehicle_Plate']. "</td>";
                                            echo "  <td><input type='radio' name='vehicle_id' value=".$row_vehicle['Vehicle_ID']." required></td>";
                                            echo "</tr>";
                                        }
                                    }else{
                                        echo "<tr><td>No vehicles available</td></tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="grid-container"></div>
                <?php
                    $result = $conn->query("SELECT Parking_Space_ID, Parking_Departure_Date FROM parking WHERE Parking_Departure_Date IS NULL");
                    $parking_space_used = array();
                    if($result ->num_rows > 0){
                        while($row_parking_space = $result->fetch_assoc()){
                            array_push($parking_space_used, $row_parking_space['Parking_Space_ID']);
                            echo "$row_parking_space[Parking_Space_ID]";
                        }
                    }
                ?>
                <script>
                    const parkingSpacesTotal = 9; // número de itens
                    const parkingSpacesUsed = <?php echo json_encode($parking_space_used);?>; // itens usados
                    const container = document.querySelector('.grid-container');
                    let previousItem = null;
                    
                    for (let i = 0; i <= (parkingSpacesTotal-1); i++) {
                        parkingSpacesUsed.sort((a, b) => a - b);
                        const item = document.createElement('div');
                        item.classList.add('grid-item');
                        item.innerHTML = "<input type='hidden' name='parking_space' value="+(i+1)+">"+(i+1);
                        if(!parkingSpacesUsed.includes(item.textContent)){
                            item.style.backgroundColor = "green";
                            item.addEventListener('click', () => {
                                if(previousItem !== null){
                                    previousItem.style.backgroundColor = "green";
                                }
                                item.style.backgroundColor = "yellow";
                                previousItem = item;
                            });
                        }else{
                            item.style.backgroundColor = "red";
                            item.addEventListener('click', () => {
                              alert("Space already in use, choose another one");
                            });
                        }
                      container.appendChild(item);
                    }

                    let customer = null;
                    let space=null;

                    let table = document.querySelectorAll('.tbl-content');
                    let numRowsTable = <?php echo $num_rows;?>;
                    if(numRowsTable>=4){
                        table[0].classList.add('fixo');
                        table[1].classList.add('fixo');
                    }else{
                        table[0].classList.remove('fixo');
                        table[1].classList.remove('fixo');
                    }

                    function lineSelect(line){
                        customer = line.querySelector('input[name="customer_id"]').value;
                    }
                </script>
                <button type="submit" class="button-system">Park Vehicle</button>
            </form>
        </div>
    <button class="button-system"><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>