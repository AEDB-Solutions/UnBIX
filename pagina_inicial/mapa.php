<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>map</title>
    <link rel="stylesheet" href="style.css">

  </head>

  <body>
    
    <button onclick="getLocation()">Inserir reclamação na localização atual</button>

    <p id="demo"></p>

    <form action="savelocation.php" method="post" id="form" style='display:none'>

    <tr><td></td> <td><input type="text" name="lat" id="lat"> </td </tr>
    <tr><td></td> <td><input type="text" name="long" id="long"><br> </td> </tr>
    <tr><td>Título: </td> <td><input type="text" name = "titulo" id= "titulo"/> </td> </tr>
    <tr><td>Reclamação: </td> <td><input type="text" name = "reclam" id='reclam'/> </td> </tr>
    <tr><td>Tipo: </td> <td><select id ='categ'> +
          <option value='infraestrutura' SELECTED>Infraestrutura</option>
          <option value='mau-funcionamento' SELECTED> Mau-funcionamento</option>
          <option value='outros'>outro</option>
          </select> </td></tr><br>

    <tr><td></td><td><input type='submit' value='Reclame!'/></td></tr>

    </form>

            <div id="map-canvas"></div>
        <script src="script.js">

	</script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1WMWZn7OQEGUH0lCnd-3i9krdCkA8LoY&callback=initMap" type="text/javascript"></script>
  </body>

</html>
