<?php 

/**
 * 
 */
class pedidos 
{
	var $conn;
		function conecta()
		{	
			$username = 'root';
			$password = '';
			try {
			  $this->conn = new PDO('mysql:host=localhost;dbname=teste_nv', $username, $password);
			    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch(PDOException $e) {
			    echo 'ERROR: ' . $e->getMessage();
			}
		}

	function busca_clientes($cliente)
	{
		$dados = array();
		$linha = 0;
		$this->conecta();
			$SQL = $this->conn->prepare("SELECT * FROM clientes WHERE cl_nome_completo LIKE '%$cliente%' ");

			$SQL->execute();

			while ($row = $SQL->fetch()) {
				$dados[$linha]['id_cliente']= $row['id_cl'];
				$dados[$linha]['nome_cliente']= $row['cl_nome_completo'];
				$linha++;
			}
		return ($dados);

	}
	function busca_status_pedido()
	{
		$dados = array();
		$linha = 0;
		$this->conecta();
			$SQL = $this->conn->prepare("SELECT * FROM pedido_status ");

			$SQL->execute();

			while ($row = $SQL->fetch()) {
				$dados[$linha]['status_pedido']= $row['pd_descricao'];
				$dados[$linha]['status_id']= $row['id_status'];
				$linha++;
			}
		return ($dados);
	}
	function cadastrar_pedido($produto_descricao,$produto_valor,$pedido_data_compra,$pedido_id_cliente,$pedido_id_status)
	{
		$this->conecta();
		$data_pedido = str_replace("-", "", $pedido_data_compra);

		$SQL =  $this->conn->prepare(
							"INSERT INTO `pedidos`(`pd_produto`, `pd_valor`, `pd_data`, `pd_cliente_id`, `pd_status_id`) 
							VALUES  ('$produto_descricao','$produto_valor','$data_pedido','$pedido_id_cliente','$pedido_id_status');
							");
		$SQL->execute();
		
		/*$SQL_IMG = $this->conn->prepare("SELECT MAX(id_pedido) as pedido_id FROM `pedidos` ");

		$SQL_IMG->execute();

		if ($row = $SQL_IMG->fetch()) {
			$pedido_id = $row['pedido_id'];

			$SQL_INSERT_IMG = $this->conn->prepare("INSERT INTO `pedidos_imagens` ( `pdi_pedido_id`, `pdi_imagen`)
																		 VALUES ('$pedido_id','$path');
																		");
			$SQL_INSERT_IMG->execute();
		}	
		*/
		$msg = 2;

		return ($msg);		
	}

	function buscar_pedidos_cadastrados()
	{
		$this->conecta();
		$dados = array();
		$linha = 0;
		$SQL = $this->conn->prepare("SELECT pd_produto as des_produto, pd_valor as vlr_produto , pd_data as data_pedido , a.cl_nome_completo as nome_cliente , b.pd_descricao as status_pedido FROM pedidos AS c INNER JOIN clientes AS a ON c.pd_cliente_id = a.id_cl INNER JOIN pedido_status AS b ON c.pd_status_id = b.id_status;");
		$SQL->execute();

		while ($row = $SQL->fetch()) {
			$dados[$linha]['produto_descricao'] = $row['des_produto'];
			$dados[$linha]['produto_valor'] = $row['vlr_produto'];
			$dados[$linha]['data_pedido'] = $row['data_pedido'];
			$dados[$linha]['nome_cliente_pedido'] = $row['nome_cliente'];
			$dados[$linha]['pedido_status'] = $row['status_pedido'];
			$linha++;
		}
		return($dados);
	}
}

 ?>