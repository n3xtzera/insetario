<?php

	Class Ordem{

		
		protected $id;
		protected $nome;
		protected $nomeComum;
		protected $caracteristicas;
		protected $controle;

		//Guarda a conexão com o banco e o statement
		private $conn;
		private $stmt;

		// Basic functions

		public function getId(){
			return $this->id;
		}
		public function setId($value){
			$this->id = $value;
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
			return $this->nomeComum;
		}

		public function setCaracteristicas($value){
			$this->caracteristicas = $value;
		}
		public function getCaracteristicas(){
			return $this->caracteristicas;
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
	            $sql = " INSERT INTO ordem " .
	                " (nome, ncomum, caract, controle) " .
	                " VALUES (:nome, :nomeComum, :caracteristicas, :controle)";
	            
	            //Informa o comando SQL ao statement
	            $this->stmt= $this->conn->prepare($sql);

	            //Adiciona os valores aos parâmetros do statement
	            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
	            $this->stmt->bindValue(':nomeComum', $this->nomeComum, PDO::PARAM_STR);
	            $this->stmt->bindValue(':caracteristicas', $this->caracteristicas, PDO::PARAM_STR);
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
				$sql = " UPDATE ordem SET " .
					" nome = :nome, ncomum = :nomeComum, caract = :caract, controle = :controle " .
					" WHERE id = :id";
				
				//Informa o comando SQL ao statement
				$this->stmt= $this->conn->prepare($sql);
	
				//Adiciona os valores aos parâmetros do statement
				$this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
				$this->stmt->bindValue(':nomeComum', $this->nomeComum, PDO::PARAM_STR);
				$this->stmt->bindValue(':caract', $this->caracteristicas, PDO::PARAM_STR);
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


		public function select(){
			try{
				//Comando SQL para pesquisar uma criança
				$sql = " SELECT * FROM ordem " .
						" ORDER BY id";
	
				//Informa o comando SQL ao statement
				$this->stmt= $this->conn->prepare($sql);
			
				//Executa o comando SQL
				if($this->stmt->execute()){
					// Associa cada registro a uma classe Crianca
					// Depois, coloca os resultados em um array
					$criancas = $this->stmt->fetchAll(PDO::FETCH_CLASS,"Ordem");                  
				}            

				//limpa o resultset
				$this->stmt = null;
				//retorno o array com as crianças encontradas
				return $criancas;	
			} catch(PDOException $e) {
				//Caso ocorra um erro 
			}	echo $e->getMessage();                 
		}
		
		public function selectName($name){
			//Comando SQL para pesquisar uma criança
				$sql = " SELECT * FROM ordem " .
						" WHERE nome LIKE :nome".
						" OR ncomum LIKE :nome".
						" ORDER BY id";	
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':nome', "%".$name."%", PDO::PARAM_STR);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$ordem = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $ordem;
		}

		public function selectById($id){
			$sql = " SELECT * FROM ordem " .
						" WHERE id = :id";
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$ordem = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $ordem;
		}

		public function excluir($id){
			try{
				//Comando SQL para excluir uma criança
				$sql = " DELETE FROM ordem " .
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