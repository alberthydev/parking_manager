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
                <table>
                    <thead>
                        <legend>Registered Customers</legend>
                        <th>#</th>
                        <th>Customer</th>
                    </thead>
                    <tbody>
                        <?php
                            $result = $conn->query("SELECT * FROM customers");
                            while($row_customer = mysqli_fetch_assoc($result)){
                                echo "<tr>";
                                echo "  <td><input type='radio' name='customer_id' value=".$row_customer['Customer_ID']." required>". $row_customer['Customer_ID']. "</td>";
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
            <button type="submit">Create Vehicle</button>
        </form>
        <button><a href="vehicle.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>