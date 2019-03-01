
<?php
///CONFIGURAÇÃO DE CONEXÃO
require("conn.php");
$count = 0;
$status_edit = "";
$tabela = "

 <div class='card mb-3' >
          <div class='card-header'>
            <i class='fas fa-table'></i>
            Vendas Realizadas </div>
          <div class='card-body'>
            <div class='table-responsive'>
              <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                <thead>
                  <tr>
                    <th style = 'width:5%;' >ID</th>
                    <th style = 'width:15%;' >DATA</th>		
					<th style = 'width:55%;'>VALOR</th>					
                    <th style = 'width:5%;' >STATUS</th>
					
                    <th style = 'width:5%;'>EXIBIR</th>
                    <th style = 'width:7%;'>EDIT</th>
					<th style = 'width:5%;'>DEL</th>
                    
                  </tr>
                </thead>
                
                <tbody>";
				                   
			$query = "SELECT * FROM phpseller_vendas order by data desc, id desc";    
		
			
			 $result = pg_query($conn, $query);

			//EXECUTA  SELECT NO BANCO E RETORNA LISTA DE VALORES
			 while($consulta = pg_fetch_assoc($result))
			 {			
				if($consulta['status'] == "Edição/Criação")
				{
					$status_edit ="";
					$status_del ="";
				}
				else
				{
					if($consulta['status'] == "Cancelado")
					{
						$status_edit ="disabled";
						$status_del ="";
					}
					else
					{
						$status_edit ="disabled";
						$status_del ="disabled";
					}
				}
				
				
				 $tabela = $tabela."
				    <tr>
                    <td>".$consulta['id']."</td>
                    <td>".$consulta['data']."</td>	
					<td>".$consulta['valor']."</td>					
                    <td>".$consulta['status']."</td>
					
                    <td>
						<form action = 'phpseller_view_vend.php' method ='POST'>
						<input type='text' value = '".$consulta['id']."' id='id_venda' name='id_venda' hidden>
						<input type='text' value = '".$consulta['data']."' id='data' name='data' hidden>
						<button style = 'width:100%' type='submit' class='btn btn-outline-primary ' >
							<i class='fas fa-eye'></i>
						</button>
						</form>	
					</td>
                    <td>
						<form action = 'phpseller_edit_vend.php' method ='POST'>
						<input type='text' value = '".$consulta['id']."' id='id_venda' name='id_venda' hidden>
						<input type='text' value = '".$consulta['data']."' id='data' name='data' hidden>
						<button style = 'width:100%' type='submit' class='btn btn-outline-warning' $status_edit >
							<i class='fas fa-pencil-alt'></i>
						</button>
						</form>					
					</td>
					<td>
						<form action = '/php/del_venda.php' method ='POST'>
						<input type='text' value = '".$consulta['id']."' id='id_venda' name='id_venda' hidden>
						<input type='text' value = '".$consulta['data']."' id='data' name='data' hidden>
						<button style = 'width:100%' type='submit' class='btn btn-danger' $status_del >
							<i class='fas fa-trash-alt'></i>
						</button>
						</form>					
					</td>                          
                  </tr>";
				
				$count++;
				
			 }
			 
			 if($count == 0 )
			 {
				 echo $tabela;
				 echo "
				 <tr>
                    <td></td>
                    <td>Nenhuma venda encontrada</td>					
                    <td></td>
					<td></td>
                    <td>						
					</td>
                    <td>											
					</td>
                    
                  </tr>
				 ";
				 echo"</tbody>
              </table>
            </div>
          </div>
          <div class='card-footer small text-muted'></div>
        </div>";
			 }
			 else
			 {
				 
		
	
				 
				 echo $tabela;
				 echo"  </tbody>
					  </table>
					</div>
				  </div>
				  <div class='card-footer small text-muted'></div>
				</div>";
				 

			 }
			 

	
pg_close($conn);

?>


