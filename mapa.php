<!DOCTYPE html>
<html dir="ltr" lang="pt-BR">
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>map</title>
    <link rel="stylesheet" href="style.css">

  </head>

  <body>
<p><button onclick="geoFindMe()">Inserir reclamação na localização atual</button></p>
<div id="out"></div>

  <p id="demo"></p>
    <script src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU"></script>

<form action="savelocation.php" method="post" id="form" style='display:none'>
      <tr><td></td> <td><input type="hidden" name="lat" id="lat" /> </td> </tr>
      <tr><td></td> <td><input type="hidden" name="long" id="long" /> </td> </tr>
      <tr><td>Título:</td> <td><input type="text" name="titulo" /> </td> </tr>
      <tr><td>Reclamação:</td> <td><input type="text" name="reclam" /> </td> </tr>
      <tr><td>Categoria:</td> <td><select name="categ"> +
      <option value="Infraestrutura" SELECTED>Infraestrutura</option>
      <option value="Mau-Funcionamento">Mau-Funcionamento</option>
      <option value="Outro">Outro</option>
      </select> </td></tr>
      <tr><td></td><td><input type='submit' value='Reclame!'/></td></tr>
    </form>

        <div id="map-canvas"></div>
        <script src="script.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1WMWZn7OQEGUH0lCnd-3i9krdCkA8LoY&callback=initMap" type="text/javascript"></script>
  </body>

</html>
