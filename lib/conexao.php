<?php
    Class Conexao {
        // private $host = "10.1.118.209:8081";
        private $host = "localhost";
        private $db = "spd";
        private $user = "root";
        private $pass = "";
        
        private $con;
        
        public function Conexao() {
            $this->con = new PDO("mysql:host=". $this->host . ";dbname=" . $this->db,$this->user,$this->pass) or print (mysql_error());
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        public function getCon() {
            return $this->con;
        }
        
        public function setCon($con) {
            $this->con = $con;
        }
    }
?>