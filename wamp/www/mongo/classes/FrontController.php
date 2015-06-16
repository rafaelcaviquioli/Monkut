<?php

/**
 * Classe com o escopo global
 */
class FrontController {

    private $request;
    private $session;
    //Commands staticos.
    static $COMMAND_HOME = "Home";
    static $COMMAND_LOGIN = "Login";
    static $COMMAND_LOGIN_REDIRECT = "LoginRedirect";
    static $COMMAND_ERROR = "Error";
    static $VAR_COMMAND = "acao";
    private $commandsPublic;

    function __construct($request) {
        $this->request = $request;
        $this->commandsPublic = array(self::$COMMAND_LOGIN, self::$COMMAND_LOGIN_REDIRECT, 'Auth', 'Cadastro', null);
    }

    private function getCommand() {
        $command = isset($this->request[self::$VAR_COMMAND]) ? $this->request[self::$VAR_COMMAND] : self::$COMMAND_HOME;

        //Caso o command seja nullo assume-se pagina inicial.
        if (empty($command)) {
            if ($_SESSION["status"]) {
                $command = self::$COMMAND_HOME;
            } else {
                $command = self::$COMMAND_LOGIN;
            }
        }

        return $command;
    }

    public function process() {
        //Se não existir o campo status cria ele com 0
        if (!isset($_SESSION["status"])) {
            $_SESSION["status"] = 0;
        }
        //Verifica se a sessão é nula e o comando é publico. Ou se a sessão está ativa.
        if ((!$_SESSION["status"] && $this->isCommandPublic() || $_SESSION["status"] && !$this->isCommandPublic())) {

            try {
                $refClass = new ReflectionClass("\commands\\" . $this->getCommand());
            } catch (Exception $e) {
                $this->session->getFlashBag()->set('error', $e->getMessage());
                $refClass = new ReflectionClass("\commands\Error");
            }
            //Instancia a classe que foi passada pelo parametro acao, e envia o request e response via construtor
            $insClass = $refClass->newInstance($this->request);

            //Chama metodo execute.
            $execute = $refClass->getMethod("execute");

            //Passa atributos.
            $execute->invokeArgs($insClass, array($this->request));
        } else if ($this->isCommandPublic() && $_SESSION["status"]) {
            //Chama comando Home - Comando publico já está logado.
            $this->setCommand("Home");
            $this->process();
        } else {
            //Chama comando Login
            $this->setCommand("LoginRedirect");
            $this->process();
        }
    }

    private function setCommand($command) {
        $this->request[self::$VAR_COMMAND] = $command;
    }

    private function isCommandPublic() {
        return in_array($this->getCommand(), $this->commandsPublic);
    }

}
