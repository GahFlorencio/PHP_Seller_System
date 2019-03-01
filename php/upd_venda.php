<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
//PRODUTO
$rela = $_POST['rela'];
$qtd = $_POST['qtd'];
$preco = $_POST['precoprod'];
$imposto = $_POST['imposto'];
///venda
$ttv = $_POST['totalvenda'];
$tti = $_POST['totalimpostos'];
$id_venda = $_POST['id_venda'];
///ACAO
$acao = $_POST['acao'];


//QUANTIDADE DE LINHAS
$linhas = count($rela);
$cont = 0;

while ($linhas> $cont)
{
	///TENTA EXECUTAR A QUERY
	$result = pg_query($conn, "UPDATE phpseller_rel_vend_prod   SET  quantidade='".$qtd[$cont]."', totalvalor='".$preco[$cont]."', totalimposto='".$imposto[$cont]."' WHERE id_rel='".$rela[$cont]."'");
	$cont++;
}
$status = "";
if($acao == 1)
{
	$status = "Edição/Criação";
	echo "<form name ='form' id ='form' action = '../phpseller_edit_vend.php' method='POST'><input type='text' name ='id_venda' id = 'id_venda' value ='$id_venda' hidden><input type='submit' value = 'Enviar' hidden></form>";
}
else
{
	
	if($acao == 2)
	{
		$status = "Finalizado";
		echo "<form name ='form' id ='form' action = '../' method='POST'><input type='text' name ='id_venda' id = 'id_venda' value ='$id_venda'><input type='submit' value = 'Enviar'></form>";

	}
	else
	{
		$status = "Cancelado";
		echo "<form name ='form' id ='form' action = '../' method='POST'><input type='text' name ='id_venda' id = 'id_venda' value ='$id_venda'><input type='submit' value = 'Enviar'></form>";

	}
	
}
	$result = pg_query($conn, "UPDATE phpseller_vendas SET  status = '".$status."', imposto='".$tti."', valor='".$ttv."' WHERE id='".$id_venda."'");

pg_close($conn);


?>


<script>
document.getElementById("form").submit();
</script>