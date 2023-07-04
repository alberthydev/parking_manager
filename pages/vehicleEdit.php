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
                <table>
                    <thead>
                        <legend>Registered Customers</legend>
                        <th>#</th>
                        <th>Customer</th>
                    </thead>
                    <tbody>
                        <?php
                            $resultC = $conn->query("SELECT * FROM customers");
                            while($row_customer = mysqli_fetch_assoc($resultC)){
                                echo "<tr>";
                                if($row_customer['Customer_ID']==$row_vehicle['Customer_ID']){
                                    echo "  <td><input type='radio' checked name='customer_id' value=".$row_customer['Customer_ID']
                                    ." required>". $row_customer['Customer_ID']. "</td>";
                                }else{
                                    echo "  <td><input type='radio' name='customer_id' value=".$row_customer['Customer_ID']
                                    ." required>". $row_customer['Customer_ID']. "</td>";
                                }
                                echo "  <td>". $row_customer['Customer_Name']. "</td>";
                                echo "  <td><button><a href='customerEdit.php?Customer_ID=" . $row_customer['Customer_ID'] . 
                                "' style='text-decoration: none; color: black;'>Editar</a></button></td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <button><a href="customerCreate.php" style="text-decoration: none; color: black;">Add</a></button>
            </div>
            <button type="submit">Save Vehicle</button>
        </form>
        <button onclick="deleteVehicle()">Delete</button>
        <button><a href="vehicle.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>