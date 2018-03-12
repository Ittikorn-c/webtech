//header
function showHead(str) {
    $.ajax({
        type: "GET",
        url: "getHead.php",
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