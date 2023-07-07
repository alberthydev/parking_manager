<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";    
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
    <h1>Parking a Vehicle</h1>
        <div id="parking">
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
                        WHERE parking.Parking_Departure_Date IS NULL
                        ORDER BY vehicles.Vehicle_ID ASC;;");
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
            <form onsubmit="park(customer, space)">
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
                                $result = $conn->query("SELECT * FROM vehicles WHERE Vehicle_Parked = 0");
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
                    </table>
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
                  let space=null;
                  const container = document.querySelector('.grid-container');
                  for (let i = 0; i <= (parkingSpacesTotal-1); i++) {
                    parkingSpacesUsed.sort((a, b) => a - b);
                    const item = document.createElement('div');
                    item.classList.add('grid-item');
                    item.innerHTML = "<input type='hidden' name='parking_space' value="+(i+1)+">"+(i+1);
                    if(!parkingSpacesUsed.includes(item.textContent)){
                        item.style.backgroundColor = "green";
                        item.addEventListener('click', () => {
                            item.style.backgroundColor = "yellow";
                            space=(i+1);
                        });
                    }else{
                        item.style.backgroundColor = "red";
                        item.addEventListener('click', () => {
                            alert("Space already in use, choose another one");
                        });
                    }
                    container.appendChild(item);
                  }
                </script>
                <button type="submit">Park Vehicle</button>
            </form>
        </div>
    <button><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>