<?php 	
include '../class/class_cliente.php';

$resCliente = new cliente();

$acao = $_POST['acao'];

switch ($acao) {
	case 'cadastrar_cliente':
		
		$cliente_nome = $_POST['cliente_nome'];
		$cliente_cpf = $_POST['cliente_cpf'];
		$cliente_telefone = $_POST['cliente_telefone'];
		$cliente_data_nascimento = $_POST['cliente_data_nascimento'];

		$retorno = $resCliente->cadastrar_cliente($cliente_nome,$cliente_cpf,$cliente_telefone,$cliente_data_nascimento);
		echo json_encode($retorno);
	break;
	case 'busca_clientes_cadastrados':
		$retorno = $resCliente->clientes_cadastrados();
		echo json_encode($retorno);
	break;
	
}
?>