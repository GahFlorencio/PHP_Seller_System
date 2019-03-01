<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
//VENDA
$id_venda = $_POST['id_venda'];

	$result = pg_query($conn, "DELETE FROM phpseller_vendas  WHERE id='".$id_venda."'");

pg_close($conn);
echo "<form name ='form' id ='form' action = '../' method='POST'>
<input type='text' name ='id_venda' id = 'id_venda' value ='$id_venda'>
<input type='submit' value = 'Enviar'>
</form>"

?>


<script>
document.getElementById("form").submit();
</script>