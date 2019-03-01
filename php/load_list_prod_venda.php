
<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
$idform = $_GET['id'];
$count = 0;
$tabela = "
<table class='table table-bordered' id='dataTable' width='100%' cellspacing='0' onload='calculaVenda();'>
                <thead>
                  <tr>
                    <th style = 'width:1%; vertical-align:middle;' ></th>
                    <th style = 'width:40%; vertical-align:middle;' >PRODUTO</th>					
                    <th style = 'width:15%; vertical-align:middle;'>QTD</th>
					<th style = 'width:5%; vertical-align:middle;'>PREÇO</th>
                    <th style = 'width:20%; vertical-align:middle;'>VALOR</th>
					<th style = 'width:5%; vertical-align:middle;'>IMP</th>
					<th style = 'width:15%; vertical-align:middle;'>TOT IMP.</th>
                    
                  </tr>
                </thead>
                <tbody>";
				                   
			$query = "SELECT * FROM phpseller_rel_vend_prod where id_venda='".$idform."' order by id_rel asc";    
		
			
			 $result = pg_query($conn, $query);

			//EXECUTA  SELECT NO BANCO E RETORNA LISTA DE VALORES
			 while($consulta = pg_fetch_assoc($result))
			 {			
				
				$qtdprod ="";
				if($consulta['quantidade']<>'')
				{
					$qtdprod = "value='".$consulta['quantidade']."'";
				}
				$ttprod ="";
				if($consulta['totalvalor']<>'')
				{
					$ttprod = "value='".$consulta['totalvalor']."'";
				}
				$ttiprod ="";
				if($consulta['totalimposto']<>'')
				{
					$ttiprod = "value='".$consulta['totalimposto']."'";
				}
				 $tabela = $tabela."
				    <tr id = 'linha".$count."'>
					<td><input type='text' value='".$consulta['id_rel']."' id='rel$count' hidden name ='rela[$count]'><button style = 'width:100%;  'type='button' class='btn btn-outline-danger' onclick='deletaProdRelVenda(".$consulta['id_rel'].",".$idform.");'><i class='fas fa-trash-alt'></i></button></td>
                    
                    <td>".$consulta['produto']."</td>					
					<td>
					<input style ='width:100%;' type = 'text' $qtdprod id='qtd".$consulta['id_rel']."' onKeyup='calculoValores(".$consulta['id_rel'].",".$consulta['preco'].",".$consulta['imposto'].");numero(this);' name='qtd[$count]' class='form-control' required ></td>
					<td>".$consulta['preco']."</td>
                    <td> <input style='width:100%;' type='text' $ttprod  name='precoprod[$count]' id='totalv".$consulta['id_rel']."'  class='form-control' readonly ></td>
					<td>".$consulta['imposto']."</td>
					<td><input style ='width:100%; ' type='text' $ttiprod name='imposto[$count]' id ='totalimp".$consulta['id_rel']."' class='form-control' readonly  ></td>	
                             
                  </tr>";
				
				$count++;
				
			 }
			 
			 if($count == 0 )
			 {
				 echo $tabela;
				 echo "<tr id = 'linha".$count."'>
					<td><input type='text' value='' id='rel$count' hidden name =''><button style = 'width:100%;  'type='button' class='btn btn-outline-danger' hidden></td>
                    
                    <td></td>					
					<td>
					<input style ='width:100%;' type = 'text'   name='qtd[$count]' class='form-control' hidden ></td>
					<td></td>
                    <td> <input style='width:100%;' type='text'   name='precoprod[$count]'  class='form-control' hidden ></td>
					<td></td>
					<td><input style ='width:100%;' type='text'  name='imposto[$count]'  class='form-control' hidden  ></td>	
                             
                  </tr>";
				 
				 echo"</tbody></table>";
			 }
			 else
			 {
				 
		
	
				 
				 echo $tabela;
				 echo"</tbody></table>";
				 

			 }
			 

	
pg_close($conn);

?>


