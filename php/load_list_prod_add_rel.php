
<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
$count = 0;
;///VALOR INSERIDO NO FORMULARIO
$pesquisa = $_GET['desc_prod'];
$idvendaform = $_GET['idvenda'];
$tabela="<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                <thead>
				<th style='text-align:center;width:6%;'>ID</th>
				<th style='text-align:center;width:50%;'>PRODUTO</th>
				<th style='text-align:center;width:10%;'>PRECO</th>
				<th style='text-align:center;width:10%;'>IMP.</th>
				<th style='text-align:center;width:20%;'>CAT</th>
				<th style='text-align:center;'>AÇAO</th>			  
                  </tr>
                </thead>
                <tbody>";		



			$query = "SELECT * FROM phpseller_produtos where upper(descricao) like upper('%".$pesquisa."%')";    
		
			
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
				 
				 
				 
				$tabela = $tabela."<tr>
				<td style='text-align:center;'>".$consulta['id']."</td>
				<td>".$consulta['descricao']."</td>
				<td style='text-align:center;'>".$consulta['preco']."</td>
				<td style='text-align:center;'>".$imposto."</td>
				<td >".$categoria."</td>
				<td style='text-align:center;'><button type='button' class='btn btn-outline-primary' onclick='addProdRelVenda(".$consulta['id'].",$idvendaform)' data-dismiss='modal' ><i class='fas fa-plus-square'></i></button></td>
				
				</tr>";
				$count++;
				
			 }
			 
			 echo $tabela;
				 echo"</tbody></table>";
			 

	
pg_close($conn);

?>


