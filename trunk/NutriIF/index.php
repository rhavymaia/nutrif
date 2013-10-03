<?php
// Cabeçalho e menu da página html.
require_once 'template/header.php';
session_start();
//$_SESSION['id'];
/* if (!isset($_SESSION['id'])){
  echo '<script language="javascript" type="text/javascript">';
  echo 'window.alert("Realize o Login!");';
  echo 'window.location.href="login.php";';
  echo '</script>';
  }
  $_SESSION["logado"] = false;
  if ($_SESSION["logado"] != null){
  if ($_SESSION["logado"] == false){
  echo '<script language="javascript" type="text/javascript">';
  echo 'window.alert("Realize o Login!");';
  echo 'window.location.href="login.php";';
  echo '</script>';
  }
  }else{
  echo '<script language="javascript" type="text/javascript">';
  echo 'window.alert("Realize o Login!");';
  echo 'window.location.href="login.php";';
  echo '</script>';
  } */
// Cabeçalho e menu da página html.
require_once 'template/header.php';

if (isset($_SESSION['id'])) {
    echo "<div class='caixa_login'>";
    echo "<div id='centralizar'>";
    echo "Olá, " . $_SESSION['id'];
    echo "<a href='logout.php'> &nbsp Logout</a>";
    echo "</div>";
    echo "</div>";
}
?>

<div id="centralizar">
    <div id="content">
        <div class="inside">
            <p> 
                Software para obter o perfil alimentar e antropométrico, 
                individual e coletivo, dos estudantes do Instituto Federal 
                de Educação, Ciência e Tecnologia da Paraíba, campus Campina 
                Grande, a fim de auxiliar o nutricionista na definição da 
                quantidade calórica média das refeições do Restaurante Estudantil. 
            </p>
        </div>
    </div>
</div>
<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
