<?php 	

include '../class/class_pedidos.php';

$resPedidos = new pedidos();

$acao_cad = $_POST['acaocad'];

switch ($acao_cad) {
	
		case 'cadastrar_pedido_novo' :
		$produto_descricao = $_POST['produto_descricao'];
		$produto_valor = $_POST['produto_valor'];
		$pedido_data_compra = $_POST['pedido_data_compra'];
		$pedido_id_cliente = $_POST['pedido_id_cliente'];
		$pedido_id_status = $_POST['pedido_id_status'];
		
		$retorno = $resPedidos->cadastrar_pedido($produto_descricao,$produto_valor,$pedido_data_compra,$pedido_id_cliente,$pedido_id_status);
				echo json_encode($retorno);
		break;

		case 'busca_pedidos_cadastrados':
			$retorno = $resPedidos->buscar_pedidos_cadastrados();
			echo json_encode($retorno);
		break;

	} 
	
 



?>