<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";    
?>
<nav class="nav-menu">
    <img src="../img/logo.png" alt="logo PM - Parking Manager" class="logo">
    <div class="nav-buttons">
        <button class="button-system"><a href="vehicle.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
</nav>
<div class="create-edit-structure">
    <div>
        <div class="create-edit-text-structure">
                <h1>New Vehicle</h1>
        </div>
    </div>
    <div id="formulario">
        <form method="POST" id="form" onsubmit="createVehicle()" action="vehicle.php">
            <label for="desc">Name:</label>
            <input type="text" id="desc" name="desc" required>
            <label for="plate">License Plate:</label>
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
            <button type="submit" class="button-system">Create Vehicle</button>
        </form>
    </div>
</div>

<script>
    let table = document.querySelector('.tbl-content');
    let numRowsTable = <?php echo $num_rows;?>;
    if(numRowsTable>=4){
        table.classList.add('fixo');
    }else{
        table.classList.remove('fixo');
    }
</script>
<?php require "../structure/footer.php"?>