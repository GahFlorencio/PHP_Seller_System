<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");

///DATA E HORA 
date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d');
$stsvenda =  "Edição/Criação";

///TENTA EXECUTAR A QUERY
	$result = pg_query($conn, "INSERT INTO phpseller_vendas (data,status) VALUES ('$date','$stsvenda')");
	///VERIFICA STATUS DA EXECUÇÃO
	if($result === false)
	{
		
			$status = "Falha ao iniciar venda";
					
		
		
	}
	else
	{
		$query = "SELECT currval('phpseller_vendas_id_seq') AS lastinsertid;";    

			 $result2 = pg_query($conn, $query);

			//EXECUTA  SELECT NO BANCO E RETORNA LISTA DE VALORES
			 while($consulta = pg_fetch_assoc($result2))
			 {
				$status  = $consulta['lastinsertid'];
				
				echo "<form name ='form' id ='form' action = '../phpseller_edit_vend.php' method='POST'><input type='text' name ='id_venda' id = 'id_venda' value ='$status'><input type='submit' value = 'Enviar'></form>";
				
			 }
			 if(!$result2)
			 {
				 $status ="false";
				echo "<form name ='form' id ='form' action = '/boostrap/' method='POST'><input type='text' name ='status' id = 'status' value ='$status'><input type='submit' value = 'Enviar'></form>";

			 }
			
			 
		
		
	}
	


	
pg_close($conn);

?>



<script>
document.getElementById("form").submit();
</script>


