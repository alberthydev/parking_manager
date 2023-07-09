<?php require "../structure/header.php";?>
    <h1>New Customer</h1>
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
        <button class="button-system"><a href="customer.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>