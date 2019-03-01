
<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
$count = 0;
///VALOR INSERIDO NO FORMULARIO
$prod = $_GET['id_rel'];
$venda = $_GET['id_venda'];


			$query = "Delete  FROM phpseller_rel_vend_prod where id_rel = '$prod' and id_venda='$venda '"; 
			echo $query;
			$result = pg_query($query);
		   
		
			 

	
pg_close($conn);

?>


