function setID(id){
   document.getElementById("idEvent").value = id;
   document.getElementById("join").value = id;
   $('#idEvent').hide();
   $('#join').hide();
}
function formatDate(date) {
    var monthNames = [
        "January", "February", "March",
        "April", "May", "June", "July",
        "August", "September", "October",
        "November", "December"
    ];

    var day = date.getDate();
    var monthIndex = date.getMonth();
    var year = date.getFullYear();

    return day + ' ' + monthNames[monthIndex] + ' ' + year;
}

function getevent(str){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
    	   console.log(this.responseText);
            var myObj = JSON.parse(this.responseText);
            document.getElementById("eventName").innerHTML = myObj.name;
            document.getElementById("eventSize").innerHTML = "Event size: "+myObj.size+" People";
            document.getElementById("cat").innerHTML = "Category: "+myObj.cat;
            document.getElementById("location").innerHTML = "Location: "+myObj.location;
            date = formatDate(new Date(myObj.date));
            start = myObj.start.substring(0, 5);
            end = myObj.end.substring(0, 5);
            document.getElementById("date").innerHTML = "Date&Time: "+date+" ("+start+" - "+end+")";
            document.getElementById("invitation").innerHTML = myObj.invite;
            document.getElementById('detail').innerHTML = "Event detail:\n"+myObj.detail;

            lat = myObj.lat;
            lng = myObj.lng;

            pic = myObj.poster;
            $('#poster').attr("src", pic);

            if (myObj.video === ""){
        	   $('#video').hide();
            }else{
        	   $('#video').attr("src", myObj.video);
            }

            if (myObj.type == "free"){
                document.getElementById('price').innerHTML = "Price: Free";
            }else{
                document.getElementById('price').innerHTML = "Price: "+myObj.price+" Baht";
            }

            if (myObj.condition === ""){
                $('#pre-condition').hide();
            }else{
                document.getElementById('condition').href = myObj.condition;
            }

            if (lat == "" || lng == ""){
                $('#map').hide();
            }else{
                setMap(lat, lng);
            }
        }
    };
    xmlhttp.open("GET", "./php/setEvent.php?event="+str, true);
    xmlhttp.send();
}

function setMap(lat, lng) {
    console.log(lat);
        var myLatLng = {lat: Number(lat), lng: Number(lng)};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 15,
          center: myLatLng
        });

        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          
        });
}

function showComment(str){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            document.getElementById("showComment").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "./php/showComment.php?event="+str, true);
    xmlhttp.send();           
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