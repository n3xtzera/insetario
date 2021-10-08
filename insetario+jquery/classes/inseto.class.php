<?php

Class Inseto{

    protected $id;
    protected $id_familia;
    protected $nomeCientifico;
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

    public function setIdFamilia($value){
        $this->id_familia = $value;
    }
    public function getIdFamilia(){
        return $this->id_familia;
    }

    public function setNomeCientifico($value){
        $this->nomeCientifico = $value;
    }
    public function getNomeCientifico(){
        return $this->nomeCientifico;
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
            $sql = " INSERT INTO inseto " .
                " (nomeCientifico, id_familia, ncomum, caract, controle) " .
                " VALUES (:nomeCientifico, :id_familia, :nomeComum, :caract, :controle)";
            
            //Informa o comando SQL ao statement
            $this->stmt= $this->conn->prepare($sql);

            //Adiciona os valores aos parâmetros do statement
            $this->stmt->bindValue(':nomeCientifico', $this->nomeCientifico, PDO::PARAM_STR);
            $this->stmt->bindValue(':id_familia', $this->id_familia, PDO::PARAM_INT);
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
            $sql = " UPDATE inseto SET " .
                " nomeCientifico = :nomeCientifico, id_familia = :id_familia, ncomum = :nomeComum, caract = :caract, controle = :controle " .
                " WHERE id = :id";
            
            //Informa o comando SQL ao statement
            $this->stmt= $this->conn->prepare($sql);

            //Adiciona os valores aos parâmetros do statement
            $this->stmt->bindValue(':nomeCientifico', $this->nomeCientifico, PDO::PARAM_STR);
            $this->stmt->bindValue(':id_familia', $this->id_familia, PDO::PARAM_INT);
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

    public function selectName($name){
        //Comando SQL para pesquisar uma criança
            $sql = " SELECT * FROM inseto " .
                    " WHERE nomeCientifico LIKE :nome".
                    " OR ncomum LIKE :nome".
                    " ORDER BY id";	
            //Informa o comando SQL ao statement
            $this->stmt = $this->conn->prepare($sql);
            //Adiciona os valores aos parâmetros do statement 
            $this->stmt->bindValue(':nome', "%".$name."%", PDO::PARAM_STR);
            //Executa o comando SQL
            if($this->stmt->execute()){
                $inseto = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
                $retorno = true;
            }else{
                $retorno = false;
            }        
            return $inseto;
    }

    public function selectById($id){
        $sql = " SELECT * FROM inseto " .
                    " WHERE id = :id";
            //Informa o comando SQL ao statement
            $this->stmt = $this->conn->prepare($sql);
            //Adiciona os valores aos parâmetros do statement 
            $this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
            //Executa o comando SQL
            if($this->stmt->execute()){
                $inseto = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
                $retorno = true;
            }else{
                $retorno = false;
            }        
            return $inseto;
    }

    public function getInsetosFamilia($id){
        $sql = " SELECT nomeCientifico, id FROM inseto WHERE id_familia = :id";
				//Informa o comando SQL ao statement
				$this->stmt = $this->conn->prepare($sql);
				//Adiciona os valores aos parâmetros do statement 
				$this->stmt->bindValue(':id', $id, PDO::PARAM_INT);
				//Executa o comando SQL
				if($this->stmt->execute()){
					$inseto = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
					$retorno = true;
				}else{
					$retorno = false;
				}        
				return $inseto;
    }


    public function excluir($id){
        try{
            //Comando SQL para excluir uma criança
            $sql = " DELETE FROM inseto " .
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