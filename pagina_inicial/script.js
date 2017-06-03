
function initMap() 
{
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

    load_on_map(map,"http://localhost/UNBIX/chega2/pagina_inicial/key_points_json.php");
    //load_on_map(map,"http://localhost/UNBIX/chega2/pagina_inicial/all_complaints.php")
    map_events(map);
    //user_current_location(map);

}

function map_events(map)
{
        var marker;
        var infowindow;
        var messagewindow;
        var wind;
    
      infowindow = new google.maps.InfoWindow({
        content: document.getElementById('form')
      })

      messagewindow = new google.maps.InfoWindow({
        content: document.getElementById('message')
      });

      google.maps.event.addListener(map, 'click', function(event) {
        var position = event.latLng;
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

//------------------------------------------pegar localização----------------------------------


function user_current_location(map)
{
        //dica para integrar os dois mapas em um .Usem a linha abaixo e tentem mudar o index;
        //document.getElementById("user_pos").addEventListener("click",getLocation(map));
}


function getLocation() 
{
        console.log("oi");
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
        var wind = new google.maps.InfoWindow({map: map});

        if (navigator.geolocation) {
             navigator.geolocation.getCurrentPosition(function(position) {
               var pos = {
                 lat: position.coords.latitude,
                 lng: position.coords.longitude
               };

               var marker = new google.maps.Marker({
                 position: pos,
                 map: map,
                 animation: google.maps.Animation.DROP,
                 draggable: true
                 });
               map.setCenter(pos);
             }, function() {
               handleLocationError(true, infoWindow, map.getCenter());
             });
           } else {
             // Browser doesn't support Geolocation
             handleLocationError(false, infoWindow, map.getCenter());
           }


         function handleLocationError(browserHasGeolocation, infoWindow, pos) {
           wind.setPosition(pos);
           wind.setContent(browserHasGeolocation ?
                                 'Error: The Geolocation service failed.' :
                                 'Error: Your browser doesnt support geolocation.');
         }

}


    var x = document.getElementById("demo");//para que que serve issa linha??


    var savePosition = function (position)
    {

        document.getElementById('currentLat').value = position.coords.latitude;
        document.getElementById('currentLon').value = position.coords.longitude;
        marker = new google.maps.Marker({
          position: position,
          map: map,
          animation: google.maps.Animation.DROP,
          draggable: true
        })
    }


//-------------------botar em outro arquivo as requests----------------------------------------------------------

function requests(host, method = "GET") 
{
    var content = null
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
    if (this.readyState == 4 && this.status == 200) 
    {
     content = this.responseText
    }
    };

    xhttp.open(method, host, false)
    xhttp.send()
    return content;
}

function requestasync(host, callback, method = "GET") 
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         callback(this.responseText)
      }
    }

    xhttp.open(method, host, true)
    xhttp.send()
}

function getting_db_info(host)
{
  var server_awnser = requests(host);

  console.log("hola", JSON.parse(server_awnser));
  
  return JSON.parse(server_awnser);

}

function load_on_map(map,host)
{
  var row_objs = getting_db_info(host);
  for(i = 0; i < row_objs.length; i++)
  create_marker_and_info_window(row_objs[i],map);
}

function create_marker_and_info_window(row_obj,map)
{
  var key_point_location = new google.maps.LatLng(row_obj.latitude,row_obj.longitude);
  var marker = new google.maps.Marker({position: key_point_location});
  //var info_window = 

  marker.setMap(map); 
}

