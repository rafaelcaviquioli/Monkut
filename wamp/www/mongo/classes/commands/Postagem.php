<?php

namespace commands;

class Postagem extends Command {

    public function execute() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case self::$GET:
                $this->sendContent($this->getRenderView("home.php"));
                break;
            case self::$POST:
                try {
                    $conteudo = $this->request['conteudo'];

                    if (empty($conteudo)) {
                        throw new \ValidationException("Preencha o conteúdo da postagem.");
                    }
                    $colPostagens = \Connection::getDB()->postagens;
                    $colPostagens->insert(
                            array(
                                '_id_usuario' => $_SESSION['usuario']['_id'],
                                'usuario' => $_SESSION['usuario']['nome'],
                                'conteudo' => $conteudo,
                                'data' => date('Y-m-d H:i:s')
                            )
                    );

                    $this->redirect("?acao=Home");
                } catch (\ValidationException $e) {
                    $_SESSION['error'][] = $e->getMessage();
                    $this->redirect("?acao=Home");

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
