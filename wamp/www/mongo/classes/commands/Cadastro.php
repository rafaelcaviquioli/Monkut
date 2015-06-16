<?php

namespace commands;

use \Usuario;

class Cadastro extends Command {

    public function execute() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case self::$GET:
                $this->sendContent($this->getRenderView("login.php"));
                break;
            case self::$POST:
                try {
                    $nome = $this->request['nome'];
                    $email = $this->request['email'];
                    $senha = $this->request['senha'];
                    $senhaConfirmacao = $this->request['senhaConfirmacao'];

                    if (empty($email)) {
                        throw new \ValidationException("Preencha o e-mail.");
                    }
                    if (empty($senha)) {
                        throw new \ValidationException("Preencha a senha.");
                    }
                    if ($senhaConfirmacao != $senha) {
                        throw new \ValidationException("As senhas não coincidem.");
                    }
                    $colUsuarios = \Connection::getDB()->usuarios;
                    $colUsuarios->insert(
                            array(
                                'nome' => $nome,
                                'email' => $email,
                                'senha' => $senha
                            )
                    );

                    $this->redirect("?acao=Cadastro&sucesso");
                } catch (\ValidationException $e) {
                    $_SESSION['error'][] = $e->getMessage();
                    $content = $this->getRenderView("login.php");
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
