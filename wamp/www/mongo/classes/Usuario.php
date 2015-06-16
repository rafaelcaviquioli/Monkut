<?php

class Usuario {

    //Validação de cadastro.
    protected function validationSave() {
        if (empty($this->login)) {
            throw new ValidationException("Login do usuário não preenchido.");
        } else
        if (empty($this->senha)) {
            throw new ValidationException("Senha do usuário não preenchida.");
        } else {
            return true;
        }
    }

    public function autenticar($loginDigitado, $senhaDigitada) {
        $colUsuarios = Connection::getDB()->usuarios;
        $usuario = $colUsuarios->findOne(array('email' => $loginDigitado, 'senha' => $senhaDigitada));    
        
        if (!is_null($usuario)) {
            //Usuário encontrado
            return $usuario;
        } else {
            throw new ValidationException("Login ou senha inválido.");
        }
    }

    public function alterarSenha($senhaAtual, $novaSenha, $confirmaNovaSenha) {
        if (empty($senhaAtual)) {
            throw new ValidationException('Senha atual não preenchida.', '03');
        }
        if (empty($novaSenha)) {
            throw new ValidationException('Preencha a nova senha', '04');
        }
        if (empty($confirmaNovaSenha)) {
            throw new ValidationException('Preencha confirmação da nova senha', '05');
        }
        if (md5($senhaAtual) == $this->getSenha()) {
            if ($novaSenha == $confirmaNovaSenha) {
                $this->setSenha($novaSenha);
                $this->save();
                return true;
            } else {
                throw new ValidationException('A confirmação da nova senha não confere.', '01');
            }
        } else {
            throw new ValidationException("Senha atual não confere.", '02');
        }
    }

}

?>
