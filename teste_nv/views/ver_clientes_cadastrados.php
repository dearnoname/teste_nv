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
      			<th>NOME CLIENTE</th>
      			<th>CPF CLIENTE</th>
      			<th>TELEFONE CLIENTE</th>
      			<th>DATA DE NASCIMENTO</th>
      			<th>STATUS CLIENTE</th>
      		</thead>
      		<tbody id="lista_clientes_cadastrados">
      			
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
    busca_clientes();
   
    
  });

	 function busca_clientes(){
          $.ajax({
            type: "POST",
            data: {acao:'busca_clientes_cadastrados'},
            url: "../controllers/controllers_clientes_ajax.php",
            success: function(data) {
               var result = [];
                    result = $.parseJSON(data);
               var html = '';


             if (result.length != 0) {
                  html +='<tr>';
                  for (var cli in result) 
                  {
                    	html +='<td>'+result[cli]['cliente_nome']+'</td>';
                    	html +='<td>'+result[cli]['cliente_cpf']+'</td>';
                    	html +='<td>'+result[cli]['cliente_telefone']+'</td>';
						html +='<td>'+result[cli]['cliente_data_nascimento']+'</td>';
						if (result[cli]['cliente_status'] == '1') {
							html +='<td>ATIVO</td>';
						}else {
							html +='<td>INATIVO</td>';
						}
						

                  }
                  html +='</tr>';
                
                  $("#lista_clientes_cadastrados").html(html);
                  
            }else{
              $("#lista_clientes_cadastrados").html('SEM DADOS');
            }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console.log(xhr.responseText);
            }
          });
       
      
  }
</script>