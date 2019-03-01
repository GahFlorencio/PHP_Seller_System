<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
//PREPARA A QUERY
$query = "SELECT * FROM phpseller_categorias ";

///PREPARA VALOR INICIAL DA LISTA
$lista = "<option value = ''></option>";
			///CRIA QUERY
			 $result = pg_query($conn, $query);

			//EXECUTA  SELECT NO BANCO E RETORNA LISTA DE VALORES
			 while($consulta = pg_fetch_assoc($result))
			 {
				 $lista = $lista."<option value = '".$consulta['id']."'>".$consulta['descricao']."</option>";			
								
			 }
			 echo $lista;
pg_close($conn);
?>



