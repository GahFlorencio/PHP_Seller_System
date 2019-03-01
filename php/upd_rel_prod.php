
<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
$count = 0;
;///VALOR INSERIDO NO FORMULARIO
$rela = $_GET['rel'];
$qtd = $_GET['qtd'];
$imposto = $_GET['imposto'];
$tt = $_GET['tt'];




///TENTA EXECUTAR A QUERY
	$result = pg_query($conn, "UPDATE phpseller_rel_vend_prod   SET  quantidade='".$qtd."', totalvalor='".$tt."', totalimposto='".$imposto."' WHERE id_rel='".$rela."'");
	
	
	///VERIFICA STATUS DA EXECUÇÃO
	if($result === false)
	{
		$status = "ERRO:Falha ao cadastrar";
	}
	else
	{
		$status = "Cadastrado com sucesso !";
		
	}

	


echo $status;
pg_close($conn);



?>


