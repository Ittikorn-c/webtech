function disable(type){
	if (type == "free"){
		document.getElementById("price").value = 0;
		document.getElementById("price").readOnly = true;
		console.log("This event is free");
	}
	else{
		document.getElementById("price").readOnly = false;
		console.log("This event is not free");
	}
}

//header
function showHead(str) {
    $.ajax({
        type: "GET",
        url: "php/getHead.php",
        success: function(response){
            if (str=="") {
                return;
              }
            else{
                $('#buttonUser').html(response);
            }
        }
    });
}