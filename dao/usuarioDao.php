<?php
  Class UsuarioDao {
    private $con;
    
    public function UsuarioDao($conexao) {
      $this->con = $conexao->getCon();
    }
    
    //Função de inserção de novos usuarios
    function insert($usuario){
      $user = array('login'=>$usuario->login,'senha'=>$usuario->senha, 'nome'=>$usuario->nome);                      // setinha de merda '=>'
      $sql = 'INSERT INTO usuario (login, senha, nome) VALUES (:login, :senha, :nome)';
      $this->con->prepare($sql)->execute($user);
      echo '<script>alert("Usuario Adicionado com sucesso!");</script>';
    }
    
    function buscar($usuario){
      try {
        $stmt = $this->con->prepare('SELECT * FROM usuario WHERE login = :login');
        $stmt->execute(array('login' => $usuario->getLogin()));
        
        $linha = null;
        foreach($stmt as $row) {
          $linha = $row;
        }
        
        return $linha;
      } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
      }
    }
    
    function selectLogin($usuario){
      try {
        $stmt = $this->con->prepare('SELECT login, senha FROM usuario WHERE login = :login');
        $stmt->execute(array('login' => $usuario->getLogin()));
     
        foreach($stmt as $row) {
          return $row['senha'];
        }
        
        return false;
      } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
        die('<br><a href="../login.php"><button>Voltar</button></a>');
      }
    }
      
      //return resposta
    function login($usuario) {
      $res = $this->selectLogin($usuario);
      if($res != null && $res == $usuario->getSenha()) {
        return true;
      } else {
        return false;
      }
    }
  }
?>