<?php require "../structure/header.php";?>
    <h1>Customers Page</h1>
    <button onclick="callPHP('teste1')" class="choice">Teste 1</button>
    <button onclick="callPHP('teste2')" class="choice">Teste 2</button>
    <script>
        function callPHP(teste) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                }
            };
            xhttp.open("POST", "../functions/customersFunction.php?teste="+teste, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send();
        }   
    </script>
<?php require "../structure/footer.php"?>