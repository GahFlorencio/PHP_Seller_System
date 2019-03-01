//Função para criar um objeto XMLHTTPRequest
 function CriaRequest() {
     try{
         request = new XMLHttpRequest();        
     }catch (IEAtual){
          
         try{
             request = new ActiveXObject("Msxml2.XMLHTTP");       
         }catch(IEAntigo){
          
             try{
                 request = new ActiveXObject("Microsoft.XMLHTTP");          
             }catch(falha){
                 request = false;
             }
         }
     }
      
     if (!request) 
         alert("Seu Navegador não suporta Ajax!");
     else
         return request;
 }
  
 //CARREGA LISTA DE PRODUTOS DENTRO DA VENDA
 function carregaListaRelVenda() {
      
    
     var idvendaform = document.getElementById("id").value;
	 var result = document.getElementById("Resultado");
     var xmlreq = CriaRequest();     
      
     
    xmlreq.open("GET", "/php/load_list_prod_venda.php?id="+idvendaform, true);
      
     
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 }
 
 
  function carregaListaRelVendaView() {
      
    
     var idvendaform = document.getElementById("id").value;
	 var result = document.getElementById("Resultado");
     var xmlreq = CriaRequest();     
      
     
    xmlreq.open("GET", "/php/load_list_prod_venda_view.php?id="+idvendaform, true);
      
     
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 }
 
  //CARREGA LISTA DE PRODUTOS PARA ADICIONAR NA VENDA
 function carregaListaProdAddRel() {
      
    
     var idvendaform = document.getElementById("id").value;
	 var pesquisa = document.getElementById("pesquisa").value;
	 var result = document.getElementById("listaprodutos");
     var xmlreq = CriaRequest();     
      
     
    xmlreq.open("GET", "/php/load_list_prod_add_rel.php?desc_prod="+pesquisa+"&idvenda="+idvendaform, true);
      
     
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
 }
 
 //CARREGA LISTA DE PRODUTOS DENTRO DA VENDA COMPARAMETRO
  function carregaListaRelVendaOrientado(idvendaform) {
      
    
    
	 var result = document.getElementById("Resultado");
     var xmlreq = CriaRequest();     
      
     
    xmlreq.open("GET", "/php/load_list_prod_venda.php?id="+idvendaform, true);
      
     
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
     xmlreq.send(null);
	 
	
 }
 
 //ADICIONA PRODUTO NA RELAÇÃO DE VENDA
  function addProdRelVenda(prod,venda) {
      
	 
     var xmlreq = CriaRequest();     
      
     
    xmlreq.open("GET", "/php/add_rel_prod.php?id_prod="+prod+"&id_venda="+venda, true);
      
     
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                carregaListaRelVendaOrientado(venda);
             }else{
                
             }
         }
     };
     xmlreq.send(null);
 }
 
 
  //ATUALIZA LISTA DE RELAÇÃO DE  PRODUTO DA VENDA
  function atualizaRelVenda(rel,qtd,imposto,tt) {
      
	
	 
     var xmlreq = CriaRequest();     
      
     
    xmlreq.open("GET", "/php/upd_rel_prod.php?rel="+rel+"&qtd="+qtd+"&imposto="+imposto+"&tt="+tt, true);
      
     
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                carregaListaRelVenda();
             }else{
                
             }
         }
     };
     xmlreq.send(null);
 }
 
 //ATUALIZA VALORES TOTAIS DA VENDA
  function atualizaVenda(tt,imposto,venda) {
      
	 
     var xmlreq = CriaRequest();     
      
     
    xmlreq.open("GET", "/boostrap/php/updt_venda_tt.php?tt="+tt+"&imposto="+imposto+"&venda="+venda, true);
      
     
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                carregaListaRelVenda();
             }else{
                
             }
         }
     };
     xmlreq.send(null);
 }
 
 //DELETA PRODUTO DA RELAÇÃO DA VENDA REFERENCIADA
  function deletaProdRelVenda(id_rel,id_venda) {			

   
	 ////CRIA UMA REQUISIÇÃO XML
     var xmlreq = CriaRequest();
	     
	// CRIA REQUISIÇÃO GET PARA O PHP
     xmlreq.open("GET", "/php/del_rel_prod.php?id_rel="+id_rel+"&id_venda="+id_venda, true);
      
     //TRATA RESULTADO RETORNADO PELO PHP
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 carregaListaRelVendaOrientado(id_venda);
             }else{
                 
             }
         }
     };
	 //ENVIA REQUISIÇAO PARA O PHP
     xmlreq.send(null);
	 
 }
 
 //CADASTRA UM NOVO PRODUTO
 function addProd() {			

    //PEGA VALORES DO FORMULÁRIO
     var desc   = document.getElementById("desc").value;
	 var preco   = document.getElementById("preco").value;
	 var cat   = document.getElementById("cat").value;
	////DEFINE ELEMENTO QUE VAI SER POPULADO COM O RESULTADO
	 var result = document.getElementById("Resultado");
	 ////CRIA UMA REQUISIÇÃO XML
     var xmlreq = CriaRequest();
	     
	// CRIA REQUISIÇÃO POST PARA O PHP
     xmlreq.open("GET", "/php/add_prod.php?desc="+desc+"&preco="+preco+"&cat="+cat, true);
      
     //TRATA RESULTADO RETORNADO PELO PHP
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
	 //ENVIA REQUISIÇAO PARA O PHP
     xmlreq.send(null);
 }
 
 //CADASTRO UMA NOVA CATEGORIA
 function addCat() {
	 
	 
			

    //PEGA VALORES DO FORMULÁRIO
     var desc   = document.getElementById("desc").value;
	 var imp   = document.getElementById("imp").value;
	////DEFINE ELEMENTO QUE VAI SER POPULADO COM O RESULTADO
	 var result = document.getElementById("Resultado");
	 ////CRIA UMA REQUISIÇÃO XML
     var xmlreq = CriaRequest();
	     
	// CRIA REQUISIÇÃO POST PARA O PHP
     xmlreq.open("GET", "/php/add_cat.php?desc="+desc+"&imp="+imp, true);
      
     //TRATA RESULTADO RETORNADO PELO PHP
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
	 //ENVIA REQUISIÇAO PARA O PHP
     xmlreq.send(null);
 }
 
 //CARREGA LISTA DE CATEGORIAS NO SELECT DA TELA DE CADASTRO DE PRODUTO
  function carregaListaCat() {
	  

	////DEFINE ELEMENTO QUE VAI SER POPULADO COM O RESULTADO
	 var result = document.getElementById("cat");
	 ////CRIA UMA REQUISIÇÃO XML
     var xmlreq = CriaRequest();
	     
	// CRIA REQUISIÇÃO POST PARA O PHP
     xmlreq.open("GET", "/php/load_list_cat.php", true);
      
     //TRATA RESULTADO RETORNADO PELO PHP
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
				 
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
	 //ENVIA REQUISIÇAO PARA O PHP
     xmlreq.send(null);
 }

//CARREGA LISTA DE VENDA NA PAGINA HOME 
function carregaListaVendaHome() {
	  
	
	////DEFINE ELEMENTO QUE VAI SER POPULADO COM O RESULTADO
	 var result = document.getElementById("Resultado");
	 ////CRIA UMA REQUISIÇÃO XML
     var xmlreq = CriaRequest();
	     
	// CRIA REQUISIÇÃO POST PARA O PHP
     xmlreq.open("GET", "/php/load_list_vend_home.php", true);
      
     //TRATA RESULTADO RETORNADO PELO PHP
     xmlreq.onreadystatechange = function(){
          
         // Verifica se foi concluído com sucesso e a conexão fechada (readyState=4)
         if (xmlreq.readyState == 4) {
              
             // Verifica se o arquivo foi encontrado com sucesso
             if (xmlreq.status == 200) {
                 result.innerHTML = xmlreq.responseText;
				 
             }else{
                 result.innerHTML = "Erro: " + xmlreq.statusText;
             }
         }
     };
	 //ENVIA REQUISIÇAO PARA O PHP
     xmlreq.send(null);
 }
 
 

 //CONVERTE VALORES EM DECIMAL
 function converter(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.length,
    h = 0; h < u && ("0" == a.charAt(h) || a.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.charAt(h)) && (l += a.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a = ""),
    1 == u && (a = "0" + r + "0" + l),
    2 == u && (a = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a += ajd2.charAt(h);
        a += r + l.substr(u - 2, u)
    }
   
 }
 
//CALCULA VALORES IMP E TOTAL DE VENDA
function calculoValores(rel,prec,imp){
	
var qtd = document.getElementById("qtd"+rel).value;	
var ttpreco =  qtd*prec;
var ttimp =(imp/100)*ttpreco;


document.getElementById('totalv'+rel).value=ttpreco.toFixed(2);
document.getElementById('totalimp'+rel).value=ttimp.toFixed(2);
var ttv = (ttpreco.toFixed(2));
var tti = (ttimp.toFixed(2));

calculaVenda()

}
 
//CALCULA TOTAL DO VALOR DA VENDA E TOTAL DO VALOR DE IMPOSTOS
 function calculaVenda()
{
	
	var cont = 0 ;
	var valores = [];
	var tabela = document.getElementById('dataTable');
	var id_venda = document.getElementById('id').value;
	var linhas = tabela.getElementsByTagName('tr');
	var linhas = (linhas.length)-1;	
	var totalvalor=0;
	var totalimposto=0;
	
	while(linhas > cont)
	{
		var linha = document.getElementById('linha'+cont);
		var colunas = linha.getElementsByTagName('td');
		
		var id_rel = document.getElementById('rel'+cont).value;
		
		var qtd =  document.getElementById('qtd'+id_rel).value;
		var ttv =  document.getElementById('totalv'+id_rel).value;
		var tti =  document.getElementById('totalimp'+id_rel).value;
		

		
		
		
		totalvalor = 1*(totalvalor)+1*(ttv);
		totalimposto = 1*(totalimposto)+1*(tti);
		cont++;		
		
	}  
	
	
	
	document.getElementById('totalimpostos').value = (totalimposto.toFixed(2));
	document.getElementById('totalvenda').value = (totalvalor.toFixed(2));
	
	
}



 
