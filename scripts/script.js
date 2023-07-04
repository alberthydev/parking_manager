function createCustomer() {
    $.ajax({
        type: "POST",
        url: "../functions/customersFunction.php",
        data: $(form).serialize(),
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