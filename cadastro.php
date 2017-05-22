<!DOCTYPE html>

<html>
 <head>
 <title> UNBIX - Cadastro </title>
 <link href="cadastrodef.css" rel="stylesheet">
 <meta name="description" content="FaÃ§a aqui seu cadastro no UnBix!">
 <meta http-equiv="content-Type" content="text/html; charset=ISO-8859-1" />
 <meta charset="utf-8" />

 <script language="text/javascript" type="text/javascript">
  function validar() {

  var mat = document.forms["cad"]["matricula"].value;
  var soNumeros = /^[0-9]+$/;

         if (document.forms["cad"]["nome"].value == "") {
            alert("Campo Obrigatorio: Nome");
            return false;
         }
        if (document.forms["cad"]["email"].value == "") {
     alert("Campo Obrigatorio: e-mail");
            return false;
         }
        if (mat.length < 9) {
            alert("Campo Matricula: deve conter 9 caracteres numericos");
            return false;
     }
  if (document.forms["cad"]["genero"].value == "") {
         alert("Campo Obrigatorio: Genero");
         return false;
     }
  if (!mat.match(soNumeros)) {
  document.forms["cad"]["matricula"].value="";
         alert("Campo Matricula: Utilizar somente numeros");
         return false;
     }
  if (document.forms["cad"]["senha"].value != document.forms["cad"]["confsenha"].value) {
  alert("Campo senha diferente de campo confirma senha");
         return false;
     }
    if (document.forms["cad"]["senha"].value == "") {
         alert("Campo Obrigatorio: Senha");
         return false;
     }
 }
</script>
</head>


<body>
<div align="center">  
  <img src="http://imgur.com/UzU7KBX.png" alt="UNBIX - Logo" style="width:auto; height:auto;">
</div>  
<form action="confirma.php" method="post" name="cad" onsubmit="return validar();">
<!-- DADOS DE CADASTRO -->
<hgroup>
  <h1>Cadastro</h1>
</hgroup>
<form>

  <div class="group">
    <h2>Nome</h2>
    <input type="text" name = 'nome'><span class="highlight"></span><span class="bar"></span>
    <label></label>
  </div>

  <div class="group">
    <h2>Email</h2>
    <input type="email" name = 'email'><span class="highlight"></span><span class="bar"></span>
    <label></label>
  </div>

  <div class="group">
    <h2>Curso</h2>
  <td>
  <select name="curso">
   <option value="1">Administração</option><option value="66">Administração Pública</option><option value="2">Agronomia</option><option value="3">Arquiterura e Urbanismo</option><option value="4">Arquivologia</option><option value="5">Artes Cênicas</option><option value="6">Artes Visuais</option><option value="67">Artes Visuais</option><option value="7">Biblioteconomia</option><option value="8">Biotecnologia</option><option value="9">Ciência da Computação</option><option value="10">Ciência Política</option><option value="11">Ciências Ambientais</option><option value="12">Ciências Biológicas</option><option value="13">Ciências Contábeis</option><option value="14">Ciências Econômicas</option><option value="15">Ciências Sociais</option><option value="16">Computação</option><option value="17">Comunicação Social</option><option value="18">Design</option><option value="19">Direito</option><option value="20">Educação Artística</option><option value="21">Educação Física</option><option value="22">Enfermagem</option><option value="23">Engenharia Ambiental</option><option value="24">Engenharia Civil</option><option value="25">Engenharia de Computação</option><option value="26">Engenharia de Produção</option><option value="27">Engenharia de Redes de Comunicação</option><option value="28">Engenharia Elétrica</option><option value="29">Engenharia Florestal</option><option value="30">Engenharia Mecânica</option><option value="31">Engenharia Mecatrônica</option><option value="32">Engenharia Química</option><option value="33">Estatística</option><option value="34">Farmácia</option><option value="35">Filosofia</option><option value="36">Física</option><option value="37">Geofísica</option><option value="38">Geologia</option><option value="39">Gestão de Agronegócios</option><option value="41">Gestão de Políticas Públicas</option><option value="40">História</option><option value="42">Jornalismo</option><option value="43">Letras</option><option value="44">Letras-Tradução</option><option value="45">Letras-Tradução Espanhol</option><option value="46">Língua de Sinais Brasileira</option><option value="47">Línguas Estrangeiras Aplicadas-MSI</option><option value="48">Matemática</option><option value="49">Matemática - Segunda Licenciatura</option><option value="50">Medicina</option><option value="51">Medicina Veterinária</option><option value="52">Museologia</option><option value="53">Música</option><option value="54">Nutrição</option><option value="55">Odontologia</option><option value="56">Pedagogia</option><option value="57">Pedagogia - Primeira Licenciatura</option><option value="58">Psicologia</option><option value="59">Química</option><option value="60">Química Tecnológica</option><option value="61">Relações Internacionais</option><option value="62">Saúde Coletiva</option><option value="63">Serviço Social</option><option value="68">Teatro</option><option value="64">Teoria Crítica e História da Arte</option><option value="65">Turismo</option> </select>
   </td>
  </tr>
</div>


  <div class="group">
    <h2>Matricula</h2>
    <input type="text" maxlength="9" name="matricula"><span class="highlight"></span><span class="bar"></span>
    <label></label>
  </div>


  <div class="group">
    
      <h2>Genero</h2>
    
<select name="genero">
  <option value="Masculino">Masculino</option><option value="Feminino">Feminino</option><option value="Outro">Outro</option>  
</select>
    
    </div>
  


  <div class="group">
    <h2>Senha</h2>
    <input type="password" name="senha"><span class="highlight"></span><span class="bar"></span>
    <label></label>
  </div>

  <div class="group">
    <h2>Confirmar senha</h2>
    <input type="password" name="confsenha"><span class="highlight"></span><span class="bar"></span>
    <label></label>
  </div>

  <button type="submit" class="button buttonBlue">Enviar
    <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
  </button>
</form>

</form>
<!--    <footer><a href="http://www.polymer-project.org/" target="_blank"><img src="https://www.polymer-project.org/images/logos/p-logo.svg"></a>
        <p>You Gotta Love <a href="http://www.polymer-project.org/" target="_blank">Google</a></p>
        </footer>
-->
<footer class="w3-container w3-padding-64 w3-center w3-opacity">
  <div class="w3-xlarge w3-padding-32">
    <i class="fa fa-gears" style="font-size:36px;color:red"></i>
    <i class="fa fa-terminal" style="font-size:36px;color:orange"></i>
    <i class="fa fa-check" style="font-size:36px;color:yellow"></i>
    <i class="fa fa-map-o" style="font-size:36px;color:green"></i>
    <i class="fa fa-thumb-tack" style="font-size:36px;color:blue"></i>
    <i class="fa fa-thumbs-up" style="font-size:36px;color:purple"></i>
</form>


 </body>
</html>

