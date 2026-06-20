<?php
    require "conexao.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>
        <h1>Bem vindo de volta!</h1>

        <div>
            <form action="" method="post">
                Usuário: <input type="text" name="usuario" required>
                <br><br>
                Senha: <input type="password" name="senha" required>
                <br><br><br>
                <input type="submit" name="entrar" value="Entrar">
                <br><br><br>
            </form>
            <a href="cadastro.php">Não tem uma conta? Cadastre-se</a>
        </div>
        <?php
        
            if (isset($_POST['entrar'])) {

                $usuario = $_POST['usuario'];
                $senha = $_POST['senha'];

                $sql = "SELECT  nomeUsuario, senha
                        FROM    usuarios
                        WHERE   nomeUsuario = '$usuario'";
                
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) == 1) {
                    
                    $user = mysqli_fetch_assoc($result);

                    if (password_verify($senha, $user['senha'])) {

                        header("Location: home.php");
                        exit();

                    } else {

                        echo "<br><br>Senha incorreta!";

                    }

                } else {

                    echo "<br><br>Usuário não encontrado.";

                }

            }

        ?>
    </body>
</html>
