<?php
  Class Usuario {
    private $id;
    private $nome;
    private $login;
    private $senha;
    
    public function Usuario() {
      
    }
    
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }
    public function getNome() { return $this->nome; }
    public function setNome($nome) { $this->nome = $nome; }
    public function getLogin() { return $this->login; }
    public function setLogin($login) { $this->login = $login; }
    public function getSenha() { return $this->senha; }
    public function setSenha($senha) { $this->senha = $senha; }
  }
?>