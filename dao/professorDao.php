<?php
  Class ProfessorDao {
    private $con;
    
    public function ProfessorDao($conexao) {
      $this->con = $conexao->getCon();
    }
  
    public function insert($professor){
      try {
        $array = array('nome'=>$professor->getNome());
        $sql = 'SELECT nome FROM professor WHERE nome=:nome';
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
        $array = array('nome'=>$professor->getNome());
        $sql = 'INSERT INTO professor (nome) VALUES (:nome)';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function select(){
      try {
        $stmt = $this->con->prepare('SELECT * FROM professor ORDER BY nome ASC');
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
    
    public function search($professor){
      try{
        $nome = "%".$professor->getNome()."%";
        $array = array('nome'=>$nome);
        $sql = 'SELECT * FROM professor WHERE nome LIKE :nome ORDER BY nome ASC';
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
        $sql = 'DELETE FROM professor WHERE id=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function update($professor){
      try {
        $array = array('nome'=>$professor->getNome());
        $sql = 'SELECT nome FROM professor WHERE nome=:nome';
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
        $array = array('id'=>$professor->getId(), 'nome'=>$professor->getNome());
        $sql = 'UPDATE professor SET nome=:nome WHERE id=:id';
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
      $sql = 'SELECT nome FROM professor WHERE id=:id';
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