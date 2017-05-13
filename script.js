
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
    }

    function savePosition(position)
    {
        document.getElementById('lat').value = position.coords.latitude;
        document.getElementById('long').value = position.coords.longitude;
    }
        