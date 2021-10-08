<?php

	Class Foto{

		private $id;
		private $id_inseto;
		private $foto_nome;
		private $fotografo;
		private $coletor;
		private $local;

		public function setIdInseto($value){
			$this->id_inseto = $value;
		}
		public function getIdInseto(){
			return $this->id_inseto;
		}

		public function setFotoNome($value){
			$this->foto_nome = $value;
		}

		public function setFotografo($value){
			$this->fotografo = $value;
		}
		public function getFotografo(){
			return $this->fotografo;
		}

		public function setColetor($value){
			$this->coletor = $value;
		}
		public function getColetor(){
			return $this->coletor;
		}

		public function setLocal($value){
			$this->local = $value;
		}
		public function getLocal(){
			return $this->local;
		}

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
				$sql = " INSERT INTO foto " .
					" (id_inseto, fotografo, coletor, local_, foto_nome) " .
					" VALUES (:id_inseto, :fotografo, :coletor, :local_, :foto_nome)";
				
				//Informa o comando SQL ao statement
				$this->stmt= $this->conn->prepare($sql);

				//Adiciona os valores aos parâmetros do statement
				$this->stmt->bindValue(':id_inseto', $this->id_inseto, PDO::PARAM_INT);
				$this->stmt->bindValue(':fotografo', $this->fotografo, PDO::PARAM_STR);
				$this->stmt->bindValue(':coletor', $this->coletor, PDO::PARAM_STR);
				$this->stmt->bindValue(':local_', $this->local, PDO::PARAM_STR);
				$this->stmt->bindValue(':foto_nome', $this->foto_nome, PDO::PARAM_STR);
				
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

		public function excluir_u($id){
			try{
				//Comando SQL para excluir uma criança
				$sql = " DELETE FROM foto " .
					" WHERE id_inseto = :id";
	
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

		public function excluir($id){
			try{
				//Comando SQL para excluir uma criança
				$sql = " DELETE FROM foto " .
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

		public function getFotosInseto($id){
			$sql = " SELECT foto_nome, id FROM foto WHERE id_inseto = :id";
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$fotos = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $fotos;
		}

		public function selectById($id){
			$sql = " SELECT * FROM foto " .
					" WHERE id = :id";
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$foto = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $foto;
		}

		public function selectFoto($id){
			$sql = " SELECT * FROM foto " .
					" WHERE id_inseto = :id order by id limit 1";
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$foto = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $foto;
		}
	}	
?>