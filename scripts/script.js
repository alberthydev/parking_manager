function createCustomer() {
    $.ajax({
        type: "POST",
        url: "../functions/customersFunction.php",
        data: $(form).serialize() + "&func=create",
        success: (response) => {
            console.log(response);
            console.log("Sending data");
            if(response){
                alert("Customer resgistration successful")
            }else{
                alert("Error");
            }
        }
    });
}

function editCustomer() {
    $.ajax({
        type: "POST",
        url: "../functions/customersFunction.php",
        data: $(form).serialize() + "&func=edit",
        success: (response) => {
            console.log(response);
            console.log("Sending data");
            if(response){
                alert("Customer was updated successfully")
            }else{
                alert("Error");
            }
        }
    });
}

function deleteCustomer() {
    $.ajax({
        type: "POST",
        url: "../functions/customersFunction.php",
        data: $(form).serialize() + "&func=delete",
        success: (response) => {
            console.log(response);
            console.log("Sending data");
            if(response){
                alert("Customer was deleted successfully")
                window.location.href='customer.php';
            }else{
                alert("Error");
            }
        }
    });
}

function createVehicle() {
    $.ajax({
        type: "POST",
        url: "../functions/vehicleFunction.php",
        data: $(form).serialize() + "&func=create",
        success: (response) => {
            console.log(response);
            console.log("Sending data");
            if(response){
                alert("Registred New Vehicle")
            }else{
                alert("Error");
            }
        }
    });
}

function editVehicle() {
    $.ajax({
        type: "POST",
        url: "../functions/vehicleFunction.php",
        data: $(form).serialize() + "&func=edit",
        success: (response) => {
            console.log(response);
            console.log("Sending data");
            if(response){
                alert("Updated Vehicle")
            }else{
                alert("Error");
            }
        }
    });
}

function deleteVehicle() {
    $.ajax({
        type: "POST",
        url: "../functions/vehicleFunction.php",
        data: $(form).serialize() + "&func=delete",
        success: (response) => {
            console.log(response);
            console.log("Sending data");
            if(response){
                alert("Vehicle deleted successfully");
                window.location.href='vehicle.php';
            }else{
                alert("Error");
            }
        }
    });
}