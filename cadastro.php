<?php
    require "conexao.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro</title>
    </head>
    <body>
        <h1>Crie sua conta</h1>
        <br><br><br>

        <div>
            <form action="" method="post">
                Nome Completo: <input type="text" name="nome" required>
                Nome de Usuário: <input type="text" name="nomeUsuario" required>
                <br><br>
                E-mail: <input type="text" name="email" required>
                CPF: <input type="text" name="cpf" required>
                <br><br>
                Senha: <input type="password" name="senha" required>
                Confirmar Senha: <input type="password" name="senhaConf" required>
                <br><br><br>
                <input type="submit" name="cadastrar" value="Cadastrar" required>
                <br><br>
                <a href="login.php">Já tem uma conta? Fazer Login</a>
            </form>
        </div>
        <?php
        
            if (isset($_POST['cadastrar'])) {

                $nome = $_POST['nome'];
                $nomeUsuario = $_POST['nomeUsuario'];
                $email = $_POST['email'];
                $cpf = $_POST['cpf'];
                $senha = $_POST['senha'];
                $senhaConf = $_POST['senhaConf'];

                $erro = false;

                $sqlNomeUsuario = "SELECT   nomeUsuario
                                   FROM     usuarios
                                   WHERE    nomeUsuario = '$nomeUsuario'";
                $sqlNomeUsuario = mysqli_query($conn, $sqlNomeUsuario);

                $sqlEmail = "SELECT email
                             FROM   usuarios
                             WHERE  email = '$email'";
                $sqlEmail = mysqli_query($conn, $sqlEmail);

                $sqlCpf = "SELECT   cpf
                           FROM     usuarios
                           WHERE    cpf = '$cpf'";
                $sqlCpf = mysqli_query($conn, $sqlCpf);

                if (mysqli_num_rows($sqlNomeUsuario) > 0) {
                    echo "<br>Já existe alguém com esse nome de usuario!";
                    $erro = true;
                }
                if(mysqli_num_rows($sqlEmail) > 0) {
                    echo "<br>E-mail já cadastrado!";
                    $erro = true;
                }
                if(mysqli_num_rows($sqlCpf) > 0) {
                    echo "<br>CPF já cadastrado!";
                    $erro = true;
                }
                if ($senha != $senhaConf) {   
                    echo "<br>As senhas não coincidem!";
                    $erro = true;
                }

                if (!$erro) {
                    
                    $hash = password_hash($senha, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO usuarios (nome, nomeUsuario, cpf, senha, email)
                            VALUES ('$nome', '$nomeUsuario', '$cpf', '$hash', '$email')";
                    mysqli_query($conn, $sql);

                    echo "<br>Usuario cadastrado com sucesso!";

                }

            }

        ?>
    </body>
</html>
