
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

    load_on_map(map,"http://localhost/UNBIX/pagina_inicial/loc_1.php","http://localhost/UNBIX/pagina_inicial/get_complaints.php");
    load_on_map(map,"http://localhost/UNBIX/pagina_inicial/loc_0.php","http://localhost/UNBIX/pagina_inicial/get_complaints.php");
    map_events(map);
    //map_events(map);//SE DEIXO ISTO DEPOIS DO LOAD MAP A PAGINA FICA CARREGANDO CONSTANTEMENTE
    
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

function load_on_map(map,host1,host2)
{
  var array_objs_loc = getting_db_info(host1);
  var array_objs_comp = getting_db_info(host2);
  
  //console.log(corresp_local_id(array_objs_comp, array_objs_loc[i].localID));
  
  for(i = 0; i < array_objs_loc.length; i++)
  {
  	if(array_objs_loc[i].keypoint == 0)
  	create_marker_and_info_window_key0(array_objs_loc[i],corresp_local_id(array_objs_comp, array_objs_loc[i].localID), map);

   else
   create_marker_and_info_window_key1(array_objs_loc[i],map);
  }
}

function create_marker_and_info_window_key1(objs_loc,map)
{
    var key_point_location = new google.maps.LatLng(objs_loc.latitude,objs_loc.longitude);
    var marker = new google.maps.Marker({position: key_point_location});
    marker.setMap(map);
    var info_window = new google.maps.InfoWindow({content:"Ponto chave--teste--Banheiro x"});
    google.maps.event.addListener(marker, 'click', function(){ info_window.open(map,marker)});
}

function create_marker_and_info_window_key0(objs_loc,objs_comp, map)
{
  var point_location = new google.maps.LatLng(objs_loc.latitude,objs_loc.longitude);
  var marker = new google.maps.Marker({position: point_location});
  marker.setMap(map);

    var info_window = new google.maps.InfoWindow({content:getting_form(objs_comp,objs_loc)});
    google.maps.event.addListener(marker, 'click', function(){ info_window.open(map,marker)});
}


function corresp_local_id(array_objs_comp,localID)
{
	for(i = 0; i < array_objs_comp.length; i++)
	{
		if(array_objs_comp[i].LocalID == localID)
		return array_objs_comp[i];
	}
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
function getting_form(objs_comp,objs_loc)
{
    return "<form action='savelocation.php' method='post' id='form'>"+"<table>"+
          "<tr><td></td> <td><input type='text' name='lat' id='lat' value ="+objs_loc.latitude+"> </td> </tr>"+
          "<tr><td></td> <td><input type='text' name='long' id='long' value ="+objs_loc.longitude+"> </td> </tr>"+
          "<tr><td>Título: </td> <td><input type='text' name = 'Titulo' id= 'Titulo' value ="+objs_comp.Titulo+"> </td> </tr>"+
          "<tr><td>Descrição:</td> <td><input type='text' name = 'Descricao' id='Descricao' value ="+objs_comp.Descricao+"> </td> </tr>"+
          "<tr><td>Type:</td> <td><select name = 'Categoria' id ='Categoria' value ="+objs_comp.Categoria+"> +"+
                "<option value='Iluminacao' SELECTED>Iluminação</option>"+
                "<option value='Banheiro' SELECTED> Banheiro</option>"+
                "<option value='Bebedouro'>Bebedouro</option>"+
                "<option value='Infraestrutura'>Infraestrutura</option>"+
                "<option value='Seguranca'>Segurança</option>"+
                "<option value='Barulho'>Barulho</option>"+
                "<option value='Outro'>Outro</option>"+
                "</select> </td></tr>"+
            "<tr><td>Emergencia:</td> <td><select name = 'Emergencia' id ='Emergencia' value ="+objs_comp.Emergencia+"> +"+
                "<option value='1' SELECTED> 1 </option>"+
                "<option value='2' SELECTED> 2 </option>"+
                "<option value='3' SELECTED> 3 </option>"+
                "<option value='4' SELECTED> 4 </option>"+
                "<option value='5' SELECTED> 5 </option>"+
            "</select> </td></tr>"+
              "<tr><td></td><td><input type='submit' value='Reclame!'/></td></tr>"+
          "</table>"+"</form>";
}
