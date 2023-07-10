$(window).on("load resize ", function() {
    let scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
    $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();

function park(customer, space){
    if (customer!=null && space != null) {
        $.ajax({
            type: "POST",
            url: "../functions/parkingFunction.php",
            data: $('form').serialize() + "&customer_id="+customer+"&parking_space="+space+"&func=park",
            success: (response) => {
                console.log(response);
                console.log("Sending data");
                if(response){
                    alert("Vehicle has been Parked");
                    window.location.href = "index.php";
                }else{
                    alert("Error");
                }
            }
        })
      } else {
        alert("Error, verify the available options");
        window.location.href = "parkingCreate.php";
      }      
    
}

function payParking(vehicle){
    $.ajax({
        type: "POST",
        url: "../functions/parkingFunction.php",
        data: {
            vehicle_id: vehicle,
            func: "pay"
        },
        success: (response) => {
            console.log(response);
            console.log("Sending data");
            if(response){
                alert("Vehicle has been paid");
                window.location.href="index.php";
            }else{
                alert("Error");
            }
        }
    })
}

function createCustomer() {
    $.ajax({
        type: "POST",
        url: "../functions/customersFunction.php",
        data: $('form').serialize() + "&func=create",
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

