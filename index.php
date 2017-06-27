<!DOCTYPE html>
<html>
<title>UnBIX</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-anchor,.fa-coffee {font-size:200px}
</style>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-green w3-card-2 w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large w3-white">Home</a>
    <a href="#" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Quem somos</a>
    <a href="http://www.unb.br/" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">UnB</a>

  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Quem somos</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">UnB</a>
  </div>
</div>

<!-- Header -->
<header class="w3-container w3-light-grey w3-center" style="padding:128px 16px">
  <img src=" http://i.imgur.com/RJTalj1.png" alt="UNBIX - Logo" style="width:auto; height:auto;">
  <p class="w3-xlarge">Um novo jeito de ver a UnB</p>
  <button onclick="window.location.href='tela_login.php'" class="w3-button w3-green w3-padding-large w3-large w3-margin-top"> Login </button></br>
  <button onclick="window.location.href='cadastro.php'" class="w3-button w3-green w3-padding-large w3-large w3-margin-top">Cadastro</button>





</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Reporte de qualquer lugar</h1>
      <h5 class="w3-padding-32">Andando no meio do ICC, FT, BSAN, etc. e viu algo irregular na UnB? Sem problemas, abra seu celular ou notebook e reporte ali mesmo para que outros alunos, como você, possam ficar em alerta do que esta acontecendo nas redondezas da universidade!</h5>

      <p class="w3-text-grey">Este programa consiste em você poder reportar qualquer problema estrutural de segurança e de qualidade da UnB. Em qualquer lugar, é só acessar este site pelo seu computador ou smartphone, logar e denunciar.</p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa fa-map-marker" style="font-size:250px" w3-padding-64 w3-text-red"></i>
    </div>
  </div>
</div>

<!-- Second Grid -->
<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fa fa-map-o" style="font-size:250px" w3-padding-64 w3-text-red w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h1>Veja o que os outros estão falando</h1>
      <h5 class="w3-padding-32">Estas indo do IQ para o BSAN mas não sabe se lá tem água? Indo estudar na BCE e se perguntou se está lotado? Está indo para o IDA de noite mas não sabe se aquela iluminação está funcionando? Seus problemas semi-acabaram.</h5>

      <p class="w3-text-grey">Com o UnbIX, você pode ver, em tempo real, o que as outras pessoas estão falando sobre os problemas gerais da Unb. Fique atualizad@ antes de longos trajetos!.</p>
    </div>
  </div>
</div>

<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Não lamente o acidente que já aconteceu, comemore o acidente que você foi capaz de evitar.</h1>
</div>

<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
  <div class="w3-xlarge w3-padding-32">
    <i class="fa fa-gears" style="font-size:36px;color:red"></i>
    <i class="fa fa-terminal" style="font-size:36px;color:orange"></i>
    <i class="fa fa-check" style="font-size:36px;color:yellow"></i>
    <i class="fa fa-map-o" style="font-size:36px;color:green"></i>
    <i class="fa fa-thumb-tack" style="font-size:36px;color:blue"></i>
    <i class="fa fa-thumbs-up" style="font-size:36px;color:purple"></i>

 </div>
 <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>

</body>
</html>
