<?php
    session_start();
    require "../structure/header.php";
    include_once "../connection/connection.php";

?>
<h1>Customers Page</h1>
<div>
<div class="tbl-header">
    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>CPF</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Registration Date</th>
            <th>Vehicle</th>
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
                        echo "  <td>". $row_customer['Customer_ID']. "</td>";
                        echo "  <td>". $row_customer['Customer_Name']. "</td>";
                        echo "  <td>". $row_customer['Customer_CPF']. "</td>";
                        echo "  <td>". $row_customer['Customer_Phone']. "</td>";
                        echo "  <td>". $row_customer['Customer_Address']. "</td>";
                        echo "  <td>". $row_customer['Customer_Registration_Date']. "</td>";
                        if(isset($row_customer['Vehicle_Desc'])){
                            echo "  <td>". $row_customer['Vehicle_Desc']. "</td>";
                        }else{
                            echo "  <td>No Cars Found</td>";
                        }
                        echo "  <td><button class='button-pay'><a href='customerEdit.php?Customer_ID=" . $row_customer['Customer_ID'] . 
                                        "' style='text-decoration: none; color: black;'>Editar</a></button></td>";
                        echo '  <td><button class="button-delete"><a href="'.$_SERVER["PHP_SELF"].'?Customer_ID='.$row_customer["Customer_ID"].
                        '&del=true" style="text-decoration: none; color: black;">Excluir</a></button></td>';
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
<script>
    let table = document.querySelector('.tbl-content');
    let numRowsTable = <?php echo $num_rows;?>;
    if(numRowsTable>=4){
        table.classList.add('fixo');
    }else{
        table.classList.remove('fixo');
    }
</script>
<button class="button-system"><a href="customerCreate.php">Create Customer</a></button>
<button class="button-system"><a href="vehicleCreate.php">Create Vehicle</a></button>
<button class="button-system"><a href="index.php">Back</a></button>
    
<?php require "../structure/footer.php"?>