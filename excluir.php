<?php

include('lib/conexao.php');


$id = $_GET['id'];

// Excluindo banco
if(isset($_POST['sim'])) {
    $sql_code = "DELETE FROM usuarios WHERE id ='$id'";
    $sql_query = $mysqli->query($sql_code) or die ($mysqli->error);
    echo "DELETADO COM SUCESSO<a href=clientes.php>Voltar para a tabela</a>";
} else {
    echo "<a href=clientes.php>Voltar para a tabela</a>";
}


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>Tem certeza que deseja deletar este usuário?<h1>
        <form method="POST" action="">
            <button type="submit" name="nao">Não</button>
            <button  type="submit" name="sim">Sim</button>
        </form>
    </body>
</html>