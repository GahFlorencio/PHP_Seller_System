
<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
$count = 0;
///VALOR INSERIDO NO FORMULARIO
$prod = $_GET['id_prod'];
$venda = $_GET['id_venda'];




			$query = "SELECT * FROM phpseller_produtos where id = '$prod'"; 
			
		
			
			 $result2 = pg_query($conn, $query);

			//EXECUTA  SELECT NO BANCO E RETORNA LISTA DE VALORES
			 while($consulta = pg_fetch_assoc($result2))
			 {
				 $querycat = "SELECT * FROM phpseller_categorias where id = '".$consulta['id_categoria']."'";			
				 $resultcat = pg_query($conn, $querycat);
				 //EXECUTA  SELECT NO BANCO E RETORNA LISTA DE VALORES
				while($consultacat = pg_fetch_assoc($resultcat))
				{
					$imposto = $consultacat['imposto'];
					$categoria = $consultacat['descricao'];
					
				}
				 
				 $produto = $consulta['descricao'];
				 $preco = $consulta['preco'];		 
				 
				
			 }
			 
			 ///TENTA EXECUTAR A QUERY
	$result = pg_query($conn, "INSERT INTO phpseller_rel_vend_prod (produto,preco,imposto,categoria,id_venda) VALUES ('$produto','$preco','$imposto','$categoria','$venda')");
	///VERIFICA STATUS DA EXECUÇÃO
	if($result === false)
	{
	$status = "Falha ao cadastrar";
		
		
	} 

	
pg_close($conn);

?>

