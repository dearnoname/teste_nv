<?php 	

	/**
	 * ESSA CLASS FAZ TUDO SOMENTE PARA CLIENTES
	 */
	class cliente 
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

		/*function teste()
		{
			$this->conecta();
			$teste = $this->conn->prepare("SELECT * FROM pedido_status ");

			$teste->execute();

			while ($row = $teste->fetch()) {
				$id = $row['id_status'];
				echo $id;
			}
			
		}*/

		
		function cadastrar_cliente($cliente_nome,$cliente_cpf,$cliente_telefone,$cliente_data_nascimento)
		{
			
			$this->conecta();
		
			$msg = 0;
			$data_nascimento = str_replace("-", "", $cliente_data_nascimento);
		   
		   	$data_hoje =date('Ymd');

			$SQL_VALIDA = $this->conn->prepare("SELECT * FROM `clientes` WHERE cl_cpf = '$cliente_cpf' ");

			$SQL_VALIDA->execute();

			if ($row = $SQL_VALIDA->fetch()) {
				$VALIDA_CPF = $row['cl_cpf'];
				if ($VALIDA_CPF == $cliente_cpf ) {
					/*DEIXAMOS UM PARA QUANDO ELE EXISTE*/
					$msg = 1;
				}else{
					/*QUANDO VOLTA 3 HOUVE ALGUM ERRO*/
					$msg = 3;
				}

			}
			/*DEIXAMOS ZERO PARA QUANDO ELE NÃO EXISTE NO BANCO*/
			if ($msg == 0){
					
					/*MESMO PASSANDO ZERO VALIDAMOS QUE SEJA UM CPF CORRETO*/
					
					$cpf_valido = $this->validaCPF($cliente_cpf);
					
					/*QUANDO VOLTA 4 NOSSA FUNÇÃO AI SIM ESTA CORRETO PARA MANDAR*/
					
					if($cpf_valido == 4)
					{		
						if ($data_nascimento < $data_hoje) 
						{
							$SQL =  $this->conn->prepare(
							"INSERT INTO `clientes` 
							(`cl_nome_completo`, `cl_cpf`, `cl_telefone`, `cl_status`, `cl_dtnascimento`) 
							 VALUES ('$cliente_nome','$cliente_cpf','$cliente_telefone','1','$cliente_data_nascimento');
							");
							$SQL->execute();
							$msg = 2;
						} else {
							/*VALIDA DATA SIM RETORNA 6 E PORQUE A DATA DE NASCIMENTO E MAIOR */
							$msg = 6;
						}
					}else {
						/*QUANDO VOLTA 3 HOUVE ALGUM ERRO*/
						$msg = 3;
					}	
				}

			return ($msg);
			
		}
		function clientes_cadastrados()
		{
			$this->conecta();
			$dados = array();
			$linha = 0;

			$SQL = $this->conn->prepare("SELECT * FROM clientes");
			$SQL->execute();

			while ($row = $SQL->fetch()) {
				
				$dados[$linha]['cliente_nome'] = $row['cl_nome_completo'];
				$dados[$linha]['cliente_cpf'] = $row['cl_cpf'];
				$dados[$linha]['cliente_telefone'] = $row['cl_telefone'];
				$dados[$linha]['cliente_status'] = $row['cl_status'];
				$dados[$linha]['cliente_data_nascimento'] = $row['cl_dtnascimento'];
				$linha++;
			}

			return ($dados);

		}

		function validaCPF($cpf) { 
		    $valida = 0;
		    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
		    
		    if (strlen($cpf) != 11) {
		    	$valida = 1;
		        return ($valida);
		    }
		    if (preg_match('/(\d)\1{10}/', $cpf)) {
		    	$valida = 2;
		        return ($valida);
		    }
		    for ($t = 9; $t < 11; $t++) {
		        for ($d = 0, $c = 0; $c < $t; $c++) {
		            $d += $cpf[$c] * (($t + 1) - $c);
		        }
		        $d = ((10 * $d) % 11) % 10;
		        if ($cpf[$c] != $d) {
		        	$valida = 3;
		            return ($valida);
		        }
		    }
		    $valida = 4;
		    return ($valida);
		}

		
	}

 ?>