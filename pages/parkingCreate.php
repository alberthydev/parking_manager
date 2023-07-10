<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";    
?>
<nav class="nav-menu">
        <img src="../img/logo.png" alt="logo PM - Parking Manager" class="logo">
        <div class="nav-buttons">
            <button class="button-system"><a href="index.php" style="text-decoration: none; color: black;">BACK</a></button>
        </div>
    </nav>
<div class="vehicles-parked">
    <div class="vp-structure">
        <h1>Vehicles Parked</h1>
    </div>
    <div class="vehicle-table-right">
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
                        $num_rows_parked = mysqli_num_rows($result);
                        if($num_rows_parked>0){
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
</div>
<div>
    </div>
        <form onsubmit="park(customer, space)">
            <div class="vehicles-parked">
                <div class="vehicle-table-left">
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
                                    $num_rows = mysqli_num_rows($result);
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
                <div>
                    <div class="vp-structure">
                        <h1>Available Vehicles</h1>
                    </div>
                </div>
            </div>
            <div class="grid-parking-create">
                <div>
                    <div class="vp-structure">
                        <h1>Parking Spaces</h1>
                    </div>
                    <div class="grid-parking-buttons">
                        <button type="submit" class="button-system park-create-button">Park Vehicle</button>
                    </div>
                </div>
                <div class="grid-container grid-container-left"></div>
                <?php
                    $result = $conn->query("SELECT Parking_Space_ID, Parking_Departure_Date FROM parking WHERE Parking_Departure_Date IS NULL");
                    $parking_space_used = array();
                    if($result ->num_rows > 0){
                        while($row_parking_space = $result->fetch_assoc()){
                            array_push($parking_space_used, $row_parking_space['Parking_Space_ID']);
                        }
                    }
                ?>
            </div>
        </form>
    </div>
    <script>
        const parkingSpacesTotal = 10; // número de itens
        const parkingSpacesUsed = <?php echo json_encode($parking_space_used);?>; // itens usados
        const container = document.querySelector('.grid-container');
        let previousItem = null;
        let customer = null;
        let space=null;
        let table = document.querySelectorAll('.tbl-content');
        let numRowsTable = <?php echo $num_rows;?>;
        
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
</div>
<?php require "../structure/footer.php"?>