<?php
  Class SalaDao {
    private $con;
    
    public function SalaDao($conexao) {
      $this->con = $conexao->getCon();
    }
    
    public function insert($sala){
        try {
          $array = array('nome'=>$sala->getNome());
          $sql = 'SELECT nome FROM sala WHERE nome=:nome';
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
          $array = array('nome'=>$sala->getNome());
          $sql = 'INSERT INTO sala (nome) VALUES (:nome)';
          $stmt = $this->con->prepare($sql);
          $stmt->execute($array);
          return true;
        } catch(PDOException $e) {
          return $e->getMessage();
        }
    }
    
      public function select(){
      try {
        $stmt = $this->con->prepare('SELECT * FROM sala ORDER BY nome ASC');
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
    
    public function search($sala){
      try{
        $nome = "%".$nome."%";
        $array = array('nome'=>$sala->getNome());
        $sql = 'SELECT * FROM sala WHERE nome LIKE :nome ORDER BY nome ASC';
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
        $sql = 'DELETE FROM sala WHERE id=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    public function update($sala) {
      try {
        $array = array('nome'=>$sala->getNome());
        $sql = 'SELECT nome FROM sala WHERE nome=:nome';
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
        $array = array('id'=>$sala->getId(), 'nome'=>$sala->getNome());
        $sql = 'UPDATE sala SET nome=:nome WHERE id=:id';
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
        $sql = 'SELECT nome FROM sala WHERE id=:id';
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