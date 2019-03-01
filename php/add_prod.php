<?php
error_reporting(0);
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");

///VALOR INSERIDO NO FORMULARIO
$produto =$_GET['desc'];
$preco =$_GET['preco'];
$cat = $_GET['cat'];


///TENTA EXECUTAR A QUERY
	$result = pg_query($conn, "INSERT INTO phpseller_produtos (descricao,preco,id_categoria) VALUES ('$produto','$preco','$cat')");
	///VERIFICA STATUS DA EXECUÇÃO
	if($result === false)
	{
		//VERIFICA SE O ERRO É SOBRE DUPLICIDADE
		$erro = substr(pg_last_error($conn),0,53);
		if( $erro = "ERROR: duplicate key value violates unique constrain")
		{
			$status = "ERRO: Produto já existe !";
			
		}
		else
		{
			$status = "ERRO:Falha ao cadastrar";
					
		}
		
	}
	else
	{
		$status = "Cadastrado com sucesso !";
		
	}
	


echo $status;
pg_close($conn);
?>



