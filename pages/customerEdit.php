<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php";

    $Customer_ID= filter_input(INPUT_GET, 'Customer_ID', FILTER_SANITIZE_NUMBER_INT);
    $result = $conn->query("SELECT * FROM customers WHERE Customer_ID = '$Customer_ID'");
    $row_customer = mysqli_fetch_assoc($result);
?>
<nav class="nav-menu">
    <img src="../img/logo.png" alt="logo PM - Parking Manager" class="logo">
    <div class="nav-buttons">
        <button class="button-system"><a href="customer.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
</nav>
<div class="create-edit-structure">
    <div>
        <div class="create-edit-text-structure">
            <h1>Edit <?php echo $row_customer['Customer_Name']?></h1>
        </div>
    </div>
    <div id="formulario">
        <form method="POST" id="form" onsubmit="editCustomer()" action="customer.php">
            <input type="hidden" id="id" name="id" value="<?php echo $row_customer['Customer_ID']; ?>">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="<?php echo $row_customer['Customer_Name'];?>">
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required value="<?php echo $row_customer['Customer_Phone'];?>">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required value="<?php echo $row_customer['Customer_Address'];?>"> 
            <button type="submit" class="button-system">Save Customer</button>
            <button onclick="deleteCustomer()" class="button-delete">Delete</button>
        </form>
    </div>
</div>
<?php require "../structure/footer.php"?>