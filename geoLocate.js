//document.addEventListener("DOMContentLoaded", createRequest);


	
function initMap(){
var myLat;
var myLon;

	var mac1 = document.getElementById("macForm").elements.namedItem("mac1").value;
	var mac2 = document.getElementById("macForm").elements.namedItem("mac2").value;
     var req = new XMLHttpRequest();
     var key = "AIzaSyBi5WiwpTdn9kACD9XKV2uWvvYnZVK848o";
     req.open("POST", "https://www.googleapis.com/geolocation/v1/geolocate?key=" + key, false);
     req.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
     req.send(JSON.stringify({  "considerIp": "false",
          "wifiAccessPoints": [
            {
				"macAddress": mac1,
            },
            {
				"macAddress": mac2,
            }
          ]}));
	
     var responseInfo = JSON.parse(req.responseText);
     console.log(responseInfo);

    myLat = responseInfo.location.lat;
    myLon = responseInfo.location.lng;

     console.log(myLat);
     console.log(myLon);

     document.getElementById("lat").innerHTML = responseInfo.location.lat;
     document.getElementById("long").innerHTML = responseInfo.location.lng;
	 
	 var petLoc = {lat: myLat, lng: myLon};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 18,
          center: petLoc
        });
        var marker = new google.maps.Marker({
          position: petLoc,
          map: map
        });

}

/*
      function initMap() {
        var petLoc = {lat: myLat, lng: myLon};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: petLoc
        });
        var marker = new google.maps.Marker({
          position: petLoc,
          map: map
        });
      }

*/