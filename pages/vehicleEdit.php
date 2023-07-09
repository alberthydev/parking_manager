<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";

    $Vehicle_ID= filter_input(INPUT_GET, 'Vehicle_ID', FILTER_SANITIZE_NUMBER_INT);
    $resultV = $conn->query("SELECT * FROM vehicles WHERE Vehicle_ID = '$Vehicle_ID'");
    $row_vehicle = mysqli_fetch_assoc($resultV);
?>
    <h1>Edit <?php echo $row_vehicle['Vehicle_Desc']?></h1>
    <div id="formulario">
        <form method="POST" id="form" onsubmit="editVehicle()" action="vehicle.php">
            <input type="hidden" id="id" name="id" value="<?php echo $row_vehicle['Vehicle_ID']; ?>">
            <label for="desc">Nome:</label>
            <input type="text" id="desc" name="desc" required value="<?php echo $row_vehicle['Vehicle_Desc'];?>">
            <label for="plate">Placa:</label>
            <input type="text" id="plate" name="plate" required value="<?php echo $row_vehicle['Vehicle_Plate']?>">
            <div>
                <div class="tbl-header">
                    <table>
                        <thead>
                            <th>#</th>
                            <th>Customer</th>
                        </thead>
                    </table>
                </div>
                <div class="tbl-content">
                    <table>
                        <tbody>
                            <?php
                                $result = $conn->query("SELECT * FROM customers ORDER BY Customer_ID ASC;");
                                $num_rows = mysqli_num_rows($result);
                                if($num_rows>0){
                                    while($row_customer = mysqli_fetch_assoc($result)){
                                        echo "<tr>";
                                        if($row_customer['Customer_ID']==$row_vehicle['Customer_ID']){
                                            echo "  <td><input type='radio' checked name='customer_id' value=".$row_customer['Customer_ID']
                                            ." required>". $row_customer['Customer_ID']. "</td>";
                                        }else{
                                            echo "  <td><input type='radio' name='customer_id' value=".$row_customer['Customer_ID']
                                            ." required></td>";
                                        }
                                        echo "  <td>". $row_customer['Customer_Name']. "</td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<tr><td>No customers registred</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <button type="submit" class="button-system">Save Vehicle</button>
        </form>
        <script>
            let numRowsTable = <?php echo $num_rows;?>;
            if(numRowsTable>=4){
                table.classList.add('fixo');
            }else{
                table.classList.remove('fixo');
            }
        </script>
        <button onclick="deleteVehicle()" class="button-delete">Delete</button>
        <button class="button-system"><a href="vehicle.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>