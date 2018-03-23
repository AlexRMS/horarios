<?php
  Class TurmaDao {
    private $con;
    
    public function TurmaDao($conexao) {
      $this->con = $conexao->getCon();
    }
    
    public function insert($turma){
      try {
        $array = array('nome'=>$turma->getNome());
        $sql = 'SELECT nome FROM turma WHERE nome=:nome';
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
        $array = array('nome'=>$turma->getNome(), 'turno'=>$turma->getTurno());
        $sql = 'INSERT INTO turma (nome,turno) VALUES (:nome,:turno)';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
      
    public function select(){
      try {
        $stmt = $this->con->prepare('SELECT * FROM turma ORDER BY nome ASC');
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
    
    public function search($turma){
      try{
        $nome = "%".$turma->getNome()."%";
        $array = array('nome'=>$nome);
        $sql = 'SELECT * FROM turma WHERE nome LIKE :nome ORDER BY nome ASC';
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
        $sql = 'DELETE FROM turma WHERE id=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function update($turma){
      try {
        $array = array('nome'=>$turma->getNome(),'turno'=>$turma->getTurno());
        $sql = 'SELECT nome FROM turma WHERE nome=:nome AND turno=:turno';
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
        $array = array('id'=>$turma->getId(), 'nome'=>$turma->getNome(), 'turno'=>$turma->getTurno());
        $sql = 'UPDATE turma SET nome=:nome, turno=:turno WHERE id=:id';
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
        $sql = 'SELECT nome FROM turma WHERE id=:id';
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
    
    function selectByTurno($turno){
      try {
        $array = array('turno'=>$turno);
        $stmt = $this->con->prepare('SELECT * FROM turma WHERE turno=:turno ORDER BY nome ASC');
        $stmt->execute($array);
        
        $i = 0;
        $linha = null;
        foreach($stmt as $row) {
          $linha[$i] = $row;
          $i++;
        }
        
        if($linha != null) return $linha;
        else return false;
        
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
  }
?>