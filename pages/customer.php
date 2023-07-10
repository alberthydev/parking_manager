<?php
    session_start();
    require "../structure/header.php";
    include_once "../connection/connection.php";

?>
<nav class="nav-menu">
    <img src="../img/logo.png" alt="logo PM - Parking Manager" class="logo">
    <div class="nav-buttons">
        <button class="button-system"><a href="vehicleCreate.php">Create Vehicle</a></button>
        <button class="button-system"><a href="index.php">Back</a></button>
    </div>
</nav>
<div class="information">
    <div>
        <div class="info-structure">
            <h1>Custumer Create</h1>
        </div>
        <button class="button-system info-button"><a href="customerCreate.php">Create Customer</a></button>
    </div>
    <div class="vehicle-table-right">
        <div class="tbl-header">
            <table>
                <tr>
                    <th class="row-small-font">#</th>
                    <th class="row-small-font">Name</th>
                    <th class="row-small-font">CPF</th>
                    <th class="row-small-font">Phone</th>
                    <th class="row-small-font">Address</th>
                    <th class="row-small-font">Registration Date</th>
                    <th class="row-small-font">Vehicle</th>
                    <th></th>
                    <th></th>
                </tr>
            </table>
        </div>
        <div id="tbl-content-fixo" class="tbl-content">
            <table>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT customers.Customer_ID, Customer_Name, Customer_CPF, Customer_Phone, Customer_Address, Customer_Registration_Date,
                    Vehicle_Desc FROM customers LEFT JOIN vehicles ON customers.Customer_ID = vehicles.Customer_ID
                    ORDER BY customers.Customer_ID ASC;");
                    $num_rows = mysqli_num_rows($result);
                    if($num_rows>0){
                        while($row_customer = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "  <td class='row-small-font'>". $row_customer['Customer_ID']. "</td>";
                            echo "  <td class='row-small-font'>". $row_customer['Customer_Name']. "</td>";
                            echo "  <td class='row-small-font'>". $row_customer['Customer_CPF']. "</td>";
                            echo "  <td class='row-small-font'>". $row_customer['Customer_Phone']. "</td>";
                            echo "  <td class='row-small-font'>". $row_customer['Customer_Address']. "</td>";
                            echo "  <td class='row-small-font'>". $row_customer['Customer_Registration_Date']. "</td>";
                            if(isset($row_customer['Vehicle_Desc'])){
                                echo "  <td class='row-small-font'>". $row_customer['Vehicle_Desc']. "</td>";
                            }else{
                                echo "  <td class='row-small-font'>No Cars Found</td>";
                            }
                            echo "  <td ><button class='button-pay info-bt'><a href='customerEdit.php?Customer_ID=" . $row_customer['Customer_ID'] . 
                                            "' class='row-small-font'>EDIT</a></button></td>";
                            echo '  <td><button class="button-delete info-bt"><a href="'.$_SERVER["PHP_SELF"].'?Customer_ID='.$row_customer["Customer_ID"].
                            '&del=true" class="row-small-font">DELETE</a></button></td>';
                            echo "</tr>";
                        }
                    }else{
                        echo "<tr><td>No customers registred</td></tr>";
                    }

                    if(isset($_GET["del"]))
        	        {
                        $del_customer_ID = $_GET["Customer_ID"];
        	        	$stmt = $conn->prepare("DELETE FROM customers WHERE Customer_ID = ?");
        	        	$stmt->bind_param('i', $del_customer_ID);
        	        	$stmt->execute();
                        echo "<script>window.location.href='customer.php';</script>";
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
    if(numRowsTable>=3){
        table.classList.add('fixo');
    }else{
        table.classList.remove('fixo');
    }
</script>    
<?php require "../structure/footer.php"?>