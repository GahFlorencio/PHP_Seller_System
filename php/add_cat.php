<?php
error_reporting(0);
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
///VALOR POST DO FORMULARIO
$categoria =$_GET['desc'];
$imposto =$_GET['imp'];

///TENTA EXECUTAR A QUERY
	$result = pg_query($conn, "INSERT INTO phpseller_categorias (descricao,imposto) VALUES ('$categoria','$imposto')");
	///VERIFICA STATUS DA EXECUÇÃO
	if($result === false)
	{
		//VERIFICA SE O ERRO É SOBRE DUPLICIDADE
		$erro = substr(pg_last_error($conn),0,53);
		if( $erro = "ERROR: duplicate key value violates unique constrain")
		{
			$status = "ERRO: Categoria já existe !";
			
		}
		else
		{
			$status = "Falha ao cadastrar";
					
		}
		
	}
	else
	{
		$status = "Cadastrado com sucesso !";
		
	}
	

echo $status;
	
pg_close($conn);
?>



