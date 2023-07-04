<?php
    session_start();
    require "../structure/header.php";
    include_once "../connection/connection.php";

?>

    <h1>Customers Page</h1>
    <table>
        <tr>
            <th><strong>#</strong></th>
            <th><strong>Nome</strong></th>
            <th><strong>CPF</strong></th>
            <th><strong>Phone</strong></th>
            <th><strong>Address</strong></th>
            <th><strong>Registration Date</strong></th>
        </tr>
    <?php
        $result = $conn->query("SELECT * FROM customers");
        while($row_customer = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "  <td>". $row_customer['Customer_ID']. "</td>";
            echo "  <td>". $row_customer['Customer_Name']. "</td>";
            echo "  <td>". $row_customer['Customer_CPF']. "</td>";
            echo "  <td>". $row_customer['Customer_Phone']. "</td>";
            echo "  <td>". $row_customer['Customer_Address']. "</td>";
            echo "  <td>". $row_customer['Customer_Registration_Date']. "</td>";
            echo "  <td><button><a href='customerEdit.php?Customer_ID=" . $row_customer['Customer_ID'] . 
                            "' style='text-decoration: none; color: black;'>Editar</a></button></td>";
            echo '  <td><button><a href="'.$_SERVER["PHP_SELF"].'?Customer_ID='.$row_customer["Customer_ID"].
            '&del=true" style="text-decoration: none; color: black;">Excluir</a></button></td>';
            echo "</tr>";
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
    </table>
    <button><a href="customerCreate.php" style="text-decoration: none; color: black;">Create Customer</a></button>
    <button><a href="vehicleCreate.php" style="text-decoration: none; color: black;">Create Vehicle</a></button>
    <button><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    
<?php require "../structure/footer.php"?>