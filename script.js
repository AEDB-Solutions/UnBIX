
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




    var x = document.getElementById("demo");

    function getLocation()
    {
        if (navigator.geolocation)
        {
            navigator.geolocation.getCurrentPosition(savePosition);
        } else
        {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
        return position;
    }

    function savePosition(position)
   {
    document.forms["lat"]["latitude"].value = position.coords.latitude;
    document.forms["long"]["longitude"].value = position.coords.longitude;
    }


function markerlocal() {
  var myLatLng = {lat: position.coords.latitude, lng: position.coords.longitude};

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: myLatLng
  });

  var marker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    title: 'Hello World!'
  });
}