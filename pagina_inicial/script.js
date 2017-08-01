//verificar url das linhas:21,22,231,562

function initMap()
{
  var options = {
      center: {
        lat: -15.764114,
        lng: -47.870709
      },
      zoom: 17,
      scrollwheel: false,
      disableDefaultUI: false,
      maxZoom: 20,
      minZoom: 18
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), options);


    load_on_map(map,"http://localhost/UNBIX/git/pagina_inicial/loc_1.php");
    load_on_map(map,"http://localhost/UNBIX/git/pagina_inicial/loc_0.php");

    map_events(map);
    //user_current_location(map);

}

function map_events(map)
{

      google.maps.event.addListener(map, 'click', function(event) {
        var position = event.latLng;
        var marker = new google.maps.Marker({
          position: position,
          map: map,
          animation: google.maps.Animation.DROP,
          draggable: true
          });
        var lat = position.lat();
        var long = position.lng();

        var infowindow = new google.maps.InfoWindow({
        content: general_form(lat,long)
      })

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
          document.getElementById('form').style = 'display:block';
        });
      });

}

function general_form(lat,long)
{
   return "<form action='savelocation.php' method='post' id='form' class='w3-container'>"+"<table>"+
          "<input type='hidden' name='lat' id='user_id_session' value = <?php echo $_SESSION['id']?> >"+
          "<tr><td></td> <td><input type='text' name='lat' id='lat' value='"+lat+"'> </td> </tr>"+
          "<tr><td></td> <td><input type='text' name='long' id='long' value='"+long+"'> </td> </tr>"+
          "<tr><td>Título do problema: </td> <td><input type='text' name = 'Titulo' id= 'Titulo' class='w3-input w3-border' style='margin-top: 10px;'/> </td> </tr>"+
          "<tr><td>Descrição da localidade:</td> <td><input type='text' name='descricao_loc' id='descricao_loc' class='w3-input w3-border' style='margin-top: 10px;'> </td></tr>"+
          "<tr><td>Descrição do  problema:</td> <td><textarea name = 'descricao_comp' id='descricao_comp' placeholder='Reclame aqui' class='w3-input w3-border' maxlength='140' rows='25' cols='80' style='margin-top: 10px;'></textarea>"+
          "<style>textarea{width: 150px;height: 113px;}"+
          "</style> </td> </tr>"+
          "<tr><td>Type:</td> <td><select name = 'Categoria' id ='Categoria'> +"+
                "<option value='Iluminacao' SELECTED>Iluminação</option>"+
                "<option value='Banheiro' SELECTED> Banheiro</option>"+
                "<option value='Bebedouro'>Bebedouro</option>"+
                "<option value='Infraestrutura'>Infraestrutura</option>"+
                "<option value='Seguranca'>Segurança</option>"+
                "<option value='Barulho'>Barulho</option>"+
                "<option value='Outro'>Outro</option>"+
                "</select> </td></tr>"+
              "<style>select {margin-top: 15px;-webkit-appearance: none;  -moz-appearance: none; background: url(http://www.webcis.com.br/images/imagens-noticias/select/ico-seta-appearance.gif) no-repeat #eeeeee;  /* Imagem de fundo (Seta) */background-position: 218px center;"+
                 "background-color: white; width: 250px; height:30px; border:1px solid #ddd;}"+
              "input[type='submit']{background-color: #4CAF50;margin-top: 10px;width: 80px;height: 40px;border: none;margin-bottom: 10px;color: white;margin-left: 10px;}"+
              "input [type='text'] {border-style: groove;margin-top: 10px;border-color: grey;}</style>"+   
              "<tr><td>Emergencia:</td> <td><select name = 'Emergencia' id ='Emergencia'> +"+
                "<option value='1' SELECTED> 1 </option>"+
                "<option value='2' > 2 </option>"+
                "<option value='3' > 3 </option>"+
                "<option value='4' > 4 </option>"+
                "<option value='5' > 5 </option>"+
                "</select> </td></tr>"+
                "<tr><td></td><td><input type='submit' value='Reclame!'/></td></tr></table></form>";
}


//------------------------------------------PEGAR LOCALIZAÇÃO----------------------------------


function user_current_location(map)
{
         console.log("oi");
         document.getElementById("user_pos").addEventListener("click",function() {
           getLocation(map);
         });
}


function getLocation(map)
{

  var infoWindow = new google.maps.InfoWindow({
    content: document.getElementById('form')
  })

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

     infoWindow.setPosition(pos);
     infoWindow.setContent(browserHasGeolocation ?
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
  var like_info = getting_db_info("http://localhost/UNBIX/git/pagina_inicial/user_curtidas.php");
  console.log(like_info);
  var complaints_info = getting_db_info(host);
  var windows = [];

  for(i = 0; i < complaints_info.length; i++)
  {

    var choosenIcon = 'banheiro';
 if (complaints_info[i].keypoint == '0'){
   if(complaints_info[i][3] == "Outro"){
     choosenIcon = 'parking'
   } else {
     choosenIcon = 'info'
   }
}
     var marker = create_marker(complaints_info[i].latitude, complaints_info[i].longitude, complaints_info[i].keypoint, map, choosenIcon);
     create_info_window(like_info,windows,complaints_info[i], complaints_info[i].keypoint,marker,map);
  }
}

function create_marker(lat,long,type,map,iconmydick)
{

  var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';
 var icons = {
   banheiro: {
     icon: 'privada.png'
   },
   parking: {
     icon: iconBase + 'library_maps.png'
   },
   info: {
     icon: iconBase + 'info-i_maps.png'
   }
 };

 var choosenIcon = icons[iconmydick].icon

  var key_point_location = new google.maps.LatLng(lat,long);
  var marker = new google.maps.Marker({position: key_point_location, icon: choosenIcon});

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

function create_info_window(like_info,windows,complaints_info,type,marker,map)
{
  var info_window;

  //console.log(complaints_info);

  if(type == 0)
  {
    info_window = new google.maps.InfoWindow({content:"<div id='choose_form'><input type='hidden' name='user_id' id='"+complaints_info.ComplaintID+"' value='"+complaints_info.IDuser+"'></div>"});
    windows.push(info_window);
    console.log(windows);
    google.maps.event.addListener(marker, 'click', function(){info_window_actions(info_window,windows,map,marker,complaints_info,like_info)});
  
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
function info_window_actions(info_window,windows,map,marker,complaints_info,like_info)
{
  close_windows(windows);
  info_window.open(map,marker);
  define_form(complaints_info,like_info); 
  
  if(already_like(complaints_info.ComplaintID,like_info) == false)
  curtida_event(complaints_info); 
  else
  descurtir_event(complaints_info,get_curtida_of_complaint_id(complaints_info.ComplaintID,like_info));

}

function close_windows(windows)
{
   for(i = 0; i < windows.length; i++)
   {
      windows[i].close();
   }
}

function define_form(complaints_info,like_info)
{
  //if(document.getElementById(complaints_info.ComplaintID).value != null) 
  var complaint_user = document.getElementById(complaints_info.ComplaintID).value;
  
  var user_id = document.getElementById('user_id_session').value;

  console.log(complaint_user);
  console.log(user_id);

  if(complaint_user == user_id)
  getting_form_loc_0(complaints_info)

  else
  curtir_define(complaints_info,like_info);


}

function getting_form_loc_0(complaints_info)
{
  document.getElementById('choose_form').innerHTML = "<form action='savelocation.php' method='post' id='form'><input type='hidden' name='complaint_id' value='"+complaints_info.ComplaintID+"'/><table>"+
            "<input type='hidden' name='user_id' id='user_id_complain' value='"+complaints_info.IDuser+"'>"+
            "<tr><td></td> <td><input type='hidden' name='lat' id='lat' value='"+complaints_info.latitude+"'> </td> </tr>"+
            "<tr><td></td> <td><input type='hidden' name='long' id='long' value='"+complaints_info.longitude+"'> </td> </tr>"+
            "<tr><td>Título: </td> <td><input type='text' name='Titulo' id='Titulo' class='w3-input w3-border' style='margin-top: 10px;' value='"+complaints_info.Titulo+"'> </td> </tr>"+
            "<tr><td>Descrição do problema:</td> <td><textarea name = 'descricao_comp' id='descricao_comp' class='w3-input w3-border' style='margin-top: 10px;'' value='"+complaints_info.Descricao+"'maxlength='140' rows='25' cols='80'>"+complaints_info.Descricao+"</textarea><style>textarea{width: 150px;height: 113px;}</style> </td> </tr>"+
            "<tr><td>Descrição da localidade:</td> <td><input type='text' name='descricao_loc' id='descricao_loc' class='w3-input w3-border' style='margin-top: 10px;'' value='"+complaints_info.descricao+"'> </td> </tr>"+
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
              "<tr><td></td><td><input type='submit' value='Atualizar!'/></td></tr>"+
          "</table>"+"</form>";
}

function curtir_define(complaints_info,like_info)
{
  if(already_like(complaints_info.ComplaintID,like_info) == true)
  already_like_form(complaints_info);

  else
  curtir(complaints_info);
}

function already_like(complaint_id,like_info)
{
  for(i = 0; i < like_info.length; i++)
  {
      if(like_info[i].IDcomplaint == complaint_id)
      return true;
  }

    return false;
}

function get_curtida_of_complaint_id(complaint_id,like_info)
{ 
    for(i = 0; i < like_info.length; i++)
    {
      if(like_info[i].IDcomplaint == complaint_id)
      {
        if(like_info[i].Value == 1)
        return 'like';

        else
        return 'deslike'
      }
    }

      return 'nada';
}

function already_like_form(complaints_info)
{
    var user_id_session = document.getElementById('user_id_session').value;
    var aprovation_s;
    var likes = parseFloat(complaints_info.Likes);
    var dislikes = parseFloat(complaints_info.Dislikes);
    
    if((parseFloat(complaints_info.Likes)+parseFloat(complaints_info.Dislikes)) != 0)
    aprovation_s = ((parseFloat(complaints_info.Likes))/(parseFloat(complaints_info.Likes)+parseFloat(complaints_info.Dislikes)))*100;

    else
    aprovation_s = 0;

    var aprovation = parseInt(aprovation_s);

    document.getElementById('choose_form').innerHTML = "<form id='form'>"+
            "<input type = 'hidden' id = 'save_likes' value='"+likes+"'></input>"+
            "<input type = 'hidden' id = 'save_dislikes' value='"+dislikes+"'></input>"+  
            "<input type='hidden' name='complaint_id' value='"+complaints_info.ComplaintID+"'></inputs>"+
            "<input type='hidden' name='user_id' value='"+user_id_session+"'></input>"+
            "<p><b>titulo:</b> "+complaints_info.Titulo+"<p>"+
            "<p><b>descricao da localidade:</b> "+complaints_info.descricao+"<p>"+
            "<p id = 'aprovation'><b>Nivel de aprovacao da reclamacao:</b>"+aprovation+"%</p>"+
            "<p><b>descricao da reclamacao:</b> "+complaints_info.Descricao+"<p>"+
            "<p><b>categoria:</b> "+complaints_info.Categoria+"<p>"+
            "<p><b>emergencia:</b> "+complaints_info.Emergencia+"<p>"+
            "<div id = 'curtida'>"+
            "<button id = 'descurtir' style='border:none; background-color:#33ccff; color:white; width:50px; height:30px;'>Descurtir</button>"+
            "</div>"+
            "</form>";
}


function curtir(complaints_info)
{
   var aprovation_s;
   var user_id_session = document.getElementById('user_id_session').value;
   var likes = parseFloat(complaints_info.Likes);
   var dislikes = parseFloat(complaints_info.Dislikes);

   if((parseFloat(complaints_info.Likes)+parseFloat(complaints_info.Dislikes)) != 0)
    aprovation_s = ((parseFloat(complaints_info.Likes))/(parseFloat(complaints_info.Likes)+parseFloat(complaints_info.Dislikes)))*100;

    else
    aprovation_s = 0.0;

  var aprovation = parseInt(aprovation_s);

      document.getElementById('choose_form').innerHTML = "<form id='form'>"+
            "<input type = 'hidden' id = 'save_likes' value='"+likes+"'></input>"+
            "<input type = 'hidden' id = 'save_dislikes' value='"+dislikes+"'></input>"+
            "<input type='hidden' name='complaint_id' value='"+complaints_info.ComplaintID+"'></input>"+
            "<input type='hidden' name='user_id' value='"+user_id_session+"'></input>"+
            "<p><b>titulo:</b> "+complaints_info.Titulo+"<p>"+
            "<p><b>descricao da localidade:</b> "+complaints_info.descricao+"<p>"+
            "<p id = 'aprovation'><b>Nivel de aprovacao da reclamacao:</b>"+aprovation+"%<p>"+
            "<p><b>descricao da reclamacao:</b> "+complaints_info.Descricao+"<p>"+
            "<p><b>categoria:</b> "+complaints_info.Categoria+"<p>"+
            "<p><b>emergencia:</b> "+complaints_info.Emergencia+"<p>"+
            "<div id = 'curtida'>"+
            "<button id = 'like' style='border:none; background-color:#33ccff; color:white; width:50px; height:30px;'>Like</button>"+
            "<button id = 'deslike' style='border:none; background-color:red; color:white; width:50px; height:30px; margin-left:10px;'>Deslike</button>"+
            "</div>"+
            "</form>";

            console.log(document.getElementById('save_likes').value+"este_aqui")
}

function curtida_event(complaints_info)
{
  var user_id_session = document.getElementById('user_id_session').value;
  document.getElementById("like").addEventListener("click",function(e){e.preventDefault(); save_curtida(1,user_id_session,complaints_info.ComplaintID,'incrementa');update_aprovation(complaints_info,'like'); document.getElementById("curtida").innerHTML = "<button id = 'descurtir' style='border:none; background-color:red; color:white; width:50px; height:30px; margin-left:10px;'>Descurtir</button>";descurtir_event(complaints_info,'like');});
  document.getElementById("deslike").addEventListener("click",function(e){e.preventDefault(); save_curtida(0,user_id_session,complaints_info.ComplaintID,'incrementa');update_aprovation(complaints_info,'deslike'); document.getElementById("curtida").innerHTML = "<button id = 'descurtir' style='border:none; background-color:red; color:white; width:50px; height:30px; margin-left:10px;'>Descurtir</button>";descurtir_event(complaints_info,'deslike');});
}

function update_aprovation(complaints_info,curtida)
{
  var update;
  var likes_s = document.getElementById('save_likes').value;
  var dislikes_s = document.getElementById('save_dislikes').value;
  var likes = parseFloat(likes_s);
  var dislikes = parseFloat(dislikes_s);

    if(curtida == 'like')
    {
     update = ((likes+1)/(likes+dislikes+1))*100;
     document.getElementById('save_likes').value = likes+1;
    }

    else
    {
      update = ((likes)/(likes+dislikes+1))*100;
      document.getElementById('save_dislikes').value = dislikes+1;
    } 

  if(isFinite(update) == false)
  update = 0;
  
  var int_value = parseInt(update);

  document.getElementById("aprovation").innerHTML = "<p><b>Nivel de aprovacao da reclamacao:</b>"+int_value+"%</p>"; 

}

function decrement_aprovation(complaints_info,curtida)
{
    var update;
    var likes_s = document.getElementById('save_likes').value;
    var dislikes_s = document.getElementById('save_dislikes').value;
    var likes = parseFloat(likes_s);
    var dislikes = parseFloat(dislikes_s);


    if(curtida == 'like')
    {
      update = ((likes-1)/(likes+dislikes-1))*100;
      document.getElementById('save_likes').value = likes-1;
      console.log(document.getElementById('save_likes').value);
    }

    else
    {
      update = ((likes)/(likes+dislikes-1))*100;
      document.getElementById('save_dislikes').value = dislikes-1;
    } 

  if(isFinite(update) == false)
  update = 0;

  var int_value = parseInt(update);

  document.getElementById("aprovation").innerHTML = "<p><b>Nivel de aprovacao da reclamacao</b>"+int_value+"%</p>";
}

function descurtir_event(complaints_info,curtida)
{
    var user_id_session = document.getElementById('user_id_session').value;
    if(curtida == 'like')
    document.getElementById("descurtir").addEventListener("click",function(e){e.preventDefault();document.getElementById("curtida").innerHTML = "<button id = 'like' style='border:none; background-color:#33ccff; color:white; width:50px; height:30px;'>Like</button><button id = 'deslike' style='border:none; background-color:red; color:white; width:50px; height:30px; margin-left:10px;'>Deslike</button>";curtida_event(complaints_info); save_curtida(0,user_id_session,complaints_info.ComplaintID,'decrementa');decrement_aprovation(complaints_info,'like');});
    
    else
    document.getElementById("descurtir").addEventListener("click",function(e){e.preventDefault();document.getElementById("curtida").innerHTML = "<button id = 'like' style='border:none; background-color:#33ccff; color:white; width:50px; height:30px;'>Like</button><button id = 'deslike' style='border:none; background-color:red; color:white; width:50px; height:30px; margin-left:10px;'>Deslike</button>";curtida_event(complaints_info); save_curtida(0,user_id_session,complaints_info.ComplaintID,'decrementa');decrement_aprovation(complaints_info,'deslike');});
}

function save_curtida(like,user_id_session,ComplaintID,option)
{
    var a = requests("http://localhost/UNBIX/git/pagina_inicial/curtida.php?session_user="+user_id_session+"&complaint_id="+ComplaintID+"&like="+like+"&option="+option);
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