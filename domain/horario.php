<?php
  Class Horario {
    private $id;
    private $turno;
    private $turma;
    private $professor;
    private $sala;
    private $tipo;
    
    public function Horario() {
      
    }
    
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getTurno() { return $this->turno; }
    public function setTurno($turno) { $this->turno = $turno; }
    public function getTurma() { return $this->turma; }
    public function setTurma($turma) { $this->turma = $turma; }
    public function getProfessor() { return $this->professor; }
    public function setProfessor($professor) { $this->professor = $professor; }
    public function getSala() { return $this->sala; }
    public function setSala($sala) { $this->sala = $sala; }
    public function getTipo() { return $this->tipo; }
    public function setTipo($tipo) { $this->tipo = $tipo; }
  }
?>