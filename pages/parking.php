<?php 
    require "../structure/header.php";
    include_once "../connection/connection.php"
?>

    <h1>Parking</h1>
    <div id="vehicles_parked">
        <h2>Vehicles Parked</h2>
    </div>
    <div id="parking-spaces">
        <h2>Parking Spaces</h1>
        <div>
            <p><a href="parkingSpace.php?space=1" style="text-decoration: none; color: black;">Parking Space 1</a></p>
        </div>
        <div>
            <p><a href="parkingSpace.php?space=2" style="text-decoration: none; color: black;">Parking Space 2</a></p>
        </div>
        <div>
            <p><a href="parkingSpace.php?space=3" style="text-decoration: none; color: black;">Parking Space 3</a></p>
        </div>
    </div>

    <button><a href="parkingCreate.php" style="text-decoration: none; color: black;">Park a car</a></button>
<?php
    require "../structure/footer.php"
?>