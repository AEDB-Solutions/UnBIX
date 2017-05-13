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

    <form action="savelocation.php" method="post">
    <input type="hidden" name="latitude" id="lat"><br>
    <input type="hidden" name="longitude" id="long"><br>
    </form>

    <form action="savelocation.php" id="form" style='display:none'>
      <input type="hidden" name="latitude" id="lat"><br>
      <input type="hidden" name="longitude" id="long"><br>
      <tr><td>Reclamação:</td> <td><input type='text' id='reclam'/> </td> </tr>
      <tr><td>Type:</td> <td><select id='type'> +

                 <option value='infraestrutura' SELECTED>bar</option>
                 <option value='outros'>restaurant</option>
                 </select> </td></tr>
                 <tr><td></td><td><input type='submit' value='Reclame!'/></td></tr>
      <input type ="text" name="reclamacao" id="reclam"><br>
    </form>

            <div id="map-canvas"></div>
        <script src="script.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1WMWZn7OQEGUH0lCnd-3i9krdCkA8LoY&callback=initMap" type="text/javascript"></script>
  </body>

</html>

