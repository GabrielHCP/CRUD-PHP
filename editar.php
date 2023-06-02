<?php
    include('lib/conexao.php');

    $id = intval($_GET['id']);


    function formatar_telefone($telefone){
        if(!empty($telefone)) {
            $ddd = substr($telefone, 0, 2);
            $parte1 = substr($telefone, 2, 5);
            $parte2 = substr($telefone,7);
            return "($ddd) $parte1-$parte2";
        }
    }

    function formatar_data($data) {
        return implode('/', array_reverse(explode('-', $data)));
    }



    function limpar_texto($str){ 
        return preg_replace("/[^0-9]/", "", $str); 
    }

    if(count($_POST) > 0){

        $usuario = $_POST['nome_user'];
        $email = $_POST['email_user'];
        $nascimento = $_POST['nascimento_user'];
        $telefone = $_POST['telefone_user']; 
        $erro = false;

        if(strlen($usuario) < 3 || empty($usuario)) {
            $erro = "Por favor, digite no campo de usuário!";
        }
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = "Por favor, digite um e-mail válido";
        }

        if(empty($nascimento)){
            $erro =  "Por favor, digite sua data de nascimento";
        } else {
            $tmp = explode("/", $nascimento);
            if(count($tmp) == 3) {
                $nascimento = implode("-", array_reverse($tmp));
            } else 
                $erro = "Digite a data no padrão Dia/Mes/Ano";
        }
        
        if(empty($telefone)) {
            $erro = "Por favor, digite seu número de telefone";
        } else {
            $format_telefone = limpar_texto($telefone);
            if(strlen($format_telefone) != 11){
                $erro = "Por favor digite o telefone no padrão (18) 99171-4844";
            }

        }
        // Update no banco
        if($erro) {
            echo "<p><b>ERRO: $erro </b></p>";
        } else {
            $sql_code = "UPDATE usuarios SET nome ='$usuario', email ='$email', nascimento = '$nascimento', telefone = '$format_telefone' WHERE id = '$id'";
            $deu_certo = $mysqli->query($sql_code) or die($mysqli->error);
            if($deu_certo) {
                echo "Cliente atualizado com sucesso <a href='clientes.php'>Clique aqui</a> para visualizar a tabela";
            } else
                echo "Erro ao cadastrar";
        }
    }


 //PUXAR ID DO BANCO DE DADOS
    $sql_cliente = "SELECT * FROM usuarios WHERE id = '$id'";
    $query_cliente = $mysqli->query($sql_cliente) or die ($mysqli->error);
    $cliente = $query_cliente->fetch_assoc();

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
        <h1>Área de cadastro</h1>
            <form method="POST" action="">
                <input type="text" name="nome_user" placeholder="Nome" value="<?php echo $cliente['nome']; ?>">* <br><br>
                <input type="text" name="email_user" placeholder="E-mail" value="<?php echo $cliente['email']; ?>">* <br><br>
                <input type="text" name="nascimento_user" placeholder="Nascimento" value="<?php echo formatar_data($cliente['nascimento']); ?>">* <br><br>
                <input type="text" name="telefone_user" placeholder="(11) 99448-4741" value="<?php echo formatar_telefone($cliente['telefone']); ?>">* <br><br>
                <button type="submit" value="enviar">Enviar</button>
            </form>
    </body>
</html>