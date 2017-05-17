
function initMap() {
  var options = {
      center: {
        lat: -15.764114,
        lng: -47.870709
      },
      zoom: 17,
      scrollwheel: false,
      disableDefaultUI: true,
      maxZoom: 17,
      minZoom: 17
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), options);

  var marker;
  var infowindow;
  var messagewindow;


      infowindow = new google.maps.InfoWindow({
        content: document.getElementById('form')
      })

      messagewindow = new google.maps.InfoWindow({
        content: document.getElementById('message')
      });

      google.maps.event.addListener(map, 'click', function(event) {
        marker = new google.maps.Marker({
          position: event.latLng,
          map: map,
          animation: google.maps.Animation.DROP,
          draggable: true
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
          document.getElementById('form').style = 'display:block';
        });
      });
    }




    

function geoFindMe() {
  // var output = document.getElementById("out");
  var x = document.getElementById("demo");
  if (navigator.geolocation){
   navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else {
    x.innerHTML = "Tente novamente em outro Browser com suporte a localização."
  }
}

function showPosition(position) {
    lat = position.coords.latitude;
    lon = position.coords.longitude;
    latlon = new google.maps.LatLng(lat, lon)
   
    var marker = new google.maps.Marker({position:latlon,map:map,title:"You are here!"});
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred."
            break;
    }
}
  
function CreateLocalMarker(latlon){
  var marker = new google.maps.Marker({position: latlon,map: map,animation: google.maps.Animation.DROP})



}