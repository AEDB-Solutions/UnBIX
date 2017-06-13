
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

    load_on_map(map,"http://localhost/UnBIX/pagina_inicial/loc_1.php");
    load_on_map(map,"http://localhost/UnBIX/pagina_inicial/loc_0.php");
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

//------------------------------------------PEGAR LOCALIZAÇÃO----------------------------------


function user_current_location(map)
{
        //dica para integrar os dois mapas em um .Usem a linha abaixo e tentem mudar o index.php;
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


//-------------------INICIO REQUESTS----------------------------------------------------------

function constroy_url(host,array_keys,array_values)
{
  var string = host+"?";

    for(i = 0; i < array_values.length; i++)
    {
      string+= array_keys[i] + "=" + array_values[i];

      if(i != array_values.length-1)
      string += "&";
    }

      return string;
}



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

  //console.log("hola", JSON.parse(server_awnser));
  
  return JSON.parse(server_awnser);

}
//-------------------LOAD ON MAP-------------------------------------------------------

function load_on_map(map,host)
{

  var complaints_info = getting_db_info(host);

  console.log(complaints_info);

  for(i = 0; i < complaints_info.length; i++)
  {
     var marker = create_marker(complaints_info[i].latitude, complaints_info[i].longitude, complaints_info[i].keypoint, map);
     create_info_window(complaints_info[i], complaints_info[i].keypoint,marker,map);
  }
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

function create_info_window(complaints_info,type,marker,map)
{
  var info_window;

  console.log(complaints_info);

  if(type == 0)
    info_window = new google.maps.InfoWindow({content:getting_form_loc_0(complaints_info)});
  
  else if(type == 1)
    info_window = new google.maps.InfoWindow({content:"Ponto chave--teste--Banheiro x"});

  google.maps.event.addListener(marker, 'click', function(){ info_window.open(map,marker)});

}

//----------------------------------------------------URL_ATT------------------------------


function pass_js_variables_to_php(host,array_keys,array_values)
{
  var string = host+"?";

  for(i = 0; i < array_values.length; i++)
  {
    string+= array_keys[i] + "=" + array_values[i];

    if(i != array_values.length-1)
    string += "&";
  }

  window.location = string;
}//EXEMPLO: pass_js_variables_to_php("http://localhost/UNBIX/get/passing_with_get.php",["name","idade"],["pedro",18]);EECUTADA ESSA FUNÇÃO A PAGINA É REDIRECIONADA PARA UM .PHP ESCOLHIDO NO HOST



//----------------------------GETTING_FORM------------------------------------------------------------
function getting_form_loc_0(complaints_info)
{
    return "<form action='savelocation.php' method='post' id='form'><input type='hidden' name='id' value='"+complaints_info.ComplaintID+"'/><table>"+
          "<tr><td></td> <td><input type='hidden' name='lat' id='lat' value='"+complaints_info.latitude+"'> </td> </tr>"+
          "<tr><td></td> <td><input type='hidden' name='long' id='long' value='"+complaints_info.longitude+"'> </td> </tr>"+
          "<tr><td>Título: </td> <td><input type='text' name='Titulo' id='Titulo'value='"+complaints_info.Titulo+"'> </td> </tr>"+
            "<tr><td>Descrição do problema:</td> <td><textarea name = 'Descricao' id='Descricao' value='"+complaints_info.Descricao+"'maxlength='140' rows='25' cols='80'>Reclame aqui...</textarea><style>textarea{width: 150px;height: 113px;}</style> </td> </tr>"+
          "<tr><td>Descrição da localidade:</td> <td><input type='text' name='Descricao' id='Descricao' value='"+complaints_info.descricao+"'> </td> </tr>"+
          "<tr><td>Type:</td> <td><select name='Categoria' id='Categoria' value='"+complaints_info.Categoria+"'> +"+
                "<option value='Iluminacao' "+ (complaints_info.Categoria == 'Iluminacao' ? 'selected' : '') +">Iluminação</option>"+
                "<option value='Banheiro' "+ (complaints_info.Categoria == 'Banheiro' ? 'selected' : '') +"> Banheiro</option>"+
                "<option value='Bebedouro' "+ (complaints_info.Categoria == 'Bebedouro' ? 'selected' : '') +">Bebedouro</option>"+
                "<option value='Infraestrutura' "+ (complaints_info.Categoria == 'Infraestrutura' ? 'selected' : '') +">Infraestrutura</option>"+
                "<option value='Seguranca' "+ (complaints_info.Categoria == 'Seguranca' ? 'selected' : '') +">Segurança</option>"+
                "<option value='Barulho' "+ (complaints_info.Categoria == 'Barulho' ? 'selected' : '') +">Barulho</option>"+
                "<option value='Outro' "+ (complaints_info.Categoria == 'Outro' ? 'selected' : '') +">Outro</option>"+
                "</select> </td></tr>"+
            "<tr><td>Emergencia:</td> <td><select name='Emergencia' id='Emergencia'> +"+
                "<option value='1' "+ (complaints_info.Emergencia == 1 ? 'selected' : '') +"> 1 </option>"+
                "<option value='2' "+ (complaints_info.Emergencia == 2 ? 'selected' : '') +"> 2 </option>"+
                "<option value='3' "+ (complaints_info.Emergencia == 3 ? 'selected' : '') +"> 3 </option>"+
                "<option value='4' "+ (complaints_info.Emergencia == 4 ? 'selected' : '') +"> 4 </option>"+
                "<option value='5' "+ (complaints_info.Emergencia == 5 ? 'selected' : '') +"> 5 </option>"+
            "</select> </td></tr>"+
              "<tr><td></td><td><input type='submit' value='Atualizar Reclamacao!'/></td></tr>"+
          "</table>"+"</form>";
}


//function getting_form_loc_0