<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";

    $Customer_ID= filter_input(INPUT_GET, 'Customer_ID', FILTER_SANITIZE_NUMBER_INT);
    $result = $conn->query("SELECT * FROM customers WHERE Customer_ID = '$Customer_ID'");
    $row_usuario = mysqli_fetch_assoc($result);
?>
    <h1>Edit <?php echo $row_usuario['Customer_Name']?></h1>
    <div id="formulario">
        <form method="POST" id="form" onsubmit="editCustomer()" action="customer.php">
            <input type="hidden" id="id" name="id" value="<?php echo $row_usuario['Customer_ID']; ?>">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required value="<?php echo $row_usuario['Customer_Name'];?>">
            <label for="phone">Telefone:</label>
            <input type="text" id="phone" name="phone" required value="<?php echo $row_usuario['Customer_Phone'];?>">
            <label for="address">Endereço:</label>
            <input type="text" id="address" name="address" required value="<?php echo $row_usuario['Customer_Address'];?>"> 
            <button type="submit">Save</button>
        </form>
        <button onclick="deleteCustomer()">Delete</button>
        <button><a href="customer.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>