
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

    load_on_map(map,"http://localhost/unbix/UnBiX/UnBIX/pagina_inicial/loc_1.php");
    load_on_map(map,"http://localhost/unbix/UnBiX/UnBIX/pagina_inicial/loc_0.php");
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
  var windows = [];

  for(i = 0; i < complaints_info.length; i++)
  {
     var marker = create_marker(complaints_info[i].latitude, complaints_info[i].longitude, complaints_info[i].keypoint, map);
     create_info_window(windows,complaints_info[i], complaints_info[i].keypoint,marker,map);
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

function create_info_window(windows,complaints_info,type,marker,map)
{
  var info_window;

  //console.log(complaints_info);

  if(type == 0)
  {  
    info_window = new google.maps.InfoWindow({content:"<div id='choose_form'><input type='hidden' name='user_id' id='"+complaints_info.ComplaintID+"' value='"+complaints_info.IDuser+"'></div>"});
    windows.push(info_window);
    console.log(windows);
    google.maps.event.addListener(marker, 'click', function(){close_windows(windows);info_window.open(map,marker);define_form(complaints_info);curtida_event(complaints_info);});
  }
  else if(type == 1)
  {
    info_window = new google.maps.InfoWindow({content:content_keypoint(complaints_info)});
    windows.push(info_window);
    google.maps.event.addListener(marker, 'click', function(){close_windows(windows); info_window.open(map,marker);
    document.getElementById("reclame").addEventListener("click",function(){complain_on_keypoint(complaints_info);});});
  }
}
//----------------------------------------------------URL_ATT------------------------------
function close_windows(windows)
{
   for(i = 0; i < windows.length; i++) 
   {
      windows[i].close();
   }
}

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
  return string
}//EXEMPLO: pass_js_variables_to_php("http://localhost/UNBIX/get/passing_with_get.php",["name","idade"],["pedro",18]);EECUTADA ESSA FUNÇÃO A PAGINA É REDIRECIONADA PARA UM .PHP ESCOLHIDO NO HOST




//-----------------REQUESTING FORM-----------------------------------------------------------------------------------------------------

/*function stringify_dados(host, dados){
  var pair_list = []
  for (key in dados) {
    pair_list.push(key + "=" + dados[key])
  }
  return host + "?" + pair_list.join("&")
}


function send_data(host, dados){
  //requests(host, "POST", dados)
   var a = requests(stringify_dados(host,dados));

}

function pick_html_imputs(classe)
{
  var inputs = document.getElementsByClassName(classe)
  var dados = {}
  for (var i = 0; i < inputs.length; i++) {
    dados[inputs[i].name] = inputs[i].value
  }

  return dados
}

function submete_formulario()
{
//var dados = {name:"John Rambo", time:"2pm"}
  send_data("http://localhost/UNBIX/atual1/pagina_inicial/savelocation.php", pick_html_imputs('input'));
}

function click_on_submit(button_id,map,infowindow)
{

  document.getElementById(button_id).addEventListener("click", function(e){
  e.preventDefault()
  submete_formulario();infowindow.close();})
}*/

//----------------------------GETTING_FORMS------------------------------------------------------------

function define_form(complaints_info)
{
  var complaint_user = document.getElementById(complaints_info.ComplaintID).value; 
  var user_id = document.getElementById('user_id_session').value;

  console.log(complaint_user);
  console.log(user_id);
   
  if(complaint_user == user_id)
  getting_form_loc_0(complaints_info)

  else 
  curtir(complaints_info);


}


function getting_form_loc_0(complaints_info)
{
  document.getElementById('choose_form').innerHTML = "<form action='savelocation.php' method='post' id='form'><input type='hidden' name='complaint_id' value='"+complaints_info.ComplaintID+"'/><table>"+
            "<input type='hidden' name='user_id' id='user_id_complain' value='"+complaints_info.IDuser+"'>"+
            "<tr><td></td> <td><input type='hidden' name='lat' id='lat' value='"+complaints_info.latitude+"'> </td> </tr>"+
            "<tr><td></td> <td><input type='hidden' name='long' id='long' value='"+complaints_info.longitude+"'> </td> </tr>"+
            "<tr><td>Título: </td> <td><input type='text' name='Titulo' id='Titulo'value='"+complaints_info.Titulo+"'> </td> </tr>"+
            "<tr><td>Descrição do problema:</td> <td><textarea name = 'descricao_comp' id='descricao_comp' value='"+complaints_info.Descricao+"'maxlength='140' rows='25' cols='80'>"+complaints_info.Descricao+"</textarea><style>textarea{width: 150px;height: 113px;}</style> </td> </tr>"+
            "<tr><td>Descrição da localidade:</td> <td><input type='text' name='descricao_loc' id='descricao_loc' value='"+complaints_info.descricao+"'> </td> </tr>"+
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

function curtir(complaints_info)
{
   var user_id_session = document.getElementById('user_id_session').value;
   console.log(user_id_session+"oi");
  //get
      document.getElementById('choose_form').innerHTML = "<form id='form'>"+
            "<input type='hidden' name='complaint_id' value='"+complaints_info.ComplaintID+"'></inputs>"+
            "<input type='hidden' name='user_id' value='"+user_id_session+"'></input>"+
            "<p>titulo: "+complaints_info.Titulo+"<p>"+
            "<p>descricao da localidade: "+complaints_info.descricao+"<p>"+
            "<p>Nivel de aprovacao da reclamacao:atualizar depois do php<p>"+
            "<p>descricao da reclamacao: "+complaints_info.Descricao+"<p>"+
            "<p>categoria: "+complaints_info.Categoria+"<p>"+
            "<p>emergencia "+complaints_info.Emergencia+"<p>"+
            "<div id = 'curtida'>"+
            "<button id = 'like'>Like</button>"+
            "<button id = 'deslike'>Deslike</button>"+
            "</div>"+
            "</form>";
}

function curtida_event(complaints_info)
{
  var user_id_session = document.getElementById('user_id_session').value;
  document.getElementById("like").addEventListener("click",function(e){e.preventDefault(); save_curtida(1,user_id_session,complaints_info.ComplaintID); document.getElementById("curtida").innerHTML = "<button>Descurtir</button>"});
  document.getElementById("deslike").addEventListener("click",function(e){e.preventDefault(); save_curtida(0,user_id_session,complaints_info.ComplaintID); document.getElementById("curtida").innerHTML = "<button>Descurtir</button>"});
}

function save_curtida(like,user_id_session,ComplaintID)
{
  //document.getElementById("like")
    var a = requests("http://localhost/UNBIX/atual/pagina_inicial/curtida.php?session_user="+user_id_session+"&complaint_id="+ComplaintID+"&like="+like);
    console.log(a);
}

function content_keypoint(complaints_info)
{

 if(document.getElementById('content_keypoint') == null)
 {
      return "<p>"+complaints_info.descricao+"</p>"+
      "<div id = 'content_keypoint'>"+
      "<button id = 'reclame'>reclame</button>"+
      "<button id = 'tabela_de_reclamacoes'>tabela de reclamacoes</button>"+
      "</div>";
 }

}


function complain_on_keypoint(complaints_info)
{ 
  //console.log(complaints_info.localID);
  var formulario ="<form action='savelocation.php' method='post' id='form'>"+"<table>"+
          "<input type='hidden' name='localid' id='localid' value='"+complaints_info.localID+"'>"+
          "<tr><td>Título do problema: </td> <td><input type='text' name = 'Titulo' id= 'Titulo'/> </td> </tr>"+
          //"<tr><td>Descrição da localidade:</td> <td><input type='text' name='descricao_loc' id='descricao_loc'> </td></tr>"+
          "<tr><td>Descrição do problema:</td> <td><textarea name = 'descricao_comp' id='descricao_comp' maxlength='140' rows='25' cols='80'>Reclame aqui...</textarea>"+
          "<style>textarea{width: 150px;height: 113px;}</style> </td> </tr>"+
          "<tr><td>Type:</td> <td><select name = 'Categoria' id ='Categoria'>"+
                "<option value='Iluminacao' SELECTED>Iluminação</option>"+
                "<option value='Banheiro' SELECTED> Banheiro</option>"+
                "<option value='Bebedouro'>Bebedouro</option>"+
                "<option value='Infraestrutura'>Infraestrutura</option>"+
                "<option value='Seguranca'>Segurança</option>"+
                "<option value='Barulho'>Barulho</option>"+
                "<option value='Outro'>Outro</option>"+
                "</select> </td></tr>"+
            "<tr><td>Emergencia:</td> <td><select name = 'Emergencia' id ='Emergencia'> +"+
                "<option value='1' SELECTED> 1 </option>"+
                "<option value='2' > 2 </option>"+
                "<option value='3' > 3 </option>"+
                "<option value='4' > 4 </option>"+
                "<option value='5' > 5 </option>"+
            "</select> </td></tr>"+
              "<tr><td></td><td><input type='submit' value='Reclame!'/></td></tr>"+
              "</table></form>";

              document.getElementById('content_keypoint').innerHTML = formulario;

}
