<?php
    session_start();
    require "../structure/header.php";
    include_once "../connection/connection.php";
?>
<nav class="nav-menu">
    <img src="../img/logo.png" alt="logo PM - Parking Manager" class="logo">
    <div class="nav-buttons">
    <button class="button-system"><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
</nav>
<div class="information">
    <div>
        <div class="info-structure">
            <h1>Vehicles Page</h1>
        </div>
        <button class="button-system info-button"><a href="vehicleCreate.php" style="text-decoration: none; color: black;">Create Vehicle</a></button>
    </div>
    <div class="vehicle-table-right">
        <div class="tbl-header">
            <table>
                <thead>
                    <th>#</th>
                    <th>Nome</th>
                    <th>License Plate</th>
                    <th>Registration Date</th>
                    <th>Customer</th>
                    <th></th>
                    <th></th>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT Vehicle_ID, Vehicle_Desc, Vehicle_Plate, Vehicle_Registration_Date, Customer_Name
                    FROM vehicles JOIN customers ON vehicles.Customer_ID = customers.Customer_ID
                    ORDER BY vehicles.Vehicle_ID ASC;;");
                    $num_rows = mysqli_num_rows($result);
                    if($num_rows>0){
                        while($row_vehicle = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "  <td>". $row_vehicle['Vehicle_ID']. "</td>";
                            echo "  <td>". $row_vehicle['Vehicle_Desc']. "</td>";
                            echo "  <td>". $row_vehicle['Vehicle_Plate']. "</td>";
                            echo "  <td>". $row_vehicle['Vehicle_Registration_Date']. "</td>";
                            echo "  <td>". $row_vehicle['Customer_Name']. "</td>";
                            echo "  <td><button class='button-pay info-bt'><a href='vehicleEdit.php?Vehicle_ID=" . $row_vehicle['Vehicle_ID'] . 
                                            "'>Edit</a></button></td>";
                            echo '  <td><button class="button-delete info-bt"><a href="'.$_SERVER["PHP_SELF"].'?Vehicle_ID='.$row_vehicle["Vehicle_ID"].
                            '&del=true">Delete</a></button></td>';
                            echo "</tr>";
                        }
                    }else{
                        echo "<tr><td>No vehicles registred</td></tr>";
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
        </div>
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