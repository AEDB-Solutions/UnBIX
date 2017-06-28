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

  load_on_map(map,"http://localhost/UnBIX/pagina_inicial/chamarfuncaomap.php");
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

//pegar array da tabela toda, passar referenciado aqui q faz o resto, so tem q checar a coisa do mapa
//fazer funções

function load_on_map(map,host)
{

  var complaints_info = getting_db_info(host);
  var windows = [];

  for(i = 0; i < complaints_info.length; i++)
  {
     var marker = create_marker(complaints_info[i].latitude, complaints_info[i].longitude, complaints_info[i].keypoint, map);
     create_info_window(windows,complaints_info[i], complaints_info[i].keypoint,marker,map);
  }
}


//-------------------------------------------------------------------------------------------------------

function requests(host, method = "GET", data = {}) //ERA OBJETO
{
    var content = null
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() 
    {
    if(this.readyState == 4 && this.status == 200) 
    {
     content = this.responseText
    }
    };

    xhttp.open(method, host, false)
    
    if(method = "GET")
    xhttp.send()
    
    else
    {
      xhttp.setRequestHeader("Content-Type", "application/json");
      xhttp.send(JSON.stringify(data));
      //xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    }
    
    return content;
}
function getting_db_info(host)
{
  var server_awnser = requests(host);

  //console.log("hola", JSON.parse(server_awnser));
  
  return JSON.parse(server_awnser);
}

function create_marker(lat,long,type,map)
{

  var key_point_location = new google.maps.LatLng(lat,long);
  var marker = new google.maps.Marker({position: key_point_location});
  
  if(type == 0)
  {
    //normal// personalize
  }
  else if(type == 1)
  {
    //ponto chave//personalize
  }  

  marker.setMap(map);

  return marker;
}

function create_info_window(windows,complaints_info,type,marker,map)
{
  var info_window;

  //console.log(complaints_info);

  if(type == 0)
  {  
    info_window = new google.maps.InfoWindow({content:"<div id='choose_form'><input type='hidden' name='user_id' id='"+complaints_info.ComplaintID+"' value='"+complaints_info.IDuser+"'></div>"});
    windows.push(info_window);
    console.log(windows);
    google.maps.event.addListener(marker, 'click', function(){close_windows(windows);info_window.open(map,marker);define_form(complaints_info);});
  }
  else if(type == 1)
  {
    info_window = new google.maps.InfoWindow({content:content_keypoint(complaints_info)});
    windows.push(info_window);
    google.maps.event.addListener(marker, 'click', function(){close_windows(windows); info_window.open(map,marker);
    document.getElementById("reclame").addEventListener("click",function(){complain_on_keypoint(complaints_info);});});
  }
}