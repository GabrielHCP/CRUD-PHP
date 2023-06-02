<?php
    include('lib/conexao.php');
    //Puxando todos os dados do banco
    $sql_clientes = "SELECT * FROM usuarios";
    $query_clientes = $mysqli->query($sql_clientes) or die($mysqli->error);
    $num_clientes = $query_clientes->num_rows;


?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Formulário de cadastro</title>
    </head>
    <body>
        <h1>Lista de clientes</h1>
        <h3>Tabela de clientes cadastrados no sistema</h3>
        <a href="cadastrar.php">Página de cadastro</a> <br><br>
        <table border="1" cellpadding="10">
            <thead>
                <th>ID</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Nascimento</th>
                <th>Telefone</th>
                <th>Ações</th>
            </thead>
            <tbody>
                <?php 
                    if($num_clientes == 0) { ?>
                        <tr>
                            <td colspan="5">Nenhum cliete foi cadastrado</td>
                        </tr>
                <?php } else // Formatando o telefone 
                            while($clientes = $query_clientes->fetch_assoc()) {
                            if(!empty($clientes['telefone'])) {
                                $ddd = substr($clientes['telefone'], 0, 2);
                                $parte1 = substr($clientes['telefone'], 2, 5);
                                $parte2 = substr($clientes['telefone'],7);
                                $telefone = "($ddd) $parte1-$parte2";
                            }
                            //Formatando a data
                            if(!empty($clientes['nascimento'])) {
                                $nascimento = implode('/', array_reverse(explode('-', $clientes['nascimento'])));
                            }
                ?>
                <tr>
                    <td><?php echo $clientes['id']; ?></td>
                    <td><?php echo $clientes['nome']; ?></td>
                    <td><?php echo $clientes['email']; ?></td>
                    <td><?php echo $nascimento; ?></td>
                    <td><?php echo $telefone; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $clientes['id']; ?>">Editar</a>
                        <a href="excluir.php?id=<?php echo $clientes['id']; ?>">Excluir</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </body>
</html>