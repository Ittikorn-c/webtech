//events
function showUEvent() {
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText != "ERROR"){
              console.log("OK");
              document.getElementById("events").innerHTML = this.responseText;
          }
      }
  };
  xmlhttp.open("GET","get-upcoming-event-user.php",true);
  xmlhttp.send();
}

function showPEvent() {
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText != "ERROR"){
              console.log("OK");
              document.getElementById("events").innerHTML = this.responseText;
          }
      }
  };
  xmlhttp.open("GET","get-previous-event-user.php",true);
  xmlhttp.send();
}

function showUEventO() {
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText != "ERROR"){
              console.log("OK");
              document.getElementById("events").innerHTML = this.responseText;
          }
      }
  };
  xmlhttp.open("GET","get-upcoming-event-organizer.php",true);
  xmlhttp.send();
}

function showPEventO() {
  if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp = new XMLHttpRequest();
  } else {
      // code for IE6, IE5
      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          if(this.responseText != "ERROR"){
              console.log("OK");
              document.getElementById("events").innerHTML = this.responseText;
          }
      }
  };
  xmlhttp.open("GET","get-previous-event-organizer.php",true);
  xmlhttp.send();
}

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
