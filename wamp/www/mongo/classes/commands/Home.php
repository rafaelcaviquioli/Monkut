<?php

namespace commands;

class Home extends Command {

    public function execute() {
        $colPostagens = \Connection::getDB()->postagens;
        $this->request['postagens'] = $colPostagens->find()->sort(array('data' => -1));
        
        $content = $this->getRenderView("home.php");
        $this->sendContent($content);
    }

}
