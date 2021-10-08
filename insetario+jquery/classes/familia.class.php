<?php

	Class Familia{

		protected $id;
		protected $id_ordem;
		protected $nome;
		protected $nomeComum;
		protected $caract;
		protected $controle;

		//Guarda a conexão com o banco e o statement
		private $conn;
		private $stmt;

		public function getId(){
			return $this->id;
		}
		public function setId($value){
			$this->id = $value;
		}

		public function setIdOrdem($value){
			$this->id_ordem = $value;
		}
		public function getIdOrdem(){
			return $this->id_ordem;
		}

		public function setNome($value){
			$this->nome = $value;
		}
		public function getNome(){
			return $this->nome;
		}

		public function setNomeComum($value){
			$this->nomeComum = $value;
		}
		public function getNomeComum(){
			return $this->nomeCmum;
		}

		public function setCaract($value){
			$this->caract = $value;
		}
		public function getCaract(){
			return $this->caract;
		}

		public function setControle($value){
			$this->controle = $value;
		}
		public function getControle(){
			return $this->controle;
		}

		// Crud

		public function __construct() {
	        try {
				require 'banco.php';
	            //Cria conexão com o banco
	            $this->conn = new PDO("mysql:host={$database['server']}; dbname={$database['database']}", $database['user'], $database['password']);
	            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	            $this->conn->exec("set names utf8");
	        } catch (PDOException $erro) {
	            //Verifica se houve algum erro de conexão com o banco de dados
	            die ("Erro na conexão: " .$erro->getMessage());            
	        }
    	}

	    public function __destruct(){
	        if(!empty($this->stmt)) $this->stmt = null;
	        if(!empty($this->conn)) $this->conn = null;
	    }

		public function adicionar(){
			try{
				//Comando SQL para inserir uma criança
				$sql = " INSERT INTO familia " .
					" (nome, id_ordem, ncomum, caract, controle) " .
					" VALUES (:nome, :id_ordem, :nomeComum, :caract, :controle)";
				
				//Informa o comando SQL ao statement
				$this->stmt= $this->conn->prepare($sql);
	
				//Adiciona os valores aos parâmetros do statement
				$this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
				$this->stmt->bindValue(':id_ordem', $this->id_ordem, PDO::PARAM_INT);
				$this->stmt->bindValue(':nomeComum', $this->nomeComum, PDO::PARAM_STR);
				$this->stmt->bindValue(':caract', $this->caract, PDO::PARAM_STR);
				$this->stmt->bindValue(':controle', $this->controle, PDO::PARAM_STR);
				
				//Executa o comando SQL
				if($this->stmt->execute()){
					$retorno = true;
				}else{
					$retorno = false;
				}
				return $retorno;
			} catch(PDOException $e) {
				//Caso ocorra um erro 
				echo $e->getMessage();
				die();                 
			}
		}

		public function alterar(){
			try{
				//Comando SQL para inserir uma criança
				$sql = " UPDATE familia SET " .
					" nome = :nome, id_ordem = :id_ordem, ncomum = :nomeComum, caract = :caract, controle = :controle " .
					" WHERE id = :id";
				
				//Informa o comando SQL ao statement
				$this->stmt= $this->conn->prepare($sql);
	
				//Adiciona os valores aos parâmetros do statement
				$this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
				$this->stmt->bindValue(':id_ordem', $this->id_ordem, PDO::PARAM_INT);
				$this->stmt->bindValue(':nomeComum', $this->nomeComum, PDO::PARAM_STR);
				$this->stmt->bindValue(':caract', $this->caract, PDO::PARAM_STR);
				$this->stmt->bindValue(':controle', $this->controle, PDO::PARAM_STR);
				$this->stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
	
				//Executa o comando SQL
				if($this->stmt->execute()){
					$retorno = true;
				}else{
					$retorno = false;
				}
				return $retorno;
			} catch(PDOException $e) {
				//Caso ocorra um erro 
				echo $e->getMessage();
				die();                 
			}
		}

			public function getNomeFamilia($id){
			$sql = " SELECT nome FROM familia " .
						" WHERE id = :id";	
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_STR);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$nome = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					if(count($nome)>=1){
						$nome = $nome[0]['nome'];
						return $nome;
					}else{
						return false;
					}
				}else{
					$retorno = false;
				}        
		}
		public function selectName($name){
			//Comando SQL para pesquisar uma criança
				$sql = " SELECT * FROM familia " .
						" WHERE nome LIKE :nome".
						" OR ncomum LIKE :nome".
						" ORDER BY id";	
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':nome', "%".$name."%", PDO::PARAM_STR);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$familia = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $familia;
		}

		public function selectById($id){
			$sql = " SELECT * FROM familia WHERE id = :id";
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$familia = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $familia;
		}
		
		public function getFamiliasOrdem($id){
			$sql = " SELECT nome, id FROM familia WHERE id_ordem = :id";
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$familia = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $familia;
		}

		public function excluir($id){
			try{
				//Comando SQL para excluir uma criança
				$sql = " DELETE FROM familia " .
					" WHERE id = :id";
	
				//Informa o comando SQL ao statement
				$this->stmt= $this->conn->prepare($sql);
	
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
				
				//Executa o comando SQL
				if($this->stmt->execute()){
					$retorno = true;
				}        
			} catch(PDOException $e) {
				//Caso ocorra um erro 
				echo $e->getMessage();                 
			}
		}

	}

?>