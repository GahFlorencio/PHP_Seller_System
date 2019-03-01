<?php
///CONEXÃO COM O BANCO DE DADOS PG
$conn = pg_connect("host=localhost port=5432 dbname=postgres user=admin password=root");

//VERIFICA SE CONECTOU COM SUCESSO
if(!$conn){
	echo "Erro ao conectar ao banco";
}


	


?>

