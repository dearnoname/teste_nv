<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">
    <title>CADASTRO DE CLIENTES</title>
  </head>
 
  <body>
    <?php include 'header.php' ?>
      
    <div class="container-fluid">
      <div class="alinhaFrm">
          <div class="col-sm-5">
          <div class="card">
            <h2 align="center">Cadastrar Cliente</h2>
            <div class="card-body">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="cliente_nome">
              <label for="cliente_nome">Nome Completo</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="cliente_cpf" onkeydown="javascript: fMasc( this, mCPF );">
              <label for="cliente_cpf">CPF</label>
            </div>
            <div class="form-floating mb-3">
              <input type="date" class="form-control" id="cliente_data_nascimento">
              <label for="cliente_data_nascimento">Data De Nascimento</label>
            </div>
             <div class="form-floating mb-3">
              <input type="text" class="form-control" id="cliente_telefone">
              <label for="cliente_telefone">Telefone</label>
            </div>
            <button type="button" id="btn_cadastrar" class="btn btn-primary">Cadastrar</button>
          </div>
        </div>
      </div>
      </div>
    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="../public/js/jquery.js"></script>
  </body>
</html>
<script>
  $( "#btn_cadastrar" ).click(function() {
    cadastrar_cliente();
    
  });

  function cadastrar_cliente(){

        var cliente_nome = $("#cliente_nome").val();
        var cliente_cpf = $("#cliente_cpf").val();
        var cliente_telefone = $("#cliente_telefone").val();
        var cliente_data_nascimento = $("#cliente_data_nascimento").val();

       $.ajax({
                type: "POST",
                url: "../controllers/controllers_clientes_ajax.php",
                datatype: "json",
                data: {acao: "cadastrar_cliente",cliente_nome:cliente_nome,cliente_cpf:cliente_cpf,cliente_telefone:cliente_telefone,cliente_data_nascimento:cliente_data_nascimento},
                success: function (dados) {
                   var msg = [];
                    msg = $.parseJSON(dados);
                    console.log(msg);
                    if (msg == 2 ) {
                      alert('Cadastro Realizado Com Successo');
                      $('#cliente_nome').val('');
                      $('#cliente_cpf').val('');
                      $('#cliente_telefone').val('');
                      $('#cliente_data_nascimento').val('');
                    }else if (msg == 6){
                      alert('Porfavor verifique a data de nascimento');
                      $('#cliente_data_nascimento').blur();
                    }else if (msg == 1){
                      alert('Porfavor verifique o CPF ');
                      $('#cliente_cpf').blur();
                    }else{
                      alert('Porfavor verifique a formatação do CPF ');
                      $('#cliente_cpf').blur();
                    }
                },
                error: function(erro){
                    alert("error no cadastro de clientes");
                    console.log(erro);
                }
            }).always(function() {
                // SEMPRE ENTRA AQUI

            }).fail(function() {
                // CASO A REQUISICAO FALHE
            });
  }


    function fMasc(objeto,mascara) {
    obj=objeto
    masc=mascara
    setTimeout("fMascEx()",1)
    }

    function fMascEx() {
    obj.value=masc(obj.value)
    }

    function mCPF(cpf){
    cpf=cpf.replace(/\D/g,"")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
    cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
    return cpf
    }
</script>