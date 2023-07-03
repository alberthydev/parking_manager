<?php require "../structure/header.php";?>
    <h1>New Customers</h1>
    <form method="post" id="form">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-field">
        <label for="cpf">CPF</label>
        <input type="text" name="cpf" id="cpf" class="form-field">
        <label for="phone">Phone</label>
        <input type="tel" name="phone" id="phone" class="form-field">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" class="form-field">
    </form>
    <button onclick="createCustomer()">Create</button>
    <button><a href="customer.php" style="text-decoration: none; color: black;">Back</a></button>
    <script>
        function createCustomer() {
            $.ajax({
                type: "POST",
                url: "../functions/customersFunction.php",
                data: $("#form").serialize(),
                success: (response) => {
                    console.log("Sending data");
                    console.log(response);
                }
            });
        }
    </script>
<?php require "../structure/footer.php"?>