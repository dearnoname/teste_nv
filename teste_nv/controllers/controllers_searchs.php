<?php 	
include '../class/class_pedidos.php';
$resPedidos = new pedidos();
$acao = $_GET['acao'];

switch ($acao) {
	case 'busca_cliente':
		$cliente = $_GET['cliente'];
		$retorno = $resPedidos->busca_clientes($cliente);
		echo json_encode($retorno);
	break;
	case 'busca_pedido':
		$retorno = $resPedidos->busca_status_pedido();
		echo json_encode($retorno);
	break;
	
}

?>