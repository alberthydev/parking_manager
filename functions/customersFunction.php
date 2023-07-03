<?php
    require "../connection/connection.php";

    function teste1($conn){
        $teste="Deu Certo";
        $stmt = $conn->prepare("insert into teste (teste) values (?)");

        $stmt->bind_param('s', $teste);

        $stmt->execute();

        echo "Everything works\n";
    }

    function teste2($conn){
        $teste="Deu Certo 2";
        $stmt = $conn->prepare("insert into teste (teste) values (?)");

        $stmt->bind_param('s', $teste);

        $stmt->execute();

        echo "Everything works 2\n";
    }

    if(isset($_GET['teste'])){
        if($_GET['teste'] == 'teste1'){
            teste1($conn);
        }
    }

    if(isset($_GET['teste'])){
        if($_GET['teste'] == 'teste2'){
            teste2($conn);
        }
    }
?>