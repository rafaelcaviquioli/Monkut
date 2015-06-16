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

    </head>

    <body>

        <div class="container" id="body">
            <div class="row">
                <header>
                    <img src="imagens/monkut.png" id="logo" />
                    <h4 class="form-signin-heading">
                        Olá, <?php echo $_SESSION['usuario']['nome']; ?> 
                        <a href="?acao=Logout" title="Sair">Sair</a>
                    </h4>
                </header>
                <div class="col-left">
                    <form class="form-signin" method="POST" action="?acao=Postagem">
                        <textarea class="form-control col-sm-12" placeholder="O que você deseja compartilhar?" id="conteudo" name="conteudo" value="<?php echo isset($_POST['conteudo']) ? $_POST['conteudo'] : NULL ?>" autofocus></textarea>
                        <button class="btn btn-lg btn-success btn-block" type="submit">Publicar</button>
                    </form>
                    <?php
                        if (isset($_SESSION['error'])) {
                            Tool::alert("error", $_SESSION['error']);
                            $_SESSION['error'] = null;
                        }
                    ?>
                </div>
                <div class="col-right" id="membros">
                    <h4>Membros</h4>
                </div>
                <div class="col-left" id="postagens">
                    <?php echo $this->getRenderView("postagens.php") ?>
                </div>

            </div>
        </div> 

        <script src="bootstrap/dist/js/jquery-1.10.2.min.js"></script>
        <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>
