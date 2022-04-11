<!DOCTYPE html>
<html>
<head>
	  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
	<title>Ver Clientes Cadastrados</title>
</head>
<body>
<?php include 'header.php' ?>
	<div class="container-fluid">
      <div class="alinhaFrm">
      	<table class="table table-bordered">
      		<thead>
      			<th>DESCRIÇÃO DO PRODUTO</th>
      			<th>VALOR PEDIDO</th>
      			<th>DATA PEDIDO</th>
      			<th>CLIENTE</th>
      			<th>STATUS PEDIDO</th>
      		</thead>
      		<tbody id="lista_pedidos_cadastrados">
      			
      		</tbody>
      	</table>
      </div>
    </div>
 	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="../public/js/jquery.js"></script>
</body>
</html>
<script type="text/javascript">
	$( document ).ready(function() {
    busca_pedidos();
  });

	 function busca_pedidos(){
          $.ajax({
            type: "POST",
            data: {acaocad:'busca_pedidos_cadastrados'},
            url: "../controllers/controllers_pedidos_ajax.php",
            success: function(data) {
               var result = [];
                    result = $.parseJSON(data);
               var html = '';


             if (result.length != 0) {
                  html +='<tr>';
                  for (var cli in result) 
                  {
                    
                    	html +='<td>'+result[cli]['produto_descricao']+'</td>';
                    	html +='<td>'+result[cli]['produto_valor']+'</td>';
                    	html +='<td>'+result[cli]['data_pedido']+'</td>';
          						html +='<td>'+result[cli]['nome_cliente_pedido']+'</td>';
          						html +='<td>'+result[cli]['pedido_status']+'</td>';

                  }
                  html +='</tr>';
                
                  $("#lista_pedidos_cadastrados").html(html);
                  
            }else{
              $("#lista_pedidos_cadastrados").html('SEM DADOS');
            }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console.log(xhr.responseText);
            }
          });
       
      
  }
</script>