<?php
if (isset($this->request['postagens'])) {
    $postagens = $this->request['postagens'];
    ?>
    <ul id="ul_postagens">
    <?php foreach ($postagens as $postagem) { ?>
            <li>
                <img src="imagens/usuario.jpg" />
                <h4><?php echo $postagem['usuario']; ?></h4>
                <div class="hora"><?php echo \Tool::converteData("Y-m-d H:i:s", "d/m/Y \à\s H:i", $postagem['data']); ?></div>
                <div class="clear"></div>
                <p>
                <?php echo $postagem['conteudo']; ?>
                </p>
        <?php if ($_SESSION['status']) { ?>
                    <div class="opcoes">
                        <a href="#"><i class="glyphicon glyphicon-thumbs-up"></i> Curtir</a>
                        <a href="#"><i class="glyphicon glyphicon-thumbs-down"></i> Não Curti</a>
                        <a href="#"><i class="glyphicon glyphicon-comment"></i> Comentar</a>
                    </div>
        <?php } ?>
                <div class="resumo">
                    <div><?php echo isset($postagem['curtem']) ? count($postagem['curtem']) : 0; ?> Curtiram</div>
                    <div><?php echo isset($postagem['nao_curtem']) ? count($postagem['nao_curtem']) : 0; ?> Não curtiram</div>
                    <div><?php echo isset($postagem['comentarios']) ? count($postagem['comentarios']) : 0; ?> Comentaram</div>
                </div>
                <div class="clear"></div>
                    <?php if (isset($postagem['comentarios']) AND count($postagem['comentarios'])) { ?>
                    <ul class="comentarios">
            <?php foreach ($postagem['comentarios'] as $comentario) { ?>
                            <li class="separador">
                                <img src="imagens/usuario.jpg" />
                                <h4><?php echo $comentario['usuario']; ?></h4>
                                <div class="hora"><?php echo \Tool::converteData("Y-m-d H:i:s", "d/m/Y \à\s H:i", $comentario['data']); ?></div>
                                <div class="clear"></div>
                                <p>
                <?php echo $comentario['descricao']; ?>
                                </p>
                            </li>
                    <?php } ?>
                    </ul>
            <?php } ?>
            </li>
    <?php } ?>
    </ul>
<?php } ?>