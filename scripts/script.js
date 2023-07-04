function createCustomer() {
    $.ajax({
        type: "POST",
        url: "../functions/customersFunction.php?function=create",
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