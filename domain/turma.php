<?php
  Class Turma {
    private $id;
    private $nome;
    private $turno;
    
    public function Turma() {
      
    }
    
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getTurno() { return $this->turno; }
    public function setTurno($turno) { $this->turno = $turno; }
  }
?>