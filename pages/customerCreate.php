<?php require "../structure/header.php";?>
<nav class="nav-menu">
    <img src="../img/logo.png" alt="logo PM - Parking Manager" class="logo">
    <div class="nav-buttons">
    <button class="button-system"><a href="customer.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
</nav>
<div class="create-edit-structure">
    <div>
        <div class="create-edit-text-structure">
            <h1>New Customer</h1>
        </div>
    </div>
    <div id="formulario">
        <form method="POST" id="form" onsubmit="createCustomer()" action="customer.php">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required>
            <label for="phone">Phone:</label>
            <input type="text" id="phone" name="phone" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required> 
            <button class="button-system" type="submit">Create Customer</button>
        </form>
    </div>
</div>
<?php require "../structure/footer.php"?>