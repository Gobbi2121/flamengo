<?php
include('conexao.php');

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        echo "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: index.html");

        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/login.css">
</head>
<body>
    <main>
        <div class="login-container">
            <header class="header-container">
                <img class="fla" src="./assets/fla-logo.png" />
                <h1>Login</h1>
                <h2>Faça o login para continuar</h2>
            </header>
            <form action="" method="POST">
                <div class="input-container">
                    <h3 class="input-title">
                        Nome de Usuário
                    </h3>
                    <input type="text" name="email" placeholder="Digite seu e-mail">
                </div>
                <div class="input-container">
                    <h3 class="input-title">
                      Senha
                    </h3>
                    <input type="password" name="senha" placeholder="Digite a senha">
                </div>
            <div class="buttons-container">
                <button type="submit" class="enter" >Entrar</button>
                <a class="return" target="_self" href="./acesso.html">Voltar</a>
            </div>
</form>
</div>
    </main>
</body>
</html>