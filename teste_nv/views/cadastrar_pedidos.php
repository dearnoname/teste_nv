<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
    <title>CADASTRO DE PEDIDOS</title>
  </head>
 
  <body>
    <?php include 'header.php' ?>
      
    <div class="container-fluid">
      <div class="alinhaFrm">
          <div class="col-sm-5">
          <div class="card">
            <h2 align="center">Cadastrar Pedido</h2>
            <div class="card-body">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="produto_descricao">
              <label for="produto_descricao">Produto</label>
            </div>
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="produto_valor" >
              <label for="produto_valor">Valor</label>
            </div>
            <div class="form-floating mb-3">
              <input type="date" class="form-control" id="pedido_data_compra">
              <label for="pedido_data_compra">Data De Pedido</label>
            </div>
            <div class="form-floating mb-3">
           
              <input class="form-control" list="data_list_cliente" id="pedido_cliente" >
              <datalist id="data_list_cliente" class="listacliente">
                <!--DADOS CARREGADOS A PARTIR DA FUNÇÃO busca_cliente_pedido -->
              </datalist>
               <label for="pedido_cliente" class="form-label">Buscar cliente</label>
             
            </div>
            <div class="form-floating">
              <input class="form-control" list="data_list_status" id="pedido_status" >
              <datalist id="data_list_status" class="listastatus">
                <!--DADOS CARREGADOS A PARTIR DA FUNÇÃO busca_status_pedido -->
              </datalist>
               <label for="pedido_status" class="form-label">Status pedido</label>
            </div>
            <button type="button" id="btn_cadastrar_pedido" class="btn btn-primary">Cadastrar</button>
          </div>
        </div>
      </div>
      </div>
    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" ></script>
    <script src="../public/js/jquery.js"></script>
  </body>
</html>
<script>

  $( document ).ready(function() {
    busca_cliente_pedido();
    busca_status_pedido();
    
  });

  $( "#btn_cadastrar_pedido" ).click(function() {
    cadastrar_pedido();
    
  });
  
  function busca_cliente_pedido(){

    $("#pedido_cliente").on('input',function() {

          var searchText = $(this).val();

          $.ajax({
            type: "GET",
            data: {acao:'busca_cliente', cliente:searchText },
            url: "../controllers/controllers_searchs.php",
            success: function(data) {
               var result = [];
                    result = $.parseJSON(data);
                
                var html = '';


             if (result.length != 0) {
                
                  for (var cli in result) 
                  {
                      html +='<option class="pedido_nome_aux" id="'+result[cli]['id_cliente']+'" value="'+result[cli]['nome_cliente']+'"></option>';
                  }
                
                  $("#data_list_cliente").html(html);
                  
            }else{
              $("#data_list_cliente").html('SEM DADOS');
            }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console.log(xhr.responseText);
            }
          });
        });
      
  }
  function busca_status_pedido(){

    $("#pedido_status").on('input',function() {

          $.ajax({
            type: "GET",
            data: {acao:'busca_pedido' },
            url: "../controllers/controllers_searchs.php",
            success: function(data) {
               var result = [];
                    result = $.parseJSON(data);
                
                var html = '';

                
             if (result.length != 0) {
                
                  for (var cli in result) 
                  {
                      html +='<option class="pedido_status_aux" id="'+result[cli]['status_id']+'" value="'+result[cli]['status_pedido']+'"><a></></option>';
                  }
                
                  $("#data_list_status").html(html);
                  
            }else{
              $("#data_list_status").html('SEM DADOS');
            }
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
              console.log(xhr.responseText);
            }
          });
        });
      
  }

  function cadastrar_pedido(){

      var pedido_id_cliente = 0;
      var pedido_id_status = 0;
      var produto_descricao = $("#produto_descricao").val();
      var produto_valor = $("#produto_valor").val();
      var pedido_data_compra = $("#pedido_data_compra").val();
      var cliente_pedido = $('#pedido_cliente').val();
      var status_pedido = $('#pedido_status').val();
      pedido_id_cliente= $('#data_list_cliente').find('option[value="' +cliente_pedido+ '"]').attr('id');
      pedido_id_status= $('#data_list_status').find('option[value="' +status_pedido+ '"]').attr('id');
     
  
       $.ajax({
              type: "POST",
              url: "../controllers/controllers_pedidos_ajax.php",
              datatype: "json",
              data: {acaocad: "cadastrar_pedido_novo",produto_descricao:produto_descricao,produto_valor:produto_valor,pedido_data_compra:pedido_data_compra,pedido_id_cliente:pedido_id_cliente,pedido_id_status:pedido_id_status},
              success: function (dados) {
                var msg = [];
                msg = $.parseJSON(dados);
                    console.log(msg);
                    if (msg == 2 ) {
                      alert('Cadastro Realizado Com Successo');
                    
                    }
                },
                error: function(erro){
                    alert("error no cadastro de pedidos");
                    console.log(erro);
                }
            }).always(function() {
                // SEMPRE ENTRA AQUI

            }).fail(function() {
                // CASO A REQUISICAO FALHE
            });
  }


   
</script>