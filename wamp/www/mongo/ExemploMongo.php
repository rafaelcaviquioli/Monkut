<?php

try {
    $conexao = new MongoClient();
$db = $conexao->primeiroBd;
$baldePessoas = $db->pessoa;

$marcelo = array(
	"nome"=>"Pedrinhoo",
	"cpf"=>"444.444.444",
	"email"=>"paula@univali.br",
	"telefone"=>array(
		"47-1234-1234","48-3333-2222","49-3444-1222"
	),
	"endereco"=>array(
		"rua"=>"rua 1",
		"cidade"=>"Itajai"
	)
);

$baldePessoas->save($marcelo);


$lista = $baldePessoas->find();
echo "<h1>Lista de pessoas</h1>";
foreach($lista as $item){
	var_dump($item);
}


} catch (Exception $ex) {
    echo $ex->getMessage();
}
?>