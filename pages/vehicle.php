<?php
    session_start();
    require "../structure/header.php";
    include_once "../connection/connection.php";
?>

    <h1>Vehicles Page</h1>
    <table>
        <thead>
            <th><strong>#</strong></th>
            <th><strong>Nome</strong></th>
            <th><strong>Plate</strong></th>
            <th><strong>Registration Date</strong></th>
            <th><strong>Customer</strong></th>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT Vehicle_ID, Vehicle_Desc, Vehicle_Plate, Vehicle_Registration_Date, Customer_Name
            FROM vehicles JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
            ORDER BY vehicles.Vehicle_ID ASC;;");
            while($row_vehicle = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "  <td>". $row_vehicle['Vehicle_ID']. "</td>";
                echo "  <td>". $row_vehicle['Vehicle_Desc']. "</td>";
                echo "  <td>". $row_vehicle['Vehicle_Plate']. "</td>";
                echo "  <td>". $row_vehicle['Vehicle_Registration_Date']. "</td>";
                echo "  <td>". $row_vehicle['Customer_Name']. "</td>";
                echo "  <td><button><a href='vehicleEdit.php?Vehicle_ID=" . $row_vehicle['Vehicle_ID'] . 
                                "' style='text-decoration: none; color: black;'>Editar</a></button></td>";
                echo '  <td><button><a href="'.$_SERVER["PHP_SELF"].'?Vehicle_ID='.$row_vehicle["Vehicle_ID"].
                '&del=true" style="text-decoration: none; color: black;">Excluir</a></button></td>';
                echo "</tr>";
            }

            if(isset($_GET["del"]))
	        {
                $del_vehicle_ID = $_GET["Vehicle_ID"];
	        	$stmt = $conn->prepare("DELETE FROM vehicles WHERE Vehicle_ID = ?");
	        	$stmt->bind_param('i', $del_vehicle_ID);
	        	$stmt->execute();
                echo "<script>window.location.href='vehicle.php';</script>";
	        	exit;
	        }
            ?>
        </tbody>
    </table>
    <button><a href="vehicleCreate.php" style="text-decoration: none; color: black;">Create Vehicle</a></button>
    <button><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    
<?php require "../structure/footer.php"?>