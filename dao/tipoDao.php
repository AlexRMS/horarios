<?php
  Class TipoDao {
    private $con;
    
    public function TipoDao($conexao) {
      $this->con = $conexao->getCon();
    }
    
    public function insert($tipo){
        try {
          $array = array('nome'=>$tipo->getNome());
          $sql = 'SELECT nome FROM tipo WHERE nome=:nome';
          $stmt = $this->con->prepare($sql);
          $stmt->execute($array);
          
          $linha = null;
          foreach($stmt as $row) {
            $linha = $row;
          }
          
          if($linha != null) {
            return false;
          }
        } catch(PDOException $e) {
          return $e->getMessage();
        }
    
        try {
          $array = array('nome'=>$tipo->getNome());
          $sql = 'INSERT INTO tipo (nome) VALUES (:nome)';
          $stmt = $this->con->prepare($sql);
          $stmt->execute($array);
          return true;
        } catch(PDOException $e) {
          return $e->getMessage();
        }
    }
    
    public function select(){
      try {
        $stmt = $this->con->prepare('SELECT * FROM tipo ORDER BY nome ASC');
        $stmt->execute();
        
        $i = 0;
        $linha = null;
        foreach($stmt as $row) {
          $linha[$i] = $row;
          $i++;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
         } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
  
    public function search($tipo){
      try{
        $nome = "%".$tipo->getNome()."%";
        $array = array('nome'=>$nome);
        $sql = 'SELECT * FROM tipo WHERE nome LIKE :nome ORDER BY nome ASC';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        $i = 0;
        $linha = null;
        foreach($stmt as $row) {
          $linha[$i] = $row;
          $i++;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
          } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function exclude($id){
      try {
        $array = array('id'=>$id);
        $sql = 'DELETE FROM tipo WHERE id=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
          } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    public function update($tipo){
      try {
        $array = array('nome'=>$tipo->getNome());
        $sql = 'SELECT nome FROM tipo WHERE nome=:nome';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        if($linha != null) {
          return false;
        }
      } catch(PDOException $e) {
        return $e->getMessage();
      }
      
      try {
        $array = array('id'=>$tipo->getId(), 'nome'=>$tipo->getNome());
        $sql = 'UPDATE tipo SET nome=:nome WHERE id=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    function searchById($id){
      try{
        $array = array('id'=>$id);
        $sql = 'SELECT nome FROM tipo WHERE id=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        return $linha['nome'];
      } catch(PDOException $e) {
        return null;
      }
    }
  }
?>