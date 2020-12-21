<?php
// Conexão
require_once 'db_connect.php';
//Inicializando a sessão
session_start();
//validação do botão enviar e tratamento das informações
if(isset($_POST['btn-entrar'])):
    $erros = array();
    $login = mysqli_escape_string($connect, $_POST['login']);
    $senha = mysqli_escape_string($connect, $_POST['senha']);

    if(empty($login) or empty($senha)):
        $erros[] = "<li>preencha os campos login/senha</li>";
    else:
        $sql = "SELECT login FROM usuarios WHERE login = '$login'";
        $resultado =  mysqli_query($connect, $sql);

        if (mysqli_num_rows($resultado) > 0):
            $senha = md5($senha);  
            $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'"; 
            $resultado =  mysqli_query($connect, $sql);
            mysqli_close($connect);
                if(mysqli_num_rows($resultado) == 1):
                    $dados = mysqli_fetch_array($resultado);
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];
                    header('Location: home.php');
                else:
                     $erros[] = "<li>usuario e senha não conferem<li>";   
                endif;
        else:
            $erros [] = "<li>usuario inexistente </li>";
        endif;
    endif;    
endif;
//verificando se o usuario existe no banco de dados
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuario</title> 
</head>
<body>
    <div class = "cabecalho">
        <h2>Login</h2>
        <hr>
    </div>
    <?php
    if(!empty($erros)):
        foreach($erros as $erro):
            echo $erro;
        endforeach;
    endif;    
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        Login: <input type="text" name="login"><br>
        Senha: <input type="password" name="senha"><br>
        <button type = "submit" name="btn-entrar"> Entrar </button>
    </form>
    
</body>
</html>