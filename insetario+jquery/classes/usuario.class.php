<?php

	Class Usuario{

		protected $id;
		protected $nome;
		protected $email;
		protected $senha;
		protected $coordenador;

		//Guarda a conexão com o banco e o statement
		private $conn;
		private $stmt;

		// Basic functions

		public function setId($value){
			$this->id = $value;
		}
		public function setNome($value){
			$this->nome = $value;
		}
		public function getNome(){
			return $this->nome;
		}

		public function setEmail($value){
			$this->email = $value;
		}
		public function getEmail(){
			return $this->email;
		}

		public function setSenha($value){
			$this->senha = $value;
		}
		public function getSenha(){
			return $this->senha;
		}

		public function setCoordenador($value){
			$this->coordenador = $value;
		}
		public function getCoordenador(){
			return $this->coordenador;
		}

		// Crud

		public function __construct() {
	        try {
				include_once 'banco.php';
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
	            $sql = " INSERT INTO usuario " .
	                " (nome, email, senha, coordenador) " .
	                " VALUES (:nome, :email, :senha, :coordenador)";
	            
	            //Informa o comando SQL ao statement
	            $this->stmt= $this->conn->prepare($sql);

	            //Adiciona os valores aos parâmetros do statement
	            $this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
	            $this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
	            $this->stmt->bindValue(':senha', $this->senha, PDO::PARAM_STR);
	            $this->stmt->bindValue(':coordenador', $this->coordenador, PDO::PARAM_BOOL);
	            
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
			}
		}

		public function excluir($id){
			try{
				//Comando SQL para excluir uma criança
				$sql = " DELETE FROM usuario " .
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

		public function alterar(){
			try{
				//Comando SQL para inserir uma criança
				$sql = " UPDATE usuario SET " .
					" nome = :nome, email = :email, coordenador = :coordenador " .
					" WHERE id = :id";
				
				//Informa o comando SQL ao statement
				$this->stmt= $this->conn->prepare($sql);
	
				//Adiciona os valores aos parâmetros do statement
				$this->stmt->bindValue(':nome', $this->nome, PDO::PARAM_STR);
				$this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
				$this->stmt->bindValue(':coordenador', $this->coordenador, PDO::PARAM_INT);
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

		public function login(){
			$sql = " SELECT * FROM usuario " .
						" WHERE email LIKE :email".
						" ORDER BY id";	
			//Informa o comando SQL ao statement
			$this->stmt = $this->conn->prepare($sql);
			//Adiciona os valores aos parâmetros do statement 
			$this->stmt->bindValue(':email', $this->email, PDO::PARAM_STR);
			//Executa o comando SQL
			if($this->stmt->execute()){
				$user = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
				if(count($user) >= 1){
					for($i = 0; $i < count($user); $i++){
						if($this->senha == $user[$i]["senha"]){
							session_start();
							$_SESSION['logado'] = true;
							$_SESSION['user']['nome'] = $user[$i]["nome"];
							$_SESSION['user']['email'] = $user[$i]["email"];
							$_SESSION['user']['coordenador'] = $user[$i]["coordenador"];
							return true;
							break;
						}
					}
				}else{
					return false;
				}
			}else{
				return false;
			}        
		}

		public function logout(){
			session_start();
			$_SESSION['logado'] = false;
			$_SESSION['user'] = null;
			header('location: index.php');
		}

		public function getDadosTable(){
			$sql = "SELECT * FROM usuario";
			//Informa o comando SQL ao statement
			$this->stmt = $this->conn->prepare($sql);
			//Executa o comando SQL
			if($this->stmt->execute()){
				$users = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
				return $users;
			}else{
				return false;
			}
		}

		public function selectById($id){
			$sql = " SELECT * FROM usuario " .
						" WHERE id = :id";
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$usuario = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $usuario;
		}

	}

?>