<?php
    require_once 'template/headerForm.php';
?>

    <form action ="trataFormCadastrarUsuario.php" method="post">
        Nome: <input type ="text" name="nm_usuario" ></br>
        Login:<input type="text" name="login"></br>
        Senha:<input type="password" name="senha1"></br>
        Repetir Senha:<input type="password" name="senha2"></br>
    </form>

<?php
// Rodapé da página html.
require_once 'template/footer.php';
?>
