<?php 
require("/php/conn.php");
$totalvalor=0;
$totalimp= 0;
$datacria ="";

$query = "SELECT * FROM phpseller_vendas where id ='".$_POST['id_venda']."'";    
		
			
			 $result = pg_query($conn, $query);

			//EXECUTA  SELECT NO BANCO E RETORNA LISTA DE VALORES
			 while($consulta = pg_fetch_assoc($result))
			 {		
				$totalvalor= $consulta['valor'];
				$totalimp= $consulta['imposto'];
				$datacria  = $consulta['data'];
			 }
			 pg_close($conn);

?> 
<html lang="pt">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>PHP Seller - Vendas Realizadas </title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">PHP Seller</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

   

   

  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="fas fa-cart-plus"></i>
          <span>Vendas</span>
        </a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-box-open"></i>
          <span>Produtos</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="phpseller_cad_prod.html">Cadastro</a>
         
        </div>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <i class="fas fa-list"></i>
          <span>Categorias</span>
        </a>
        <div class="dropdown-menu" aria-labelledby="pagesDropdown">
          <a class="dropdown-item" href="phpseller_cad_cat.html">Cadastro</a>
          
        </div>
      </li>
    </ul>

    <div id="content-wrapper">
	
	<form action="php/upd_venda.php"  method="POST" id="form1">
      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Vendas</a>
          </li>
          <li class="breadcrumb-item active">Edição</li>
        </ol>
		<div class="row" >
			<div class="col-3">
				<button style = "width:100%;  "type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal" onclick="carregaListaProdAddRel();">
					<i class="fas fa-plus-square"></i> Adicionar Produto
				</button>
			</div>
			<div class="col-3">
				<button style = "width:100%;" onclick=" document.getElementById('acao').value='1'; " type="submit" class="btn btn-outline-success">
					<i class="fas fa-save"></i> Salvar Venda
				</button>
			</div>
			 
			<div class="col-3">
				<button style = "width:100%; " type="submit" onclick="document.getElementById('acao').value='2'; " class="btn btn-outline-success">
					<i class="fas fa-money-bill-alt"></i> Finalizar Venda
				</button>
			</div>
			<div class="col-3">
				<button style = "width:100%;  "type="button" onclick="document.getElementById('acao').value='3'; document.getElementById('form1').submit();" class="btn btn-outline-danger">
					<i class="far fa-times-circle"></i> Cancelar Venda
				</button>
			</div>
		</div>
				
					

    
   

  <div class="row" style="margin-top:10px;">

    <div class="col-3">
	  <input  id = "id"  name ="id_venda" type="text" class="form-control" value= "<?php echo $_POST['id_venda'];?>" hidden>
	  <input  id = "acao"  name ="acao" type="text" class="form-control" hidden>
     DATA CRIAÇÃO<input style = "width:100%; " id = "id"  type="date" class="form-control" value= "<?php echo $datacria;?>" readonly>
    </div>
	 <div class="col-4">
     TOTAL DE IMPOSTOS <input style = "width:100%; "  id = "totalimpostos" name = "totalimpostos" value= "<?php if ($totalimp==''){$totalimp = "0.00";} echo $totalimp;?>" Type="text" class="form-control"readonly>
    </div>
	 <div class="col-5">
     VALOR FINAL <input style = "width:100%; " id = "totalvenda"  name = "totalvenda" type="text" value= "<?php   if ($totalvalor==''){$totalvalor = "0.00";} echo $totalvalor; ?>" class="form-control" readonly>
    </div>
  </div>

	
        <!-- DataTables Example -->
        <div style="margin-top:10px;" class="card mb-3">

          <div class="card-header">
            <i class="fas fa-table"></i>
            Produtos
			
			</div>    
          <div class="card-body">
          
				<div id="Resultado" class="table-responsive">
				  
				</div>
		
          </div>
		  </form>

        </div>
      </div>
      <!-- /.container-fluid -->


    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
  
  <!--MODAL ADD PRODUTOS-->
 
<div class="modal" tabindex="-1" role="dialog" id="exampleModal">
  <div class="modal-dialog  modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Seleção de Produtos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  
		<div class="row" style="margin-top:10px;">
    <div class="col">
      BUSCAR: <input style = "width:100%; " id = "pesquisa"  onkeyup="carregaListaProdAddRel();"type="text" class="form-control">
    </div>
  </div>
        <div style = "padding-top:10px;" id="listaprodutos">
			
		</div>
      </div>
      
    </div>
  </div>
</div>

  

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/ajax.js"></script>
  <script src="js/jquery-3.3.1.js"></script>
   <script>
	carregaListaRelVenda();
	carregaListaProdAddRel();
	loadInfoVenda();
	
   </script>
    <script>

	function numero(z){
	v = z.value;
	v=v.replace(/\D/g,"") //permite digitar apenas números
	z.value = v;
	}
	
	
	
	
	function salvarVenda()
	{
		document.getElementById("formularioProdutos").submit();
	}
	
	
	
</script>
    

</body>

</html>
