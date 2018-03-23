<?php
  Class Professor {
    private $id;
    private $nome;
    
    public function Professor() {
      
    }
    
    public function getId() { return $this->id; }//qual?
    public function setId($id) { $this->id = $id; }
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
  }
?>