<?php
    session_start();
    require "../structure/header.php";
    include_once "../connection/connection.php";

?>

    <h1>Customers Page</h1>
    <table>
        <td><strong>#</strong></td>
        <td><strong>Nome</strong></td>
        <td><strong>CPF</strong></td>
        <td><strong>Phone</strong></td>
        <td><strong>Address</strong></td>
        <td><strong>Registration Date</strong></td>
    <?php
        $result = $conn->query("SELECT * FROM customers");
        while($row_usuario = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "  <td>". $row_usuario['Customer_ID']. "</td>";
            echo "  <td>". $row_usuario['Customer_Name']. "</td>";
            echo "  <td>". $row_usuario['Customer_CPF']. "</td>";
            echo "  <td>". $row_usuario['Customer_Phone']. "</td>";
            echo "  <td>". $row_usuario['Customer_Address']. "</td>";
            echo "  <td>". $row_usuario['Customer_Registration_Date']. "</td>";
            echo "  <td><a href='customerEdit.php?Customer_ID=" . $row_usuario['Customer_ID'] . "'>Editar</a></td>";
            echo '  <td><a href="'.$_SERVER["PHP_SELF"].'?Customer_ID='.$row_usuario["Customer_ID"].'&del=true">Excluir</a>';
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
    <button><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    
<?php require "../structure/footer.php"?>