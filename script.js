
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
        var position = event.latLng;
      console.log(position)
        marker = new google.maps.Marker({
          position: position,
          map: map,
          animation: google.maps.Animation.DROP,
          draggable: true
          });
        document.getElementById('lat').value = position.lat();
        document.getElementById('long').value = position.lng();
        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
          document.getElementById('form').style = 'display:block';
        });
      });
    }




    var x = document.getElementById("demo");



    var savePosition = function (position)
    {
        console.log("oi parte 2")
        document.getElementById('currentLat').value = position.coords.latitude;
        document.getElementById('currentLon').value = position.coords.longitude;
        marker = new google.maps.Marker({
          position: position,
          map: map,
          animation: google.maps.Animation.DROP,
          draggable: true
        })
    }

    function getLocation()
    {

        if (navigator.geolocation)
        {
            console.log("oi porra")
            navigator.geolocation.getCurrentPosition(savePosition);

        } else
        {
            x.innerHTML = "Geolocation is not supported by this browser.";
        }
    }
