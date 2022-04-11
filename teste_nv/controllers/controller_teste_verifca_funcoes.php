<?php 	

include '../class/class_cliente.php';

$resCliente = new cliente();

$cliente_nome = 'JOSE ALEJANDRO CASTILLO';
		$cliente_cpf = '706.290.152-01';
		$cliente_telefone = '41999625175';
		$cliente_data_nascimento = '30/08/1993';

$retorno = $resCliente->cadastrar_cliente($cliente_nome,$cliente_cpf,$cliente_telefone,$cliente_data_nascimento);
//$retonor2 = $resCliente->validaCPF($cliente_cpf);
//$retorno3 = $resCliente->validaDataNascimento($cliente_data_nascimento);
echo $retorno;
?>