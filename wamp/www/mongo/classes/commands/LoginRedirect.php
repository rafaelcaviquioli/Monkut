<?php

namespace commands;

class LoginRedirect extends Command {

    public function execute() {
        $this->session['error'][] = "Você precisa fazer login para acessar esta área.";
        $this->redirect("?acao=Login");
    }

}

