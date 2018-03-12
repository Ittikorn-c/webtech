//header
function showHead() {
    $.ajax({
        type: "GET",
        url: "php/getHead.php",
        success: function(response){
            if (response=="") {
                return;
              } 
            else{
                $('#buttonUser').html(response);
            }
        }
    });
}

//loginbox
function getBox(str) {
    $.ajax({
        type: "GET",
        url: str+".html",
        success: function(response){
            
            if (str=="OK") {
                return;
              } 
            else{
                $('#'+str).html(response);
            }
        }
    });

}

//getEvent
function showEvent(doc,str) {
    $.ajax({
        type: "GET",
        url: "php/showevent.php?q="+str,
        success: function(response){
            console.log("OK");
            if (str=="") {
                return;
              } 
            else{
                $('#'+doc).html(response);

            }
        }
    });


}

//search
function search(){
    var text = document.getElementById("textsearch").value;
    console.log(text);
    $.ajax({
        type: "GET",
        url: "php/searchevent.php?event="+text,
        success: function(response){
            console.log("OK");
            if (text=="") {
                return;
              } 
            else{
                $('#event').html(response);
            }
        }
    });
}

//slide show
function slideshow(){
    $.ajax({
        type: "GET",
        url: "php/getSlideShow.php",
        success: function(response){
            $('#slideshow').html(response);
        }
    });
} 