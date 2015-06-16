<?php
namespace commands;
class Logout extends Command {

    public function execute() {
        session_destroy();
        
        $this->redirect("?acao=Login");
    }
}
