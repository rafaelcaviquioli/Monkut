<?php

namespace commands;

use \Usuario;

class Login extends Command {

    public function execute() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case self::$GET:
                $colPostagens = \Connection::getDB()->postagens;
                $this->request['postagens'] = $colPostagens->find();

                $this->sendContent($this->getRenderView("login.php"));
                break;
            case self::$POST:
                try {
                    $login = $this->request['login'];
                    $senha = $this->request['senha'];

                    $usuarioAutenticador = new Usuario();
                    $usuario = $usuarioAutenticador->autenticar($login, $senha);
                    //Registra autenticação
                    $_SESSION['status'] = true;
                    $_SESSION['usuario'] = $usuario;

                    $this->redirect("?acao=Home");
                } catch (\ValidationException $e) {
                    $_SESSION['error'][] = $e->getMessage();
                    $content = $this->getRenderView(self::$VIEW_LOGIN);
                    $this->sendContent($content);
                } catch (\Exception $e) {
                    //Joga a mensagem de erro temporariamente na sessão
                    $_SESSION['error'][] = $e->getMessage();

                    //Renderiza a view e lança no response.
                    $content = $this->getRenderView(self::$VIEW_ERROR);
                    $this->sendContent($content);
                }
                break;
        }
    }

}
