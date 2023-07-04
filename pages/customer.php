<?php 
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
    </table>
    <button><a href="customerCreate.php" style="text-decoration: none; color: black;">Create Customer</a></button>
    <button><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
    <?php
        $result_usuarios = "SELECT * FROM custormers";
        $resultado_usuarios = mysqli_query($conn, $result_usuarios);
        echo $resultado_usuarios;
        // while($row_usuario = mysqli_fetch_assoc($resultado_usuarios)){
        //     // echo "<tr>";
        //     echo "ID: ". $row_usuario['Customer_ID']. "<br>";
        //     // echo "  <td>". $row_usuario['Customer_Name']. "</td>";
        //     // echo "  <td>". $row_usuario['Customer_CPF']. "</td>";
        //     // echo "  <td>". $row_usuario['Customer_Phone']. "</td>";
        //     // echo "  <td>". $row_usuario['Customer_Address']. "</td>";
        //     // echo "  <td>". $row_usuario['Customer_Registration_Date']. "</td>";
        //     // echo "</tr>";
        // }
    ?>
    
<?php require "../structure/footer.php"?>