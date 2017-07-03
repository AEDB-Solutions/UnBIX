console.log(execute_fetch());

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function execute_fetch()
{
  var tabela_info = minha_tabela();
  event_map_button(tabela_info);

}
//melhor caminho tem seu array, q eu vou usar esse getting pra chamar o arquivo, ai ja chama a funçao de fazer pinos no mapa
function minha_tabela()
{

var info = getting_db_info("http://localhost/unbix/UnBiX/UnBiiX/UnBiiiX/UnBIX/pagina_inicial/reclamuser.php");
/*if (x = "Infraestrutura"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Infraestrutura");
} else if (x = "Seguranca"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Seguranca");
} else if (x = "Iluminacao"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Iluminacao");
} else if (x = "Bebedouro"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Bebedouro");
} else if (x = "Banheiro"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Banheiro");
} else if (x = "Outros"){
  var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Outros");
} */


//var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ =Infraestrutura");
console.log(info);
  /*var reclams = [
  {'cat': "Banheiro", 'rec': "Tá vazando"},
  {'cat': "Banheiro1", 'rec': "Tá vazando5"},
  {'cat': "Banheiro2", 'rec': "Tá vazando6"},
  {'cat': "Banheiro3", 'rec': "Tá vazando7"},
  {'cat': "Banheiro4", 'rec': "Tá vazando8ss"}
  ]
*/
var modelo = "<tr>\
    <td>{{ele1}}</td>\
    <td>{{ele2}}</td>\
    <td>{{ele3}}</td>\
    <td>{{ele4}}</td>\
    <td>{{ele5}}</td>\
  </tr>";
console.log(info.length)

//para melhor caminho, tenta meter o botao dentro do modelo, o problema é pegar essa informação, era mais fcil ir direto para o mapa

for (var i = 0; i < info.length; i++) 
{
    document.getElementById("table").innerHTML += modelo.replace("{{ele1}}", info[i].Titulo).replace("{{ele2}}", info[i].Descricao).replace("{{ele3}}", info[i].Categoria).replace("{{ele4}}", info[i].Emergencia).replace("{{ele5}}", info[i].descricao)
}

//console.log(meu_array());
//meu_array(info); //funciona

return info; 
}

//-----------------------------------------------------------------------------------------------------

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


function event_map_button(tabela_info)
{
   document.getElementById("botao").addEventListener("click",function(e){
    e.preventDefault(); initMap(tabela_info)});
}

//------------------------------------------------------------------------------------------
function initMap(tabela_info) 
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

  load_on_map(map,tabela_info);
}

//pegar array da tabela toda, passar referenciado aqui q faz o resto, so tem q checar a coisa do mapa
//fazer funções

function load_on_map(map,tabela_info)
{

  var complaints_info = tabela_info;
  var windows = [];

  for(i = 0; i < complaints_info.length; i++)
  {
     var marker = create_marker(complaints_info[i].latitude, complaints_info[i].longitude, complaints_info[i].keypoint, map);
     create_info_window(windows,complaints_info[i], complaints_info[i].keypoint,marker,map);
  }
}


//-------------------------------------------------------------------------------------------------------

function create_marker(lat,long,type,map)
{

  var key_point_location = new google.maps.LatLng(lat,long);
  var marker = new google.maps.Marker({position: key_point_location});
  marker.setMap(map);

  return marker;
}

function content_keypoint(complaints_info)
{

 if(document.getElementById('content_keypoint') == null)
 {
      return "<p>"+complaints_info.Titulo+"</p>";
 }

}

function create_info_window(windows,complaints_info,type,marker,map)
{
  var info_window;

  console.log(complaints_info);

  if(type == 0)
  {  
    info_window = new google.maps.InfoWindow({content:content_keypoint(complaints_info)});
    windows.push(info_window);
    google.maps.event.addListener(marker, 'click', function(){close_windows(windows); info_window.open(map,marker);
    document.getElementById("reclame").addEventListener("click",function(){complain_on_keypoint(complaints_info);});});
   }
  else if(type == 1)
  {
    info_window = new google.maps.InfoWindow({content:content_keypoint(complaints_info)});
    windows.push(info_window);
    google.maps.event.addListener(marker, 'click', function(){close_windows(windows); info_window.open(map,marker);
    document.getElementById("reclame").addEventListener("click",function(){complain_on_keypoint(complaints_info);});});
  }
  
  
}

function close_windows(windows)
{
   for(i = 0; i < windows.length; i++)
   {
      windows[i].close();
   }
}
