<!DOCTYPE html>
<html lang="pt_BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/dist/css/bootstrap.css" rel="stylesheet">
        <link href="css/base.css" rel="stylesheet">
        <link href="css/signin.css" rel="stylesheet">

    </head>

    <body <?php echo (isset($_POST['login']) ? "onLoad=\"document.getElementById('senha').focus();\"" : NULL) ?>>

        <div class="container" id="body">
            <div class="row">
                <div class="col-left">O <img src="imagens/monkut.png" id="logo" /> é uma comunidade online que conecta pessoas interessadas em MongoDB através de uma rede de amigos confiáveis.
                    <p>
                        <img src="imagens/pessoas.png" id="pessoas"/>
                    </p>
                </div>
                <div class="col-right">
                    <?php
                    if (isset($_GET['acao']) AND $_GET['acao'] == 'Cadastro') {
                        ?>
                        <form class="form-signin" method="POST" action="?acao=Cadastro">
                            <h2 class="form-signin-heading">Cadastro</h2>
                            <input type="text" class="form-control" placeholder="Nome" id="nome" name="nome" value="<?php echo isset($_POST['nome']) ? $_POST['nome'] : NULL ?>" required autofocus>
                            <input type="text" class="form-control" placeholder="E-mail" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : NULL ?>" required autofocus>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                            <input type="password" class="form-control" id="senhaConfirmacao" name="senhaConfirmacao" placeholder="Confirmação de senha" required>
                            <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
                        </form>
                        <?php
                        if (isset($_SESSION['error'])) {
                            Tool::alert("error", $_SESSION['error']);
                            $_SESSION['error'] = null;
                        }
                    } else {
                        if (isset($_GET['sucesso'])) {
                            Tool::alert("success", ["Parabéns, agora você é um mebro da comunicade, faça login abaixo."]);
                            echo "<br />";
                        }
                        ?>

                        <form class="form-signin" method="POST" action="?acao=Login">
                            <h2 class="form-signin-heading">Login</h2>
                            <input type="text" class="form-control" placeholder="E-email" id="login" name="login" value="<?php echo isset($_POST['login']) ? $_POST['login'] : NULL ?>" required autofocus>
                            <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
                        </form>
                        <?php
                        if (isset($_SESSION['error'])) {
                            Tool::alert("error", $_SESSION['error']);
                            $_SESSION['error'] = null;
                        }
                        ?>
                        <p>
                            Ainda não é membro? <a href="?acao=Cadastro">Cadastre-se</a>
                        </p>
                    <?php } ?>
                </div>
                <div class="col-left" id="postagens">
                    <?php
                    echo $this->getRenderView("postagens.php") ?>
                </div>
            </div>
        </div> 

        <script src="bootstrap/dist/js/jquery-1.10.2.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
