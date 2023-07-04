<?php require "../structure/header.php";?>
    <h1>New Customers</h1>
    <div id="formulario">
        <form method="POST" id="form" onsubmit="createCustomer()">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" required>
            <label for="phone">Telefone:</label>
            <input type="text" id="phone" name="phone" required>
            <label for="address">Endereço:</label>
            <input type="text" id="address" name="address" required> 
            <button type="submit">Create</button>
        </form>
        <button><a href="customer.php" style="text-decoration: none; color: black;">Back</a></button>
    </div>
<?php require "../structure/footer.php"?>