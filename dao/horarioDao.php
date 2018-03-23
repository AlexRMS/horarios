<?php
  Class HorarioDao {
    private $con;
    
    public function HorarioDao($conexao) {
      $this->con = $conexao->getCon();
    }
    
    public function insert($horario){
      try {
        $array = array("turno"=>$horario->getTurno(), "turma"=>$horario->getTurma(),"professor"=>$horario->getProfessor(),"sala"=>$horario->getSala(),"tipo"=>$horario->getTipo());
        $stmt = $this->con->prepare('SELECT id FROM horario WHERE idTurma=:turma AND idProfessor=:professor AND idSala=:sala AND idTipo=:tipo AND turno=:turno');
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
        $array = array('idProfessor'=>$horario->getProfessor(),'idSala'=>$horario->getSala(),'idTipo'=>$horario->getTipo(),'idTurma'=>$horario->getTurma(),'turno'=>$horario->getTurno());
        $sql = 'INSERT INTO horario (idProfessor, idSala, idTipo, idTurma, turno) VALUES (:idProfessor, :idSala, :idTipo, :idTurma, :turno)';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function select(){
      try {
        $stmt = $this->con->prepare('SELECT * FROM horario');
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
    
    public function search($turno){
      try {
        $array = array("turno"=>$turno);
        $stmt = $this->con->prepare('SELECT * FROM horario WHERE turno=:turno');
        $stmt->execute($array);
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function searchByAll($horario){
      try {
        $array = array("turno"=>$horario->getTurno(),"idTurma"=>$horario->getTurma(),"idProfessor"=>$horario->getProfessor(),"idSala"=>$horario->getSala(),"idTipo"=>$horario->getTipo());
        $stmt = $this->con->prepare('SELECT id FROM horario WHERE turno=:turno AND idTurma=:idTurma AND idProfessor=:idProfessor AND idSala=:idSala AND idTipo=:idTipo');
        $stmt->execute($array);
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function searchById($id){
      try {
        $array = array("id"=>$id);
        $stmt = $this->con->prepare('SELECT * FROM horario WHERE id=:id');
        $stmt->execute($array);
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function searchByIdAndTurno($id, $turno){
      try {
        $array = array("id"=>$id,"turno"=>$turno);
        $stmt = $this->con->prepare('SELECT * FROM horario WHERE id=:id AND turno=:turno');
        $stmt->execute($array);
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        if($linha != null) {
          return $linha;
        }
        
        return false;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function update($horario){
      try {
        $array = array('id'=>$horario->getId(),'turno'=>$horario->getTurno(),'idTurma'=>$horario->getTurma(),'idProfessor'=>$horario->getProfessor(),'idSala'=>$horario->getSala(),'idTipo'=>$horario->getTipo());
        $sql = 'UPDATE horario SET idProfessor=:idProfessor, idSala=:idSala, idTipo=:idTipo, idTurma=:idTurma, turno=:turno WHERE id=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
    
    public function exclude($id){
      try {
        $array = array('id'=>$id);
        $sql = 'DELETE FROM horario WHERE id=:id';
        $stmt = $this->con->prepare($sql);
        $stmt->execute($array);
        
        return true;
      } catch(PDOException $e) {
        return $e->getMessage();
      }
    }
  }
?>