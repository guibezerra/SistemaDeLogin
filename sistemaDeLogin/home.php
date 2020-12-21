<?php
// Conexão
require_once 'db_connect.php';
//Inicializando a sessão
session_start();
//verificação de visibilidade da pagina
if(!isset($_SESSION['logado'])):
    header('Location: index.php');
endif; 
//obtenção de dados
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id = '$id' ";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
mysqli_close($connect);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
</head>
<body>
    <div class = "barra-nav">
        <a href="logout.php">Sair</a>
    </div>
    <hr>
    <h1>ola, <?php echo $dados['nome']; ?></h1>
</body>
</html>