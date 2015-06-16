<?php

namespace commands;

use \Exception;

abstract class Command {

    static $VIEW_HOME = "home.php";
    static $VIEW_BASE = "base.php";
    static $VIEW_LOGIN = "login.php";
    static $VIEW_ERROR = "error.php";
    static $DIR_VIEWS = "views/";
    //Altera informação
    static $POST = "POST";
    //Solicita informação
    static $GET = "GET";
    //Deleta informação
    static $DELETE = "DELETE";
    static $PUT = "PUT";
    //Cria informação

    protected $request;
    protected $session;

    function __construct($request) {
        $this->request = $request;
    }

    public function execute() {
        
    }

    protected function redirect($destino) {
        header("location: $destino");
        die();
    }

    protected function sendContent($content) {
        die($content);
    }

    public function getRenderView($view) {

        //Verifica se a view existe.
        if (!file_exists(self::$DIR_VIEWS . $view)) {
            throw new Exception("A view " . $view . " não está disponível.");
        }

        ob_start();

        //Disponibiliza request e response em variaveis para ficar de alcance da view.
        $request = $this->request;

        //Inclui a view.
        include(self::$DIR_VIEWS . $view);

        //Captura todo conteudo que iria para o navegador desde a instancia da funcao ob_start até ob_get_contente.
        $content = ob_get_contents();

        //Limpa buffer.
        ob_end_clean();

        return $content;
    }

    public function getRenderViewInBase($view) {
        //Joga a view no request para view base pegar.
        $this->request['viewContainer'] =  $view;

        //Chama view base;
        return $this->getRenderView(self::$VIEW_BASE);
    }

//    public function redirect($url) {
//        //Joga a url no request para view base pegar.
//        $this->request->query->set('urlRedirect', $url);
//
//        //Chama view responsavel
//        return $this->getRenderView("redirecionar");
//    }

}

?>
