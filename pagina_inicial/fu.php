
<!DOCTYPE html>
<html>
<head>
	<title>TABELA</title>
	<meta charset="utf-8">
</head>
<body>

	<h1>tabela</h1>

	<table border="1" id="table">
		<tr>
			<th>Título</th>
			<th>Descrição</th>
			<th>Categoria</th>
			<th>Emergência</th>
			<th>Local</th>
		</tr>		

	</table>

	<script type="text/javascript">


		
//var x = document.getElementById("form").elements[0].value;

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

var x = getParameterByName('categ');
console.log(x);

switch(x){
	case "Infraestrutura":
		var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Infraestrutura");
		break;
	case "Seguranca":
		var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Seguranca");
		break;
	case "Iluminacao":
		var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Iluminacao");
		break;
	case "Bebedouro":
		var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Bebedouro");
		break;
	case "Banheiro":
		var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Banheiro");
		break;
	case "Outros":
		var info = getting_db_info("http://localhost/UnBIX/pagina_inicial/buscacateg.php?categ=Outros");
		break;
}

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

for (var i = 0; i < info.length; i++) 
{
		document.getElementById("table").innerHTML += modelo.replace("{{ele1}}", info[i].Titulo).replace("{{ele2}}", info[i].Descricao).replace("{{ele3}}", info[i].Categoria).replace("{{ele4}}", info[i].Emergencia).replace("{{ele5}}", info[i].descricao)
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
function getting_db_info(host)
{
  var server_awnser = requests(host);

  //console.log("hola", JSON.parse(server_awnser));
  
  return JSON.parse(server_awnser);
}

	</script> 
</body>
</html>