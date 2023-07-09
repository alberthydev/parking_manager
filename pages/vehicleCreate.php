<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";    
?>
    <h1>New Vehicle</h1>
    <div id="formulario">
        <form method="POST" id="form" onsubmit="createVehicle()" action="vehicle.php">
            <label for="desc">Nome:</label>
            <input type="text" id="desc" name="desc" required>
            <label for="plate">Placa:</label>
            <input type="text" id="plate" name="plate" required>
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
                                        echo "  <td><input type='radio' name='customer_id' value=".$row_customer['Customer_ID']." required></td>";
                                        echo "  <td>". $row_customer['Customer_Name']. "</td>";
                                    }
                                }else{
                                    echo "<tr><td>No customers registred</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <script>
                let numRowsTable = <?php echo $num_rows;?>;
                if(numRowsTable>=4){
                    table.classList.add('fixo');
                }else{
                    table.classList.remove('fixo');
                }
            </script>
            <button class="button-pay"><a href="customerCreate.php" style="text-decoration: none; color: black;">Add</a></button>
            <button type="submit" class="button-system">Create Vehicle</button>
        </form>
        <button class="button-system"><a href="vehicle.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>